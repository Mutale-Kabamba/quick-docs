<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Docs | Choose Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --ink: #10201a;
            --ink-soft: #335047;
            --line: #b8cec5;
            --panel: rgba(255, 255, 255, 0.85);
            --accent: #136f63;
            --accent-dark: #0c4a42;
            --highlight: #f59e0b;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: "Trebuchet MS", "Gill Sans", "Segoe UI", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(circle at 20% 10%, rgba(245, 158, 11, 0.22), transparent 38%),
                radial-gradient(circle at 90% 15%, rgba(19, 111, 99, 0.2), transparent 42%),
                linear-gradient(155deg, #e6fff8 0%, #edf7ff 55%, #f9ffec 100%);
            display: grid;
            place-items: center;
            padding: 24px 16px;
        }

        .shell {
            width: min(960px, 100%);
        }

        .hero {
            margin-bottom: 22px;
        }

        .eyebrow {
            display: inline-block;
            font-size: 0.8rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--accent-dark);
            margin-bottom: 8px;
            font-weight: 700;
        }

        .title {
            margin: 0;
            font-size: clamp(1.8rem, 3.5vw, 2.8rem);
            line-height: 1.15;
        }

        .subtitle {
            margin: 10px 0 0;
            color: var(--ink-soft);
            font-size: 1.02rem;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 16px;
            box-shadow: 0 12px 30px rgba(16, 32, 26, 0.08);
            padding: 18px;
            backdrop-filter: blur(4px);
            transform: translateY(10px);
            opacity: 0;
            animation: rise 420ms ease-out forwards;
        }

        .card:nth-child(2) {
            animation-delay: 90ms;
        }

        .card:nth-child(3) {
            animation-delay: 180ms;
        }

        .card h2 {
            margin: 0;
            font-size: 1.2rem;
        }

        .card p {
            margin: 8px 0 14px;
            color: var(--ink-soft);
            min-height: 46px;
            font-size: 0.95rem;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            border: 0;
            border-radius: 12px;
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

        .btn-muted {
            background: #d8e8e2;
            color: #3e5f55;
            cursor: not-allowed;
        }

        .tag {
            display: inline-block;
            margin-bottom: 8px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 4px 9px;
            background: #fff6e6;
            color: #a16207;
            border: 1px solid #f6dba3;
        }

        @keyframes rise {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: 1fr;
            }

            .card p {
                min-height: 0;
            }
        }
    </style>
</head>
<body>
    <main class="shell">
        <header class="hero">
            <span class="eyebrow">Quick Docs</span>
            <h1 class="title">Choose what you want to generate</h1>
            <p class="subtitle">Start with a document type, then fill in the details and export your PDF.</p>
        </header>

        <section class="cards">
            <article class="card">
                <span class="tag">Available</span>
                <h2>Quotation</h2>
                <p>Create a clean quotation document with line items and pricing details.</p>
                <a href="{{ route('quotation.page') }}" class="btn btn-primary">Go To Quotation</a>
            </article>

            <article class="card">
                <span class="tag">Coming Soon</span>
                <h2>Invoice</h2>
                <p>Generate invoice-ready layouts tailored for billing workflows.</p>
                <button class="btn btn-muted" type="button" disabled>Coming Soon</button>
            </article>

            <article class="card">
                <span class="tag">Coming Soon</span>
                <h2>Receipt</h2>
                <p>Build compact receipt PDFs for payment confirmations.</p>
                <button class="btn btn-muted" type="button" disabled>Coming Soon</button>
            </article>
        </section>
    </main>
</body>
</html>
