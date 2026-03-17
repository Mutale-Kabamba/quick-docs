<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 14px; color: #111; }
        .theme-color { color: #004080; }
        table { width: 100%; border-collapse: collapse; }
        .header-table td { vertical-align: top; }
        .doc-title { font-size: 36px; font-weight: bold; text-align: right; letter-spacing: 2px; }
        .meta-table { margin-top: 40px; margin-bottom: 40px; }
        .meta-table td { vertical-align: top; }
        .items-table th { background-color: #004080; color: white; padding: 10px; text-align: left; }
        .items-table td { padding: 10px; border-bottom: 1px solid #ddd; }
        .totals-table { width: 50%; float: right; margin-top: 20px; }
        .totals-table td { padding: 8px; border-bottom: 1px solid #ddd; }
        .totals-table .grand-total { font-weight: bold; color: #004080; border-bottom: 2px solid #004080; }
    </style>
</head>
<body>
    <table class="header-table">
        <tr>
            <td>
                <h2>{{ $seller_name ?? 'Ori Studio Limited' }}</h2>
                <p>{{ $seller_address }}<br>{{ $seller_phone }}<br>{{ $seller_email }}</p>
            </td>
            <td class="doc-title theme-color">
                {{ strtoupper($doc_type) }}
            </td>
        </tr>
    </table>

    <table class="meta-table">
        <tr>
            <td style="width: 50%;">
                <strong class="theme-color">Bill To</strong><br>
                <span style="font-size: 18px;">{{ $customer_name }}</span><br>
                {{ $customer_address }}<br>{{ $customer_email }}
            </td>
            <td style="width: 50%;">
                <table>
                    <tr><td style="text-align: right; font-weight: bold;" class="theme-color">{{ $doc_type }} Date:</td><td style="text-align: right;">{{ \Carbon\Carbon::parse($quote_date)->format('d-m-Y') }}</td></tr>
                    <tr><td style="text-align: right; font-weight: bold;" class="theme-color">{{ $doc_type }} #:</td><td style="text-align: right;">{{ $quote_no }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">QTY</th>
                <th style="width: 50%;">Description</th>
                <th style="width: 20%; text-align: right;">Unit Price</th>
                <th style="width: 20%; text-align: right;">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item['qty'] }}</td>
                <td>{{ $item['description'] }}</td>
                <td style="text-align: right;">ZMW {{ number_format($item['price'], 2) }}</td>
                <td style="text-align: right;">ZMW {{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr><td>Subtotal</td><td style="text-align: right;">ZMW {{ number_format($sub_total, 2) }}</td></tr>
        @if($vat_registered)
        <tr><td>VAT ({{ $vat_rate }}%)</td><td style="text-align: right;">ZMW {{ number_format($vat_amount, 2) }}</td></tr>
        @endif
        <tr><td class="grand-total">Total</td><td class="grand-total" style="text-align: right;">ZMW {{ number_format($grand_total, 2) }}</td></tr>
    </table>

    @if(!empty($payment_details))
    <div style="clear: both; margin-top: 40px;">
        <strong>Payment Details:</strong>
        <p style="white-space: pre-wrap; font-size: 12px;">{{ $payment_details }}</p>
    </div>
    @endif

    @if(!empty($terms_conditions))
    <div style="margin-top: 20px;">
        <strong>Terms & Conditions:</strong>
        <p style="white-space: pre-wrap; font-size: 12px;">{{ $terms_conditions }}</p>
    </div>
    @endif

    <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; font-size: 10px; color: #666;">
        System time generated: {{ $generated_at ?? now()->format('Y-m-d H:i:s') }} | {{ $seller_name ?? 'Ori Studio Limited' }} Business Docs
    </div>
</body>
</html>