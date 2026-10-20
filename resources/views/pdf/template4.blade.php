<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $doc_title ?? $doc_type }} - {{ $quote_no }}</title>
    <style>
        @page {
            margin: 18px 24px;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 10.5px;
            color: #1e293b;
            margin: 0;
            padding: 0;
            line-height: 1.4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
        }
        .doc-title {
            color: #00b074;
            font-size: 36px;
            font-weight: 500;
            letter-spacing: -0.5px;
            margin: 0;
            line-height: 1;
        }
        .quotation-by-label {
            font-size: 9.5px;
            color: #64748b;
            margin-bottom: 2px;
        }
        .seller-company-name {
            font-size: 12px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 2px;
        }
        .seller-details {
            font-size: 10px;
            color: #475569;
            line-height: 1.35;
        }
        .divider-banner {
            height: 4px;
            background-color: #e6f7f0;
            margin: 16px 0 16px 0;
            border-radius: 2px;
        }
        .details-table td {
            vertical-align: top;
        }
        .section-tag {
            border-left: 3px solid #00b074;
            padding-left: 6px;
            font-size: 10.5px;
            font-weight: bold;
            color: #00b074;
            margin-bottom: 6px;
            line-height: 1.1;
        }
        .client-name {
            font-size: 13px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 3px;
        }
        .client-details {
            font-size: 10px;
            color: #475569;
            line-height: 1.4;
        }
        .meta-kv-table {
            width: 100%;
        }
        .meta-kv-table td {
            padding: 2.5px 0;
            font-size: 10px;
        }
        .meta-k {
            color: #1e293b;
            font-weight: bold;
            width: 48%;
        }
        .meta-v {
            color: #475569;
            text-align: right;
            font-weight: 500;
        }
        .items-table {
            margin-top: 16px;
            margin-bottom: 14px;
            width: 100%;
            border-collapse: collapse;
        }
        .items-table th {
            background-color: #00b074;
            color: #ffffff;
            font-size: 10.5px;
            font-weight: bold;
            padding: 8px 10px;
            border: none;
        }
        .items-table th.th-first {
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            text-align: left;
        }
        .items-table th.th-last {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            text-align: right;
        }
        .items-table td {
            padding: 8px 10px;
            font-size: 10.5px;
            vertical-align: top;
            border-bottom: 1px solid #eef6f2;
        }
        .items-table tr.row-tint {
            background-color: #f2f9f6;
        }
        .items-table tr.row-white {
            background-color: #ffffff;
        }
        .item-name-bold {
            font-weight: bold;
            color: #1e293b;
        }
        .item-desc-text {
            color: #64748b;
            font-size: 9.5px;
            margin-top: 2px;
            line-height: 1.35;
        }
        .totals-wrapper-table {
            width: 100%;
            margin-top: 6px;
        }
        .totals-table {
            width: 45%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .totals-table td {
            padding: 4px 6px;
            font-size: 11px;
        }
        .totals-label {
            color: #1e293b;
            font-weight: 600;
        }
        .totals-val {
            text-align: right;
            color: #1e293b;
            font-weight: 600;
        }
        .grand-total-label {
            font-size: 15px;
            font-weight: bold;
            color: #1e293b;
            padding-top: 10px;
        }
        .grand-total-val {
            font-size: 20px;
            font-weight: 800;
            color: #00b074;
            text-align: right;
            padding-top: 10px;
        }
        .words-section {
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }
        .words-label {
            font-size: 9px;
            color: #64748b;
            margin-bottom: 2px;
        }
        .words-content {
            font-size: 11px;
            font-weight: bold;
            color: #1e293b;
            line-height: 1.3;
        }
        .footer-heading {
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            margin-top: 12px;
            margin-bottom: 4px;
        }
        .footer-body {
            font-size: 9.5px;
            color: #475569;
            line-height: 1.45;
        }
        .enquiry-line {
            margin-top: 18px;
            padding-top: 8px;
            border-top: 1px solid #eef6f2;
            font-size: 9.5px;
            color: #475569;
        }
        .enquiry-line strong {
            color: #0f172a;
        }
    </style>
</head>
<body>
    <!-- Top Header: Title, Quotation by, and Logo -->
    <table class="header-table">
        <tr>
            <td style="width: 38%; vertical-align: middle;">
                <h1 class="doc-title">{{ $doc_title ?? $doc_type }}</h1>
            </td>
            <td style="width: 38%; vertical-align: middle; padding-left: 10px;">
                <div class="quotation-by-label">{{ $doc_type }} by</div>
                <div class="seller-company-name">{{ $seller_name }}</div>
                <div class="seller-details">
                    {!! nl2br(e($seller_address)) !!}
                    @if(!empty($seller_phone))
                        <br>Phone: {{ $seller_phone }}
                    @endif
                    @if(!empty($seller_email))
                        <br>Email: {{ $seller_email }}
                    @endif
                    @if(!empty($seller_tpin))
                        <br>TPIN: {{ $seller_tpin }}
                    @endif
                    @if(!empty($seller_pacra))
                        <br>PACRA: {{ $seller_pacra }}
                    @endif
                </div>
            </td>
            <td style="width: 24%; text-align: right; vertical-align: middle;">
                @if(!empty($logo_data_uri))
                    <img src="{{ $logo_data_uri }}" style="max-height: 55px; max-width: 150px; display: inline-block;" alt="Logo">
                @elseif(!empty($logo_file_uri))
                    <img src="{{ $logo_file_uri }}" style="max-height: 55px; max-width: 150px; display: inline-block;" alt="Logo">
                @elseif(!empty($logo_abs_path))
                    <img src="{{ $logo_abs_path }}" style="max-height: 55px; max-width: 150px; display: inline-block;" alt="Logo">
                @endif
            </td>
        </tr>
    </table>

    <div class="divider-banner"></div>

    <!-- Details Section: Billed to & Document Details -->
    <table class="details-table">
        <tr>
            <!-- Left: Billed to -->
            <td style="width: 58%; padding-right: 25px;">
                <div class="section-tag">Billed to</div>
                <div class="client-name">{{ $customer_name }}</div>
                <div class="client-details">
                    {!! nl2br(e($customer_address)) !!}
                    @if(!empty($customer_phone))
                        <br>Phone: {{ $customer_phone }}
                    @endif
                    @if(!empty($customer_email))
                        <br>Email: {{ $customer_email }}
                    @endif
                    @if(!empty($customer_tpin))
                        <br><strong>TPIN:</strong> {{ $customer_tpin }}
                    @endif
                </div>
            </td>

            <!-- Right: Quotation Details -->
            <td style="width: 42%;">
                <div class="section-tag">{{ $doc_title ?? $doc_type }} Details</div>
                <table class="meta-kv-table">
                    <tr>
                        <td class="meta-k">{{ $doc_title ?? $doc_type }} #</td>
                        <td class="meta-v">{{ $quote_no }}</td>
                    </tr>
                    <tr>
                        <td class="meta-k">{{ $doc_title ?? $doc_type }} Date</td>
                        <td class="meta-v">{{ \Carbon\Carbon::parse($quote_date)->format('M d, Y') }}</td>
                    </tr>
                    @if(!empty($expiry_date))
                    <tr>
                        <td class="meta-k">{{ $doc_type === 'Quotation' ? 'Valid Until' : 'Due Date' }}</td>
                        <td class="meta-v">{{ \Carbon\Carbon::parse($expiry_date)->format('M d, Y') }}</td>
                    </tr>
                    @endif
                    @if($doc_type === 'Receipt' && !empty($payment_method_received))
                    <tr>
                        <td class="meta-k">Payment Method</td>
                        <td class="meta-v">{{ $payment_method_received }}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
    </table>

    <!-- Line Items Table -->
    <table class="items-table">
        <thead>
            <tr>
                <th class="th-first" style="width: 54%;">Item #/Item description</th>
                <th style="width: 12%; text-align: center;">Qty.</th>
                <th style="width: 17%; text-align: right;">Rate</th>
                <th class="th-last" style="width: 17%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $index => $item)
                @php
                    $isOdd = ($loop->iteration % 2 !== 0);
                    $rowClass = $isOdd ? 'row-tint' : 'row-white';
                    $lineDesc = $item['description'] ?? '';
                    $lineName = $item['name'] ?? '';
                @endphp
                <tr class="{{ $rowClass }}">
                    <td>
                        <span class="item-name-bold">{{ $loop->iteration }}. {{ !empty($lineName) ? $lineName : $lineDesc }}</span>
                        @if(!empty($lineName) && !empty($lineDesc) && $lineDesc !== $lineName)
                            <div class="item-desc-text">{!! nl2br(e($lineDesc)) !!}</div>
                        @endif

                        @if(!empty($item['image_data_uri']))
                            <div style="margin-top: 5px;">
                                <img src="{{ $item['image_data_uri'] }}" style="max-height: 40px; max-width: 80px; border-radius: 3px;" alt="Item Image">
                            </div>
                        @endif
                    </td>
                    <td style="text-align: center;">{{ $item['qty'] }}</td>
                    <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['price'], 2) }}</td>
                    <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['line_total'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals Table -->
    <table class="totals-wrapper-table">
        <tr>
            <td style="width: 50%; vertical-align: bottom;">
                <!-- Total in words -->
                <div class="words-section">
                    <div class="words-label">{{ $doc_title ?? $doc_type }} Total (in words)</div>
                    <div class="words-content">{{ $total_in_words }}</div>
                </div>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table class="totals-table">
                    <tr>
                        <td class="totals-label">Sub Total</td>
                        <td class="totals-val">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($sub_total, 2) }}</td>
                    </tr>
                    @if(!empty($discount_amount) && $discount_amount > 0)
                    <tr>
                        <td class="totals-label">
                            Discount{{ ($discount_type ?? 'percent') === 'percent' && ($discount_value ?? 0) > 0 ? ' (' . (float)$discount_value . '%)' : '' }}
                        </td>
                        <td class="totals-val" style="color: #ef4444;">
                            - {{ $currency_symbol ?? 'ZMW' }} {{ number_format($discount_amount, 2) }}
                        </td>
                    </tr>
                    @endif
                    @if(!empty($vat_registered))
                    <tr>
                        <td class="totals-label">VAT ({{ (float)$vat_rate }}%)</td>
                        <td class="totals-val">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($vat_amount, 2) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td class="grand-total-label">Total</td>
                        <td class="grand-total-val">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($grand_total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Terms & Conditions / Notes / Bank Details -->
    @if(!empty($terms_conditions))
        <div class="footer-heading">Terms and Conditions</div>
        <div class="footer-body">{!! nl2br(e($terms_conditions)) !!}</div>
    @endif

    @if(!empty($notes))
        <div class="footer-heading">Additional Notes</div>
        <div class="footer-body">{!! nl2br(e($notes)) !!}</div>
    @endif

    @if(!empty($additional_info))
        <div class="footer-heading">Additional Information</div>
        <div class="footer-body">{!! nl2br(e($additional_info)) !!}</div>
    @endif

    @if(!empty($payment_details))
        <div class="footer-heading">{{ $doc_type === 'Receipt' ? 'Payment Information' : 'Bank & Payment Details' }}</div>
        <div class="footer-body">{!! nl2br(e($payment_details)) !!}</div>
    @endif

    @if(!empty($signature_data_uri) || !empty($signee_name))
        <table style="width: 100%; margin-top: 14px; border-collapse: collapse;">
            <tr>
                <td style="width: 200px; vertical-align: bottom;">
                    @if(!empty($signature_data_uri))
                        <div style="margin-bottom: 2px;">
                            <img src="{{ $signature_data_uri }}" style="max-height: 42px; max-width: 160px; display: block;" alt="Signature">
                        </div>
                    @endif
                    <div style="font-weight: bold; font-size: 10.5px; color: #0f172a; border-top: 1px solid #94a3b8; padding-top: 3px; display: inline-block; min-width: 160px;">
                        {{ !empty($signee_name) ? $signee_name : 'Authorized Signatory' }}
                    </div>
                </td>
                <td>&nbsp;</td>
            </tr>
        </table>
    @endif

    <!-- Enquiry Contact Line -->
    <div class="enquiry-line">
        For any enquiries, email us on <strong>{{ !empty($seller_email) ? $seller_email : 'info@quickdocs.com' }}</strong> or call us on <strong>{{ $seller_phone }}</strong>
    </div>
</body>
</html>
