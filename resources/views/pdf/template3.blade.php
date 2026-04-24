<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica', Arial, sans-serif; font-size: 12px; color: #1b2a36; margin-bottom: 70px; }
        .brand { color: #0b5c49; }
        table { width: 100%; border-collapse: collapse; }
        .header { border-bottom: 2px solid #0b5c49; padding-bottom: 12px; margin-bottom: 16px; }
        .header td { vertical-align: top; }
        .title { text-align: right; font-size: 24px; font-weight: bold; letter-spacing: 1px; color: #0b5c49; }
        .logo { width: 64px; height: 64px; object-fit: contain; }
        .logo-fallback {
            width: 64px;
            height: 64px;
            display: inline-block;
            line-height: 64px;
            text-align: center;
            border-radius: 50%;
            background: #0b5c49;
            color: #fff;
            font-weight: bold;
            letter-spacing: 1px;
        }
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
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            border-top: 1px dashed #c9d7e4;
            padding-top: 8px;
            font-size: 10px;
            color: #4e6278;
            text-align: center;
            background: #fff;
        }
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
                    @else
                        <span class="logo-fallback">OS</span>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <div class="title">{{ strtoupper($doc_type) }}</div>

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
                    <div class="box-title">{{ $doc_type }} Details</div>
                    <div><strong>{{ $doc_type }} No.:</strong> {{ $quote_no }}</div>
                    <div><strong>{{ $doc_type }} Date:</strong> {{ \Carbon\Carbon::parse($quote_date)->format('d M Y') }}</div>
                    @if($doc_type === 'Invoice' && !empty($expiry_date))
                    <div><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($expiry_date)->format('d M Y') }}</div>
                    @elseif($doc_type === 'Quotation' && !empty($expiry_date))
                    <div><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($expiry_date)->format('d M Y') }}</div>
                    @endif
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
                    <div class="box-title">{{ $doc_type === 'Receipt' ? 'Notes' : 'T&amp;Cs' }}</div>
                    {!! nl2br(e($terms_conditions ?? '')) !!}
                </div>
            </td>
            <td style="width: 50%; padding-left: 8px; vertical-align: top;">
                <div class="note-box">
                    @if($doc_type === 'Receipt')
                    <div class="box-title">Payment Received</div>
                    @if(!empty($payment_method_received))
                    <div><strong>Paid Via:</strong> {{ $payment_method_received }}</div>
                    @endif
                    <div style="margin-top: 10px; color: #0b5c49; font-weight: bold; font-size: 16px;">&#10003; PAID IN FULL</div>
                    @else
                    <div class="box-title">Payment Details</div>
                    @php
                        $hasBank = !empty($bank_name) || !empty($account_name) || !empty($account_no) || !empty($branch) || !empty($branch_code) || !empty($sort_code) || !empty($swift_code);
                        $hasMobile = !empty($mobile_network_provider) || !empty($mobile_phone_no) || !empty($mobile_account_name);
                    @endphp

                    @if ($hasBank)
                        <strong>Bank</strong><br>
                        @if(!empty($bank_name))<div>Bank Name: {{ $bank_name }}</div>@endif
                        @if(!empty($account_name))<div>Account Name: {{ $account_name }}</div>@endif
                        @if(!empty($account_no))<div>Account No: {{ $account_no }}</div>@endif
                        @if(!empty($branch))<div>Branch: {{ $branch }}</div>@endif
                        @if(!empty($branch_code))<div>Branch Code: {{ $branch_code }}</div>@endif
                        @if(!empty($sort_code))<div>Sort Code: {{ $sort_code }}</div>@endif
                        @if(!empty($swift_code))<div>Swift Code: {{ $swift_code }}</div>@endif
                    @endif

                    @if ($hasBank && $hasMobile)
                        <br>
                    @endif

                    @if ($hasMobile)
                        <strong>Mobile Money</strong><br>
                        @if(!empty($mobile_network_provider))<div>Network Provider: {{ $mobile_network_provider }}</div>@endif
                        @if(!empty($mobile_phone_no))<div>Phone No: {{ $mobile_phone_no }}</div>@endif
                        @if(!empty($mobile_account_name))<div>Account Name: {{ $mobile_account_name }}</div>@endif
                    @endif
                    @endif
                </div>
            </td>
        </tr>
    </table>

    <div class="footer">
        System time generated: {{ $generated_at ?? now()->format('Y-m-d H:i:s') }} | Ori Studio Limited Business Docs
    </div>
</body>
</html>