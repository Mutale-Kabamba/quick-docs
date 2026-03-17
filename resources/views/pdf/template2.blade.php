<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; color: #22313f; margin-bottom: 68px; }
        table { width: 100%; border-collapse: collapse; }
        .header-row td { vertical-align: top; }
        .brand { font-size: 24px; font-weight: bold; color: #1f497d; margin: 0; }
        .title { font-size: 28px; font-weight: bold; text-align: right; letter-spacing: 1px; color: #1f497d; margin: 0; }
        .logo-wrap { text-align: right; margin-bottom: 8px; }
        .logo { width: 60px; height: 60px; object-fit: contain; }
        .logo-fallback {
            width: 60px;
            height: 60px;
            display: inline-block;
            line-height: 60px;
            text-align: center;
            border-radius: 50%;
            background: #1f497d;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
        }
        .meta-card {
            border: 1px solid #d9e2ec;
            background: #f8fbff;
            border-radius: 6px;
            padding: 10px;
        }
        .meta-label { font-weight: bold; color: #49627c; text-transform: uppercase; font-size: 10px; margin-bottom: 4px; }
        .doc-meta td { padding: 6px 8px; border-bottom: 1px solid #d9e2ec; }
        .doc-meta td:first-child { width: 50%; color: #49627c; font-weight: bold; }
        .doc-meta tr:last-child td { border-bottom: none; }
        .items-table { margin-top: 18px; border: 1px solid #d9e2ec; }
        .items-table th { background-color: #eef4fa; color: #28435e; border-bottom: 1px solid #d9e2ec; padding: 8px; font-size: 11px; text-align: left; }
        .items-table td { border-bottom: 1px solid #e5edf5; padding: 8px; }
        .items-table tbody tr:last-child td { border-bottom: none; }
        .totals-table { width: 42%; margin-left: auto; margin-top: 14px; border: 1px solid #d9e2ec; }
        .totals-table td { padding: 8px 10px; border-bottom: 1px solid #e5edf5; }
        .totals-table tr:last-child td { border-bottom: none; font-weight: bold; color: #1f497d; background: #eef4fa; }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 9px;
            color: #888;
            text-align: center;
            background: #fff;
        }
    </style>
</head>
<body>
    <table class="header-row">
        <tr>
            <td style="width: 58%;">
                <h2 class="brand">{{ $seller_name ?? 'Ori Studio Limited' }}</h2>
                <div>{{ $seller_address }}</div>
                <div>Phone: {{ $seller_phone }}</div>
                @if(!empty($seller_email))<div>{{ $seller_email }}</div>@endif
            </td>
            <td style="width: 42%;">
                <div class="logo-wrap">
                    @if(!empty($logo_data_uri))
                        <img src="{{ $logo_data_uri }}" class="logo" alt="logo" />
                    @elseif(!empty($logo_file_uri))
                        <img src="{{ $logo_file_uri }}" class="logo" alt="logo" />
                    @elseif(!empty($logo_abs_path))
                        <img src="{{ $logo_abs_path }}" class="logo" alt="logo" />
                    @else
                        <span class="logo-fallback">OS</span>
                    @endif
                </div>
                <div class="title">{{ strtoupper($doc_type) }}</div>
                <table class="doc-meta" style="margin-top: 10px;">
                    <tr><td>Date</td><td style="text-align: right;">{{ \Carbon\Carbon::parse($quote_date)->format('d-m-Y') }}</td></tr>
                    <tr><td>{{ strtoupper($doc_type) }} #</td><td style="text-align: right;">{{ $quote_no }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: 16px;">
        <tr>
            <td style="width: 100%; vertical-align: top;">
                <div class="meta-card">
                    <div class="meta-label">Customer</div>
                    <div><strong>{{ $customer_name }}</strong></div>
                    <div>{{ $customer_address }}</div>
                    <div>{{ $customer_phone }}</div>
                    @if(!empty($customer_email))<div>{{ $customer_email }}</div>@endif
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 55%; text-align: left;">Description</th>
                <th style="width: 10%;">QTY</th>
                <th style="width: 15%;">UNIT PRICE</th>
                <th style="width: 20%;">AMOUNT</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['description'] }}</td>
                <td style="text-align: center;">{{ $item['qty'] }}</td>
                <td style="text-align: right;">ZMW {{ number_format($item['price'], 2) }}</td>
                <td style="text-align: right;">ZMW {{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td>Subtotal</td>
            <td style="text-align: right;">ZMW {{ number_format($sub_total, 2) }}</td>
        </tr>
        @if($vat_registered)
        <tr>
            <td>VAT ({{ $vat_rate }}%)</td>
            <td style="text-align: right;">ZMW {{ number_format($vat_amount, 2) }}</td>
        </tr>
        @endif
        <tr>
            <td>Total {{ strtoupper($doc_type) }}</td>
            <td style="text-align: right;">ZMW {{ number_format($grand_total, 2) }}</td>
        </tr>
    </table>

    <div style="clear: both; margin-top: 22px;">
        @if(!empty($payment_details))
        <div class="meta-card" style="margin-bottom: 12px;">
            <div class="meta-label">Payment Details</div>
            <div style="white-space: pre-wrap;">{{ $payment_details }}</div>
        </div>
        @endif

        @if(!empty($terms_conditions))
        <div class="meta-card">
            <div class="meta-label">Terms & Conditions</div>
            <div style="white-space: pre-wrap;">{{ $terms_conditions }}</div>
        </div>
        @endif
    </div>

    <div class="footer">
        System time generated: {{ $generated_at ?? now()->format('Y-m-d H:i:s') }} | {{ $seller_name ?? 'Ori Studio Limited' }} Business Docs
    </div>
</body>
</html>