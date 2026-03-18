<!DOCTYPE html>
<html lang="en" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ori Studio Limited | Frictionless Document Generation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="/tools-filter.js"></script>
        <!-- Nav is sticky by default, no scroll-hide JS -->
</head>
<body class="relative bg-slate-50 text-slate-900 antialiased selection:bg-[#ff6600] selection:text-white overflow-x-hidden">
    
    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 h-[500px] w-[500px] rounded-full bg-[#1e3a8a]/5 blur-3xl"></div>
        <div class="absolute top-40 -left-40 h-[400px] w-[400px] rounded-full bg-[#ff6600]/5 blur-3xl"></div>
    </div>

    <div class="relative mx-auto max-w-6xl px-6 py-6 lg:px-10 lg:py-8">
        <nav class="sticky top-4 z-50 flex items-center justify-between rounded-2xl border border-slate-200 bg-white/90 px-5 py-2.5 shadow-sm backdrop-blur-md" style="position:sticky; top:1rem; transform:none !important; transition:none !important;">
    <div class="flex items-center gap-3 text-lg font-bold tracking-tight">
        <img src="/images/3.png" alt="Ori Studio Logo" class="h-8 w-auto object-contain drop-shadow-sm">
        <!-- <span class="text-[#1e3a8a]">DocGen <span class="hidden sm:inline text-slate-400 font-medium text-sm ml-1">by Ori Studio</span></span> -->
    </div>

    <!-- Mobile Hamburger -->
    <div class="md:hidden flex items-center" x-data="{ open: false, toolsOpen: false }" @click.away="open = false; toolsOpen = false">
        <button @click="open = !open" x-bind:class="open ? 'text-[#ff6600]' : ''" class="transition focus:outline-none flex items-center" aria-label="Open Menu">
            <svg x-show="!open" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" /></svg>
            <svg x-show="open" class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
        </button>
        <!-- Mobile Menu -->
        <div x-show="open" x-transition x-cloak class="absolute top-16 left-0 w-full bg-white border-t border-slate-200 shadow-lg z-50">
            <div class="flex flex-col gap-2 p-4 text-sm font-medium text-slate-700">
                <div class="relative">
                    <button type="button" @click.prevent="toolsOpen = !toolsOpen" class="w-full text-left flex items-center justify-between transition hover:text-[#ff6600] focus:outline-none">
                        <span>Tools</span>
                        <svg :class="toolsOpen ? 'rotate-180' : ''" class="w-4 h-4 ml-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                    </button>
                    <div x-show="toolsOpen" x-transition x-cloak class="mt-2 rounded-xl border border-slate-200 bg-white shadow-lg">
                        <a href="{{ route('business.docs') }}" @click="open = false; toolsOpen = false" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">Business Docs</a>
                        <a href="{{ route('career.docs') }}" @click="open = false; toolsOpen = false" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">Career Docs</a>
                        <a href="{{ route('general.docs') }}" @click="open = false; toolsOpen = false" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">General Docs</a>
                    </div>
                </div>
                <a href="#how-it-works" @click="open = false" class="transition hover:text-[#ff6600]">How it Works</a>
                <a href="#suggest-tool" @click="open = false" class="transition hover:text-[#ff6600]">Suggest a Tool</a>
                <a href="{{ route('quotation.page') }}" @click="open = false" class="rounded-full bg-[#ff6600] px-5 py-2 text-sm font-semibold text-white shadow-md shadow-[#ff6600]/20 transition hover:-translate-y-0.5 hover:bg-[#e65c00] hover:shadow-lg">
                    Start Creating
                </a>
            </div>
        </div>
    </div>

    <!-- Desktop Nav -->
    <div class="hidden items-center gap-8 text-sm font-medium text-slate-600 md:flex">
        <div class="relative group">
            <button class="transition hover:text-[#ff6600] focus:outline-none flex items-center">
                Tools <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
            </button>
            <div class="absolute left-0 mt-2 w-48 rounded-xl border border-slate-200 bg-white shadow-lg opacity-0 group-hover:opacity-100 group-hover:pointer-events-auto pointer-events-none transition-opacity duration-200 z-50">
                <a href="{{ route('business.docs') }}" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">Business Docs</a>
                <a href="{{ route('career.docs') }}" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">Career Docs</a>
                <a href="{{ route('general.docs') }}" class="block px-4 py-2 text-slate-700 hover:bg-[#ff6600]/10">General Docs</a>
            </div>
        </div>
        <a href="#how-it-works" class="transition hover:text-[#ff6600]">How it Works</a>
        <a href="#suggest-tool" class="transition hover:text-[#ff6600]">Suggest a Tool</a>
    </div>

    <a href="{{ route('quotation.page') }}" class="hidden md:inline rounded-full bg-[#ff6600] px-5 py-2 text-sm font-semibold text-white shadow-md shadow-[#ff6600]/20 transition hover:-translate-y-0.5 hover:bg-[#e65c00] hover:shadow-lg">
        Start Creating
    </a>
</nav>

        <header class="mt-20 grid gap-12 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div class="space-y-8">
                <div class="inline-flex items-center gap-2 rounded-full border border-[#1e3a8a]/10 bg-[#1e3a8a]/5 px-4 py-1.5 text-xs font-bold uppercase tracking-[0.15em] text-[#1e3a8a]">
                    Creative Technology Studio
                </div>
                <div>
                    <h1 class="text-4xl font-extrabold leading-[1.1] tracking-tight text-[#1e3a8a] sm:text-5xl lg:text-6xl">
                        Professional Documents.<br> <span class="text-[#ff6600]">Generated Instantly.</span>
                    </h1>
                    <p class="mt-6 max-w-lg text-lg text-slate-600 leading-relaxed">
                        No sign-ups. No data stored. Just choose your template, enter your details, and download a ready-to-share PDF in seconds.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('quotation.page') }}" class="inline-flex items-center justify-center rounded-full bg-[#1e3a8a] px-8 py-4 text-base font-semibold text-white shadow-lg shadow-[#1e3a8a]/20 transition hover:-translate-y-0.5 hover:bg-[#152a66]">
                        Generate a Document
                    </a>
                    <div class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-slate-500">
                        <span class="flex h-2.5 w-2.5 items-center justify-center rounded-full bg-emerald-500 animate-pulse"></span>
                        100% Free & Secure
                    </div>
                </div>
            </div>

            <div class="relative w-full max-w-md mx-auto lg:ml-auto">
                <div class="absolute -inset-1 rounded-3xl bg-gradient-to-br from-[#1e3a8a] to-[#ff6600] opacity-20 blur-xl"></div>
                <div class="relative rounded-3xl border border-slate-700 bg-slate-900 p-8 shadow-2xl">
                    <div class="inline-flex rounded-lg bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-[#ff6600]">
                        Frictionless Flow
                    </div>
                    <p class="mt-4 text-2xl font-bold text-white">Form <span class="text-slate-500 font-normal mx-2">➜</span> PDF</p>
                    <p class="mt-4 text-sm leading-relaxed text-slate-400">
                        Seamlessly shape business transactions. Your inputs are processed safely entirely within your browser.
                    </p>
                    <div class="mt-8 grid gap-4">
                        <div class="rounded-2xl border border-slate-700/50 bg-slate-800/50 p-4 transition hover:bg-slate-800">
                            <div class="text-xs font-medium text-slate-500">Inputs</div>
                            <div class="mt-1 text-sm font-semibold text-slate-200">Customer Details, Line Items</div>
                        </div>
                        <div class="rounded-2xl border border-[#1e3a8a]/50 bg-[#1e3a8a]/20 p-4">
                            <div class="text-xs font-medium text-[#60a5fa]">Output</div>
                            <div class="mt-1 text-sm font-semibold text-white">Polished PDF ready to share</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <section id="tools" class="mt-32 scroll-mt-24">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm font-bold uppercase tracking-[0.15em] text-[#ff6600]">Tools</p>
                    <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#1e3a8a]">Ready & Upcoming Tools</h2>
                </div>
                <div class="flex flex-wrap gap-2 mt-2 md:mt-0">
                    <button class="px-4 py-2 rounded-full bg-slate-200 text-slate-700 font-semibold text-sm transition hover:bg-slate-300" onclick="filterTools('all')">All Categories</button>
                    <button class="px-4 py-2 rounded-full bg-[#1e3a8a] text-white font-semibold text-sm transition hover:bg-[#152a66]" onclick="filterTools('business')">Business</button>
                    <button class="px-4 py-2 rounded-full bg-[#ff6600] text-white font-semibold text-sm transition hover:bg-[#e65c00]" onclick="filterTools('career')">Career</button>
                    <button class="px-4 py-2 rounded-full bg-slate-400 text-white font-semibold text-sm transition hover:bg-slate-500" onclick="filterTools('general')">General</button>
                </div>
            </div>

            <div id="tools-list" class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                <!-- Only show most popular tool per category by default -->
                <article data-category="business" class="tool-card popular group flex flex-col justify-between rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:shadow-lg hover:shadow-[#1e3a8a]/10 hover:-translate-y-1">
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
                <article data-category="career" class="tool-card popular group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-[#1e3a8a]/10 px-3 py-1 text-xs font-bold text-[#1e3a8a]">
                            <span class="h-1.5 w-1.5 rounded-full bg-[#1e3a8a]"></span> Next Up
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-400">CV Builder</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-500">Craft a beautiful, modern curriculum vitae that highlights your experience without the formatting headaches.</p>
                    </div>
                    <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                        Coming Soon
                    </button>
                </article>
                <article data-category="general" class="tool-card popular group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
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

                <!-- All tools, hidden by default, shown when 'View More' is clicked -->
                <article data-category="business" class="tool-card extra group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm" style="display:none;">
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
                <article data-category="business" class="tool-card extra group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm" style="display:none;">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-400">Receipt</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-500">Generate receipts for completed transactions, formatted for easy record-keeping.</p>
                    </div>
                    <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                        Coming Soon
                    </button>
                </article>
                <article data-category="career" class="tool-card extra group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm" style="display:none;">
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
                <article data-category="career" class="tool-card extra group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm" style="display:none;">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-3 py-1 text-xs font-bold text-slate-600">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span> In Build Queue
                        </div>
                        <h3 class="mt-6 text-2xl font-bold text-slate-400">Resignation Letter</h3>
                        <p class="mt-3 text-sm leading-relaxed text-slate-500">Create a professional resignation letter for a smooth transition.</p>
                    </div>
                    <button disabled class="mt-8 inline-flex w-full cursor-not-allowed items-center justify-center rounded-xl border-2 border-slate-200 bg-transparent px-4 py-3.5 text-sm font-bold text-slate-400">
                        Coming Soon
                    </button>
                </article>
                <article data-category="general" class="tool-card extra group flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50 p-6 shadow-sm" style="display:none;">
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

                <!-- View More Button -->
                <div class="col-span-full flex justify-center mt-6">
                    <button id="view-more-btn" class="inline-flex items-center gap-2 rounded-full bg-[#1e3a8a] px-6 py-2 text-white font-semibold shadow transition hover:bg-[#152a66]">View More Tools</button>
                </div>
            </div>

            <script>
                function filterTools(category) {
                    const popular = document.querySelectorAll('.tool-card.popular');
                    const extra = document.querySelectorAll('.tool-card.extra');
                    if (category === 'all') {
                        popular.forEach(card => card.style.display = '');
                        extra.forEach(card => card.style.display = 'none');
                        document.getElementById('view-more-btn').style.display = '';
                    } else {
                        popular.forEach(card => {
                            if (card.getAttribute('data-category') === category) {
                                card.style.display = '';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                        extra.forEach(card => {
                            if (card.getAttribute('data-category') === category) {
                                card.style.display = '';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                        document.getElementById('view-more-btn').style.display = 'none';
                    }
                }
                document.getElementById('view-more-btn').onclick = function() {
                    document.querySelectorAll('.tool-card.extra').forEach(card => card.style.display = '');
                    this.style.display = 'none';
                };
            </script>
        </section>

        <section id="how-it-works" class="mt-32 scroll-mt-24">
            <div class="text-center max-w-2xl mx-auto">
                <p class="text-sm font-bold uppercase tracking-[0.15em] text-[#ff6600]">How It Works</p>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-[#1e3a8a]">Simple, transparent, and secure</h2>
                <p class="mt-4 text-slate-600">We keep every interaction frictionless. Your inputs stay entirely in your browser memory, and your PDF arrives in seconds.</p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-3">
                <div class="relative rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#1e3a8a]/5 text-[#1e3a8a]">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-[#1e3a8a]">Step 1 <span class="text-slate-300 mx-1">|</span> Choose</h3>
                    <p class="mt-3 text-sm text-slate-600">Pick the document template that fits your workflow and brand style.</p>
                </div>
                
                <div class="relative rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#ff6600]/10 text-[#ff6600]">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-[#1e3a8a]">Step 2 <span class="text-slate-300 mx-1">|</span> Enter</h3>
                    <p class="mt-3 text-sm text-slate-600">Fill in your details using our intuitive, live-updating form.</p>
                </div>

                <div class="relative rounded-3xl border border-slate-200 bg-white p-8 text-center shadow-sm">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-[#1e3a8a]/5 text-[#1e3a8a]">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-[#1e3a8a]">Step 3 <span class="text-slate-300 mx-1">|</span> Download</h3>
                    <p class="mt-3 text-sm text-slate-600">Instantly export a polished PDF, ready to email to your clients.</p>
                </div>
            </div>
        </section>

        <section id="suggest-tool" class="mt-32 scroll-mt-24">
            <div class="relative overflow-hidden rounded-[2.5rem] bg-[#000720] px-8 py-14 shadow-2xl sm:px-16">
                <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_center,_white_1px,_transparent_1px)]" style="background-size: 24px 24px;"></div>
                
                <div class="relative z-10 flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-xl">
                        <p class="text-sm font-bold uppercase tracking-[0.15em] text-[#ffffff]">Suggest a Tool</p>
                        <h2 class="mt-4 text-3xl font-extrabold text-white sm:text-4xl">What should we build next?</h2>
                        <p class="mt-4 text-lg text-slate-300 leading-relaxed">
                            We are expanding into Career & Professional experiences. Tell us what document would help you move faster.
                        </p>
                    </div>

                    <form method="POST" action="{{ url('/suggest-tool') }}" class="w-full lg:max-w-md">
                        @csrf
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <input 
                                type="text" 
                                name="suggestion" 
                                placeholder="e.g., NDA, Cover Letter" 
                                class="w-full rounded-xl border border-white/20 bg-white/10 px-5 py-4 text-white placeholder:text-slate-400 focus:border-[#ff6600] focus:bg-white/15 focus:outline-none focus:ring-1 focus:ring-[#ff6600] transition" 
                                required>
                            <button type="submit" class="whitespace-nowrap rounded-xl bg-[#ff6600] px-8 py-4 font-bold text-white transition hover:bg-[#e65c00]">
                                Submit Idea
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <footer class="mt-24 mb-8 border-t border-slate-200 pt-8 text-sm font-medium text-slate-500">
            <div class="flex flex-col gap-6 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2">
                    <div class="h-6 w-6 rounded bg-[#1e3a8a] text-white flex items-center justify-center text-xs font-bold">O</div>
                    <p>© {{ date('Y') }} Ori Studio Limited.</p>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="#" class="transition hover:text-[#1e3a8a]">Privacy Policy</a>
                    <a href="#" class="transition hover:text-[#1e3a8a]">Terms of Service</a>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>