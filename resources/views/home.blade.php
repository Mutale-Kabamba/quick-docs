<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ori Studio Limited | Quotation Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 text-slate-900 antialiased">
    @php
        $oldItems = old('items', [['description' => '', 'qty' => 1, 'price' => 0]]);
        $existingTerms = array_values(array_filter(preg_split("/\r\n|\n|\r/", old('terms_conditions') ?? ''), fn($line) => trim($line) !== ''));
    @endphp

    <div class="mx-auto min-h-screen max-w-7xl px-4 py-8 lg:px-10">
        <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.5em] text-emerald-600">Ori Studio Limited</p>
                <h1 class="mt-3 text-3xl font-semibold text-slate-900">Quotation Builder</h1>
                <p class="text-sm text-slate-500">Fill details on the left, monitor the live preview on the right.</p>
            </div>
            <a href="{{ route('landing') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-emerald-400 hover:text-emerald-600">Back to Landing</a>
        </div>

        <div class="grid grid-cols-12 gap-6">
            <form action="{{ route('generate.pdf') }}" method="POST" enctype="multipart/form-data" id="quotation-form" class="col-span-12 space-y-6 lg:col-span-6 lg:max-h-[calc(100vh-6rem)] lg:overflow-y-auto lg:pr-2">
                @csrf
                <input type="hidden" name="doc_type" value="Quotation">
                <input type="hidden" name="vat_rate" value="16">

                @if ($errors->any())
                    <div class="rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                        <p class="font-semibold">Please fix the following and try again:</p>
                        <ul class="mt-2 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Document Setup</h2>
                    <div class="mt-4 space-y-2">
                        <label for="template" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Select Template</label>
                        <div class="relative">
                            <select id="template" name="template" required class="w-full appearance-none rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-medium text-slate-900 focus:border-emerald-500 focus:bg-white focus:outline-none">
                                <option value="1" {{ old('template') === '1' ? 'selected' : '' }}>Template 1 - Professional</option>
                                <option value="2" {{ old('template') === '2' ? 'selected' : '' }}>Template 2 - Compact</option>
                                <option value="3" {{ old('template', '3') === '3' ? 'selected' : '' }}>Template 3 - Standard</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-500">▾</span>
                        </div>
                        <p id="template-info" class="rounded-2xl border border-emerald-100 bg-emerald-50 px-4 py-2 text-xs text-emerald-700"></p>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Your Business Details</h2>
                    <div class="mt-4 grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label for="seller_name" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Business Name</label>
                            <input id="seller_name" name="seller_name" type="text" value="{{ old('seller_name', 'Ori Studio Limited') }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12">
                            <label for="logo" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Logo Upload (optional)</label>
                            <label class="mt-1 flex cursor-pointer flex-col items-center justify-center rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-4 py-5 text-center text-sm font-medium text-slate-500 transition hover:border-emerald-400 hover:bg-white">
                                <input id="logo" name="logo" type="file" accept="image/*" class="sr-only">
                                <span id="logo-file-label">Drag & drop or click to upload</span>
                            </label>
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="seller_tpin" class="text-xs font-semibold uppercase tracking-widest text-slate-500">TPIN</label>
                            <input id="seller_tpin" name="seller_tpin" type="text" value="{{ old('seller_tpin') }}" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="seller_pacra" class="text-xs font-semibold uppercase tracking-widest text-slate-500">PACRA Reg. No.</label>
                            <input id="seller_pacra" name="seller_pacra" type="text" value="{{ old('seller_pacra') }}" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="seller_phone" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Phone</label>
                            <input id="seller_phone" name="seller_phone" type="text" value="{{ old('seller_phone') }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="seller_email" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Email (optional)</label>
                            <input id="seller_email" name="seller_email" type="email" value="{{ old('seller_email') }}" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12">
                            <label for="seller_address" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Address</label>
                            <textarea id="seller_address" name="seller_address" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0" rows="3">{{ old('seller_address') }}</textarea>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Customer Details</h2>
                    <div class="mt-4 grid grid-cols-12 gap-4">
                        <div class="col-span-12">
                            <label for="customer_name" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Customer Name</label>
                            <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="customer_tpin" class="text-xs font-semibold uppercase tracking-widest text-slate-500">TPIN</label>
                            <input id="customer_tpin" name="customer_tpin" type="text" value="{{ old('customer_tpin') }}" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6">
                            <label for="customer_phone" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Phone</label>
                            <input id="customer_phone" name="customer_phone" type="text" value="{{ old('customer_phone') }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12">
                            <label for="customer_address" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Address</label>
                            <textarea id="customer_address" name="customer_address" rows="3" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">{{ old('customer_address') }}</textarea>
                        </div>
                        <div class="col-span-12">
                            <label for="customer_email" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Email (optional)</label>
                            <input id="customer_email" name="customer_email" type="email" value="{{ old('customer_email') }}" class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Quotation Details</h2>
                    <div class="mt-4 grid grid-cols-12 gap-4">
                        <div class="col-span-12 lg:col-span-4">
                            <label for="quote_no" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Quote No.</label>
                            <input id="quote_no" name="quote_no" type="text" value="{{ old('quote_no', 'QT-' . now()->format('Ymd-His')) }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-4">
                            <label for="quote_date" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Quote Date</label>
                            <input id="quote_date" name="quote_date" type="date" value="{{ old('quote_date', now()->toDateString()) }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                        <div class="col-span-12 md:col-span-6 lg:col-span-4">
                            <label for="expiry_date" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Expiry Date</label>
                            <input id="expiry_date" name="expiry_date" type="date" value="{{ old('expiry_date', now()->addDays(14)->toDateString()) }}" required class="mt-1 w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Line Items</h2>
                        <button type="button" id="add-item" class="text-sm font-semibold text-emerald-600 transition hover:text-emerald-500">+ Add Item</button>
                    </div>
                    <div class="mt-4 overflow-hidden rounded-2xl border border-slate-200">
                        <div class="hidden bg-slate-50 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-500 md:grid md:grid-cols-[1fr_3fr_1.5fr_1.5fr_auto]">
                            <span>Qty</span>
                            <span>Description</span>
                            <span>Unit Price</span>
                            <span>Amount</span>
                            <span></span>
                        </div>
                        <div id="items-body" class="divide-y divide-slate-100">
                            @foreach ($oldItems as $index => $item)
                                <div class="grid grid-cols-1 gap-4 px-4 py-4 md:grid-cols-[1fr_3fr_1.5fr_1.5fr_auto] md:items-center item-row">
                                    <input type="number" step="1" min="1" name="items[{{ $index }}][qty]" value="{{ $item['qty'] ?? 1 }}" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                    <input type="text" name="items[{{ $index }}][description]" value="{{ $item['description'] ?? '' }}" placeholder="Description" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                    <input type="number" step="0.01" min="0" name="items[{{ $index }}][price]" value="{{ $item['price'] ?? 0 }}" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                    <input type="text" class="line-total-display rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-right" value="0.00" readonly>
                                    <button type="button" class="text-xs font-semibold uppercase tracking-widest text-rose-500 hover:text-rose-600 remove-item">Remove</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="mt-4 flex flex-wrap items-center justify-between gap-4 border-t border-slate-100 pt-4">
                        <label class="flex items-center gap-2 text-sm font-semibold text-slate-600">
                            <input id="vat_registered" name="vat_registered" type="checkbox" value="1" {{ old('vat_registered') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-500">
                            VAT registered (16%)
                        </label>
                        <div class="text-right text-sm text-slate-600">
                            <p>Sub Total: <span id="sub-total" class="font-semibold text-slate-900">ZMW 0.00</span></p>
                            <p>VAT: <span id="vat-total" class="font-semibold text-slate-900">ZMW 0.00</span></p>
                            <p>Total: <span id="grand-total" class="font-semibold text-emerald-600">ZMW 0.00</span></p>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Terms & Conditions</h2>
                        <button type="button" id="add-term" class="text-xs font-semibold uppercase tracking-widest text-emerald-600">+ Add</button>
                    </div>
                    <div class="mt-4 flex gap-3">
                        <input id="terms_entry" type="text" placeholder="Add a clause (e.g., Payment due within 7 days)" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500 focus:ring-0">
                    </div>
                    <ul id="terms-list" class="mt-4 space-y-2">
                        @foreach ($existingTerms as $term)
                            <li class="flex items-center justify-between rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700">
                                <span>{{ $term }}</span>
                                <button type="button" class="text-xs font-semibold uppercase tracking-widest text-rose-500 term-remove" data-index="{{ $loop->index }}">Remove</button>
                            </li>
                        @endforeach
                    </ul>
                    <p id="terms-empty-state" class="mt-4 text-xs text-slate-400 {{ count($existingTerms) ? 'hidden' : '' }}">No T&Cs added yet.</p>
                    <textarea id="terms_conditions" name="terms_conditions" class="hidden">{{ old('terms_conditions') }}</textarea>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <h2 class="text-xs font-semibold uppercase tracking-widest text-slate-500">Payment Details</h2>
                    <div class="mt-4 space-y-6">
                        <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Bank Transfer</p>
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12">
                                    <label for="bank_name" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Bank Name</label>
                                    <select id="bank_name" name="bank_name" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
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
                                <div class="col-span-12 other-bank-input {{ old('bank_name') === 'Other' || old('bank_name_other') ? 'block' : 'hidden' }}">
                                    <label for="bank_name_other" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Please specify bank name</label>
                                    <input id="bank_name_other" name="bank_name_other" type="text" value="{{ old('bank_name_other') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label for="account_name" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Account Name</label>
                                    <input id="account_name" name="account_name" type="text" value="{{ old('account_name') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label for="account_no" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Account No</label>
                                    <input id="account_no" name="account_no" type="text" value="{{ old('account_no') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label for="branch" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Branch</label>
                                    <input id="branch" name="branch" type="text" value="{{ old('branch') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label for="branch_code" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Branch Code</label>
                                    <input id="branch_code" name="branch_code" type="text" value="{{ old('branch_code') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label for="sort_code" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Sort Code</label>
                                    <input id="sort_code" name="sort_code" type="text" value="{{ old('sort_code') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                                <div class="col-span-12 md:col-span-6">
                                    <label for="swift_code" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Swift Code</label>
                                    <input id="swift_code" name="swift_code" type="text" value="{{ old('swift_code') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4">
                            <p class="text-xs font-semibold uppercase tracking-widest text-slate-500">Mobile Money</p>
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-12 md:col-span-4">
                                    <label for="mobile_network_provider" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Network Provider</label>
                                    <select id="mobile_network_provider" name="mobile_network_provider" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                        <option value="">-- Select Network --</option>
                                        <option value="MTN" {{ old('mobile_network_provider') === 'MTN' ? 'selected' : '' }}>MTN</option>
                                        <option value="Airtel" {{ old('mobile_network_provider') === 'Airtel' ? 'selected' : '' }}>Airtel</option>
                                        <option value="Zamtel" {{ old('mobile_network_provider') === 'Zamtel' ? 'selected' : '' }}>Zamtel</option>
                                    </select>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label for="mobile_phone_no" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Phone No</label>
                                    <input id="mobile_phone_no" name="mobile_phone_no" type="text" value="{{ old('mobile_phone_no') }}" placeholder="e.g., 0961234567" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                    <small id="phone_hint" class="mt-1 block text-[10px] text-slate-500"></small>
                                </div>
                                <div class="col-span-12 md:col-span-4">
                                    <label for="mobile_account_name" class="text-xs font-semibold uppercase tracking-widest text-slate-500">Account Name</label>
                                    <input id="mobile_account_name" name="mobile_account_name" type="text" value="{{ old('mobile_account_name') }}" class="mt-1 w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6">
                    <button type="submit" class="w-full rounded-2xl bg-emerald-500 px-6 py-3 text-base font-semibold text-white transition hover:bg-emerald-400">Generate Quotation PDF</button>
                </section>
            </form>

            <div class="col-span-12 hidden lg:col-span-6 lg:block">
                <div class="rounded-3xl bg-slate-200 p-4 lg:sticky lg:top-6">
                    <div class="mx-auto aspect-[1/1.414] max-w-2xl bg-white">
                        <div class="flex h-full flex-col">
                            <div class="bg-slate-900 px-8 py-8 text-white">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="text-xs uppercase tracking-[0.4em] text-emerald-200">Template</p>
                                        <p id="pv-template" class="text-sm font-semibold text-white">Template 3 - Standard</p>
                                        <h2 id="pv-seller-name" class="mt-3 text-2xl font-semibold">Ori Studio Limited</h2>
                                        <p id="pv-seller-info" class="mt-2 text-sm text-slate-200"></p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-xs font-semibold uppercase tracking-widest text-slate-300">Doc Type</div>
                                        <div class="text-lg font-semibold">Quotation</div>
                                        <div class="mt-4 flex items-center justify-end">
                                            <img id="logo-preview" class="hidden h-16 w-16 rounded bg-white/10 object-contain p-1" alt="logo preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-1 bg-white px-8 py-8">
                                <div class="grid grid-cols-2 gap-4 text-xs uppercase tracking-wide text-slate-500">
                                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                                        <p class="font-semibold text-slate-600">Customer</p>
                                        <p id="pv-customer" class="mt-1 text-sm normal-case text-slate-800"></p>
                                    </div>
                                    <div class="rounded-lg border border-slate-200 bg-slate-50 p-3">
                                        <p class="font-semibold text-slate-600">Quotation</p>
                                        <p id="pv-quote" class="mt-1 text-sm normal-case text-slate-800"></p>
                                    </div>
                                </div>

                                <div class="mt-6 overflow-hidden rounded-lg border border-slate-200">
                                    <table class="w-full text-sm">
                                        <thead class="bg-slate-100 text-[11px] uppercase tracking-widest text-slate-500">
                                            <tr>
                                                <th class="px-3 py-2 text-left">Qty</th>
                                                <th class="px-3 py-2 text-left">Description</th>
                                                <th class="px-3 py-2 text-right">Unit Price</th>
                                                <th class="px-3 py-2 text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="pv-items" class="divide-y divide-slate-100 text-slate-700"></tbody>
                                    </table>
                                </div>

                                <div class="mt-6 space-y-2 text-sm text-slate-600">
                                    <div class="flex items-center justify-between border-b border-dashed border-slate-200 pb-2">
                                        <span>Sub Total</span>
                                        <span id="pv-sub" class="font-semibold">ZMW 0.00</span>
                                    </div>
                                    <div class="flex items-center justify-between border-b border-dashed border-slate-200 pb-2">
                                        <span>VAT</span>
                                        <span id="pv-vat" class="font-semibold">ZMW 0.00</span>
                                    </div>
                                    <div class="flex items-center justify-between text-base font-semibold text-slate-900">
                                        <span>Total</span>
                                        <span id="pv-grand">ZMW 0.00</span>
                                    </div>
                                </div>

                                <div class="mt-6 grid gap-4 text-sm text-slate-700">
                                    <div class="rounded-lg border border-slate-200 p-3">
                                        <p class="text-xs uppercase tracking-widest text-slate-500">T&Cs</p>
                                        <p id="pv-terms" class="mt-1 text-slate-700"></p>
                                    </div>
                                    <div class="rounded-lg border border-slate-200 p-3">
                                        <p class="text-xs uppercase tracking-widest text-slate-500">Payment Details</p>
                                        <p id="pv-payment" class="mt-1 text-slate-700"></p>
                                    </div>
                                </div>

                                <div class="mt-6 border-t border-slate-200 pt-4 text-[11px] uppercase tracking-[0.3em] text-slate-400">
                                    System time generated: <span id="pv-time">{{ now()->format('Y-m-d H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <template id="item-row-template">
        <div class="grid grid-cols-1 gap-4 px-4 py-4 md:grid-cols-[1fr_3fr_1.5fr_1.5fr_auto] md:items-center item-row">
            <input type="number" step="1" min="1" name="items[__INDEX__][qty]" value="1" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
            <input type="text" name="items[__INDEX__][description]" placeholder="Description" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
            <input type="number" step="0.01" min="0" name="items[__INDEX__][price]" value="0" required class="rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-emerald-500">
            <input type="text" class="line-total-display rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-right" value="0.00" readonly>
            <button type="button" class="text-xs font-semibold uppercase tracking-widest text-rose-500 hover:text-rose-600 remove-item">Remove</button>
        </div>
    </template>

    <script>
        (function () {
            const itemsBody = document.getElementById('items-body');
            const addButton = document.getElementById('add-item');
            const rowTemplate = document.getElementById('item-row-template').innerHTML;
            const logoInput = document.getElementById('logo');
            const logoPreview = document.getElementById('logo-preview');
            const logoLabel = document.getElementById('logo-file-label');
            const vatRegistered = document.getElementById('vat_registered');
            const termsTextarea = document.getElementById('terms_conditions');
            const termsEntry = document.getElementById('terms_entry');
            const addTermBtn = document.getElementById('add-term');
            const termsList = document.getElementById('terms-list');
            const termsEmptyState = document.getElementById('terms-empty-state');

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

            function getTermsArray() {
                return (termsTextarea.value || '')
                    .split(/\n+/)
                    .map(function (line) { return line.trim(); })
                    .filter(function (line) { return line.length; });
            }

            function syncTermsTextarea(terms) {
                termsTextarea.value = terms.join('\n');
            }

            function renderTermsList() {
                const terms = getTermsArray();
                if (!terms.length) {
                    termsList.innerHTML = '';
                    termsEmptyState.classList.remove('hidden');
                    return;
                }
                termsEmptyState.classList.add('hidden');
                termsList.innerHTML = terms.map(function (term, index) {
                    return '<li class="flex items-center justify-between rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-700">'
                        + '<span>' + term.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</span>'
                        + '<button type="button" class="text-xs font-semibold uppercase tracking-widest text-rose-500 term-remove" data-index="' + index + '">Remove</button>'
                        + '</li>';
                }).join('');
            }

            function addTerm(value) {
                const trimmed = (value || '').trim();
                if (!trimmed) {
                    return;
                }
                const terms = getTermsArray();
                terms.push(trimmed);
                syncTermsTextarea(terms);
                renderTermsList();
                termsEntry.value = '';
                updatePreview();
            }

            function buildPaymentPreviewHtml() {
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
                    'Expiry Date: ' + (document.getElementById('expiry_date').value || '-')
                ].join('<br>');

                document.getElementById('pv-seller-name').textContent = sellerName;
                document.getElementById('pv-seller-info').textContent = sellerInfo;
                document.getElementById('pv-customer').innerHTML = customerInfo || '-';
                document.getElementById('pv-quote').innerHTML = quoteInfo;

                const pvRows = data.map(function (row) {
                    const safeDescription = (row.description || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                    return '<tr>' +
                        '<td class="px-3 py-2">' + row.qty + '</td>' +
                        '<td class="px-3 py-2">' + safeDescription + '</td>' +
                        '<td class="px-3 py-2 text-right">' + formatMoney(row.price) + '</td>' +
                        '<td class="px-3 py-2 text-right">' + formatMoney(row.amount) + '</td>' +
                    '</tr>';
                }).join('');

                document.getElementById('pv-items').innerHTML = pvRows || '<tr><td colspan="4" class="px-3 py-4 text-center text-slate-400">No items added.</td></tr>';
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
                    logoPreview.classList.add('hidden');
                    logoPreview.removeAttribute('src');
                    logoLabel.textContent = 'Drag & drop or click to upload';
                    return;
                }

                logoLabel.textContent = file.name;
                const reader = new FileReader();
                reader.onload = function (event) {
                    logoPreview.src = event.target.result;
                    logoPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            });

            document.getElementById('quotation-form').addEventListener('input', updatePreview);
            document.getElementById('quotation-form').addEventListener('change', updatePreview);

            addTermBtn.addEventListener('click', function () {
                addTerm(termsEntry.value);
            });

            termsEntry.addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    addTerm(termsEntry.value);
                }
            });

            termsList.addEventListener('click', function (event) {
                if (!event.target.classList.contains('term-remove')) {
                    return;
                }
                const index = parseInt(event.target.getAttribute('data-index'), 10);
                if (Number.isNaN(index)) {
                    return;
                }
                const terms = getTermsArray();
                terms.splice(index, 1);
                syncTermsTextarea(terms);
                renderTermsList();
                updatePreview();
            });

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

            const bankNameSelect = document.getElementById('bank_name');
            const otherBankInput = document.querySelector('.other-bank-input');

            function updateBankSelection() {
                if (bankNameSelect.value === 'Other') {
                    otherBankInput.classList.remove('hidden');
                    otherBankInput.classList.add('block');
                    document.getElementById('bank_name_other').focus();
                } else {
                    otherBankInput.classList.add('hidden');
                    otherBankInput.classList.remove('block');
                }
            }

            bankNameSelect.addEventListener('change', function() {
                updateBankSelection();
                updatePreview();
            });

            updateBankSelection();

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
                    phoneInput.style.borderColor = '#dc2626';
                    return false;
                }

                phoneInput.style.borderColor = '';
                return true;
            }

            networkSelect.addEventListener('change', updatePhoneHint);
            phoneInput.addEventListener('input', validatePhoneNumber);
            phoneInput.addEventListener('blur', validatePhoneNumber);

            document.getElementById('quotation-form').addEventListener('submit', function(e) {
                const provider = networkSelect.value;
                const phone = phoneInput.value.trim();

                if (provider && !phone) {
                    e.preventDefault();
                    phoneInput.style.borderColor = '#dc2626';
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

            renderTermsList();
            updatePhoneHint();
            updatePreview();
        })();
    </script>
</body>
</html>
