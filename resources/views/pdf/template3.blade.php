<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $doc_title ?? $doc_type }} - {{ $quote_no }}</title>
    <style>
        @page {
            margin: 20px 25px 25px 25px;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            font-size: 11px;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
        }
        .doc-title {
            color: #00a8cc;
            font-size: 42px;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
            line-height: 1;
        }
        .logo-circle {
            display: inline-block;
            width: 62px;
            height: 62px;
            border-radius: 50%;
            background-color: #f59e0b;
            color: #ffffff;
            text-align: center;
            line-height: 62px;
            font-weight: bold;
            font-size: 15px;
        }
        .teal-divider {
            height: 3px;
            background-color: #00a8cc;
            margin: 15px 0 20px 0;
        }
        .info-table td {
            vertical-align: top;
        }
        .party-name {
            font-weight: bold;
            font-size: 12px;
            color: #0f172a;
        }
        .italic-info {
            font-style: italic;
            color: #475569;
            font-size: 11px;
            line-height: 1.4;
        }
        .meta-card {
            background-color: #f8fafc;
            border: 1px solid #f1f5f9;
            border-radius: 4px;
            padding: 12px 14px;
        }
        .meta-card table td {
            padding: 3px 0;
            font-size: 11px;
        }
        .meta-card-label {
            color: #334155;
            width: 55%;
        }
        .meta-card-val {
            text-align: right;
            font-weight: 500;
            color: #0f172a;
        }
        .items-table {
            margin-top: 25px;
            border-top: 2.5px solid #00a8cc;
            border-bottom: 2.5px solid #00a8cc;
        }
        .items-table th {
            padding: 9px 8px;
            font-size: 11px;
            font-weight: bold;
            color: #0f172a;
            border-bottom: 1px solid #cbd5e1;
        }
        .items-table td {
            padding: 9px 8px;
            font-size: 11px;
            border-bottom: 1px solid #e2e8f0;
            vertical-align: top;
        }
        .totals-table {
            width: 42%;
            margin-left: auto;
            margin-top: 15px;
            font-size: 11px;
        }
        .totals-table td {
            padding: 5px 8px;
        }
        .totals-table .grand-total-label {
            color: #00a8cc;
            font-weight: 800;
            font-size: 13px;
            padding-top: 8px;
        }
        .totals-table .grand-total-val {
            color: #00a8cc;
            font-weight: 800;
            font-size: 13px;
            text-align: right;
            padding-top: 8px;
        }
        .signature-section {
            margin-top: 30px;
        }
        .signature-section td {
            vertical-align: bottom;
        }
        .footer-section {
            margin-top: 35px;
            border-top: 1px solid #cbd5e1;
            padding-top: 12px;
        }
        .footer-col-title {
            font-weight: bold;
            font-size: 11px;
            color: #0f172a;
            margin-bottom: 4px;
        }
        .footer-col-content {
            font-size: 10px;
            color: #475569;
            line-height: 1.4;
        }
        .bottom-bar {
            height: 12px;
            background-color: #00a8cc;
            margin-top: 16px;
        }
    </style>
