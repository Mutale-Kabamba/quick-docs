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
}
