<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Docs | {{ $docType ?? 'Quotation' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0f172a;
            --ink-soft: #334155;
            --ink-2: #334155;
            --ink-3: #64748b;
            --line: #e2e8f0;
            --line-2: #cbd5e1;
            --panel: #ffffff;
            --paper: #f8fafc;
            --accent: #059669;
            --accent-dark: #047857;
            --accent-light: #ecfdf5;
            --warn: #92400e;
            --error: #b91c1c;
            --error-bg: #fef2f2;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            background: var(--paper);
            font-family: Inter, "Segoe UI", system-ui, -apple-system, sans-serif;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .shell {
            max-width: 1440px;
            margin: 0 auto;
            padding: 14px 14px 40px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
            padding: 10px 14px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: 0 1px 2px rgba(0,0,0,0.04);
        }

        .brand-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 2px;
        }

        .title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        .subtitle {
            margin: 1px 0 0;
            color: var(--ink-3);
            font-size: 0.75rem;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            color: var(--ink-2);
            font-weight: 600;
            font-size: 0.8rem;
            border: 1px solid var(--line);
            border-radius: 7px;
            padding: 5px 11px;
            background: var(--panel);
            white-space: nowrap;
            transition: border-color 150ms, color 150ms;
        }

        .back-link:hover {
            border-color: var(--line-2);
            color: var(--ink);
        }

        .layout { display: grid; gap: 14px; }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .section {
            padding: 13px 15px;
            border-bottom: 1px solid var(--line);
        }

        .section:last-child { border-bottom: none; }

        .section-title {
            margin: 0 0 10px;
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-3);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .section-title::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 11px;
            background: var(--accent);
            border-radius: 2px;
            flex-shrink: 0;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 7px;
        }

        .col-3 { grid-column: span 3; }
        .col-4 { grid-column: span 4; }
        .col-6 { grid-column: span 6; }
        .col-12 { grid-column: span 12; }

        label {
            display: block;
            margin-bottom: 3px;
            color: var(--ink-3);
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 6px 8px;
            font-size: 0.82rem;
            font-family: inherit;
            color: var(--ink);
            background: var(--panel);
            transition: border-color 120ms, box-shadow 120ms;
            outline: none;
            line-height: 1.4;
        }

        textarea {
            min-height: 56px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.12);
        }

        .items-wrap {
            overflow-x: auto;
            border: 1px solid var(--line);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        th,
        td {
            padding: 6px 8px;
            border-bottom: 1px solid var(--line);
            font-size: 0.81rem;
        }

        th {
            font-size: 0.66rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-3);
            background: var(--paper);
            text-align: left;
            font-weight: 700;
        }

        tr:last-child td { border-bottom: none; }

        .money { text-align: right; }

        .payment-method-section {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 11px;
            margin-bottom: 8px;
            background: var(--paper);
        }

        .payment-method-section:last-of-type { margin-bottom: 0; }

        .payment-method-title {
            font-size: 0.68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--ink-2);
            margin: 0 0 8px;
            padding-bottom: 7px;
            border-bottom: 1px solid var(--line);
        }

        .other-bank-input { display: none; }
        .other-bank-input.show { display: block; }

        .template-info {
            font-size: 0.72rem;
            color: var(--ink-3);
            margin-top: 4px;
            padding: 6px 8px;
            background: var(--accent-light);
            border-radius: 5px;
            border-left: 2px solid var(--accent);
            line-height: 1.4;
        }

        .row-actions { width: 84px; }

        .totals-grid {
            display: grid;
            gap: 0;
            max-width: 310px;
            margin-left: auto;
            margin-top: 10px;
            border: 1px solid var(--line);
            border-radius: 8px;
            overflow: hidden;
        }

        .totals-grid .line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            font-size: 0.82rem;
            padding: 6px 10px;
            border-bottom: 1px solid var(--line);
            background: var(--paper);
        }

        .totals-grid .line:last-child {
            border-bottom: none;
            background: var(--accent-light);
        }

        .totals-grid .line strong {
            color: var(--accent-dark);
            font-size: 0.88rem;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 10px 0 2px;
        }

        .checkbox-row input { width: auto; margin: 0; }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .btn {
            border: 1px solid transparent;
            border-radius: 7px;
            padding: 7px 14px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background 120ms, border-color 120ms, box-shadow 120ms;
            line-height: 1;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            box-shadow: 0 2px 8px rgba(5, 150, 105, 0.25);
        }

        .btn-outline {
            background: var(--panel);
            color: var(--ink-2);
            border-color: var(--line);
        }

        .btn-outline:hover {
            border-color: var(--line-2);
            background: var(--paper);
        }

        .btn-danger {
            background: var(--panel);
            color: var(--error);
            border-color: #fecaca;
            font-size: 0.76rem;
            padding: 5px 9px;
        }

        .btn-danger:hover { background: var(--error-bg); }

        .error-box {
            margin: 12px 15px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: var(--error-bg);
            color: #7f1d1d;
            padding: 10px 12px;
            font-size: 0.82rem;
        }

        .error-box ul {
            margin: 6px 0 0;
            padding-left: 16px;
        }

        .preview {
            position: sticky;
            top: 14px;
            align-self: start;
            display: flex;
            flex-direction: column;
            height: calc(100vh - 28px);
        }

        .preview-sheet {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 12px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            min-height: 0;
        }

        .preview-head {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 8px;
            border-bottom: 1px solid var(--line);
            padding-bottom: 9px;
            margin-bottom: 9px;
        }

        .logo-preview {
            width: 46px;
            height: 46px;
            object-fit: contain;
            border: 1px solid var(--line);
            border-radius: 5px;
            background: var(--paper);
            display: none;
        }

        .preview h3 {
            margin: 0;
            font-size: 0.88rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .muted {
            color: var(--ink-3);
            font-size: 0.71rem;
            line-height: 1.5;
        }

        .preview-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
            margin-bottom: 9px;
        }

        .preview-box {
            border: 1px solid var(--line);
            border-radius: 6px;
            padding: 7px 8px;
            font-size: 0.74rem;
            background: var(--paper);
        }

        .preview-box strong {
            font-size: 0.63rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-3);
            display: block;
            margin-bottom: 3px;
            font-weight: 700;
        }

        .preview table { min-width: 0; margin: 6px 0; }

        .preview th,
        .preview td {
            font-size: 0.71rem;
            padding: 4px 5px;
        }

        .preview .totals-grid {
            max-width: none;
            margin: 6px 0 0;
            border-radius: 6px;
        }

        .preview .totals-grid .line {
            font-size: 0.73rem;
            padding: 5px 8px;
        }

        .footer-note {
            border-top: 1px solid var(--line);
            margin-top: 8px;
            padding-top: 7px;
            font-size: 0.62rem;
            color: #94a3b8;
            line-height: 1.4;
            flex-shrink: 0;
        }

        @media (min-width: 1100px) {
            .layout {
                grid-template-columns: minmax(0, 1fr) 420px;
                align-items: start;
            }
        }

        @media (max-width: 840px) {
            .col-3,
            .col-4,
            .col-6,
            .col-12 {
                grid-column: span 12;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .preview {
                height: auto;
                position: static;
            }
        }
    </style>
</head>
<body>
    @php
        $oldItems = old('items', [['description' => '', 'qty' => 1, 'price' => 0]]);
        $docType = $docType ?? 'Quotation';
        $docPrefix = $docType === 'Invoice' ? 'INV' : ($docType === 'Receipt' ? 'REC' : 'QT');
        $docNoDefault = $docPrefix . '-' . now()->format('Ymd-His');
    @endphp

    <main class="shell">
        <header class="page-header">
            <div>
                <div class="brand-label">Quick Docs</div>
                <h1 class="title">{{ $docType }} Builder</h1>
                <p class="subtitle">Fill in the form and preview your {{ strtolower($docType) }} in real time.</p>
            </div>
            <a href="{{ route('landing') }}" class="back-link">&#8592; All Documents</a>
        </header>

        <div class="layout">
            <form action="{{ route('generate.pdf') }}" method="POST" enctype="multipart/form-data" class="card" id="quotation-form">
                @csrf
                <input type="hidden" name="doc_type" value="{{ $docType }}">
                <input type="hidden" name="vat_rate" value="16">

                @if ($errors->any())
                    <div class="error-box">
                        <strong>Please fix the following and try again:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="section">
                    <h2 class="section-title">Document Template</h2>
                    <div class="grid">
                        <div class="col-12">
                            <label for="template">Select Template</label>
                            <select id="template" name="template" required>
                                <option value="1" {{ old('template') === '1' ? 'selected' : '' }}>Template 1 - Professional</option>
                                <option value="2" {{ old('template') === '2' ? 'selected' : '' }}>Template 2 - Compact</option>
                                <option value="3" {{ old('template') === '3' ? 'selected' : '' }} selected>Template 3 - Standard</option>
                            </select>
                            <div id="template-info" class="template-info"></div>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">Your Business Details</h2>
                    <div class="grid">
                        <div class="col-6">
                            <label for="seller_name">Business Name</label>
                            <input id="seller_name" name="seller_name" type="text" value="{{ old('seller_name', 'Ori Studio Limited') }}" required>
                        </div>
                        <div class="col-6">
                            <label for="logo">Logo Upload (optional)</label>
                            <input id="logo" name="logo" type="file" accept="image/*">
                        </div>
                        <div class="col-3">
                            <label for="seller_tpin">TPIN</label>
                            <input id="seller_tpin" name="seller_tpin" type="text" value="{{ old('seller_tpin') }}">
                        </div>
                        <div class="col-3">
                            <label for="seller_pacra">PACRA Reg. No.</label>
                            <input id="seller_pacra" name="seller_pacra" type="text" value="{{ old('seller_pacra') }}">
                        </div>
                        <div class="col-3">
                            <label for="seller_phone">Phone</label>
                            <input id="seller_phone" name="seller_phone" type="text" value="{{ old('seller_phone') }}" required>
                        </div>
                        <div class="col-3">
                            <label for="seller_email">Email (optional)</label>
                            <input id="seller_email" name="seller_email" type="email" value="{{ old('seller_email') }}">
                        </div>
                        <div class="col-12">
                            <label for="seller_address">Address</label>
                            <textarea id="seller_address" name="seller_address" required>{{ old('seller_address') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">Customer Details</h2>
                    <div class="grid">
                        <div class="col-6">
                            <label for="customer_name">Customer Name</label>
                            <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required>
                        </div>
                        <div class="col-3">
                            <label for="customer_tpin">TPIN</label>
                            <input id="customer_tpin" name="customer_tpin" type="text" value="{{ old('customer_tpin') }}">
                        </div>
                        <div class="col-3">
                            <label for="customer_phone">Phone</label>
                            <input id="customer_phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" required>
                        </div>
                        <div class="col-6">
                            <label for="customer_address">Address</label>
                            <textarea id="customer_address" name="customer_address" required>{{ old('customer_address') }}</textarea>
                        </div>
                        <div class="col-6">
                            <label for="customer_email">Email (optional)</label>
                            <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}">
                        </div>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">{{ $docType }} Details</h2>
                    <div class="grid">
                        <div class="col-4">
                            <label for="quote_no">{{ $docType }} No.</label>
                            <input id="quote_no" name="quote_no" type="text" value="{{ old('quote_no', $docNoDefault) }}" required>
                        </div>
                        <div class="col-4">
                            <label for="quote_date">{{ $docType }} Date</label>
                            <input id="quote_date" name="quote_date" type="date" value="{{ old('quote_date', now()->toDateString()) }}" required>
                        </div>
                        @if($docType !== 'Receipt')
                        <div class="col-4">
                            <label for="expiry_date">{{ $docType === 'Invoice' ? 'Due Date' : 'Expiry Date' }}</label>
                            <input id="expiry_date" name="expiry_date" type="date" value="{{ old('expiry_date', now()->addDays(14)->toDateString()) }}" required>
                        </div>
                        @endif
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">Items</h2>
                    <div class="items-wrap">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 9%;">Qty</th>
                                    <th style="width: 43%;">Description</th>
                                    <th style="width: 16%;">Unit Price</th>
                                    <th style="width: 16%;">Amount</th>
                                    <th class="row-actions">Action</th>
                                </tr>
                            </thead>
                            <tbody id="items-body">
                                @foreach ($oldItems as $index => $item)
                                    <tr class="item-row">
                                        <td>
                                            <input type="number" step="1" min="1" name="items[{{ $index }}][qty]" value="{{ $item['qty'] ?? 1 }}" required>
                                        </td>
                                        <td>
                                            <input type="text" name="items[{{ $index }}][description]" value="{{ $item['description'] ?? '' }}" placeholder="Description" required>
                                        </td>
                                        <td>
                                            <input type="number" step="0.01" min="0" name="items[{{ $index }}][price]" value="{{ $item['price'] ?? 0 }}" required>
                                        </td>
                                        <td>
                                            <input type="text" class="line-total-display" value="0.00" readonly>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove-item">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="actions" style="margin-top: 10px;">
                        <button type="button" class="btn btn-outline" id="add-item">Add Item</button>
                    </div>

                    <div style="margin-top: 14px;" class="checkbox-row">
                        <input id="vat_registered" name="vat_registered" type="checkbox" value="1" {{ old('vat_registered') ? 'checked' : '' }}>
                        <label for="vat_registered" style="margin: 0; color: var(--warn); font-weight: 700;">Tick if VAT Registered (16% of Sub Total)</label>
                    </div>

                    <div class="totals-grid">
                        <div class="line"><span>Sub Total</span><span id="sub-total">ZMW 0.00</span></div>
                        <div class="line"><span>VAT (16%)</span><span id="vat-total">ZMW 0.00</span></div>
                        <div class="line"><strong>Total</strong><strong id="grand-total">ZMW 0.00</strong></div>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">Terms & Conditions</h2>
                    <textarea id="terms_conditions" name="terms_conditions" placeholder="Enter your terms and conditions here...">{{ old('terms_conditions') }}</textarea>
                </section>

                <section class="section">
                    <h2 class="section-title">Payment Details</h2>
                    
                    <!-- Bank Details Section -->
                    <div class="payment-method-section">
                        <div class="payment-method-title">Bank Transfer</div>
                        <div class="grid">
                            <div class="col-12">
                                <label for="bank_name">Bank Name</label>
                                <select id="bank_name" name="bank_name">
                                    <option value="">-- Select Bank --</option>
                                    
                                    <optgroup label="Top Commercial Banks">
                                        <option value="Zanaco (Zambia National Commercial Bank) Plc" {{ old('bank_name') === 'Zanaco (Zambia National Commercial Bank) Plc' ? 'selected' : '' }}>Zanaco (Zambia National Commercial Bank) Plc</option>
                                        <option value="Absa Bank Zambia Plc" {{ old('bank_name') === 'Absa Bank Zambia Plc' ? 'selected' : '' }}>Absa Bank Zambia Plc</option>
                                        <option value="Stanbic Bank Zambia Limited" {{ old('bank_name') === 'Stanbic Bank Zambia Limited' ? 'selected' : '' }}>Stanbic Bank Zambia Limited</option>
                                        <option value="First National Bank (FNB) Zambia Limited" {{ old('bank_name') === 'First National Bank (FNB) Zambia Limited' ? 'selected' : '' }}>First National Bank (FNB) Zambia Limited</option>
                                        <option value="Standard Chartered Bank Zambia Plc" {{ old('bank_name') === 'Standard Chartered Bank Zambia Plc' ? 'selected' : '' }}>Standard Chartered Bank Zambia Plc</option>
                                    </optgroup>
                                    
                                    <optgroup label="Other Registered Commercial Banks">
                                        <option value="Indo-Zambia Bank Limited" {{ old('bank_name') === 'Indo-Zambia Bank Limited' ? 'selected' : '' }}>Indo-Zambia Bank Limited</option>
                                        <option value="Access Bank Zambia Limited" {{ old('bank_name') === 'Access Bank Zambia Limited' ? 'selected' : '' }}>Access Bank Zambia Limited</option>
                                        <option value="United Bank for Africa (UBA) Zambia Limited" {{ old('bank_name') === 'United Bank for Africa (UBA) Zambia Limited' ? 'selected' : '' }}>United Bank for Africa (UBA) Zambia Limited</option>
                                        <option value="Ecobank Zambia Limited" {{ old('bank_name') === 'Ecobank Zambia Limited' ? 'selected' : '' }}>Ecobank Zambia Limited</option>
                                        <option value="Bank of China (Zambia) Limited" {{ old('bank_name') === 'Bank of China (Zambia) Limited' ? 'selected' : '' }}>Bank of China (Zambia) Limited</option>
                                        <option value="First Capital Bank Zambia Limited" {{ old('bank_name') === 'First Capital Bank Zambia Limited' ? 'selected' : '' }}>First Capital Bank Zambia Limited</option>
                                        <option value="Zambia Industrial Commercial Bank (ZICB)" {{ old('bank_name') === 'Zambia Industrial Commercial Bank (ZICB)' ? 'selected' : '' }}>Zambia Industrial Commercial Bank (ZICB)</option>
                                    </optgroup>
                                    
                                    <option value="Other" {{ old('bank_name') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                            <div class="col-12 other-bank-input {{ old('bank_name') === 'Other' || old('bank_name_other') ? 'show' : '' }}">
                                <label for="bank_name_other">Please specify bank name</label>
                                <input id="bank_name_other" name="bank_name_other" type="text" placeholder="Enter your bank name" value="{{ old('bank_name_other') }}">
                            </div>
                            <div class="col-6">
                                <label for="account_name">Account Name</label>
                                <input id="account_name" name="account_name" type="text" value="{{ old('account_name') }}">
                            </div>
                            <div class="col-6">
                                <label for="account_no">Account No</label>
                                <input id="account_no" name="account_no" type="text" value="{{ old('account_no') }}">
                            </div>
                            <div class="col-4">
                                <label for="branch">Branch</label>
                                <input id="branch" name="branch" type="text" value="{{ old('branch') }}">
                            </div>
                            <div class="col-4">
                                <label for="branch_code">Branch Code</label>
                                <input id="branch_code" name="branch_code" type="text" value="{{ old('branch_code') }}">
                            </div>
                            <div class="col-4">
                                <label for="sort_code">Sort Code</label>
                                <input id="sort_code" name="sort_code" type="text" value="{{ old('sort_code') }}">
                            </div>
                            <div class="col-6">
                                <label for="swift_code">Swift Code</label>
                                <input id="swift_code" name="swift_code" type="text" value="{{ old('swift_code') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Money Details Section -->
                    <div class="payment-method-section">
                        <div class="payment-method-title">Mobile Money</div>
                        <div class="grid">
                            <div class="col-6">
                                <label for="mobile_network_provider">Network Provider</label>
                                <select id="mobile_network_provider" name="mobile_network_provider">
                                    <option value="">-- Select Network --</option>
                                    <option value="MTN" {{ old('mobile_network_provider') === 'MTN' ? 'selected' : '' }}>MTN</option>
                                    <option value="Airtel" {{ old('mobile_network_provider') === 'Airtel' ? 'selected' : '' }}>Airtel</option>
                                    <option value="Zamtel" {{ old('mobile_network_provider') === 'Zamtel' ? 'selected' : '' }}>Zamtel</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="mobile_phone_no">Phone No</label>
                                <input id="mobile_phone_no" name="mobile_phone_no" type="text" placeholder="e.g., 0961234567" value="{{ old('mobile_phone_no') }}">
                                <small id="phone_hint" style="color: #666; font-size: 0.75rem; display: block; margin-top: 2px;"></small>
                            </div>
                            <div class="col-12">
                                <label for="mobile_account_name">Account Name</label>
                                <input id="mobile_account_name" name="mobile_account_name" type="text" value="{{ old('mobile_account_name') }}">
                            </div>
                        </div>
                    </div>
                </section>

                <section class="section">
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Generate {{ $docType }} PDF</button>
                    </div>
                </section>
            </form>

            <aside class="preview">
                <div class="preview-sheet">
                    <div class="preview-box" style="margin-bottom: 10px; background: #e8f5e9; border-color: var(--accent);">
                        <strong style="color: var(--accent);">Template:</strong>
                        <div id="pv-template" style="font-size: 0.78rem; color: #2d6a4f;">Template 3 - Standard</div>
                    </div>

                    <div class="preview-head">
                        <div>
                            <h3 id="pv-seller-name">Ori Studio Limited</h3>
                            <div class="muted" id="pv-seller-info"></div>
                        </div>
                        <img id="logo-preview" class="logo-preview" alt="Logo preview">
                    </div>

                    <div class="preview-meta">
                        <div class="preview-box">
                            <strong>Customer</strong>
                            <div id="pv-customer"></div>
                        </div>
                        <div class="preview-box">
                            <strong>{{ $docType }}</strong>
                            <div id="pv-quote"></div>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Description</th>
                                <th class="money">Unit Price</th>
                                <th class="money">Amount</th>
                            </tr>
                        </thead>
                        <tbody id="pv-items"></tbody>
                    </table>

                    <div class="totals-grid" style="margin-top: 8px;">
                        <div class="line"><span>Sub Total</span><span id="pv-sub">ZMW 0.00</span></div>
                        <div class="line"><span>VAT</span><span id="pv-vat">ZMW 0.00</span></div>
                        <div class="line"><strong>Total</strong><strong id="pv-grand">ZMW 0.00</strong></div>
                    </div>

                    <div class="preview-box" style="margin-top: 10px; min-height: 64px;">
                        <strong>T&Cs</strong>
                        <div id="pv-terms" class="muted"></div>
                    </div>

                    <div class="preview-box" style="margin-top: 10px;" id="pv-payment-box">
                        <strong id="pv-payment-label">{{ $docType === 'Receipt' ? 'Payment Received' : 'Payment Details' }}</strong>
                        <div id="pv-payment" class="muted"></div>
                    </div>

                    <div class="footer-note">System time generated: <span id="pv-time">{{ now()->format('Y-m-d H:i:s') }}</span> | <a href="https://www.oristudiozm.com" target="_blank" rel="noopener noreferrer" style="color:inherit;text-decoration:underline;">Ori Studio Limited</a> Business Docs</div>
                </div>
            </aside>
        </div>
    </main>

    <template id="item-row-template">
        <tr class="item-row">
            <td><input type="number" step="1" min="1" name="items[__INDEX__][qty]" value="1" required></td>
            <td><input type="text" name="items[__INDEX__][description]" placeholder="Description" required></td>
            <td><input type="number" step="0.01" min="0" name="items[__INDEX__][price]" value="0" required></td>
            <td><input type="text" class="line-total-display" value="0.00" readonly></td>
            <td><button type="button" class="btn btn-danger remove-item">Remove</button></td>
        </tr>
    </template>

    <script>
        (function () {
            const itemsBody = document.getElementById('items-body');
            const addButton = document.getElementById('add-item');
            const rowTemplate = document.getElementById('item-row-template').innerHTML;

            const logoInput = document.getElementById('logo');
            const logoPreview = document.getElementById('logo-preview');
            const vatRegistered = document.getElementById('vat_registered');

            function formatMoney(value) {
                return 'ZMW ' + Number(value || 0).toLocaleString(undefined, {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }

            function parseNumber(value) {
                const number = parseFloat(value);
                return Number.isFinite(number) ? number : 0;
            }

            function reindexRows() {
                const rows = itemsBody.querySelectorAll('.item-row');
                rows.forEach(function (row, index) {
                    row.querySelectorAll('input').forEach(function (input) {
                        if (!input.name) {
                            return;
                        }

                        input.name = input.name
                            .replace(/items\[\d+\]\[qty\]/, 'items[' + index + '][qty]')
                            .replace(/items\[\d+\]\[description\]/, 'items[' + index + '][description]')
                            .replace(/items\[\d+\]\[price\]/, 'items[' + index + '][price]');
                    });
                });
            }

            function addRow() {
                const index = itemsBody.querySelectorAll('.item-row').length;
                const html = rowTemplate.replace(/__INDEX__/g, index);
                itemsBody.insertAdjacentHTML('beforeend', html);
                updatePreview();
            }

            function rowsData() {
                const rows = itemsBody.querySelectorAll('.item-row');
                return Array.from(rows).map(function (row) {
                    const qty = parseNumber(row.querySelector('input[name*="[qty]"]').value);
                    const description = row.querySelector('input[name*="[description]"]').value || '';
                    const price = parseNumber(row.querySelector('input[name*="[price]"]').value);
                    return {
                        qty: qty,
                        description: description,
                        price: price,
                        amount: qty * price,
                        row: row
                    };
                });
            }

            function lineBreaksToHtml(text) {
                return (text || '').replace(/\n/g, '<br>');
            }

            function buildPaymentPreviewHtml() {
                @if($docType === 'Receipt')
                const methodEl = document.getElementById('payment_method_received');
                const method = methodEl ? methodEl.value : '';
                return method ? ('<strong>Paid Via:</strong> ' + method) : '-';
                @else
                const bankNameSelect = document.getElementById('bank_name').value;
                const bankNameVal = bankNameSelect === 'Other' 
                    ? document.getElementById('bank_name_other').value 
                    : bankNameSelect;

                const bankFields = [
                    { label: 'Bank Name', value: bankNameVal },
                    { label: 'Account Name', value: document.getElementById('account_name').value },
                    { label: 'Account No', value: document.getElementById('account_no').value },
                    { label: 'Branch', value: document.getElementById('branch').value },
                    { label: 'Branch Code', value: document.getElementById('branch_code').value },
                    { label: 'Sort Code', value: document.getElementById('sort_code').value },
                    { label: 'Swift Code', value: document.getElementById('swift_code').value }
                ].filter(function (field) {
                    return (field.value || '').trim() !== '';
                });

                const mobileFields = [
                    { label: 'Network', value: document.getElementById('mobile_network_provider').value },
                    { label: 'Phone', value: document.getElementById('mobile_phone_no').value },
                    { label: 'Account', value: document.getElementById('mobile_account_name').value }
                ].filter(function (field) {
                    return (field.value || '').trim() !== '';
                });

                const parts = [];

                if (bankFields.length) {
                    const bankLines = bankFields.map(function (field) {
                        return field.label + ': ' + field.value;
                    }).join('<br>');
                    parts.push('<strong>Bank</strong><br>' + bankLines);
                }

                if (mobileFields.length) {
                    const mobileLines = mobileFields.map(function (field) {
                        return field.label + ': ' + field.value;
                    }).join('<br>');
                    parts.push('<strong>Mobile Money</strong><br>' + mobileLines);
                }

                return parts.join('<br><br>') || '-';
                @endif
            }

            function updatePreview() {
                const data = rowsData();
                const subTotal = data.reduce(function (total, row) {
                    return total + row.amount;
                }, 0);
                const vatAmount = vatRegistered.checked ? (subTotal * 0.16) : 0;
                const grandTotal = subTotal + vatAmount;

                data.forEach(function (rowData) {
                    const display = rowData.row.querySelector('.line-total-display');
                    display.value = rowData.amount.toFixed(2);
                });

                document.getElementById('sub-total').textContent = formatMoney(subTotal);
                document.getElementById('vat-total').textContent = formatMoney(vatAmount);
                document.getElementById('grand-total').textContent = formatMoney(grandTotal);

                const sellerName = document.getElementById('seller_name').value || 'Ori Studio Limited';
                const sellerInfo = [
                    document.getElementById('seller_tpin').value ? ('TPIN: ' + document.getElementById('seller_tpin').value) : '',
                    document.getElementById('seller_pacra').value ? ('PACRA: ' + document.getElementById('seller_pacra').value) : '',
                    document.getElementById('seller_phone').value,
                    document.getElementById('seller_address').value,
                    document.getElementById('seller_email').value
                ].filter(Boolean).join(' | ');

                const customerInfo = [
                    document.getElementById('customer_name').value,
                    document.getElementById('customer_tpin').value ? ('TPIN: ' + document.getElementById('customer_tpin').value) : '',
                    document.getElementById('customer_phone').value,
                    document.getElementById('customer_address').value,
                    document.getElementById('customer_email').value
                ].filter(Boolean).join('<br>');

                const docType = '{{ $docType }}';
                const expiryEl = document.getElementById('expiry_date');
                const expiryLabel = docType === 'Invoice' ? 'Due Date' : 'Expiry Date';
                const quoteInfoParts = [
                    docType + ' No.: ' + (document.getElementById('quote_no').value || '-'),
                    docType + ' Date: ' + (document.getElementById('quote_date').value || '-'),
                ];
                if (expiryEl) {
                    quoteInfoParts.push(expiryLabel + ': ' + (expiryEl.value || '-'));
                }
                const quoteInfo = quoteInfoParts.join('<br>');

                document.getElementById('pv-seller-name').textContent = sellerName;
                document.getElementById('pv-seller-info').textContent = sellerInfo;
                document.getElementById('pv-customer').innerHTML = customerInfo || '-';
                document.getElementById('pv-quote').innerHTML = quoteInfo;

                const pvRows = data.map(function (row) {
                    const safeDescription = (row.description || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    return '<tr>' +
                        '<td>' + row.qty + '</td>' +
                        '<td>' + safeDescription + '</td>' +
                        '<td class="money">' + formatMoney(row.price) + '</td>' +
                        '<td class="money">' + formatMoney(row.amount) + '</td>' +
                    '</tr>';
                }).join('');

                document.getElementById('pv-items').innerHTML = pvRows || '<tr><td colspan="4">No items added.</td></tr>';
                document.getElementById('pv-sub').textContent = formatMoney(subTotal);
                document.getElementById('pv-vat').textContent = formatMoney(vatAmount);
                document.getElementById('pv-grand').textContent = formatMoney(grandTotal);

                document.getElementById('pv-terms').innerHTML = lineBreaksToHtml(document.getElementById('terms_conditions').value || '-');
                document.getElementById('pv-payment').innerHTML = buildPaymentPreviewHtml();
                document.getElementById('pv-time').textContent = new Date().toLocaleString();
            }

            addButton.addEventListener('click', addRow);

            itemsBody.addEventListener('click', function (event) {
                if (!event.target.classList.contains('remove-item')) {
                    return;
                }

                const rows = itemsBody.querySelectorAll('.item-row');
                if (rows.length <= 1) {
                    return;
                }

                event.target.closest('.item-row').remove();
                reindexRows();
                updatePreview();
            });

            logoInput.addEventListener('change', function () {
                const [file] = logoInput.files;
                if (!file) {
                    logoPreview.style.display = 'none';
                    logoPreview.removeAttribute('src');
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (event) {
                    logoPreview.src = event.target.result;
                    logoPreview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('quotation-form').addEventListener('input', updatePreview);
            document.getElementById('quotation-form').addEventListener('change', updatePreview);

            // Template selection
            const templateSelect = document.getElementById('template');
            const templateInfo = document.getElementById('template-info');
            const pvTemplate = document.getElementById('pv-template');
            
            const templateDescriptions = {
                '1': 'Professional layout with comprehensive formatting. Best for formal quotations.',
                '2': 'Compact layout optimized for shorter quotations. Space-efficient design.',
                '3': 'Standard balanced layout. Recommended for most business documents.'
            };

            const templateNames = {
                '1': 'Template 1 - Professional',
                '2': 'Template 2 - Compact',
                '3': 'Template 3 - Standard'
            };

            function updateTemplateInfo() {
                const selected = templateSelect.value;
                templateInfo.textContent = 'Selected: ' + templateDescriptions[selected];
                if (pvTemplate) {
                    pvTemplate.textContent = templateNames[selected];
                }
            }

            templateSelect.addEventListener('change', updateTemplateInfo);
            updateTemplateInfo();

            // Bank name dropdown handling
            const bankNameSelect = document.getElementById('bank_name');
            const otherBankInput = document.querySelector('.other-bank-input');

            function updateBankSelection() {
                if (!bankNameSelect) return;
                if (bankNameSelect.value === 'Other') {
                    otherBankInput.classList.add('show');
                    document.getElementById('bank_name_other').focus();
                } else {
                    otherBankInput.classList.remove('show');
                }
            }

            if (bankNameSelect) {
                bankNameSelect.addEventListener('change', function() {
                    updateBankSelection();
                    updatePreview();
                });
                updateBankSelection();
            }

            // Mobile phone validation
            const networkSelect = document.getElementById('mobile_network_provider');
            const phoneInput = document.getElementById('mobile_phone_no');
            const phoneHint = document.getElementById('phone_hint');

            const phonePatterns = {
                'MTN': { pattern: /^(096|076|056)\d{7}$/, hint: 'MTN: Must start with 096, 076, or 056 (10 digits total)' },
                'Airtel': { pattern: /^(097|077|057)\d{7}$/, hint: 'Airtel: Must start with 097, 077, or 057 (10 digits total)' },
                'Zamtel': { pattern: /^(095|075|055)\d{7}$/, hint: 'Zamtel: Must start with 095, 075, or 055 (10 digits total)' }
            };

            function updatePhoneHint() {
                const provider = networkSelect.value;
                if (provider && phonePatterns[provider]) {
                    phoneHint.textContent = phonePatterns[provider].hint;
                    phoneHint.style.display = 'block';
                } else {
                    phoneHint.style.display = 'none';
                }
            }

            function validatePhoneNumber() {
                const provider = networkSelect.value;
                const phone = phoneInput.value.trim();

                if (!provider || !phone) {
                    phoneInput.style.borderColor = '';
                    return true;
                }

                if (phonePatterns[provider] && !phonePatterns[provider].pattern.test(phone)) {
                    phoneInput.style.borderColor = '#dc3545';
                    return false;
                }

                phoneInput.style.borderColor = '';
                return true;
            }

            networkSelect.addEventListener('change', updatePhoneHint);
            phoneInput.addEventListener('input', validatePhoneNumber);
            phoneInput.addEventListener('blur', validatePhoneNumber);

            // Validate on form submit
            document.getElementById('quotation-form').addEventListener('submit', function(e) {
                const provider = networkSelect.value;
                const phone = phoneInput.value.trim();

                if (provider && !phone) {
                    e.preventDefault();
                    phoneInput.style.borderColor = '#dc3545';
                    alert('Please enter a mobile phone number for ' + provider);
                    phoneInput.focus();
                    return false;
                }

                if (provider && phone && !validatePhoneNumber()) {
                    e.preventDefault();
                    alert('Invalid phone number format for ' + provider + '.\n' + phonePatterns[provider].hint);
                    phoneInput.focus();
                    return false;
                }

                return true;
            });

            updatePhoneHint();
            updatePreview();
        })();
    </script>
</body>
</html>
