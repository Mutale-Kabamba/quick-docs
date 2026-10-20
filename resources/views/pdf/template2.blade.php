<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $doc_title ?? $doc_type }} - {{ $quote_no }}</title>
    <style>
        @page {
            margin: 25px 30px 45px 30px;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 11px;
            color: #2e1065;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: top;
        }
        .section-label {
            color: #6b21a8;
            font-weight: 800;
            font-size: 11px;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        .party-name {
            font-weight: 800;
            font-size: 13px;
            color: #1e1b4b;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .party-details {
            font-size: 11px;
            line-height: 1.45;
            color: #4b5563;
        }
        .doc-title {
            color: #6b21a8;
            font-size: 34px;
            font-weight: 900;
            letter-spacing: 1.5px;
            margin: 12px 0 10px 0;
            text-align: right;
            text-transform: uppercase;
        }
        .meta-table td {
            padding: 3px 0;
            font-size: 11px;
        }
        .meta-label {
            color: #6b21a8;
            font-weight: bold;
            padding-right: 12px;
            text-align: left;
        }
        .meta-val {
            text-align: right;
            font-weight: bold;
            color: #1e1b4b;
        }
        .logo-placeholder {
            display: inline-block;
            border: 1.5px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 20px;
            color: #94a3b8;
            font-size: 12px;
            font-weight: bold;
            text-align: center;
        }
        .items-table {
            margin-top: 25px;
            margin-bottom: 15px;
            border: 1px solid #e9d5ff;
        }
        .items-table th {
            background-color: #6b21a8;
            color: #ffffff;
            font-weight: bold;
            font-size: 11px;
            padding: 9px 12px;
            text-align: left;
            border-right: 1px solid #7e22ce;
            text-transform: uppercase;
        }
        .items-table th:last-child {
            border-right: none;
        }
        .items-table td {
            padding: 8px 12px;
            font-size: 11px;
            color: #374151;
            border-right: 1px solid #f3e8ff;
            border-bottom: 1px solid #f3e8ff;
            vertical-align: top;
            background-color: #ffffff;
        }
        .items-table td:last-child {
            border-right: none;
        }
        .totals-table {
            width: 42%;
            margin-left: auto;
            border: 1px solid #e9d5ff;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 20px;
        }
        .totals-table td {
            padding: 7px 12px;
            font-size: 11px;
            border: 1px solid #e9d5ff;
            color: #374151;
        }
        .totals-table .total-highlight {
            background-color: #f3e8ff;
            color: #581c87;
            font-weight: bold;
            font-size: 13px;
        }
        .terms-title {
            color: #6b21a8;
            font-weight: 800;
            font-size: 12px;
            letter-spacing: 0.5px;
            margin-top: 25px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        .terms-content {
            font-size: 11px;
            color: #374151;
            line-height: 1.5;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            font-size: 11px;
            color: #4b5563;
            background-color: #ffffff;
        }
    </style>
</head>
<body>
    <!-- Top Header: FROM & TO on left, Logo & Quote title & Meta on right -->
    <table class="header-table">
        <tr>
            <td style="width: 55%; padding-right: 20px;">
                <!-- FROM Block -->
                <div class="section-label">FROM</div>
                <div class="party-name">{{ $seller_name }}</div>
                <div class="party-details">
                    @if(!empty($seller_address))<div>{!! nl2br(e($seller_address)) !!}</div>@endif
                    @if(!empty($seller_phone))<div>Phone: {{ $seller_phone }}</div>@endif
                    @if(!empty($seller_email))<div>Email: {{ $seller_email }}</div>@endif
                    @if(!empty($seller_tpin))<div>TPIN: {{ $seller_tpin }}</div>@endif
                    @if(!empty($seller_pacra))<div>PACRA: {{ $seller_pacra }}</div>@endif
                </div>

                <div style="height: 18px;"></div>

                <!-- TO Block -->
                <div class="section-label">TO</div>
                <div class="party-name" style="text-transform: none;">{{ $customer_name }}</div>
                <div class="party-details">
                    @if(!empty($customer_address))<div>{!! nl2br(e($customer_address)) !!}</div>@endif
                    @if(!empty($customer_phone))<div>Phone: {{ $customer_phone }}</div>@endif
                    @if(!empty($customer_email))<div>Email: {{ $customer_email }}</div>@endif
                    @if(!empty($customer_tpin))<div>TPIN: {{ $customer_tpin }}</div>@endif
                </div>
            </td>

            <td style="width: 45%; text-align: right;">
                <!-- Logo -->
                @if(!empty($logo_data_uri))
                <div style="text-align: right; margin-bottom: 10px;">
                    <img src="{{ $logo_data_uri }}" style="max-height: 60px; max-width: 170px; object-fit: contain;" alt="Logo">
                </div>
                @elseif(!empty($logo_file_uri))
                <div style="text-align: right; margin-bottom: 10px;">
                    <img src="{{ $logo_file_uri }}" style="max-height: 60px; max-width: 170px; object-fit: contain;" alt="Logo">
                </div>
                @elseif(!empty($logo_abs_path))
                <div style="text-align: right; margin-bottom: 10px;">
                    <img src="{{ $logo_abs_path }}" style="max-height: 60px; max-width: 170px; object-fit: contain;" alt="Logo">
                </div>
                @endif

                <!-- Big Purple Title -->
                <div class="doc-title">{{ $doc_title ?? $doc_type }}</div>

                <!-- Meta Table -->
                <table class="meta-table" style="width: auto; margin-left: auto;">
                    <tr>
                        <td class="meta-label">{{ $doc_type }} #:</td>
                        <td class="meta-val">{{ $quote_no }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">{{ $doc_type }} Date:</td>
                        <td class="meta-val">{{ \Carbon\Carbon::parse($quote_date)->format('m/d/Y') }}</td>
                    </tr>
                    <tr>
                        <td class="meta-label">{{ $doc_type === 'Invoice' ? 'Due Date:' : 'Due Date:' }}</td>
                        <td class="meta-val">
                            {{ !empty($expiry_date) ? \Carbon\Carbon::parse($expiry_date)->format('m/d/Y') : 'On Receipt' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Items Table: Solid Purple Header -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%; text-align: center;">QTY</th>
                <th style="width: 54%;">Description</th>
                <th style="width: 18%; text-align: right;">Unit Price</th>
                <th style="width: 18%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td style="text-align: center; font-weight: 500;">{{ $item['qty'] }}</td>
                <td>
                    <div style="font-weight: 600; color: #1f2937;">{!! nl2br(e($item['description'])) !!}</div>
                    @if(!empty($item['image_data_uri']))
                    <div style="margin-top: 5px;">
                        <img src="{{ $item['image_data_uri'] }}" style="max-height: 48px; max-width: 65px; object-fit: contain; border: 1px solid #e9d5ff; border-radius: 3px;" alt="Item image">
                    </div>
                    @endif
                </td>
                <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['price'], 2) }}</td>
                <td style="text-align: right; font-weight: 600;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals Area with Total (in words) -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 15px;">
        <tr>
            <td style="vertical-align: top; width: 52%; padding-right: 15px;">
                @if(!empty($total_in_words))
                <div style="padding: 8px 12px; background-color: #faf5ff; border: 1px solid #e9d5ff; border-radius: 4px;">
                    <div style="font-size: 10px; font-weight: 800; color: #6b21a8; text-transform: uppercase; margin-bottom: 2px;">Total (in words)</div>
                    <div style="font-size: 11px; font-weight: bold; color: #1e1b4b; font-style: italic;">{{ $total_in_words }}</div>
                </div>
                @endif
            </td>
            <td style="vertical-align: top; width: 48%;">
                <table class="totals-table" style="width: 100%; margin: 0;">
                    <tr>
                        <td style="width: 50%;">Subtotal</td>
                        <td style="text-align: right; width: 50%;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($sub_total, 2) }}</td>
                    </tr>
                    @if(!empty($discount_amount) && $discount_amount > 0)
                    <tr>
                        <td>Discount {{ ($discount_type ?? 'percent') === 'percent' ? '('.($discount_value + 0).'%)' : '' }}</td>
                        <td style="text-align: right; color: #dc2626;">- {{ $currency_symbol ?? 'ZMW' }} {{ number_format($discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    @if($vat_registered)
                    <tr>
                        <td>VAT ({{ $vat_rate }}%)</td>
                        <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($vat_amount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="total-highlight">
                        <td>Total</td>
                        <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($grand_total, 2) }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Terms, Payment Details, and Signature -->
    <table style="width: 100%; margin-top: 10px;">
        <tr>
            <td style="width: 65%; vertical-align: top; padding-right: 20px;">
                @if($doc_type === 'Receipt')
                    <div style="padding: 6px 10px; background-color: #f3e8ff; border: 1px solid #d8b4fe; border-radius: 4px; color: #581c87; margin-bottom: 8px; font-size: 11px;">
                        <strong>Payment Received:</strong> {{ $payment_method_received ?? 'Direct' }} &mdash; <strong>PAID IN FULL</strong>
                    </div>
                @endif

                @if(!empty($terms_conditions))
                    <div class="terms-title">TERMS AND CONDITIONS</div>
                    <div class="terms-content">
                        <div>{!! nl2br(e($terms_conditions)) !!}</div>
                    </div>
                @endif

                @if(!empty($account_name))
                    <div style="margin-top: 8px; font-size: 11px; color: #374151;">
                        All checks to be made out to: <strong>{{ $account_name }}</strong>
                    </div>
                @endif

                @if(!empty($payment_details))
                    <div style="margin-top: 10px; padding: 6px 10px; background-color: #faf5ff; border: 1px solid #e9d5ff; border-radius: 4px; font-size: 10px;">
                        <strong>Payment Details:</strong><br>
                        {!! nl2br(e($payment_details)) !!}
                    </div>
                @endif

                @if(!empty($notes))
                    <div style="margin-top: 10px; padding: 6px 10px; background-color: #faf5ff; border: 1px solid #e9d5ff; border-radius: 4px; font-size: 10px; color: #374151;">
                        <strong style="color: #6b21a8;">Notes:</strong><br>
                        {!! nl2br(e($notes)) !!}
                    </div>
                @endif

                @if(!empty($additional_info))
                    <div style="margin-top: 10px; padding: 6px 10px; background-color: #faf5ff; border: 1px solid #e9d5ff; border-radius: 4px; font-size: 10px; color: #374151;">
                        <strong style="color: #6b21a8;">Additional Information:</strong><br>
                        {!! nl2br(e($additional_info)) !!}
                    </div>
                @endif

                <div style="margin-top: 12px; font-weight: bold; color: #4b5563; font-size: 11px;">
                    Thank you for your business!
                </div>
            </td>

            <td style="width: 35%; vertical-align: top; text-align: center;">
                @if(!empty($signature_data_uri) || !empty($signee_name))
                <div style="margin-top: 20px; display: inline-block; text-align: center; min-width: 170px;">
                    @if(!empty($signature_data_uri))
                    <div style="margin-bottom: 4px;">
                        <img src="{{ $signature_data_uri }}" style="max-height: 50px; max-width: 160px; object-fit: contain;" alt="Signature">
                    </div>
                    @endif
                    <div style="border-top: 1.5px solid #6b21a8; padding-top: 4px; font-size: 11px; font-weight: bold; color: #1e1b4b;">
                        {{ !empty($signee_name) ? $signee_name : 'Authorized Signature' }}
                    </div>
                </div>
                @endif
            </td>
        </tr>
    </table>

    <!-- 3-Column Contact Footer -->
    <div class="footer">
        <table>
            <tr>
                <td style="width: 33%; text-align: left;">
                    Tel: {{ $seller_phone }}
                </td>
                <td style="width: 34%; text-align: center;">
                    @if(!empty($seller_email))Email: {{ $seller_email }}@endif
                </td>
                <td style="width: 33%; text-align: right;">
                    @if(!empty($seller_pacra))
                        Reg: {{ $seller_pacra }}
                    @else
                        quick-docs.io
                    @endif
                </td>
            </tr>
        </table>
    </div>
</body>
</html>