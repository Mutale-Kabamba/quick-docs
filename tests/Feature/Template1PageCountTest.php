<?php

namespace Tests\Feature;

use Barryvdh\DomPDF\Facade\Pdf;
use Tests\TestCase;

class Template1PageCountTest extends TestCase
{
    public function test_template1_page_count(): void
    {
        $data = [
            'doc_type' => 'Quotation',
            'doc_title' => 'Quotation',
            'quote_no' => 'Q-001',
            'quote_date' => '2026-09-08',
            'expiry_date' => '2026-09-22',
            'seller_name' => 'Acme Ltd',
            'seller_address' => 'Lusaka, Zambia',
            'seller_phone' => '+260971234567',
            'customer_name' => 'Client Company',
            'customer_address' => 'Kabwe, Zambia',
            'customer_phone' => '+260961234567',
            'sub_total' => 1000,
            'vat_registered' => false,
            'vat_rate' => 16,
            'vat_amount' => 0,
            'grand_total' => 1000,
            'discount_amount' => 0,
            'discount_value' => 0,
            'discount_type' => 'percent',
            'total_in_words' => 'One Thousand Kwacha Only',
            'items' => [
                ['qty' => 1, 'description' => 'Item 1', 'price' => 1000, 'line_total' => 1000, 'image_data_uri' => null]
            ],
            'terms_conditions' => null,
            'payment_details' => null,
            'signature_data_uri' => null,
            'signee_name' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
            'seller_email' => null,
            'customer_email' => null,
            'seller_tpin' => null,
            'seller_pacra' => null,
            'customer_tpin' => null,
            'currency' => 'ZMW',
            'currency_symbol' => 'ZK',
            'notes' => null,
            'payment_method_received' => null,
        ];

        $pdf = Pdf::loadView('pdf.template1', $data);
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();
        $canvas = $dompdf->getCanvas();
        $pageCount = $canvas->get_page_count();
        $this->assertEquals(1, $pageCount, "Template 1 produced {$pageCount} pages instead of 1!");
    }

    public function test_template4_page_count(): void
    {
        $data = [
            'doc_type' => 'Quotation',
            'doc_title' => 'Quotation',
            'quote_no' => '003',
            'quote_date' => '2020-02-19',
            'expiry_date' => '2020-02-19',
            'seller_name' => 'Foobar Labs',
            'seller_address' => "46, Raghuveer Dham Society\nSurat, Gujarat, India - 394210",
            'seller_phone' => '+91 98765 43210',
            'seller_email' => 'foobarlabs@gmail.com',
            'seller_tpin' => null,
            'seller_pacra' => null,
            'customer_name' => 'Studio Den',
            'customer_address' => "305, 3rd Floor Orion mall, Bengaluru,\nKarnataka, India - 560055",
            'customer_phone' => '+91 98765 00000',
            'customer_email' => null,
            'customer_tpin' => '29VGCED1234KZ26',
            'sub_total' => 101000,
            'vat_registered' => false,
            'vat_rate' => 16,
            'vat_amount' => 0,
            'grand_total' => 95950,
            'discount_amount' => 5050,
            'discount_value' => 5,
            'discount_type' => 'percent',
            'total_in_words' => 'Ninety Thousand Nine Hundred Fifty Rupees Only',
            'items' => [
                ['name' => 'Basic Web Development', 'description' => 'Basic Web Development', 'qty' => 1, 'price' => 10000, 'line_total' => 10000, 'image_data_uri' => null],
                ['name' => 'Logo Design', 'description' => 'Logo Design', 'qty' => 1, 'price' => 1000, 'line_total' => 1000, 'image_data_uri' => null],
                ['name' => 'Web Design', 'description' => 'Web Design', 'qty' => 1, 'price' => 50000, 'line_total' => 50000, 'image_data_uri' => null],
                ['name' => 'Full Stack Web development', 'description' => 'Full Stack Web development', 'qty' => 1, 'price' => 40000, 'line_total' => 40000, 'image_data_uri' => null],
            ],
            'terms_conditions' => "1. Please pay within 15 days from the date of invoice, overdue interest @ 14% will be charged on delayed payments.\n2. Please quote invoice number when remitting funds.",
            'notes' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
            'additional_info' => null,
            'payment_details' => null,
            'signature_data_uri' => null,
            'signee_name' => null,
            'logo_data_uri' => null,
            'logo_file_uri' => null,
            'logo_abs_path' => null,
            'currency' => 'INR',
            'currency_symbol' => '₹',
            'payment_method_received' => null,
        ];

        $pdf = Pdf::loadView('pdf.template4', $data);
        $dompdf = $pdf->getDomPDF();
        $dompdf->render();
        $canvas = $dompdf->getCanvas();
        $pageCount = $canvas->get_page_count();
        $this->assertEquals(1, $pageCount, "Template 4 produced {$pageCount} pages instead of 1!");
    }
}