</head>
<body>
    <!-- Top Header: Large Teal Title on left, Logo on right -->
    <table class="header-table">
        <tr>
            <td style="width: 70%;">
                <h1 class="doc-title">{{ ucfirst(strtolower($doc_title ?? $doc_type)) }}</h1>
            </td>
            <td style="width: 30%; text-align: right;">
                @if(!empty($logo_data_uri))
                    <img src="{{ $logo_data_uri }}" style="max-height: 60px; max-width: 140px; object-fit: contain;" alt="Logo">
                @elseif(!empty($logo_file_uri))
                    <img src="{{ $logo_file_uri }}" style="max-height: 60px; max-width: 140px; object-fit: contain;" alt="Logo">
                @elseif(!empty($logo_abs_path))
                    <img src="{{ $logo_abs_path }}" style="max-height: 60px; max-width: 140px; object-fit: contain;" alt="Logo">
                @endif
            </td>
        </tr>
    </table>

    <!-- Horizontal Teal Divider -->
    <div class="teal-divider"></div>

    <!-- Body Information: Left Parties & Info, Right Gray Metadata Box -->
    <table class="info-table">
        <tr>
            <td style="width: 52%; padding-right: 15px;">
                <!-- Seller Info -->
                <div class="party-name">{{ $seller_name }}</div>
                <div class="italic-info">
                    @if(!empty($seller_address))<div>{!! nl2br(e($seller_address)) !!}</div>@endif
                    @if(!empty($seller_tpin))<div>TPIN: {{ $seller_tpin }}</div>@endif
                    @if(!empty($seller_pacra))<div>PACRA: {{ $seller_pacra }}</div>@endif
                    @if(!empty($seller_phone))<div>Phone: {{ $seller_phone }}</div>@endif
                    @if(!empty($seller_email))<div>Email: {{ $seller_email }}</div>@endif
                </div>

                <div style="height: 14px;"></div>

                <!-- Customer Info -->
                <div class="party-name">To</div>
                <div class="party-name">{{ $customer_name }}</div>
                <div class="italic-info">
                    @if(!empty($customer_address))<div>{!! nl2br(e($customer_address)) !!}</div>@endif
                    @if(!empty($customer_tpin))<div>TPIN: {{ $customer_tpin }}</div>@endif
                    @if(!empty($customer_phone))<div>Phone: {{ $customer_phone }}</div>@endif
                    @if(!empty($customer_email))<div>Email: {{ $customer_email }}</div>@endif
                </div>
            </td>

            <td style="width: 48%; padding-left: 10px;">
                <!-- Right Metadata Card -->
                <div class="meta-card">
                    <table>
                        <tr>
                            <td class="meta-card-label">{{ $doc_type }} Date:</td>
                            <td class="meta-card-val">{{ \Carbon\Carbon::parse($quote_date)->format('d.m.Y') }}</td>
                        </tr>
                        <tr>
                            <td class="meta-card-label">{{ $doc_type }} Reference Number:</td>
                            <td class="meta-card-val">{{ $quote_no }}</td>
                        </tr>
                        <tr>
                            <td class="meta-card-label">{{ $doc_type === 'Invoice' ? 'Due Date:' : 'Quote Valid Until:' }}</td>
                            <td class="meta-card-val">
                                {{ !empty($expiry_date) ? \Carbon\Carbon::parse($expiry_date)->format('d.m.Y') : 'Upon receipt' }}
                            </td>
                        </tr>
                        <tr>
                            <td class="meta-card-label">Issued By:</td>
                            <td class="meta-card-val">{{ !empty($signee_name) ? $signee_name : $seller_name }}</td>
                        </tr>
                        <tr>
                            <td class="meta-card-label">Client Contact:</td>
                            <td class="meta-card-val">{{ $customer_name }}</td>
                        </tr>
                        <tr>
                            <td class="meta-card-label">Work Start Date:</td>
                            <td class="meta-card-val">{{ \Carbon\Carbon::parse($quote_date)->format('d.m.Y') }}</td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>

    <!-- Items Table: Minimal with Teal Borders -->
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 44%; text-align: left;">Description</th>
                <th style="width: 10%; text-align: center;">Qty</th>
                <th style="width: 15%; text-align: right;">Unit Price</th>
                @if($vat_registered)
                <th style="width: 13%; text-align: right;">VAT%</th>
                <th style="width: 18%; text-align: right;">Total</th>
                @else
                <th style="width: 31%; text-align: right;">Total</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>
                    <div style="font-weight: 500; color: #0f172a;">{!! nl2br(e($item['description'])) !!}</div>
                    @if(!empty($item['image_data_uri']))
                    <div style="margin-top: 5px;">
                        <img src="{{ $item['image_data_uri'] }}" style="max-height: 48px; max-width: 65px; object-fit: contain; border: 1px solid #cbd5e1; border-radius: 2px;" alt="Item image">
                    </div>
                    @endif
                </td>
                <td style="text-align: center;">{{ $item['qty'] }}</td>
                <td style="text-align: right;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['price'], 2) }}</td>
                @if($vat_registered)
                <td style="text-align: right;">{{ $vat_rate }}%</td>
                @endif
                <td style="text-align: right; font-weight: 500;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Totals Area with Total (in words) -->
    <table style="width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 15px;">
        <tr>
            <td style="vertical-align: top; width: 52%; padding-right: 15px;">
                @if(!empty($total_in_words))
                <div style="padding: 8px 12px; background-color: #f0fdfa; border-left: 3px solid #00a8cc; border-radius: 2px;">
                    <div style="font-size: 10px; font-weight: bold; color: #00a8cc; text-transform: uppercase; margin-bottom: 2px;">Total (in words)</div>
                    <div style="font-size: 11px; font-weight: bold; color: #0f172a; font-style: italic;">{{ $total_in_words }}</div>
                </div>
                @endif
            </td>
            <td style="vertical-align: top; width: 48%;">
                <table class="totals-table" style="width: 100%; margin: 0;">
                    <tr>
                        <td style="font-weight: bold; color: #334155;">Sub Total</td>
                        <td style="text-align: right; font-weight: bold; color: #0f172a;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($sub_total, 2) }}</td>
                    </tr>
                    @if(!empty($discount_amount) && $discount_amount > 0)
                    <tr>
                        <td style="font-weight: bold; color: #dc2626;">Discount {{ ($discount_type ?? 'percent') === 'percent' ? '('.($discount_value + 0).'%)' : '' }}</td>
                        <td style="text-align: right; font-weight: bold; color: #dc2626;">- {{ $currency_symbol ?? 'ZMW' }} {{ number_format($discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    @if($vat_registered)
                    <tr>
                        <td style="font-weight: bold; color: #334155;">VAT</td>
                        <td style="text-align: right; font-weight: bold; color: #0f172a;">{{ $currency_symbol ?? 'ZMW' }} {{ number_format($vat_amount, 2) }}</td>
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

    <!-- Signatures: Client Signature on Left, Authorized Signature on Right -->
    <table class="signature-section" style="width: 100%;">
        <tr>
            <td style="width: 60%; text-align: left;">
                <div style="font-size: 11px; color: #334155;">
                    Client Signature: <span style="display: inline-block; border-bottom: 1px solid #64748b; width: 220px; height: 12px;"></span>
                </div>
            </td>
            <td style="width: 40%; text-align: right;">
                @if(!empty($signature_data_uri) || !empty($signee_name))
                <div style="display: inline-block; text-align: center; min-width: 160px;">
                    @if(!empty($signature_data_uri))
                    <div style="margin-bottom: 3px;">
                        <img src="{{ $signature_data_uri }}" style="max-height: 48px; max-width: 150px; object-fit: contain;" alt="Signature">
                    </div>
                    @endif
                    <div style="border-top: 1.5px solid #00a8cc; padding-top: 3px; font-size: 11px; font-weight: bold; color: #0f172a;">
                        {{ !empty($signee_name) ? $signee_name : 'Authorized Signature' }}
                    </div>
                </div>
                @endif
            </td>
        </tr>
    </table>

    <!-- Bottom Section: T&Cs, Bank Details, Notes, Additional Info (only shown if added) -->
    @php
        $hasBankDetails = ($doc_type === 'Receipt' && !empty($payment_method_received)) || (!empty($bank_name) || !empty($account_no) || !empty($mobile_network_provider) || !empty($payment_details));
        $hasTerms = !empty($terms_conditions);
        $hasNotes = !empty($notes);
        $hasAdditionalInfo = !empty($additional_info);
        $activeCols = ($hasBankDetails ? 1 : 0) + ($hasTerms ? 1 : 0) + ($hasNotes ? 1 : 0) + ($hasAdditionalInfo ? 1 : 0);
        $colWidth = $activeCols > 0 ? floor(100 / $activeCols) : 100;
    @endphp

    @if($activeCols > 0)
    <div class="footer-section">
        <table style="width: 100%;">
            <tr>
                @if($hasBankDetails)
                <td style="width: {{ $colWidth }}%; vertical-align: top; padding-right: 15px;">
                    <div class="footer-col-title">Bank &amp; Payment Details:</div>
                    <div class="footer-col-content">
                        @if($doc_type === 'Receipt')
                            <div>Method: {{ $payment_method_received ?? 'Direct' }}</div>
                            <div style="font-weight: bold; color: #00a8cc; margin-top: 2px;">PAID IN FULL</div>
                        @else
                            @if(!empty($bank_name))
                                <div>Bank Name: {{ $bank_name }}</div>
                                @if(!empty($account_name))<div>Account Name: {{ $account_name }}</div>@endif
                                @if(!empty($account_no))<div>Account No: {{ $account_no }}</div>@endif
                                @if(!empty($branch))<div>Branch: {{ $branch }}</div>@endif
                                @if(!empty($sort_code))<div>Sort-Code: {{ $sort_code }}</div>@elseif(!empty($branch_code))<div>Branch Code: {{ $branch_code }}</div>@endif
                                @if(!empty($swift_code))<div>Swift Code: {{ $swift_code }}</div>@endif
                            @elseif(!empty($mobile_network_provider))
                                <div>Provider: {{ $mobile_network_provider }}</div>
                                <div>Phone: {{ $mobile_phone_no }}</div>
                                @if(!empty($mobile_account_name))<div>Name: {{ $mobile_account_name }}</div>@endif
                            @elseif(!empty($payment_details))
                                <div>{!! nl2br(e($payment_details)) !!}</div>
                            @endif
                        @endif
                    </div>
                </td>
                @endif

                @if($hasTerms)
                <td style="width: {{ $colWidth }}%; vertical-align: top; padding-right: 15px;">
                    <div class="footer-col-title">Terms &amp; Conditions:</div>
                    <div class="footer-col-content">
                        <div>{!! nl2br(e($terms_conditions)) !!}</div>
                    </div>
                </td>
                @endif

                @if($hasNotes)
                <td style="width: {{ $colWidth }}%; vertical-align: top; padding-right: 15px;">
                    <div class="footer-col-title">Notes:</div>
                    <div class="footer-col-content">
                        <div>{!! nl2br(e($notes)) !!}</div>
                    </div>
                </td>
                @endif

                @if($hasAdditionalInfo)
                <td style="width: {{ $colWidth }}%; vertical-align: top;">
                    <div class="footer-col-title">Additional Info:</div>
                    <div class="footer-col-content">
                        <div>{!! nl2br(e($additional_info)) !!}</div>
                    </div>
                </td>
                @endif
            </tr>
        </table>
    </div>
    @endif

    <!-- Bottom Teal Bar -->
    <div class="bottom-bar"></div>
</body>
</html>