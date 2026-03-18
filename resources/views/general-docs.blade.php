@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-6 py-12 lg:px-10 lg:py-16">
    <div class="mb-12">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-[#ff6600] mb-6">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Home
        </a>
        <h1 class="text-4xl font-extrabold tracking-tight text-[#1e3a8a] sm:text-5xl">General & Admin</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600">Handle day-to-day administrative tasks with standard, ready-to-print utility documents.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Meeting Minutes</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Capture action items, decisions, and attendees in a clean, easily readable format.</p>
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
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Simple Agreement</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Draft a basic, two-party service agreement with clear terms and signature blocks.</p>
            </div>
            <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                Coming Soon
            </button>
        </article>
    </div>
</div>
@endsection