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
            gap: 8px;
            margin-bottom: 36px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent);
        }

        .brand-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--accent);
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

        @keyframes rise {
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 600px) {
            .cards { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="shell">
        <div class="topbar">
            <div class="brand">
                <span class="brand-dot"></span>
                Quick Docs
            </div>
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

        <p class="footer">Quick Docs &mdash; Powered by Ori Studio Limited</p>
    </main>
</body>
</html>
