<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Docs | Quotation</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #172331;
            --ink-soft: #44566c;
            --line: #cad6e2;
            --panel: #ffffff;
            --paper: #f4f8fc;
            --accent: #0c6c56;
            --accent-dark: #084f40;
            --warn: #92400e;
            --error: #b91c1c;
            --error-bg: #fef2f2;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink);
            background:
                radial-gradient(circle at 10% 0%, rgba(14, 116, 144, 0.14), transparent 35%),
                radial-gradient(circle at 95% 20%, rgba(12, 108, 86, 0.16), transparent 38%),
                linear-gradient(170deg, #eef5ff 0%, #f9fbff 100%);
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .shell {
            max-width: 1420px;
            margin: 24px auto;
            padding: 0 16px 26px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .title {
            margin: 0;
            font-size: 1.8rem;
        }

        .subtitle {
            margin: 6px 0 0;
            color: var(--ink-soft);
        }

        .back-link {
            text-decoration: none;
            color: var(--accent-dark);
            font-weight: 700;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 8px 12px;
            background: #fff;
        }

        .layout {
            display: grid;
            gap: 16px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 8px 28px rgba(15, 23, 42, 0.08);
            overflow: hidden;
        }

        .section {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .section:last-child {
            border-bottom: 0;
        }

        .section-title {
            margin: 0 0 10px;
            font-size: 1rem;
            font-weight: 700;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(12, minmax(0, 1fr));
            gap: 10px;
        }

        .col-3 { grid-column: span 3; }
        .col-4 { grid-column: span 4; }
        .col-6 { grid-column: span 6; }
        .col-12 { grid-column: span 12; }

        label {
            display: block;
            margin-bottom: 6px;
            color: var(--ink-soft);
            font-size: 0.86rem;
            font-weight: 600;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 9px 10px;
            font-size: 0.93rem;
            font-family: inherit;
            color: var(--ink);
            background: #fff;
        }

        textarea {
            min-height: 84px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: 2px solid rgba(12, 108, 86, 0.22);
            border-color: var(--accent);
        }

        .items-wrap {
            overflow-x: auto;
            border: 1px solid #d7e0eb;
            border-radius: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 720px;
        }

        th,
        td {
            padding: 9px;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            text-transform: uppercase;
            letter-spacing: 0.03em;
            font-size: 0.76rem;
            color: #4a5b71;
            background: var(--paper);
            text-align: left;
        }

        .money {
            text-align: right;
        }

        .row-actions {
            width: 98px;
        }

        .totals-grid {
            display: grid;
            gap: 8px;
            max-width: 360px;
            margin-left: auto;
            margin-top: 12px;
        }

        .totals-grid .line {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            font-size: 0.93rem;
        }

        .totals-grid .line strong {
            color: var(--accent-dark);
            font-size: 1rem;
        }

        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-row input {
            width: auto;
            margin: 0;
        }

        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 0.92rem;
            font-weight: 700;
            cursor: pointer;
            transition: transform 120ms ease, background-color 120ms ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
        }

        .btn-outline {
            border: 1px solid var(--line);
            background: #fff;
            color: var(--ink);
        }

        .btn-danger {
            border: 1px solid #fecaca;
            color: var(--error);
            background: #fff;
        }

        .error-box {
            margin: 0 16px;
            margin-top: 14px;
            border: 1px solid #fecaca;
            border-radius: 10px;
            background: var(--error-bg);
            color: #7f1d1d;
            padding: 12px;
        }

        .error-box ul {
            margin: 8px 0 0;
            padding-left: 18px;
        }

        .preview {
            position: sticky;
            top: 16px;
            align-self: start;
            padding: 16px;
            background: #fff;
            border: 1px solid #d0deea;
            border-radius: 14px;
            box-shadow: inset 0 0 0 1px #f2f6fb;
        }

        .preview-sheet {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px;
        }

        .preview-head {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 10px;
            border-bottom: 1px solid #d9e3ef;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .logo-preview {
            width: 72px;
            height: 72px;
            object-fit: contain;
            border: 1px solid #d8e4f0;
            border-radius: 8px;
            background: #f8fbff;
            display: none;
        }

        .preview h3 {
            margin: 0;
            font-size: 1.05rem;
        }

        .muted {
            color: #5a6d82;
            font-size: 0.86rem;
        }

        .preview-meta {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }

        .preview-box {
            border: 1px solid #deebf7;
            border-radius: 8px;
            padding: 8px;
            font-size: 0.82rem;
            background: #fbfdff;
            min-height: 72px;
        }

        .preview table {
            min-width: 0;
        }

        .preview th,
        .preview td {
            font-size: 0.78rem;
            padding: 6px;
        }

        .footer-note {
            border-top: 1px dashed #d4e2ef;
            margin-top: 10px;
            padding-top: 8px;
            font-size: 0.72rem;
            color: #55697f;
        }

        @media (min-width: 1100px) {
            .layout {
                grid-template-columns: minmax(0, 1fr) 470px;
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
        }
    </style>
</head>
<body>
    @php
        $oldItems = old('items', [['description' => '', 'qty' => 1, 'price' => 0]]);
    @endphp

    <main class="shell">
        <header class="page-header">
            <div>
                <h1 class="title">Quotation Builder</h1>
                <p class="subtitle">Fill details on the left and monitor the live quotation preview on the right.</p>
            </div>
            <a href="{{ route('landing') }}" class="back-link">Back To Landing</a>
        </header>

        <div class="layout">
            <form action="{{ route('generate.pdf') }}" method="POST" enctype="multipart/form-data" class="card" id="quotation-form">
                @csrf
                <input type="hidden" name="doc_type" value="Quotation">
                <input type="hidden" name="template" value="3">
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
                    <h2 class="section-title">Quotation Details</h2>
                    <div class="grid">
                        <div class="col-4">
                            <label for="quote_no">Quote No.</label>
                            <input id="quote_no" name="quote_no" type="text" value="{{ old('quote_no', 'QT-' . now()->format('Ymd-His')) }}" required>
                        </div>
                        <div class="col-4">
                            <label for="quote_date">Quote Date</label>
                            <input id="quote_date" name="quote_date" type="date" value="{{ old('quote_date', now()->toDateString()) }}" required>
                        </div>
                        <div class="col-4">
                            <label for="expiry_date">Expiry Date</label>
                            <input id="expiry_date" name="expiry_date" type="date" value="{{ old('expiry_date', now()->addDays(14)->toDateString()) }}" required>
                        </div>
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
                    <textarea id="terms_conditions" name="terms_conditions">{{ old('terms_conditions', '1. Quotation validity: 14 days.\n2. Work starts after payment confirmation.\n3. Balance payment due before final delivery.') }}</textarea>
                </section>

                <section class="section">
                    <h2 class="section-title">Payment Details</h2>
                    <textarea id="payment_details" name="payment_details">{{ old('payment_details', 'Bank: \nAccount Name: \nAccount Number: \nMobile Money: ') }}</textarea>
                </section>

                <section class="section">
                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Generate Quotation PDF</button>
                    </div>
                </section>
            </form>

            <aside class="preview">
                <div class="preview-sheet">
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
                            <strong>Quotation</strong>
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

                    <div class="preview-box" style="margin-top: 10px; min-height: 64px;">
                        <strong>Payment Details</strong>
                        <div id="pv-payment" class="muted"></div>
                    </div>

                    <div class="footer-note">System time generated: <span id="pv-time">{{ now()->format('Y-m-d H:i:s') }}</span> | Ori Studio Limited Business Docs</div>
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

                const quoteInfo = [
                    'Quote No.: ' + (document.getElementById('quote_no').value || '-'),
                    'Quote Date: ' + (document.getElementById('quote_date').value || '-'),
                    'Expiry Date: ' + (document.getElementById('expiry_date').value || '-'),
                ].join('<br>');

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
                document.getElementById('pv-payment').innerHTML = lineBreaksToHtml(document.getElementById('payment_details').value || '-');
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

            updatePreview();
        })();
    </script>
</body>
</html>
