<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        .title { font-size: 28px; font-weight: bold; text-align: right; letter-spacing: 1px; color: #333; }
        .box-header { background-color: #d9d9d9; font-weight: bold; text-align: center; padding: 5px; border: 1px solid #000; }
        .box-cell { border: 1px solid #000; padding: 5px; text-align: center; }
        .section-title { background-color: #d9d9d9; font-weight: bold; padding: 5px; border: 1px solid #000; margin-top: 20px; }
        .bordered-box { border: 1px solid #000; padding: 10px; height: 60px; }
        .items-table { margin-top: 20px; }
        .items-table th { background-color: #d9d9d9; border: 1px solid #000; padding: 5px; }
        .items-table td { border-left: 1px solid #000; border-right: 1px solid #000; padding: 5px; }
        .items-table .bottom-border { border-bottom: 1px solid #000; }
        .totals-box { border: 1px solid #000; padding: 5px; font-weight: bold; }
    </style>
</head>
<body>
    <table>
        <tr>
            <td style="width: 60%; vertical-align: top;">
                <h2 style="margin:0; color:#1f497d;">Ori Studio Limited</h2>
                Livingstone, Zambia<br>Phone: +260 XXX XXX<br>hello@oristudio.com
            </td>
            <td style="width: 40%; vertical-align: top;">
                <div class="title">{{ strtoupper($doc_type) }}</div><br>
                <table>
                    <tr><td class="box-header">DATE</td><td class="box-header">{{ strtoupper($doc_type) }} #</td></tr>
                    <tr><td class="box-cell">{{ \Carbon\Carbon::parse($date)->format('m/d/Y') }}</td><td class="box-cell">2034</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="section-title" style="width: 40%;">CUSTOMER INFO</div>
    <div class="bordered-box" style="width: 38%;">
        <strong>{{ $client_name }}</strong><br>
        [Client Address]<br>[City, ZIP]
    </div>

    <table class="items-table" style="border-bottom: 1px solid #000;">
        <thead>
            <tr>
                <th style="width: 55%; text-align: left;">ITEMIZED COSTS</th>
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
                <td style="text-align: right;">{{ number_format($item['price'], 2) }}</td>
                <td style="text-align: right;">{{ number_format($item['line_total'], 2) }}</td>
            </tr>
            @endforeach
            <tr><td colspan="4" style="height: 50px;"></td></tr> 
        </tbody>
    </table>

    <table style="width: 40%; float: right; margin-top: -1px;">
        <tr>
            <td class="totals-box" style="background-color: #d9d9d9;">TOTAL {{ strtoupper($doc_type) }}</td>
            <td class="totals-box" style="text-align: right;">ZMW {{ number_format($grand_total, 2) }}</td>
        </tr>
    </table>
</body>
</html>