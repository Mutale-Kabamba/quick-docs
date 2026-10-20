<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $doc_title ?? $doc_type }} - {{ $quote_no }}</title>
    <style>
        @page {
            margin: 14px 18px;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 11px;
            color: #2b2b2b;
            margin: 0;
            padding: 0;
        }
        .outer-frame {
            border: 2px solid #00a86b;
            padding: 16px 20px;
            box-sizing: border-box;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
        }
        .main-title {
            font-family: 'Times New Roman', Georgia, serif;
            font-size: 32px;
            letter-spacing: 2px;
            color: #4a5568;
            margin: 0;
            font-weight: normal;
            text-transform: uppercase;
        }
        .meta-top td {
            padding: 2px 0;
            font-size: 11px;
            color: #4a5568;
        }
        .address-table {
            margin-top: 15px;
            margin-bottom: 15px;
        }
        .address-table td {
            vertical-align: top;
            font-size: 11px;
            line-height: 1.4;
            color: #374151;
        }
        .party-name {
            font-weight: bold;
            color: #1f2937;
            font-size: 12px;
        }
        .summary-bar {
            margin-bottom: 12px;
            border: 1px solid #00a86b;
        }
        .summary-bar th {
            background-color: #00a86b;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            padding: 6px 10px;
            text-align: left;
            border-right: 1px solid #00935d;
        }
        .summary-bar th:last-child {
            border-right: none;
        }
        .summary-bar td {
            padding: 6px 10px;
            font-size: 11px;
            color: #1f2937;
            border-right: 1px solid #00a86b;
            background-color: #ffffff;
        }
        .summary-bar td:last-child {
            border-right: none;
        }
        .items-table {
            margin-bottom: 15px;
            border: 1px solid #00a86b;
        }
        .items-table th {
            background-color: #00a86b;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            padding: 8px 10px;
            text-align: left;
            border-right: 1px solid #00935d;
        }
        .items-table th:last-child {
            border-right: none;
        }
        .items-table td {
            padding: 8px 10px;
            font-size: 11px;
            border-right: 1px solid #00a86b;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .items-table td:last-child {
            border-right: none;
        }
        .items-table tr.zebra {
            background-color: #f7faf8;
        }
        .totals-table {
            width: 38%;
            margin-left: auto;
            border: 1px solid #00a86b;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .totals-table td {
            padding: 5px 8px;
            font-size: 11px;
            border: 1px solid #00a86b;
        }
        .totals-table .total-row {
            background-color: #e6f7f0;
            font-weight: bold;
            color: #065f46;
        }
        .signature-block {
            margin-top: 10px;
            font-size: 11px;
            color: #374151;
            line-height: 1.45;
        }
        .signature-line {
            display: inline-block;
            border-bottom: 1px solid #6b7280;
            width: 320px;
            height: 14px;
        }
        .footer-table {
            margin-top: 12px;
            vertical-align: middle;
        }
        .logo-placeholder-box {
            display: inline-block;
            border: 1.5px solid #94a3b8;
            padding: 8px 12px;
            font-size: 10px;
            font-weight: bold;
            color: #64748b;
            text-align: center;
            letter-spacing: 1px;
            vertical-align: middle;
        }
        .logo-img-box {
            display: inline-block;
            max-height: 48px;
            max-width: 120px;
            vertical-align: middle;
        }
        .thank-you {
            font-family: 'Times New Roman', Georgia, serif;
            font-style: italic;
            font-size: 13px;
            color: #4b5563;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="outer-frame">
        <!-- Top Header: Title Left, Meta Right -->
        <table class="header-table">
            <tr>
                <td style="width: 50%;">
                    <h1 class="main-title">{{ $doc_title ?? $doc_type }}</h1>
                </td>
                <td style="width: 50%; text-align: right;">
                    <table class="meta-top" style="width: auto; margin-left: auto;">
                        <tr>
                            <td style="text-align: right; color: #4b5563; padding-right: 6px;">Date:</td>
                            <td style="text-align: left; font-weight: bold;">{{ \Carbon\Carbon::parse($quote_date)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; color: #4b5563; padding-right: 6px;">{{ $doc_type }} #:</td>
                            <td style="text-align: left; font-weight: bold;">{{ $quote_no }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right; color: #4b5563; padding-right: 6px;">
                                {{ $doc_type === 'Invoice' ? 'Due Date:' : 'Expiration Date:' }}
                            </td>
                            <td style="text-align: left; font-weight: bold;">
                                {{ !empty($expiry_date) ? \Carbon\Carbon::parse($expiry_date)->format('d/m/Y') : 'Due on receipt' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Two Column Address Block -->
        <table class="address-table">
            <tr>
                <td style="width: 50%; padding-right: 15px;">
                    <div class="party-name">{{ $seller_name }}</div>
                    @if(!empty($seller_address))<div>{!! nl2br(e($seller_address)) !!}</div>@endif
                    @if(!empty($seller_phone))<div>Phone: {{ $seller_phone }}</div>@endif
                    @if(!empty($seller_email))<div>Email: {{ $seller_email }}</div>@endif
                    @if(!empty($seller_tpin))<div>TPIN: {{ $seller_tpin }}</div>@endif
                    @if(!empty($seller_pacra))<div>PACRA: {{ $seller_pacra }}</div>@endif
                </td>
                <td style="width: 50%; text-align: right; padding-left: 15px;">
                    <div class="party-name">{{ $customer_name }}</div>
                    @if(!empty($customer_address))<div>{!! nl2br(e($customer_address)) !!}</div>@endif
                    @if(!empty($customer_phone))<div>Phone: {{ $customer_phone }}</div>@endif
                    @if(!empty($customer_email))<div>Email: {{ $customer_email }}</div>@endif
                    @if(!empty($customer_tpin))<div>Customer ID / TPIN: {{ $customer_tpin }}</div>@endif
                </td>
            </tr>
        </table>

        <!-- Green Summary Bar -->
        <table class="summary-bar">
            <thead>
                <tr>
                    <th style="width: 28%;">Salesperson</th>
                    <th style="width: 26%;">Job</th>
                    <th style="width: 24%;">Payment Terms</th>
                    <th style="width: 22%;">Due Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ !empty($signee_name) ? $signee_name : $seller_name }}</td>
                    <td>{{ $doc_title ?? $doc_type }}</td>
                    <td>{{ $doc_type === 'Receipt' ? 'Paid in full' : 'Due on receipt' }}</td>
                    <td>{{ !empty($expiry_date) ? \Carbon\Carbon::parse($expiry_date)->format('d/m/Y') : 'Upon receipt' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Items Table with Emerald Header and Zebra Rows -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 14%;">Quantity</th>
                    <th style="width: 52%;">Description</th>
                    <th style="width: 17%; text-align: right;">Unit Price</th>
                    <th style="width: 17%; text-align: right;">Line Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $index => $item)
                <tr class="{{ $index % 2 === 1 ? 'zebra' : '' }}">
                    <td>{{ $item['qty'] }}</td>
                    <td>
                        <div style="font-weight: 600; color: #1f2937;">{!! nl2br(e($item['description'])) !!}</div>
                        @if(!empty($item['image_data_uri']))
                        <div style="margin-top: 5px;">
                            <img src="{{ $item['image_data_uri'] }}" style="max-height: 48px; max-width: 65px; object-fit: contain; border: 1px solid #d1d5db; border-radius: 2px;" alt="Item image">
                        </div>
                        @endif
                    </td>
                    <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['price'], 2) }}</td>
                    <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['line_total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals Area with Total (in words) -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 15px;">
            <tr>
                <td style="vertical-align: top; width: 55%; padding-right: 20px;">
                    @if(!empty($total_in_words))
                    <div style="padding: 8px 10px; background-color: #f7faf8; border: 1px solid #00a86b; border-radius: 2px;">
                        <div style="font-size: 10px; font-weight: bold; color: #065f46; text-transform: uppercase; margin-bottom: 2px;">Total (in words)</div>
                        <div style="font-size: 11px; font-weight: bold; color: #1f2937; font-style: italic;">{{ $total_in_words }}</div>
                    </div>
                    @endif
                </td>
                <td style="vertical-align: top; width: 45%;">
                    <table class="totals-table" style="width: 100%; margin: 0;">
                        <tr>
                            <td style="width: 45%;">Subtotal</td>
                            <td style="text-align: right; width: 55%;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($sub_total, 2) }}</td>
                        </tr>
                        @if(!empty($discount_amount) && $discount_amount > 0)
                        <tr>
                            <td>Discount {{ ($discount_type ?? 'percent') === 'percent' ? '('.($discount_value + 0).'%)' : '' }}</td>
                            <td style="text-align: right; color: #dc2626;">- {{ $currency_symbol ?? 'ZMW' }} {{ number_format($discount_amount, 2) }}</td>
                        </tr>
                        @endif
                        @if($vat_registered)
                        <tr>
                            <td>Sales Tax ({{ $vat_rate }}%)</td>
                            <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($vat_amount, 2) }}</td>
                        </tr>
                        @endif
                        <tr class="total-row">
                            <td>Total</td>
                            <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($grand_total, 2) }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Acceptance / Conditions Block -->
        <div class="signature-block">
            <!-- Prepared by line -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 8px;">
                <tr>
                    <td style="width: 150px; vertical-align: bottom; font-size: 11px; color: #374151; padding-bottom: 2px; white-space: nowrap;">
                        {{ $doc_type }} prepared by:
                    </td>
                    <td style="vertical-align: bottom; border-bottom: 1px solid #6b7280; padding-bottom: 2px;">
                        @if(!empty($signature_data_uri))
                            <div style="margin-bottom: 2px;">
                                <img src="{{ $signature_data_uri }}" style="max-height: 42px; max-width: 160px; display: block;" alt="Signature">
                            </div>
                        @endif
                        <span style="font-weight: bold; font-size: 11px; color: #111827;">
                            {{ !empty($signee_name) ? $signee_name : (!empty($signature_data_uri) ? 'Authorized Signatory' : '') }}
                        </span>
                    </td>
                </tr>
            </table>

            @if($doc_type === 'Receipt')
                <div style="margin: 10px 0; padding: 6px 10px; background-color: #e6f7f0; border: 1px solid #00a86b; border-radius: 3px; color: #065f46; font-size: 11px;">
                    <strong>Payment Received:</strong> {{ $payment_method_received ?? 'Cash / Direct Transfer' }} &mdash; <strong>PAID IN FULL</strong>
                </div>
            @else
                <div style="margin: 10px 0; font-size: 10px; color: #4b5563; line-height: 1.45;">
                    This is a {{ strtolower($doc_type) }} on the goods named, subject to the conditions noted below:
                    @if(!empty($terms_conditions))
                        <div style="margin-top: 3px; font-weight: normal; color: #374151;">{!! nl2br(e($terms_conditions)) !!}</div>
                    @else
                        <span style="color: #6b7280;">(Standard commercial terms and conditions apply to this agreement.)</span>
                    @endif
                </div>

                @if(!empty($payment_details))
                <div style="margin: 8px 0; padding: 6px 10px; background-color: #f9fafb; border: 1px solid #d1d5db; font-size: 10px;">
                    <strong>Payment Details:</strong><br>
                    {!! nl2br(e($payment_details)) !!}
                </div>
                @endif
            @endif

            <!-- Acceptance line -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 12px; margin-bottom: 15px;">
                <tr>
                    <td style="width: 250px; vertical-align: bottom; font-size: 11px; color: #374151; padding-bottom: 2px; white-space: nowrap;">
                        To accept this {{ strtolower($doc_type) }}, sign here and return:
                    </td>
                    <td style="vertical-align: bottom; border-bottom: 1px solid #6b7280; height: 22px;">
                        &nbsp;
                    </td>
                </tr>
            </table>
        </div>

        <!-- Footer: Logo on left, Thank you on right -->
        <table class="footer-table" style="width: 100%;">
            <tr>
                <td style="width: 60%; vertical-align: middle;">
                    @if(!empty($logo_data_uri))
                        <img src="{{ $logo_data_uri }}" class="logo-img-box" style="vertical-align: middle; margin-right: 10px;" alt="Company Logo">
                    @elseif(!empty($logo_file_uri))
                        <img src="{{ $logo_file_uri }}" class="logo-img-box" style="vertical-align: middle; margin-right: 10px;" alt="Company Logo">
                    @elseif(!empty($logo_abs_path))
                        <img src="{{ $logo_abs_path }}" class="logo-img-box" style="vertical-align: middle; margin-right: 10px;" alt="Company Logo">
                    @endif
                    <span style="font-style: italic; font-size: 11px; color: #6b7280; vertical-align: middle;">
                        {{ $seller_name }}
                    </span>
                </td>
                <td style="width: 40%; vertical-align: middle;" class="thank-you">
                    Thank you for your business
                </td>
            </tr>
        </table>
    </div>
</body>
</html>