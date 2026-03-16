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
                <h2>Ori Studio Limited</h2>
                <p>1234 Design Street<br>Livingstone, Zambia<br>hello@oristudio.com</p>
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
                <span style="font-size: 18px;">{{ $client_name }}</span><br>
                Client Address/Details Here
            </td>
            <td style="width: 50%;">
                <table>
                    <tr><td style="text-align: right; font-weight: bold;" class="theme-color">{{ $doc_type }} Date:</td><td style="text-align: right;">{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</td></tr>
                    <tr><td style="text-align: right; font-weight: bold;" class="theme-color">{{ $doc_type }} #:</td><td style="text-align: right;">000123</td></tr>
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
        <tr><td>Subtotal</td><td style="text-align: right;">ZMW {{ number_format($grand_total, 2) }}</td></tr>
        <tr><td class="grand-total">Total</td><td class="grand-total" style="text-align: right;">ZMW {{ number_format($grand_total, 2) }}</td></tr>
    </table>
</body>
</html>