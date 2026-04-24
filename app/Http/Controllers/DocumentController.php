<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DocumentController extends Controller
{
    public function landing()
    {
        return view('landing');
    }

    public function index()
    {
        return view('home', ['docType' => 'Quotation']);
    }

    public function invoice()
    {
        return view('home', ['docType' => 'Invoice']);
    }

    public function receipt()
    {
        return view('home', ['docType' => 'Receipt']);
    }

    public function generate(Request $request)
    {
        // Custom validation messages
        $messages = [
            'bank_name_other.required_if' => 'Please specify your bank name when selecting "Other".',
            'mobile_phone_no.required_if' => 'Mobile phone number is required when a network provider is selected.',
        ];

        $validated = $request->validate([
            'doc_type' => 'required|in:Quotation,Invoice,Receipt',
            'template' => 'nullable|in:1,2,3',
            'logo' => 'nullable|image|max:2048',
            'seller_name' => 'required|string|max:255',
            'seller_tpin' => 'nullable|string|max:100',
            'seller_pacra' => 'nullable|string|max:100',
            'seller_phone' => 'required|string|max:50',
            'seller_address' => 'required|string|max:500',
            'seller_email' => 'nullable|email|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_tpin' => 'nullable|string|max:100',
            'customer_phone' => 'required|string|max:50',
            'customer_address' => 'required|string|max:500',
            'customer_email' => 'nullable|email|max:255',
            'quote_no' => 'required|string|max:100',
            'quote_date' => 'required|date',
            'expiry_date' => $request->input('doc_type') === 'Receipt' ? 'nullable|date' : 'required|date|after_or_equal:quote_date',
            'payment_method_received' => 'nullable|string|max:100',
            'vat_rate' => 'nullable|numeric|min:0|max:100',
            'terms_conditions' => 'nullable|string|max:3000',
            'bank_name' => 'nullable|string|max:255',
            'bank_name_other' => 'nullable|required_if:bank_name,Other|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'sort_code' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:255',
            'mobile_network_provider' => 'nullable|in:MTN,Airtel,Zamtel',
            'mobile_phone_no' => [
                'nullable',
                'required_if:mobile_network_provider,MTN,Airtel,Zamtel',
                function ($attribute, $value, $fail) use ($request) {
                    if (empty($value)) {
                        return;
                    }
                    
                    $provider = $request->input('mobile_network_provider');
                    $patterns = [
                        'MTN' => '/^(096|076|056)\d{7}$/',
                        'Airtel' => '/^(097|077|057)\d{7}$/',
                        'Zamtel' => '/^(095|075|055)\d{7}$/'
                    ];
                    
                    if ($provider && isset($patterns[$provider])) {
                        if (!preg_match($patterns[$provider], $value)) {
                            $fail("Invalid mobile phone number format for $provider.");
                        }
                    }
                }
            ],
            'mobile_account_name' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ], $messages);

        $template = $validated['template'] ?? '3';
        $vatRate = isset($validated['vat_rate']) ? (float) $validated['vat_rate'] : 16.0;
        $isVatRegistered = $request->boolean('vat_registered');

        $subTotal = 0;
        foreach ($validated['items'] as &$item) {
            $item['line_total'] = $item['qty'] * $item['price'];
            $subTotal += $item['line_total'];
        }

        $vatAmount = $isVatRegistered ? ($subTotal * ($vatRate / 100)) : 0;
        $grandTotal = $subTotal + $vatAmount;

        $validated['vat_registered'] = $isVatRegistered;
        $validated['vat_rate'] = $vatRate;
        $validated['sub_total'] = $subTotal;
        $validated['vat_amount'] = $vatAmount;
        $validated['grand_total'] = $grandTotal;
        $validated['generated_at'] = now()->format('Y-m-d H:i:s');

        // Use bank_name_other if bank_name is "Other"
        $finalBankName = ($validated['bank_name'] === 'Other') 
            ? ($validated['bank_name_other'] ?? '')
            : ($validated['bank_name'] ?? '');
        
        // Update bank_name to the actual name for PDF generation
        $validated['bank_name'] = $finalBankName;

        $bankFields = array_filter([
            'Bank Name: ' . $finalBankName,
            'Account Name: ' . ($validated['account_name'] ?? ''),
            'Account No: ' . ($validated['account_no'] ?? ''),
            'Branch: ' . ($validated['branch'] ?? ''),
            'Branch Code: ' . ($validated['branch_code'] ?? ''),
            'Sort Code: ' . ($validated['sort_code'] ?? ''),
            'Swift Code: ' . ($validated['swift_code'] ?? ''),
        ], function ($line) {
            return !str_ends_with($line, ': ');
        });

        $mobileFields = array_filter([
            'Network Provider: ' . ($validated['mobile_network_provider'] ?? ''),
            'Phone No: ' . ($validated['mobile_phone_no'] ?? ''),
            'Account Name: ' . ($validated['mobile_account_name'] ?? ''),
        ], function ($line) {
            return !str_ends_with($line, ': ');
        });

        $paymentSections = [];
        if (!empty($bankFields)) {
            $paymentSections[] = "Bank\n" . implode("\n", $bankFields);
        }
        if (!empty($mobileFields)) {
            $paymentSections[] = "Mobile Money\n" . implode("\n", $mobileFields);
        }
        $validated['payment_details'] = implode("\n\n", $paymentSections);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            if (extension_loaded('gd')) {
                $path = (string) $file->getRealPath();
                $validated['logo_abs_path'] = $path;
                $validated['logo_file_uri'] = 'file:///' . ltrim(str_replace('\\', '/', $path), '/');

                $fileContents = file_get_contents($path);
                if ($fileContents !== false) {
                    $validated['logo_data_uri'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($fileContents);
                }
            }
        }

        // Dynamically load the chosen template
        $viewName = 'pdf.template' . $template;
        $pdf = Pdf::loadView($viewName, $validated);

        $fileName = strtolower($validated['doc_type']) . '-' . time() . '.pdf';
        return $pdf->download($fileName);
    }
}
