<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser\StreamReader;

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
        // Pre-normalize mobile money phone number to prevent 422 errors from spaces/dashes/country code
        if ($request->filled('mobile_phone_no')) {
            $cleaned = preg_replace('/[\s\-\(\)\.]/', '', (string) $request->input('mobile_phone_no'));
            if (preg_match('/^\+?260(\d{9})$/', $cleaned, $matches)) {
                $cleaned = '0' . $matches[1];
            } elseif (preg_match('/^(\d{9})$/', $cleaned, $matches)) {
                $cleaned = '0' . $matches[1];
            }
            $request->merge(['mobile_phone_no' => $cleaned]);
        }

        // Custom validation messages
        $messages = [
            'bank_name_other.required_if' => 'Please specify your bank name when selecting "Other".',
            'payment_method_received_other.required_if' => 'Please specify the payment method when selecting "Other".',
            'mobile_phone_no.required_if' => 'Mobile phone number is required when a network provider is selected.',
        ];

        $validated = $request->validate([
            'doc_type' => 'required|in:Quotation,Invoice,Receipt',
            'action' => 'nullable|in:download,preview',
            'template' => 'nullable|in:1,2,3,4',
            'attachments' => 'nullable|array',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,png,jpg,jpeg,webp,gif',
            'logo' => 'nullable|image|max:2048',
            'seller_name' => 'nullable|string|max:255',
            'seller_tpin' => 'nullable|string|max:100',
            'seller_pacra' => 'nullable|string|max:100',
            'seller_phone' => 'nullable|string|max:50',
            'seller_address' => 'nullable|string|max:500',
            'seller_email' => 'nullable|email|max:255',
            'customer_name' => 'nullable|string|max:255',
            'customer_tpin' => 'nullable|string|max:100',
            'customer_phone' => 'nullable|string|max:50',
            'customer_address' => 'nullable|string|max:500',
            'customer_email' => 'nullable|email|max:255',
            'quote_no' => 'required|string|max:100',
            'quote_date' => 'required|date',
            'expiry_date' => 'nullable|date',
            'payment_method_received' => 'nullable|string|max:100',
            'payment_method_received_other' => 'nullable|string|max:255',
            'vat_rate' => 'nullable|numeric|min:0|max:100',
            'terms_conditions' => 'nullable|string|max:3000',
            'bank_name' => 'nullable|string|max:255',
            'bank_name_other' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_no' => 'nullable|string|max:255',
            'branch' => 'nullable|string|max:255',
            'branch_code' => 'nullable|string|max:255',
            'sort_code' => 'nullable|string|max:255',
            'swift_code' => 'nullable|string|max:255',
            'mobile_network_provider' => 'nullable|in:MTN,Airtel,Zamtel',
            'mobile_phone_no' => [
                'nullable',
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
                            $fail("Invalid mobile phone number format for $provider (e.g. 096XXXXXXX).");
                        }
                    }
                }
            ],
            'mobile_account_name' => 'nullable|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.name' => 'nullable|string',
            'items.*.description' => 'nullable|string',
            'items.*.image' => 'nullable|image|max:2048',
            'items.*.image_data_uri' => 'nullable|string',
            'items.*.qty' => 'nullable|numeric|min:0',
            'items.*.price' => 'nullable|numeric|min:0',
            'signature' => 'nullable|image|max:2048',
            'signature_data_uri' => 'nullable|string',
            'signee_name' => 'nullable|string|max:255',
            'total_in_words' => 'nullable|string|max:500',
            'discount_type' => 'nullable|in:percent,amount',
            'discount_value' => 'nullable|numeric|min:0',
            'discount_rate' => 'nullable|numeric|min:0',
            'additional_info' => 'nullable|string',
        ], $messages);

        // Fill safe defaults for party details if omitted
        $validated['seller_name'] = !empty(trim($validated['seller_name'] ?? '')) ? $validated['seller_name'] : 'Ori Studio Limited';
        $validated['seller_phone'] = $validated['seller_phone'] ?? '';
        $validated['seller_address'] = $validated['seller_address'] ?? '';
        $validated['customer_name'] = !empty(trim($validated['customer_name'] ?? '')) ? $validated['customer_name'] : 'Valued Client';
        $validated['customer_phone'] = $validated['customer_phone'] ?? '';
        $validated['customer_address'] = $validated['customer_address'] ?? '';

        if (($validated['bank_name'] ?? '') === 'Other' && empty($validated['bank_name_other'])) {
            $validated['bank_name_other'] = 'Bank Transfer';
        }
        if (($validated['payment_method_received'] ?? '') === 'Other' && empty($validated['payment_method_received_other'])) {
            $validated['payment_method_received_other'] = 'Other';
        }

        $template = $validated['template'] ?? '3';
        $vatRate = isset($validated['vat_rate']) ? (float) $validated['vat_rate'] : 16.0;
        $isVatRegistered = $request->boolean('vat_registered');

        $subTotal = 0;
        foreach ($validated['items'] as $index => &$item) {
            $name = trim($item['name'] ?? '');
            $desc = trim($item['description'] ?? '');
            if ($name !== '' && $desc !== '') {
                $item['description'] = $name . "\n" . $desc;
            } elseif ($name !== '') {
                $item['description'] = $name;
            } elseif ($desc !== '') {
                $item['description'] = $desc;
            } else {
                $item['description'] = 'Item ' . ($index + 1);
            }
            $item['qty'] = isset($item['qty']) && is_numeric($item['qty']) ? (float) $item['qty'] : 1.0;
            $item['price'] = isset($item['price']) && is_numeric($item['price']) ? (float) $item['price'] : 0.0;
            $item['line_total'] = $item['qty'] * $item['price'];
            $subTotal += $item['line_total'];

            // Process item image
            $itemImageUri = $item['image_data_uri'] ?? null;
            if ($request->hasFile("items.$index.image")) {
                $imgFile = $request->file("items.$index.image");
                if ($imgFile->isValid()) {
                    $content = file_get_contents($imgFile->getRealPath());
                    if ($content !== false) {
                        $itemImageUri = 'data:' . $imgFile->getMimeType() . ';base64,' . base64_encode($content);
                    }
                }
            }
            $item['image_data_uri'] = $itemImageUri;
        }

        // Process signature
        $signatureDataUri = $request->input('signature_data_uri');
        if ($request->hasFile('signature')) {
            $sigFile = $request->file('signature');
            if ($sigFile->isValid()) {
                $content = file_get_contents($sigFile->getRealPath());
                if ($content !== false) {
                    $signatureDataUri = 'data:' . $sigFile->getMimeType() . ';base64,' . base64_encode($content);
                }
            }
        }
        $validated['signature_data_uri'] = $signatureDataUri;
        $validated['signee_name'] = $request->input('signee_name');

        $currency = $request->input('currency', 'ZMW');
        $currencySymbol = $request->input('currency_symbol', 'ZMW');
        $validated['currency'] = $currency;
        $validated['currency_symbol'] = $currencySymbol;

        $discountType = $request->input('discount_type', 'percent');
        if (!in_array($discountType, ['percent', 'amount'])) {
            $discountType = 'percent';
        }
        $discountValue = (float) $request->input('discount_value', $request->input('discount_rate', 0));
        if ($discountValue < 0) {
            $discountValue = 0.0;
        }

        $discountAmount = 0.0;
        if ($discountValue > 0) {
            if ($discountType === 'percent') {
                $discountAmount = $subTotal * ($discountValue / 100);
            } else {
                $discountAmount = min($subTotal, $discountValue);
            }
        }
        $subAfterDiscount = max(0, $subTotal - $discountAmount);

        $vatAmount = $isVatRegistered ? ($subAfterDiscount * ($vatRate / 100)) : 0;
        $grandTotal = $subAfterDiscount + $vatAmount;

        $validated['vat_registered'] = $isVatRegistered;
        $validated['vat_rate'] = $vatRate;
        $validated['sub_total'] = $subTotal;
        $validated['discount_type'] = $discountType;
        $validated['discount_value'] = $discountValue;
        $validated['discount_amount'] = $discountAmount;
        $validated['sub_after_discount'] = $subAfterDiscount;
        $validated['vat_amount'] = $vatAmount;
        $validated['grand_total'] = $grandTotal;
        $totalInWords = trim((string) $request->input('total_in_words', ''));
        if ($totalInWords === '') {
            $totalInWords = $this->numberToWords((float) $grandTotal, $currency);
        }
        $validated['total_in_words'] = $totalInWords;
        $validated['generated_at'] = now()->format('Y-m-d H:i:s');
        $validated['notes'] = $request->input('notes');
        $validated['additional_info'] = $request->input('additional_info');
        $validated['doc_title'] = $request->input('doc_title', $validated['doc_type']);

        // Append extra location details to address if provided
        $sellerCity = $request->input('seller_city');
        $sellerZip = $request->input('seller_zip');
        $sellerState = $request->input('seller_state');
        $sellerCountry = $request->input('seller_country');
        $extraSeller = array_filter([$sellerCity, $sellerState, $sellerZip, $sellerCountry]);
        if (!empty($extraSeller)) {
            $validated['seller_address'] = !empty($validated['seller_address']) 
                ? ($validated['seller_address'] . "\n" . implode(', ', $extraSeller)) 
                : implode(', ', $extraSeller);
        }

        $custCity = $request->input('customer_city');
        $custZip = $request->input('customer_zip');
        $custState = $request->input('customer_state');
        $custCountry = $request->input('customer_country');
        $extraCust = array_filter([$custCity, $custState, $custZip, $custCountry]);
        if (!empty($extraCust)) {
            $validated['customer_address'] = !empty($validated['customer_address']) 
                ? ($validated['customer_address'] . "\n" . implode(', ', $extraCust)) 
                : implode(', ', $extraCust);
        }

        // Resolve payment method for receipts
        $paymentMethodReceived = $validated['payment_method_received'] ?? null;
        if ($paymentMethodReceived === 'Other' && !empty($validated['payment_method_received_other'])) {
            $paymentMethodReceived = $validated['payment_method_received_other'];
        }
        $validated['payment_method_received'] = $paymentMethodReceived;

        if ($validated['doc_type'] === 'Receipt') {
            $validated['payment_details'] = null;
        } else {
            // Use bank_name_other if bank_name is "Other"
            $bankName = $validated['bank_name'] ?? '';
            $finalBankName = ($bankName === 'Other') 
                ? ($validated['bank_name_other'] ?? '')
                : $bankName;
            
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
        }

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

        $defaultKeys = [
            'seller_email' => null,
            'customer_email' => null,
            'seller_tpin' => null,
            'seller_pacra' => null,
            'customer_tpin' => null,
            'terms_conditions' => null,
            'expiry_date' => null,
            'payment_method_received' => null,
            'payment_details' => null,
            'bank_name' => null,
            'account_name' => null,
            'account_no' => null,
            'branch' => null,
            'branch_code' => null,
            'sort_code' => null,
            'swift_code' => null,
            'mobile_network_provider' => null,
            'mobile_phone_no' => null,
            'mobile_account_name' => null,
            'currency' => 'ZMW',
            'currency_symbol' => 'ZMW',
            'notes' => null,
            'additional_info' => null,
            'doc_title' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
            'signature_data_uri' => null,
            'signee_name' => null,
            'total_in_words' => null,
            'discount_type' => 'percent',
            'discount_value' => 0,
            'discount_amount' => 0,
            'sub_after_discount' => 0,
        ];
        $pdfData = array_merge($defaultKeys, $validated);

        // Dynamically load the chosen template
        $viewName = 'pdf.template' . $template;
        $pdf = Pdf::loadView($viewName, $pdfData);

        $fileName = strtolower($validated['doc_type']) . '-' . time() . '.pdf';
        $action = $request->input('action', 'download');

        $pdfContent = $pdf->output();

        // Append attachments if uploaded
        if ($request->hasFile('attachments')) {
            $rawAttachments = $request->file('attachments');
            if (!is_array($rawAttachments)) {
                $rawAttachments = [$rawAttachments];
            }
            $validAttachments = array_filter($rawAttachments, function ($f) {
                return $f && $f->isValid();
            });

            if (!empty($validAttachments)) {
                $pdfContent = $this->appendAttachments($pdfContent, $validAttachments);
            }
        }

        if ($action === 'preview') {
            return response($pdfContent, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            ]);
        }

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    /**
     * Merge the main PDF with any uploaded PDF or image attachments using FPDI
     *
     * @param string $mainPdfContent
     * @param array $attachments
     * @return string
     */
    private function appendAttachments(string $mainPdfContent, array $attachments): string
    {
        $fpdi = new Fpdi();

        // 1. Import main document pages
        try {
            $pageCount = $fpdi->setSourceFile(StreamReader::createByString($mainPdfContent));
            for ($i = 1; $i <= $pageCount; $i++) {
                $tpl = $fpdi->importPage($i);
                $size = $fpdi->getTemplateSize($tpl);
                $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $fpdi->useTemplate($tpl);
            }
        } catch (\Throwable $e) {
            return $mainPdfContent;
        }

        // 2. Iterate each attachment
        foreach ($attachments as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $realPath = $file->getRealPath();
            $mime = strtolower((string) $file->getMimeType());
            $clientName = $file->getClientOriginalName();
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext === 'pdf' || $mime === 'application/pdf') {
                try {
                    $attPageCount = $fpdi->setSourceFile($realPath);
                    for ($pageNo = 1; $pageNo <= $attPageCount; $pageNo++) {
                        $tpl = $fpdi->importPage($pageNo);
                        $size = $fpdi->getTemplateSize($tpl);
                        $fpdi->AddPage($size['orientation'], [$size['width'], $size['height']]);
                        $fpdi->useTemplate($tpl);
                    }
                } catch (\Throwable $e) {
                    continue;
                }
            } elseif (in_array($ext, ['png', 'jpg', 'jpeg', 'webp', 'gif']) || str_starts_with($mime, 'image/')) {
                $tempFileToClean = null;
                $imagePathForFpdi = $realPath;

                try {
                    // Convert WebP or GIF to PNG for FPDF compatibility
                    if ($ext === 'webp' || $ext === 'gif' || $mime === 'image/webp' || $mime === 'image/gif') {
                        if (function_exists('imagecreatefromstring')) {
                            $gdImg = @imagecreatefromstring((string) file_get_contents($realPath));
                            if ($gdImg) {
                                $tempPng = tempnam(sys_get_temp_dir(), 'att_img') . '.png';
                                imagepng($gdImg, $tempPng);
                                imagedestroy($gdImg);
                                $imagePathForFpdi = $tempPng;
                                $tempFileToClean = $tempPng;
                            }
                        }
                    }

                    $origInfo = @getimagesize($imagePathForFpdi);
                    if ($origInfo && $origInfo[0] > 0 && $origInfo[1] > 0) {
                        $origW = $origInfo[0];
                        $origH = $origInfo[1];

                        $a4W = 210;
                        $a4H = 297;
                        $margin = 15;
                        $headerSpace = 12;
                        $maxW = $a4W - ($margin * 2);
                        $maxH = $a4H - ($margin * 2) - $headerSpace;

                        $scale = min($maxW / $origW, $maxH / $origH);
                        $imgW = $origW * $scale;
                        $imgH = $origH * $scale;
                        $x = ($a4W - $imgW) / 2;
                        $y = $margin + $headerSpace + (($maxH - $imgH) / 2);

                        $fpdi->AddPage('P', 'A4');
                        $fpdi->SetFont('Helvetica', 'B', 10);
                        $fpdi->SetTextColor(75, 85, 99);
                        $fpdi->SetXY($margin, $margin);
                        $fpdi->Cell($maxW, 6, 'Attachment: ' . $clientName, 0, 1, 'L');

                        $fpdi->Image($imagePathForFpdi, $x, $y, $imgW, $imgH);
                    }
                } catch (\Throwable $e) {
                    // Skip if single image fails
                } finally {
                    if ($tempFileToClean && file_exists($tempFileToClean)) {
                        @unlink($tempFileToClean);
                    }
                }
            }
        }

        return $fpdi->Output('S');
    }

    /**
     * Convert numeric amount to words with currency
     */
    private function numberToWords(float $amount, string $currencyCode): string
    {
        $currencyUnits = $this->getCurrencyUnits($currencyCode);
        $amount = round($amount, 2);

        if ($amount <= 0) {
            return 'Zero ' . $currencyUnits['major_plural'] . ' Only';
        }

        $wholePart = (int) floor($amount);
        $decimalPart = (int) round(($amount - $wholePart) * 100);
        if ($decimalPart >= 100) {
            $wholePart += 1;
            $decimalPart = 0;
        }

        $majorName = ($wholePart === 1) ? $currencyUnits['major_single'] : $currencyUnits['major_plural'];
        $words = $this->convertIntegerToWords($wholePart);
        $result = $words . ' ' . $majorName;

        if ($decimalPart > 0) {
            $minorName = ($decimalPart === 1) ? $currencyUnits['minor_single'] : $currencyUnits['minor_plural'];
            $result .= ' and ' . $this->convertIntegerToWords($decimalPart) . ' ' . $minorName;
        }

        return $result . ' Only';
    }

    /**
     * Get major and minor currency units (singular and plural)
     */
    private function getCurrencyUnits(string $currencyCode): array
    {
        $units = [
            'USD' => ['major_single' => 'Dollar', 'major_plural' => 'Dollars', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'ZMW' => ['major_single' => 'Kwacha', 'major_plural' => 'Kwacha', 'minor_single' => 'Ngwee', 'minor_plural' => 'Ngwee'],
            'EUR' => ['major_single' => 'Euro', 'major_plural' => 'Euros', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'GBP' => ['major_single' => 'Pound', 'major_plural' => 'Pounds', 'minor_single' => 'Penny', 'minor_plural' => 'Pence'],
            'ZAR' => ['major_single' => 'Rand', 'major_plural' => 'Rand', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'CAD' => ['major_single' => 'Dollar', 'major_plural' => 'Dollars', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'AUD' => ['major_single' => 'Dollar', 'major_plural' => 'Dollars', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'INR' => ['major_single' => 'Rupee', 'major_plural' => 'Rupees', 'minor_single' => 'Paisa', 'minor_plural' => 'Paise'],
            'KES' => ['major_single' => 'Shilling', 'major_plural' => 'Shillings', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'NGN' => ['major_single' => 'Naira', 'major_plural' => 'Naira', 'minor_single' => 'Kobo', 'minor_plural' => 'Kobo'],
            'GHS' => ['major_single' => 'Cedi', 'major_plural' => 'Cedis', 'minor_single' => 'Pesewa', 'minor_plural' => 'Pesewas'],
            'UGX' => ['major_single' => 'Shilling', 'major_plural' => 'Shillings', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'TZS' => ['major_single' => 'Shilling', 'major_plural' => 'Shillings', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'BWP' => ['major_single' => 'Pula', 'major_plural' => 'Pula', 'minor_single' => 'Thebe', 'minor_plural' => 'Thebe'],
            'MWK' => ['major_single' => 'Kwacha', 'major_plural' => 'Kwacha', 'minor_single' => 'Tambala', 'minor_plural' => 'Tambala'],
            'AED' => ['major_single' => 'Dirham', 'major_plural' => 'Dirhams', 'minor_single' => 'Fils', 'minor_plural' => 'Fils'],
            'SAR' => ['major_single' => 'Riyal', 'major_plural' => 'Riyals', 'minor_single' => 'Halala', 'minor_plural' => 'Halalas'],
            'JPY' => ['major_single' => 'Yen', 'major_plural' => 'Yen', 'minor_single' => 'Sen', 'minor_plural' => 'Sen'],
            'CNY' => ['major_single' => 'Yuan', 'major_plural' => 'Yuan', 'minor_single' => 'Fen', 'minor_plural' => 'Fen'],
            'NZD' => ['major_single' => 'Dollar', 'major_plural' => 'Dollars', 'minor_single' => 'Cent', 'minor_plural' => 'Cents'],
            'CHF' => ['major_single' => 'Franc', 'major_plural' => 'Francs', 'minor_single' => 'Rappen', 'minor_plural' => 'Rappen'],
        ];

        $units['ZK'] = $units['ZMW'];
        $units['K'] = $units['ZMW'];
        $units['$'] = $units['USD'];
        $units['€'] = $units['EUR'];
        $units['£'] = $units['GBP'];
        $units['₹'] = $units['INR'];
        $units['R'] = $units['ZAR'];

        $code = strtoupper(trim($currencyCode));
        return $units[$code] ?? [
            'major_single' => $currencyCode,
            'major_plural' => $currencyCode,
            'minor_single' => 'Cent',
            'minor_plural' => 'Cents',
        ];
    }

    /**
     * Convert integer portion to English words
     */
    private function convertIntegerToWords(int $num): string
    {
        $units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
        $teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
        $tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

        $convertChunk = function ($n) use (&$convertChunk, $units, $teens, $tens) {
            $str = '';
            if ($n >= 100) {
                $str .= $units[(int) floor($n / 100)] . ' Hundred ';
                $n %= 100;
            }
            if ($n >= 20) {
                $str .= $tens[(int) floor($n / 10)] . ' ';
                $n %= 10;
            } elseif ($n >= 10) {
                $str .= $teens[$n - 10] . ' ';
                $n = 0;
            }
            if ($n > 0) {
                $str .= $units[$n] . ' ';
            }
            return trim($str);
        };

        if ($num === 0) {
            return 'Zero';
        }

        $words = '';
        $remaining = $num;

        if ($remaining >= 1000000000) {
            $words .= $convertChunk((int) floor($remaining / 1000000000)) . ' Billion ';
            $remaining %= 1000000000;
        }
        if ($remaining >= 1000000) {
            $words .= $convertChunk((int) floor($remaining / 1000000)) . ' Million ';
            $remaining %= 1000000;
        }
        if ($remaining >= 1000) {
            $words .= $convertChunk((int) floor($remaining / 1000)) . ' Thousand ';
            $remaining %= 1000;
        }
        if ($remaining > 0) {
            $words .= $convertChunk($remaining);
        }

        return trim($words);
    }
}
