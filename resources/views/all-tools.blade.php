@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    <h1 class="text-3xl font-extrabold tracking-tight text-[#1e3a8a] mb-8">All Tools</h1>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <!-- Example tool cards, copy from landing page or category pages -->
        <article class="group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-lg hover:shadow-[#1e3a8a]/10 hover:-translate-y-1">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span> Live
                </div>
                <h3 class="mt-6 text-2xl font-bold text-[#1e3a8a]">Quotation</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-600">Generate a professional, branded price quote to win your next client. Supports multiple line items and automatic totals.</p>
            </div>
            <a href="{{ route('quotation.page') }}" class="mt-8 inline-flex w-full items-center justify-center rounded-xl bg-[#ff6600] px-4 py-3.5 text-sm font-bold text-white transition hover:bg-[#e65c00]">
                Create Quotation
            </a>
        </article>
        <!-- Add more tool cards for each tool -->
    </div>
</div>
@endsection
