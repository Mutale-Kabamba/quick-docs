<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Docs | Choose Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #0f172a;
            --ink-2: #334155;
            --ink-3: #64748b;
            --line: #e2e8f0;
            --panel: #ffffff;
            --paper: #f8fafc;
            --accent: #059669;
            --accent-dark: #047857;
            --accent-light: #ecfdf5;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: Inter, "Segoe UI", system-ui, -apple-system, sans-serif;
            color: var(--ink);
            background: var(--paper);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .shell { width: min(880px, 100%); }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 36px;
            padding: 12px 18px;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(14px) saturate(180%);
            -webkit-backdrop-filter: blur(14px) saturate(180%);
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 14px;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 1px 2px rgba(0, 0, 0, 0.02);
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
        }

        .brand-icon-wrap {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(135deg, #0284c7 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff;
            box-shadow: 0 4px 10px -2px rgba(2, 132, 199, 0.4);
            flex-shrink: 0;
            transition: transform 200ms ease;
        }

        .brand-link:hover .brand-icon-wrap {
            transform: scale(1.05);
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: #0f172a;
        }

        .brand-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: var(--accent);
        }

        .topbar-nav {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-nav-link {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--ink-3);
            text-decoration: none;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 150ms ease;
        }

        .topbar-nav-link:hover {
            color: var(--ink);
            background: rgba(241, 245, 249, 0.9);
        }

        .hero { margin-bottom: 24px; }

        .hero h1 {
            font-size: clamp(1.5rem, 3vw, 2.2rem);
            font-weight: 700;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: var(--ink);
        }

        .hero p {
            margin-top: 8px;
            color: var(--ink-3);
            font-size: 0.92rem;
            line-height: 1.5;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
            opacity: 0;
            transform: translateY(8px);
            animation: rise 320ms ease-out forwards;
            display: flex;
            flex-direction: column;
            transition: box-shadow 150ms ease, border-color 150ms ease;
        }

        .card:hover {
            box-shadow: 0 4px 18px rgba(0,0,0,0.1);
            border-color: #cbd5e1;
        }

        .card:nth-child(2) { animation-delay: 70ms; }
        .card:nth-child(3) { animation-delay: 140ms; }

        .card-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.66rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--accent);
            background: var(--accent-light);
            padding: 3px 8px;
            border-radius: 999px;
            margin-bottom: 12px;
            width: fit-content;
        }

        .card h2 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            margin: 0 0 6px;
        }

        .card p {
            font-size: 0.84rem;
            color: var(--ink-3);
            line-height: 1.5;
            flex: 1;
            margin: 0 0 16px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.83rem;
            border-radius: 7px;
            padding: 8px 14px;
            border: none;
            cursor: pointer;
            font-family: inherit;
            transition: background 150ms ease, box-shadow 150ms ease;
            width: 100%;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-dark);
            box-shadow: 0 2px 10px rgba(5, 150, 105, 0.28);
        }

        .footer {
            margin-top: 28px;
            text-align: center;
            font-size: 0.73rem;
            color: var(--ink-3);
        }

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        @keyframes rise {
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 820px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 14px;
            }
            .card:nth-child(3) {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 600px) {
            body {
                padding: 24px 14px;
                justify-content: flex-start;
            }
            .topbar {
                margin-bottom: 20px;
            }
            .hero {
                margin-bottom: 18px;
            }
            .hero h1 {
                font-size: 1.55rem;
            }
            .hero p {
                font-size: 0.88rem;
            }
            .cards {
                grid-template-columns: 1fr;
                gap: 12px;
            }
            .card:nth-child(3) {
                grid-column: auto;
            }
            .card {
                padding: 16px;
            }
            .btn {
                min-height: 44px;
                font-size: 0.92rem;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <div class="topbar">
            <a href="{{ route('landing') }}" class="brand-link" title="Quick Docs Home">
                <span class="brand-icon-wrap">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                    </svg>
                </span>
                <span class="brand">
                    <span class="brand-dot"></span>
                    Quick Docs
                </span>
            </a>

            <nav class="topbar-nav" aria-label="Quick navigation">
                <a href="{{ route('quotation.page') }}" class="topbar-nav-link">Quotation</a>
                <a href="{{ route('invoice.page') }}" class="topbar-nav-link">Invoice</a>
                <a href="{{ route('receipt.page') }}" class="topbar-nav-link">Receipt</a>
            </nav>
        </div>

        <header class="hero">
            <h1>Generate your business document</h1>
            <p>Select a document type below, fill in the details, and export a polished PDF.</p>
        </header>

        <section class="cards">
            <article class="card">
                <span class="card-badge">Available</span>
                <h2>Quotation</h2>
                <p>Create a clean quotation with itemised pricing for your clients.</p>
                <a href="{{ route('quotation.page') }}" class="btn btn-primary">Open Quotation</a>
            </article>

            <article class="card">
                <span class="card-badge">Available</span>
                <h2>Invoice</h2>
                <p>Generate professional invoices tailored for billing workflows.</p>
                <a href="{{ route('invoice.page') }}" class="btn btn-primary">Open Invoice</a>
            </article>

            <article class="card">
                <span class="card-badge">Available</span>
                <h2>Receipt</h2>
                <p>Build compact receipt PDFs to confirm payments and transactions.</p>
                <a href="{{ route('receipt.page') }}" class="btn btn-primary">Open Receipt</a>
            </article>
        </section>

        <p class="footer">Quick Docs &mdash; Powered by <a href="https://www.oristudiozm.com" target="_blank" rel="noopener noreferrer" style="color:inherit;text-decoration:underline;">Ori Studio Limited</a></p>
    </main>
</body>
</html>
