@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-6 py-12 lg:px-10 lg:py-16">
    <div class="mb-12">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-[#ff6600] mb-6">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Home
        </a>
        <h1 class="text-4xl font-extrabold tracking-tight text-[#1e3a8a] sm:text-5xl">Business Transactions</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600">Seal deals, request payments, and formalize agreements with professionally structured business documents.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        
        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-white p-8 shadow-sm transition hover:shadow-xl hover:shadow-[#1e3a8a]/5 hover:-translate-y-1">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
                </div>
                <h3 class="mt-6 text-2xl font-bold text-[#1e3a8a]">Quotation</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Generate a professional, branded price quote to win your next client. Supports multiple line items and automatic totals.</p>
            </div>
            <a href="{{ route('quotation.page') }}" class="mt-8 inline-flex w-full items-center justify-center rounded-xl bg-[#ff6600] px-4 py-3.5 text-sm font-bold text-white transition hover:bg-[#e65c00]">
                Create Quotation
            </a>
        </article>

        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Invoice</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Get paid faster with clear, crisp invoicing formatted for standard A4 printing and immediate digital delivery.</p>
            </div>
            <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                Coming Soon
            </button>
        </article>

        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Receipt</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Acknowledge payments with instant, professional receipts for your clients.</p>
            </div>
            <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                Coming Soon
            </button>
        </article>

        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Purchase Order</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Formally request goods and services from vendors with a legally sound and clear purchase order document.</p>
            </div>
            <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                Coming Soon
            </button>
        </article>

    </div>
</div>
@endsection