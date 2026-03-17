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
        return view('home');
    }

    public function generate(Request $request)
    {
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
            'expiry_date' => 'required|date|after_or_equal:quote_date',
            'vat_rate' => 'nullable|numeric|min:0|max:100',
            'terms_conditions' => 'nullable|string|max:3000',
            'payment_details' => 'nullable|string|max:3000',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.qty' => 'required|numeric|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

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
