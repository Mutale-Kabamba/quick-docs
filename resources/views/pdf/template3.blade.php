<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; color: #1b2a36; }
        .brand { color: #0b5c49; }
        table { width: 100%; border-collapse: collapse; }
        .header { border-bottom: 2px solid #0b5c49; padding-bottom: 12px; margin-bottom: 16px; }
        .header td { vertical-align: top; }
        .title { text-align: right; font-size: 24px; font-weight: bold; letter-spacing: 1px; color: #0b5c49; }
        .logo { width: 64px; height: 64px; object-fit: contain; }
        .meta-wrap { margin-bottom: 14px; }
        .meta-wrap td { vertical-align: top; }
        .box { border: 1px solid #d9e3ed; border-radius: 6px; padding: 8px; background: #fbfdff; min-height: 90px; }
        .box-title { font-weight: bold; font-size: 11px; margin-bottom: 4px; color: #0f3855; text-transform: uppercase; }
        .items-table th { background: #0b5c49; color: #fff; padding: 8px; font-size: 11px; text-transform: uppercase; border: 1px solid #0b5c49; text-align: left; }
        .items-table td { padding: 8px; border: 1px solid #d9e3ed; }
        .text-right { text-align: right; }
        .totals { width: 42%; margin-left: auto; margin-top: 12px; }
        .totals td { padding: 7px 8px; border-bottom: 1px solid #d9e3ed; }
        .totals .grand td { font-weight: bold; color: #0b5c49; border-top: 2px solid #0b5c49; border-bottom: 2px solid #0b5c49; }
        .note-wrap { margin-top: 16px; }
        .note-box { border: 1px solid #d9e3ed; border-radius: 6px; padding: 8px; min-height: 64px; }
        .footer { margin-top: 22px; border-top: 1px dashed #c9d7e4; padding-top: 8px; font-size: 10px; color: #4e6278; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td style="width: 74%;">
                    <h2 style="margin:0;" class="brand">{{ $seller_name }}</h2>
                    @if(!empty($seller_tpin))<div>TPIN: {{ $seller_tpin }}</div>@endif
                    @if(!empty($seller_pacra))<div>PACRA Reg. No.: {{ $seller_pacra }}</div>@endif
                    <div>Phone: {{ $seller_phone }}</div>
                    <div>{{ $seller_address }}</div>
                    @if(!empty($seller_email))<div>{{ $seller_email }}</div>@endif
                </td>
                <td style="width: 26%; text-align: right;">
                    @if(!empty($logo_data_uri))
                        <img src="{{ $logo_data_uri }}" class="logo" alt="logo" style="display:block; margin-left:auto;" />
                    @elseif(!empty($logo_file_uri))
                        <img src="{{ $logo_file_uri }}" class="logo" alt="logo" style="display:block; margin-left:auto;" />
                    @elseif(!empty($logo_abs_path))
                        <img src="{{ $logo_abs_path }}" class="logo" alt="logo" style="display:block; margin-left:auto;" />
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="title">QUOTATION</div>

    <table class="meta-wrap">
        <tr>
            <td style="width: 52%; padding-right: 8px;">
                <div class="box">
                    <div class="box-title">Customer Details</div>
                    <div><strong>{{ $customer_name }}</strong></div>
                    @if(!empty($customer_tpin))<div>TPIN: {{ $customer_tpin }}</div>@endif
                    <div>Phone: {{ $customer_phone }}</div>
                    <div>{{ $customer_address }}</div>
                    @if(!empty($customer_email))<div>{{ $customer_email }}</div>@endif
                </div>
            </td>
            <td style="width: 48%; padding-left: 8px;">
                <div class="box">
                    <div class="box-title">Quotation Details</div>
                    <div><strong>Quote No.:</strong> {{ $quote_no }}</div>
                    <div><strong>Quote Date:</strong> {{ \Carbon\Carbon::parse($quote_date)->format('d M Y') }}</div>
                    <div><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($expiry_date)->format('d M Y') }}</div>
                </div>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr class="navy-bg">
                <th style="width: 12%;">QTY</th>
                <th style="width: 46%;">Description</th>
                <th style="width: 21%;" class="text-right">Unit Price</th>
                <th style="width: 21%;" class="text-right">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['qty'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td class="text-right">{{ number_format($item['price'], 2) }}</td>
                <td class="text-right">{{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals">
        <tr>
            <td>Sub Total</td>
            <td class="text-right">ZMW {{ number_format($sub_total, 2) }}</td>
        </tr>
        <tr>
            <td>VAT @ {{ number_format($vat_rate, 0) }}% {{ $vat_registered ? '' : '(Not Registered)' }}</td>
            <td class="text-right">ZMW {{ number_format($vat_amount, 2) }}</td>
        </tr>
        <tr class="grand">
            <td>Total</td>
            <td class="text-right">ZMW {{ number_format($grand_total, 2) }}</td>
        </tr>
    </table>

    <table class="note-wrap">
        <tr>
            <td style="width: 50%; padding-right: 8px; vertical-align: top;">
                <div class="note-box">
                    <div class="box-title">T&amp;Cs</div>
                    {!! nl2br(e($terms_conditions ?? '')) !!}
                </div>
            </td>
            <td style="width: 50%; padding-left: 8px; vertical-align: top;">
                <div class="note-box">
                    <div class="box-title">Payment Details</div>
                    {!! nl2br(e($payment_details ?? '')) !!}
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        System time generated: {{ $generated_at ?? now()->format('Y-m-d H:i:s') }} | Ori Studio Limited Business Docs
    </div>
</body>
</html>