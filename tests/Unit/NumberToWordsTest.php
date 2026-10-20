<?php

namespace Tests\Unit;

use App\Http\Controllers\DocumentController;
use Tests\TestCase;

class NumberToWordsTest extends TestCase
{
    private DocumentController $controller;
    private \ReflectionMethod $method;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new DocumentController();
        $this->method = new \ReflectionMethod(DocumentController::class, 'numberToWords');
        $this->method->setAccessible(true);
    }

    private function convert(float $amount, string $currency): string
    {
        return $this->method->invoke($this->controller, $amount, $currency);
    }

    public function test_usd_decimal_amounts_show_cents(): void
    {
        $this->assertEquals('One Hundred Dollars and Fifty Cents Only', $this->convert(100.50, 'USD'));
        $this->assertEquals('One Dollar and One Cent Only', $this->convert(1.01, 'USD'));
        $this->assertEquals('Zero Dollars Only', $this->convert(0, 'USD'));
    }

    public function test_zmw_decimal_amounts_show_ngwee_not_cents(): void
    {
        $this->assertEquals('Two Thousand Five Hundred Kwacha and Fifty Ngwee Only', $this->convert(2500.50, 'ZMW'));
        $this->assertEquals('One Kwacha and One Ngwee Only', $this->convert(1.01, 'ZMW'));
        $this->assertEquals('Zero Kwacha and Seventy Five Ngwee Only', $this->convert(0.75, 'ZMW'));
    }

    public function test_gbp_decimal_amounts_show_pence_and_penny(): void
    {
        $this->assertEquals('One Hundred Twenty Pounds and Fifty Pence Only', $this->convert(120.50, 'GBP'));
        $this->assertEquals('One Pound and One Penny Only', $this->convert(1.01, 'GBP'));
    }

    public function test_inr_decimal_amounts_show_paise_and_paisa(): void
    {
        $this->assertEquals('Five Hundred Rupees and Fifty Paise Only', $this->convert(500.50, 'INR'));
        $this->assertEquals('One Rupee and One Paisa Only', $this->convert(1.01, 'INR'));
    }

    public function test_eur_decimal_amounts_show_cents(): void
    {
        $this->assertEquals('Ninety Nine Euros and Ninety Nine Cents Only', $this->convert(99.99, 'EUR'));
        $this->assertEquals('One Euro and One Cent Only', $this->convert(1.01, 'EUR'));
    }

    public function test_zar_decimal_amounts_show_cents(): void
    {
        $this->assertEquals('Forty Five Rand and Twenty Cents Only', $this->convert(45.20, 'ZAR'));
        $this->assertEquals('One Rand and One Cent Only', $this->convert(1.01, 'ZAR'));
    }

    public function test_cad_and_aud_show_dollars_and_cents(): void
    {
        $this->assertEquals('One Hundred Fifty Dollars and Thirty Five Cents Only', $this->convert(150.35, 'CAD'));
        $this->assertEquals('Two Hundred Dollars and Ten Cents Only', $this->convert(200.10, 'AUD'));
    }

    public function test_african_currencies_use_appropriate_subunits(): void
    {
        $this->assertEquals('Fifty Shillings and Fifty Cents Only', $this->convert(50.50, 'KES'));
        $this->assertEquals('One Thousand Naira and Fifty Kobo Only', $this->convert(1000.50, 'NGN'));
        $this->assertEquals('Twenty Cedis and Fifty Pesewas Only', $this->convert(20.50, 'GHS'));
        $this->assertEquals('Ten Pula and Fifty Thebe Only', $this->convert(10.50, 'BWP'));
        $this->assertEquals('One Hundred Kwacha and Fifty Tambala Only', $this->convert(100.50, 'MWK'));
    }
}
