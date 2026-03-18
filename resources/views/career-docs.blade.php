@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-6xl px-6 py-12 lg:px-10 lg:py-16">
    <div class="mb-12">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-[#ff6600] mb-6">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Back to Home
        </a>
        <h1 class="text-4xl font-extrabold tracking-tight text-[#1e3a8a] sm:text-5xl">Career & Professional</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-600">Stand out to recruiters and formalize your professional journey with minimalist, ATS-friendly documents.</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <article class="group flex flex-col justify-between rounded-3xl border border-slate-200 bg-slate-50 p-8 shadow-sm">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full bg-[#1e3a8a]/10 px-3 py-1 text-xs font-bold text-[#1e3a8a]">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#1e3a8a] animate-pulse"></span> Next Up
                </div>
                <h3 class="mt-6 text-2xl font-bold text-slate-400">CV Builder</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Craft a beautiful, modern curriculum vitae that highlights your experience without the formatting headaches.</p>
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
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Cover Letter</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Generate a structured, persuasive cover letter perfectly formatted to match your CV.</p>
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
                <h3 class="mt-6 text-2xl font-bold text-slate-400">Resignation Letter</h3>
                <p class="mt-3 text-sm leading-relaxed text-slate-500">Leave on good terms with a polite, professionally formatted formal notice of resignation.</p>
            </div>
            <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                Coming Soon
            </button>
        </article>
    </div>
</div>
@endsection