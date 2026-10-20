<?php

namespace Tests\Feature;

use Tests\TestCase;

class DocumentTest extends TestCase
{
    public function test_landing_page_loads(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_quotation_page_loads(): void
    {
        $response = $this->get('/quotation');
        $response->assertStatus(200);
        $response->assertSee('Quotation Builder');
        $response->assertSee('Bank Transfer');
        $response->assertSee('Preview');
        $response->assertDontSee('Save & Continue');
        $response->assertDontSee('1. Quotation is valid for 14 days from date of issue.');
        $response->assertSee('Template 1 (Emerald Green Frame)');
        $response->assertSee('Template 2 (Royal Purple Modern)');
        $response->assertSee('Template 3 (Teal Corporate Minimal)');
        $response->assertSee('Template 4 (Emerald Mint Modern)');
        $response->assertSee('id="custom_prompt_modal"', false);
        $response->assertSee('id="custom_prompt_input"', false);
        $response->assertSee('id="custom_prompt_chips"', false);
        $response->assertSee('id="attachments_input"', false);
    }

    public function test_invoice_page_loads(): void
    {
        $response = $this->get('/invoice');
        $response->assertStatus(200);
        $response->assertSee('Invoice Builder');
        $response->assertSee('Due Date');
    }

    public function test_receipt_page_loads_and_has_only_payment_method(): void
    {
        $response = $this->get('/receipt');
        $response->assertStatus(200);
        $response->assertSee('Receipt Builder');
        $response->assertSee('Payment Received');
        $response->assertSee('Method Used to Pay');
        $response->assertDontSee('Top Commercial Banks');
        $response->assertDontSee('Network Provider');
    }

    public function test_receipt_pdf_generation_without_bank_details(): void
    {
        $payload = [
            'doc_type' => 'Receipt',
            'template' => '3',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'John Doe',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Woodlands, Lusaka',
            'quote_no' => 'REC-20260908-001',
            'quote_date' => '2026-09-08',
            'payment_method_received' => 'Mobile Money (MTN)',
            'terms_conditions' => 'Payment received in full. Thank you for your business.',
            'items' => [
                [
                    'description' => 'Web Design Services',
                    'qty' => 1,
                    'price' => 2500,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_receipt_pdf_generation_with_other_payment_method(): void
    {
        $payload = [
            'doc_type' => 'Receipt',
            'template' => '1',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Jane Smith',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Kabulonga, Lusaka',
            'quote_no' => 'REC-20260908-002',
            'quote_date' => '2026-09-08',
            'payment_method_received' => 'Other',
            'payment_method_received_other' => 'Visa Debit Card',
            'items' => [
                [
                    'description' => 'Brand Consultation',
                    'qty' => 2,
                    'price' => 1500,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_quotation_pdf_generation(): void
    {
        $payload = [
            'doc_type' => 'Quotation',
            'template' => '2',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Acme Corp',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'QT-20260908-003',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'bank_name' => 'Zanaco (Zambia National Commercial Bank) Plc',
            'account_name' => 'Ori Studio Ltd',
            'account_no' => '1234567890',
            'items' => [
                [
                    'description' => 'Graphic Design',
                    'qty' => 1,
                    'price' => 800,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_invoice_pdf_generation(): void
    {
        $payload = [
            'doc_type' => 'Invoice',
            'template' => '3',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Acme Corp',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'INV-20260908-004',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'mobile_network_provider' => 'MTN',
            'mobile_phone_no' => '0961234567',
            'mobile_account_name' => 'Ori Studio Ltd',
            'items' => [
                [
                    'description' => 'Software Development',
                    'qty' => 1,
                    'price' => 5000,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_quotation_pdf_generation_with_signature_and_item_image(): void
    {
        $fakeSignature = \Illuminate\Http\UploadedFile::fake()->image('signature.png', 200, 80);
        $fakeItemImage = \Illuminate\Http\UploadedFile::fake()->image('item.jpg', 100, 100);

        $payload = [
            'doc_type' => 'Quotation',
            'template' => '3',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Acme Corp',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'QT-20260908-005',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'signature' => $fakeSignature,
            'signee_name' => 'Mutale Kabamba, Director',
            'items' => [
                [
                    'name' => 'Design Service',
                    'description' => 'Brand Package',
                    'image' => $fakeItemImage,
                    'qty' => 1,
                    'price' => 1200,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_quotation_pdf_generation_with_data_uri_signature_and_image_all_templates(): void
    {
        $dummyBase64 = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==';

        foreach (['1', '2', '3'] as $template) {
            $payload = [
                'doc_type' => 'Quotation',
                'template' => $template,
                'seller_name' => 'Ori Studio Limited',
                'seller_phone' => '+260971234567',
                'seller_address' => 'Plot 123, Great East Road, Lusaka',
                'customer_name' => 'Acme Corp',
                'customer_phone' => '+260961234567',
                'customer_address' => 'Industrial Area, Lusaka',
                'quote_no' => 'QT-20260908-T' . $template,
                'quote_date' => '2026-09-08',
                'expiry_date' => '2026-09-22',
                'signature_data_uri' => $dummyBase64,
                'signee_name' => 'Mutale Kabamba',
                'items' => [
                    [
                        'name' => 'Product ' . $template,
                        'description' => 'Product description with image',
                        'image_data_uri' => $dummyBase64,
                        'qty' => 2,
                        'price' => 500,
                    ],
                ],
            ];

            $response = $this->post('/generate', $payload);
            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');
        }
    }

    public function test_quotation_pdf_preview_action_returns_inline_stream(): void
    {
        $payload = [
            'doc_type' => 'Quotation',
            'action' => 'preview',
            'template' => '3',
            'seller_name' => 'Ori Studio Limited',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Acme Corp',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'QT-20260908-PREV',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'items' => [
                [
                    'name' => 'Consulting',
                    'description' => 'Preview Test Item',
                    'qty' => 1,
                    'price' => 2000,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
        $disposition = $response->headers->get('content-disposition');
        $this->assertStringContainsString('inline', $disposition);
    }

    public function test_total_in_words_appends_to_pdf_for_all_templates(): void
    {
        foreach (['1', '2', '3'] as $template) {
            $payload = [
                'doc_type' => 'Quotation',
                'template' => $template,
                'seller_name' => 'Ori Studio Limited',
                'seller_phone' => '+260971234567',
                'seller_address' => 'Plot 123, Great East Road, Lusaka',
                'customer_name' => 'Acme Corp',
                'customer_phone' => '+260961234567',
                'customer_address' => 'Industrial Area, Lusaka',
                'quote_no' => 'QT-WORDS-' . $template,
                'quote_date' => '2026-09-08',
                'expiry_date' => '2026-09-22',
                'items' => [
                    [
                        'name' => 'Design System',
                        'qty' => 1,
                        'price' => 2500,
                    ],
                ],
            ];

            $response = $this->post('/generate', $payload);
            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');

            // Render view directly to assert "Total (in words)" text is present
            $data = array_merge($payload, [
                'total_in_words' => 'Two Thousand Five Hundred Kwacha Only',
                'sub_total' => 2500,
                'vat_registered' => false,
                'vat_amount' => 0,
                'grand_total' => 2500,
                'currency_symbol' => 'ZK',
                'currency' => 'ZMW',
                'items' => [
                    [
                        'name' => 'Design System',
                        'description' => 'Design System',
                        'qty' => 1,
                        'price' => 2500,
                        'line_total' => 2500,
                        'image_data_uri' => null,
                    ]
                ],
                'signee_name' => 'Mutale',
                'signature_data_uri' => null,
                'logo_data_uri' => null,
                'logo_file_uri' => null,
                'logo_abs_path' => null,
                'payment_details' => null,
                'payment_method_received' => null,
                'terms_conditions' => null,
                'notes' => null,
                'doc_title' => null,
                'expiry_date' => null,
            ]);
            $html = view('pdf.template' . $template, $data)->render();
            $this->assertStringContainsString('Total (in words)', $html);
            $this->assertStringContainsString('Two Thousand Five Hundred Kwacha Only', $html);
        }
    }

    public function test_quotation_page_has_discount_toggle(): void
    {
        $response = $this->get('/quotation');
        $response->assertStatus(200);
        $response->assertSee('id="discount_value_input"', false);
        $response->assertSee('id="discount_type_input"', false);
        $response->assertSee('id="discount_type_percent_btn"', false);
        $response->assertSee('id="discount_type_amount_btn"', false);
    }

    public function test_pdf_generation_with_percent_discount(): void
    {
        foreach (['1', '2', '3'] as $template) {
            $payload = [
                'doc_type' => 'Quotation',
                'template' => $template,
                'seller_name' => 'Acme Supplies Ltd',
                'seller_phone' => '+260971234567',
                'seller_address' => 'Plot 123, Great East Road, Lusaka',
                'customer_name' => 'Zambia Breweries',
                'customer_phone' => '+260961234567',
                'customer_address' => 'Industrial Area, Lusaka',
                'quote_no' => 'Q-2026-001',
                'quote_date' => '2026-09-08',
                'expiry_date' => '2026-09-22',
                'currency' => 'ZMW',
                'currency_symbol' => 'ZK',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'items' => [
                    [
                        'name' => 'Industrial Filter',
                        'qty' => 2,
                        'price' => 1000,
                    ],
                ],
            ];

            $response = $this->post('/generate', $payload);
            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');

            // Subtotal: 2000. 10% discount: 200. Grand total: 1800.
            $data = array_merge($payload, [
                'sub_total' => 2000,
                'discount_type' => 'percent',
                'discount_value' => 10,
                'discount_amount' => 200,
                'sub_after_discount' => 1800,
                'vat_registered' => false,
                'vat_amount' => 0,
                'grand_total' => 1800,
                'total_in_words' => 'One Thousand Eight Hundred Kwacha Only',
                'items' => [
                    [
                        'name' => 'Industrial Filter',
                        'description' => 'Industrial Filter',
                        'qty' => 2,
                        'price' => 1000,
                        'line_total' => 2000,
                        'image_data_uri' => null,
                    ],
                ],
                'signee_name' => 'Mutale',
                'signature_data_uri' => null,
                'logo_data_uri' => null,
                'logo_file_uri' => null,
                'logo_abs_path' => null,
                'payment_details' => null,
                'payment_method_received' => null,
                'terms_conditions' => null,
                'notes' => null,
                'doc_title' => null,
            ]);

            $html = view('pdf.template' . $template, $data)->render();
            $this->assertStringContainsString('Discount (10%)', $html);
            $this->assertStringContainsString('- ZK 200.00', $html);
            $this->assertStringContainsString('1,800.00', $html);
        }
    }

    public function test_pdf_generation_with_amount_discount(): void
    {
        foreach (['1', '2', '3'] as $template) {
            $payload = [
                'doc_type' => 'Quotation',
                'template' => $template,
                'seller_name' => 'Acme Supplies Ltd',
                'seller_phone' => '+260971234567',
                'seller_address' => 'Plot 123, Great East Road, Lusaka',
                'customer_name' => 'Zambia Breweries',
                'customer_phone' => '+260961234567',
                'customer_address' => 'Industrial Area, Lusaka',
                'quote_no' => 'Q-2026-002',
                'quote_date' => '2026-09-08',
                'expiry_date' => '2026-09-22',
                'currency' => 'ZMW',
                'currency_symbol' => 'ZK',
                'discount_type' => 'amount',
                'discount_value' => 350,
                'items' => [
                    [
                        'name' => 'Industrial Filter',
                        'qty' => 2,
                        'price' => 1000,
                    ],
                ],
            ];

            $response = $this->post('/generate', $payload);
            $response->assertStatus(200);
            $response->assertHeader('content-type', 'application/pdf');

            // Subtotal: 2000. Fixed discount: 350. Grand total: 1650.
            $data = array_merge($payload, [
                'sub_total' => 2000,
                'discount_type' => 'amount',
                'discount_value' => 350,
                'discount_amount' => 350,
                'sub_after_discount' => 1650,
                'vat_registered' => false,
                'vat_amount' => 0,
                'grand_total' => 1650,
                'total_in_words' => 'One Thousand Six Hundred Fifty Kwacha Only',
                'items' => [
                    [
                        'name' => 'Industrial Filter',
                        'description' => 'Industrial Filter',
                        'qty' => 2,
                        'price' => 1000,
                        'line_total' => 2000,
                        'image_data_uri' => null,
                    ],
                ],
                'signee_name' => 'Mutale',
                'signature_data_uri' => null,
                'logo_data_uri' => null,
                'logo_file_uri' => null,
                'logo_abs_path' => null,
                'payment_details' => null,
                'payment_method_received' => null,
                'terms_conditions' => null,
                'notes' => null,
                'doc_title' => null,
                'expiry_date' => null,
            ]);

            $html = view('pdf.template' . $template, $data)->render();
            $this->assertStringContainsString('Discount', $html);
            $this->assertStringNotContainsString('Discount (', $html);
            $this->assertStringContainsString('- ZK 350.00', $html);
            $this->assertStringContainsString('1,650.00', $html);
        }
    }

    public function test_template3_labels_and_section_customizations(): void
    {
        $baseData = [
            'doc_type' => 'Quotation',
            'doc_title' => 'Quotation',
            'seller_name' => 'Acme Supplies Ltd',
            'seller_phone' => '+260971234567',
            'seller_email' => 'info@acme.com',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'seller_tpin' => '1002345678',
            'seller_pacra' => '12023000456',
            'customer_name' => 'Zambia Breweries',
            'customer_phone' => '+260961234567',
            'customer_email' => 'accounts@zb.com',
            'customer_address' => 'Industrial Area, Lusaka',
            'customer_tpin' => null,
            'quote_no' => 'Q-2026-003',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'currency' => 'ZMW',
            'currency_symbol' => 'ZK',
            'sub_total' => 5000,
            'vat_registered' => true,
            'vat_rate' => 16,
            'vat_amount' => 800,
            'grand_total' => 5800,
            'discount_amount' => 0,
            'discount_value' => 0,
            'discount_type' => 'percent',
            'total_in_words' => 'Five Thousand Eight Hundred Kwacha Only',
            'items' => [
                [
                    'name' => 'Solar Inverter 5kVA',
                    'description' => 'Solar Inverter 5kVA',
                    'qty' => 1,
                    'price' => 5000,
                    'line_total' => 5000,
                    'image_data_uri' => null,
                ],
            ],
            'signee_name' => 'Mutale Kabamba',
            'signature_data_uri' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
            'payment_details' => null,
            'payment_method_received' => null,
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
            'terms_conditions' => null,
            'notes' => null,
            'additional_info' => null,
        ];

        // 1. Assert without bottom info added:
        $htmlWithoutFooter = view('pdf.template3', $baseData)->render();

        // Label changes: Sub Total, VAT, Total
        $this->assertStringContainsString('Sub Total', $htmlWithoutFooter);
        $this->assertStringContainsString('VAT', $htmlWithoutFooter);
        $this->assertStringContainsString('Total', $htmlWithoutFooter);
        $this->assertStringNotContainsString('Total HT', $htmlWithoutFooter);
        $this->assertStringNotContainsString('Total TVA', $htmlWithoutFooter);
        $this->assertStringNotContainsString('Total TTC', $htmlWithoutFooter);

        // Top additional info removed
        $this->assertStringNotContainsString('Additional information', $htmlWithoutFooter);

        // Bottom Registered Address & Contact information removed
        $this->assertStringNotContainsString('Registered Address:', $htmlWithoutFooter);
        $this->assertStringNotContainsString('Contact information:', $htmlWithoutFooter);
        $this->assertStringNotContainsString('Commercial Bank', $htmlWithoutFooter);

        // 2. Assert when T&Cs, Bank Details, Notes, and Additional Info are added:
        $dataWithFooter = array_merge($baseData, [
            'terms_conditions' => 'Strictly 30 days payment terms apply.',
            'bank_name' => 'Stanbic Bank Zambia',
            'account_name' => 'Acme Supplies Ltd',
            'account_no' => '9130001234567',
            'notes' => 'Goods delivered within 5 business days.',
            'additional_info' => 'Valid ZRA Tax Clearance attached.',
        ]);

        $htmlWithFooter = view('pdf.template3', $dataWithFooter)->render();
        $this->assertStringContainsString('Terms &amp; Conditions:', $htmlWithFooter);
        $this->assertStringContainsString('Strictly 30 days payment terms apply.', $htmlWithFooter);
        $this->assertStringContainsString('Bank &amp; Payment Details:', $htmlWithFooter);
        $this->assertStringContainsString('Stanbic Bank Zambia', $htmlWithFooter);
        $this->assertStringContainsString('9130001234567', $htmlWithFooter);
        $this->assertStringContainsString('Notes:', $htmlWithFooter);
        $this->assertStringContainsString('Goods delivered within 5 business days.', $htmlWithFooter);
        $this->assertStringContainsString('Additional Info:', $htmlWithFooter);
        $this->assertStringContainsString('Valid ZRA Tax Clearance attached.', $htmlWithFooter);
    }

    public function test_template2_terms_and_vat_label(): void
    {
        $baseData = [
            'doc_type' => 'Quotation',
            'doc_title' => 'Quotation',
            'seller_name' => 'Acme Supplies Ltd',
            'seller_phone' => '+260971234567',
            'seller_email' => 'info@acme.com',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Zambia Breweries',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'Q-2026-004',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'currency' => 'ZMW',
            'currency_symbol' => 'ZK',
            'sub_total' => 1000,
            'vat_registered' => true,
            'vat_rate' => 16,
            'vat_amount' => 160,
            'grand_total' => 1160,
            'discount_amount' => 0,
            'total_in_words' => 'One Thousand One Hundred Sixty Kwacha Only',
            'items' => [
                [
                    'name' => 'Filter Cartridge',
                    'description' => 'Filter Cartridge',
                    'qty' => 1,
                    'price' => 1000,
                    'line_total' => 1000,
                    'image_data_uri' => null,
                ],
            ],
            'terms_conditions' => null,
            'payment_details' => null,
            'payment_method_received' => null,
            'account_name' => null,
            'signature_data_uri' => null,
            'signee_name' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
            'notes' => null,
            'additional_info' => null,
        ];

        // 1. Without T&Cs: TERMS AND CONDITIONS must NOT appear, fallback must not appear, VAT (16%) must appear
        $htmlWithoutTerms = view('pdf.template2', $baseData)->render();
        $this->assertStringContainsString('VAT (16%)', $htmlWithoutTerms);
        $this->assertStringNotContainsString('Sales Tax', $htmlWithoutTerms);
        $this->assertStringNotContainsString('TERMS AND CONDITIONS', $htmlWithoutTerms);
        $this->assertStringNotContainsString('Payment is due within 14 days of project completion.', $htmlWithoutTerms);

        // 2. With T&Cs: TERMS AND CONDITIONS must appear with the specified text
        $dataWithTerms = array_merge($baseData, [
            'terms_conditions' => 'Delivery upon 50% down payment.',
        ]);
        $htmlWithTerms = view('pdf.template2', $dataWithTerms)->render();
        $this->assertStringContainsString('TERMS AND CONDITIONS', $htmlWithTerms);
        $this->assertStringContainsString('Delivery upon 50% down payment.', $htmlWithTerms);
    }

    public function test_template4_generation(): void
    {
        $payload = [
            'doc_type' => 'Quotation',
            'template' => '4',
            'seller_name' => 'Foobar Labs',
            'seller_phone' => '+91 98765 43210',
            'seller_email' => 'foobarlabs@gmail.com',
            'seller_address' => '46, Raghuveer Dham Society, Surat, Gujarat, India',
            'customer_name' => 'Studio Den',
            'customer_phone' => '+91 98765 00000',
            'customer_address' => '305, 3rd Floor Orion mall, Bengaluru',
            'customer_tpin' => '29VGCED1234KZ26',
            'quote_no' => '003',
            'quote_date' => '2020-02-19',
            'expiry_date' => '2020-02-19',
            'currency' => 'USD',
            'currency_symbol' => '$',
            'discount_type' => 'percent',
            'discount_value' => 5,
            'vat_registered' => true,
            'vat_rate' => 16,
            'terms_conditions' => "1. Please pay within 15 days.\n2. Please quote invoice number.",
            'notes' => 'It is a long established fact that a reader will be distracted.',
            'items' => [
                [
                    'name' => 'Basic Web Development',
                    'description' => 'Frontend & backend setup',
                    'qty' => 1,
                    'price' => 10000,
                ],
                [
                    'name' => 'Logo Design',
                    'description' => 'Vector assets',
                    'qty' => 1,
                    'price' => 1000,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_template4_elements_and_blank_logo(): void
    {
        $baseData = [
            'doc_type' => 'Quotation',
            'doc_title' => 'Quotation',
            'seller_name' => 'Foobar Labs',
            'seller_phone' => '+91 98765 43210',
            'seller_email' => 'foobarlabs@gmail.com',
            'seller_address' => '46, Raghuveer Dham Society, Surat',
            'seller_tpin' => null,
            'seller_pacra' => null,
            'customer_name' => 'Studio Den',
            'customer_phone' => '+91 98765 00000',
            'customer_address' => '305, 3rd Floor Orion mall, Bengaluru',
            'customer_tpin' => '29VGCED1234KZ26',
            'customer_email' => null,
            'quote_no' => '003',
            'quote_date' => '2020-02-19',
            'expiry_date' => '2020-02-19',
            'currency' => 'INR',
            'currency_symbol' => '₹',
            'sub_total' => 101000,
            'discount_type' => 'percent',
            'discount_value' => 5,
            'discount_amount' => 5050,
            'vat_registered' => false,
            'vat_rate' => 16,
            'vat_amount' => 0,
            'grand_total' => 95950,
            'total_in_words' => 'Ninety Thousand Nine Hundred Fifty Rupees Only',
            'items' => [
                [
                    'name' => 'Basic Web Development',
                    'description' => 'Basic Web Development',
                    'qty' => 1,
                    'price' => 10000,
                    'line_total' => 10000,
                    'image_data_uri' => null,
                ],
            ],
            'terms_conditions' => "1. Please pay within 15 days.\n2. Please quote invoice number.",
            'notes' => 'Additional notes here.',
            'additional_info' => null,
            'payment_details' => null,
            'payment_method_received' => null,
            'signature_data_uri' => null,
            'signee_name' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
        ];

        // 1. Without logo: no img tag with alt="Logo"
        $htmlWithoutLogo = view('pdf.template4', $baseData)->render();
        $this->assertStringContainsString('Billed to', $htmlWithoutLogo);
        $this->assertStringContainsString('Studio Den', $htmlWithoutLogo);
        $this->assertStringContainsString('Quotation Details', $htmlWithoutLogo);
        $this->assertStringContainsString('Item #/Item description', $htmlWithoutLogo);
        $this->assertStringContainsString('Basic Web Development', $htmlWithoutLogo);
        $this->assertStringContainsString('Ninety Thousand Nine Hundred Fifty Rupees Only', $htmlWithoutLogo);
        $this->assertStringContainsString('Terms and Conditions', $htmlWithoutLogo);
        $this->assertStringContainsString('Additional Notes', $htmlWithoutLogo);
        $this->assertStringContainsString('For any enquiries, email us on', $htmlWithoutLogo);
        $this->assertStringNotContainsString('alt="Logo"', $htmlWithoutLogo);

        // 2. With logo: logo img tag rendered
        $dataWithLogo = array_merge($baseData, [
            'logo_data_uri' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNk+A8AAQUBAScY42YAAAAASUVORK5CYII=',
        ]);
        $htmlWithLogo = view('pdf.template4', $dataWithLogo)->render();
        $this->assertStringContainsString('alt="Logo"', $htmlWithLogo);
    }

    public function test_attachments_appended_to_pdf_for_download_and_preview(): void
    {
        // 1. Create a real 1-page PDF attachment
        $tmpPdfPath = tempnam(sys_get_temp_dir(), 'test_att_pdf') . '.pdf';
        $fpdi = new \setasign\Fpdi\Fpdi();
        $fpdi->AddPage();
        $fpdi->SetFont('Helvetica', '', 12);
        $fpdi->Write(10, 'Attachment 1 PDF Content');
        file_put_contents($tmpPdfPath, $fpdi->Output('S'));

        $pdfAttachment = new \Illuminate\Http\UploadedFile(
            $tmpPdfPath,
            'spec_sheet.pdf',
            'application/pdf',
            null,
            true
        );

        // 2. Create a real image attachment (PNG)
        $imgAttachment = \Illuminate\Http\UploadedFile::fake()->image('receipt_photo.png', 300, 200);

        $payload = [
            'doc_type' => 'Quotation',
            'template' => '4',
            'seller_name' => 'Foobar Labs',
            'seller_phone' => '+260971234567',
            'seller_address' => 'Plot 123, Great East Road, Lusaka',
            'customer_name' => 'Studio Den',
            'customer_phone' => '+260961234567',
            'customer_address' => 'Industrial Area, Lusaka',
            'quote_no' => 'Q-2026-ATT',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'currency' => 'ZMW',
            'currency_symbol' => 'ZK',
            'items' => [
                [
                    'name' => 'Server Equipment',
                    'description' => 'Server specs',
                    'qty' => 1,
                    'price' => 5000,
                ],
            ],
            'attachments' => [
                $pdfAttachment,
                $imgAttachment,
            ],
        ];

        // Test Download
        $response = $this->post('/generate', $payload);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');

        $content = $response->getContent();
        $tester = new \setasign\Fpdi\Fpdi();
        $pageCount = $tester->setSourceFile(\setasign\Fpdi\PdfParser\StreamReader::createByString($content));
        // 1 main page + 1 PDF attachment + 1 image attachment = 3 pages
        $this->assertEquals(3, $pageCount);

        // Test Preview
        $previewPayload = array_merge($payload, ['action' => 'preview']);
        // Need fresh files because previous upload completed
        $tmpPdfPath2 = tempnam(sys_get_temp_dir(), 'test_att_pdf2') . '.pdf';
        file_put_contents($tmpPdfPath2, $fpdi->Output('S'));
        $previewPayload['attachments'] = [
            new \Illuminate\Http\UploadedFile($tmpPdfPath2, 'spec2.pdf', 'application/pdf', null, true),
            \Illuminate\Http\UploadedFile::fake()->image('receipt2.png', 300, 200),
        ];

        $previewResponse = $this->post('/generate', $previewPayload);
        $previewResponse->assertStatus(200);
        $previewResponse->assertHeader('content-type', 'application/pdf');
        $this->assertStringContainsString('inline', $previewResponse->headers->get('content-disposition'));

        $previewContent = $previewResponse->getContent();
        $previewTester = new \setasign\Fpdi\Fpdi();
        $previewPageCount = $previewTester->setSourceFile(\setasign\Fpdi\PdfParser\StreamReader::createByString($previewContent));
        $this->assertEquals(3, $previewPageCount);

        @unlink($tmpPdfPath);
        @unlink($tmpPdfPath2);
    }

    public function test_preview_with_minimal_party_fields_succeeds(): void
    {
        $payload = [
            'doc_type' => 'Quotation',
            'action' => 'preview',
            'template' => '4',
            'quote_no' => 'QT-DRAFT-001',
            'quote_date' => '2026-10-20',
            'items' => [
                [
                    'name' => 'Draft Consultation',
                    'qty' => 1,
                    'price' => 1000,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload, [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json, application/pdf',
        ]);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_preview_normalizes_mobile_money_phone_number(): void
    {
        $payload = [
            'doc_type' => 'Invoice',
            'action' => 'preview',
            'template' => '3',
            'quote_no' => 'INV-PHONE-001',
            'quote_date' => '2026-10-20',
            'mobile_network_provider' => 'MTN',
            'mobile_phone_no' => '+260 96 123 4567', // with country code and spaces
            'items' => [
                [
                    'name' => 'Monthly Retainer',
                    'qty' => 1,
                    'price' => 4500,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload, [
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json, application/pdf',
        ]);

        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_quotation_preview_without_expiry_date_succeeds(): void
    {
        $payload = [
            'doc_type' => 'Quotation',
            'action' => 'preview',
            'template' => '1',
            'quote_no' => 'QT-NO-EXPIRY',
            'quote_date' => '2026-10-20',
            'expiry_date' => null,
            'items' => [
                [
                    'name' => 'Quick Design',
                    'qty' => 1,
                    'price' => 750,
                ],
            ],
        ];

        $response = $this->post('/generate', $payload);
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'application/pdf');
    }

    public function test_preview_returns_422_json_with_errors_when_invalid(): void
    {
        $payload = [
            'doc_type' => 'InvalidType',
            'action' => 'preview',
        ];

        $response = $this->postJson('/generate', $payload);
        $response->assertStatus(422);
        $response->assertJsonStructure([
            'message',
            'errors' => ['doc_type'],
        ]);
    }

    public function test_landing_page_has_mobile_responsive_viewport_and_styles(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1.0">', false);
        $response->assertSee('@media (max-width: 600px)', false);
        $response->assertSee('overflow-x: hidden', false);
    }

    public function test_builder_pages_have_mobile_responsive_viewport_and_styles(): void
    {
        foreach (['/quotation', '/invoice', '/receipt'] as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
            $response->assertSee('<meta name="viewport" content="width=device-width, initial-scale=1.0">', false);
            $response->assertSee('@media (max-width: 768px)', false);
            $response->assertSee('@media (max-width: 640px)', false);
            $response->assertSee('@media (max-width: 480px)', false);
            $response->assertSee('top-nav-left', false);
            $response->assertSee('bank-details-grid', false);
            $response->assertSee('100dvh', false);
        }
    }
}

