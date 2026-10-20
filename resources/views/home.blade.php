<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quick Docs | {{ $docType ?? 'Quotation' }} Builder</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #f1f5f9;
            --sheet-bg: #ffffff;
            --blue-primary: #0066d6;
            --blue-hover: #0052b3;
            --pink-accent: #e11d48;
            --pink-hover: #be123c;
            --purple-accent: #8b5cf6;
            --purple-border: #c084fc;
            --purple-bg: #faf5ff;
            --ink-main: #0f172a;
            --ink-muted: #64748b;
            --line-light: #e2e8f0;
            --line-dashed: #cbd5e1;
            --card-bg: #f8fafc;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            color: var(--ink-main);
            background: var(--bg-page);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* Modern Glassmorphic Top Navigation Bar */
        .top-navbar {
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(14px) saturate(180%);
            -webkit-backdrop-filter: blur(14px) saturate(180%);
            border-bottom: 1px solid rgba(226, 232, 240, 0.85);
            position: sticky;
            top: 0;
            z-index: 45;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 1px 2px rgba(0, 0, 0, 0.02);
            transition: background-color 200ms ease, box-shadow 200ms ease, border-color 200ms ease;
        }
        .top-navbar-inner {
            max-width: 1140px;
            margin: 0 auto;
            padding: 10px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }
        .top-nav-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: #64748b;
            font-size: 0.8rem;
            font-weight: 500;
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 160ms ease;
        }
        .back-btn svg {
            color: #94a3b8;
            transition: transform 160ms ease, color 160ms ease;
        }
        .back-btn:hover {
            color: #0284c7;
            background: #f1f5f9;
            border-color: #e2e8f0;
        }
        .back-btn:hover svg {
            transform: translateX(-2px);
            color: #0284c7;
        }
        .nav-breadcrumb-sep {
            color: #cbd5e1;
            font-weight: 300;
            font-size: 0.95rem;
            user-select: none;
        }
        .builder-title {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--ink-main);
            letter-spacing: -0.01em;
            line-height: 1;
            white-space: nowrap;
        }

        /* Nav Right Actions */
        .nav-right-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .template-picker-group {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            background: #ffffff;
            border: 1px solid rgba(203, 213, 225, 0.75);
            border-radius: 8px;
            padding: 4px 8px 4px 10px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
            transition: border-color 150ms ease, box-shadow 150ms ease;
        }
        .template-picker-group:focus-within {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
        }
        .template-picker-group label {
            color: #64748b;
            font-weight: 600;
            font-size: 0.76rem;
            white-space: nowrap;
            cursor: pointer;
        }
        .template-select {
            padding: 3px 4px;
            font-size: 0.78rem;
            border: none;
            background: transparent;
            color: #0f172a;
            font-weight: 600;
            cursor: pointer;
            outline: none;
            max-width: 220px;
        }

        /* Top Bar Preview & Download Buttons */
        .nav-preview-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 14px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
            background: #ffffff;
            border: 1px solid rgba(203, 213, 225, 0.8);
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            white-space: nowrap;
            transition: all 180ms cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-preview-btn svg {
            color: #0284c7;
            transition: transform 180ms ease;
        }
        .nav-preview-btn:hover {
            background: #f8fafc;
            color: #0284c7;
            border-color: #0284c7;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(2, 132, 199, 0.15);
        }
        .nav-preview-btn:hover svg {
            transform: scale(1.1);
        }
        .nav-preview-btn:active {
            transform: translateY(0);
        }

        .nav-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px !important;
            font-size: 0.82rem !important;
            font-weight: 600;
            color: #ffffff;
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 3px 10px -1px rgba(2, 132, 199, 0.38);
            white-space: nowrap !important;
            line-height: 1.2;
            transition: all 180ms cubic-bezier(0.16, 1, 0.3, 1);
        }
        .nav-download-btn svg {
            color: #ffffff;
            transition: transform 180ms ease;
        }
        .nav-download-btn:hover {
            background: linear-gradient(135deg, #0369a1 0%, #075985 100%);
            transform: translateY(-1px);
            box-shadow: 0 5px 14px -1px rgba(2, 132, 199, 0.48);
        }
        .nav-download-btn:hover svg {
            transform: translateY(1px);
        }
        .nav-download-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 6px -1px rgba(2, 132, 199, 0.4);
        }

        /* The Document Canvas */
        .canvas-wrapper {
            max-width: 880px;
            margin: 28px auto 60px;
            padding: 0 16px;
        }
        .doc-sheet {
            background: var(--sheet-bg);
            border: 1px solid var(--line-light);
            border-radius: 14px;
            box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.05), 0 4px 6px -2px rgba(0, 0, 0, 0.02);
            padding: 40px 48px;
            position: relative;
        }
        @media (max-width: 768px) {
            .doc-sheet {
                padding: 24px 18px;
            }
        }

        /* Error Notification Banner */
        .error-banner {
            margin-bottom: 24px;
            padding: 12px 16px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            color: #991b1b;
            font-size: 0.82rem;
        }
        .error-banner ul {
            margin: 6px 0 0;
            padding-left: 20px;
        }

        /* Document Header */
        .sheet-title-row {
            text-align: center;
            margin-bottom: 24px;
        }
        .editable-doc-title-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            position: relative;
        }
        .editable-doc-title {
            font-size: 1.65rem;
            font-weight: 700;
            color: var(--ink-main);
            letter-spacing: -0.02em;
            border-bottom: 2px dashed #94a3b8;
            padding: 2px 8px;
            background: transparent;
            border-top: none;
            border-left: none;
            border-right: none;
            text-align: center;
            outline: none;
            min-width: 160px;
            font-family: inherit;
        }
        .editable-doc-title:focus {
            border-bottom-color: var(--blue-primary);
        }
        .pencil-icon-btn {
            color: #94a3b8;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            border-radius: 4px;
            border: none;
            background: transparent;
        }
        .pencil-icon-btn:hover {
            color: var(--blue-primary);
            background: #eff6ff;
        }

        /* Header Split: Meta (Left) & Logo (Right) */
        .sheet-meta-split {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 24px;
            margin-bottom: 28px;
        }
        @media (max-width: 680px) {
            .sheet-meta-split {
                flex-direction: column-reverse;
                align-items: stretch;
            }
        }
        .meta-fields-col {
            flex: 1;
            max-width: 440px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .meta-field-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .meta-field-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--ink-main);
            width: 140px;
            flex-shrink: 0;
            border-bottom: 1px dashed #cbd5e1;
            padding-bottom: 2px;
            cursor: default;
        }
        .meta-field-input {
            flex: 1;
            padding: 6px 10px;
            font-size: 0.82rem;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            background: #ffffff;
            outline: none;
            font-family: inherit;
            color: var(--ink-main);
            transition: border-color 150ms;
        }
        .meta-field-input:focus {
            border-color: var(--blue-primary);
            box-shadow: 0 0 0 2px rgba(0, 102, 214, 0.1);
        }
        .meta-action-links {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-top: 4px;
        }
        .text-action-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            color: #7c3aed;
            cursor: pointer;
            text-decoration: none;
            background: none;
            border: none;
            padding: 0;
            width: fit-content;
        }
        .text-action-link:hover {
            color: #6d28d9;
            text-decoration: underline;
        }

        /* Logo Box */
        .logo-box-wrap {
            flex-shrink: 0;
        }
        .logo-drop-box {
            width: 176px;
            height: 116px;
            border: 1.5px dashed var(--purple-border);
            border-radius: 10px;
            background: var(--purple-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            transition: all 180ms ease-in-out;
            position: relative;
            overflow: hidden;
        }
        .logo-drop-box:hover {
            border-color: var(--purple-accent);
            background: #f5f3ff;
            transform: translateY(-1px);
        }
        .logo-box-icon {
            color: var(--purple-accent);
            margin-bottom: 4px;
        }
        .logo-box-title {
            font-size: 0.75rem;
            font-weight: 700;
            color: #6b21a8;
            margin-bottom: 2px;
        }
        .logo-box-hint {
            font-size: 0.62rem;
            color: #9333ea;
            line-height: 1.25;
            max-width: 140px;
        }
        .logo-preview-img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: none;
        }
        .logo-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.65);
            display: none;
            align-items: center;
            justify-content: center;
            gap: 8px;
            backdrop-filter: blur(2px);
        }
        .logo-drop-box:hover .logo-overlay.active {
            display: flex;
        }
        .logo-mini-btn {
            background: #ffffff;
            color: var(--ink-main);
            border: none;
            font-size: 0.68rem;
            font-weight: 600;
            padding: 4px 8px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Party Cards (Your Details & Client's Details) */
        .party-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 22px;
        }
        @media (max-width: 720px) {
            .party-grid {
                grid-template-columns: 1fr;
            }
        }
        .party-card {
            background: var(--card-bg);
            border: 1px solid var(--line-light);
            border-radius: 10px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .party-card-title {
            font-size: 0.78rem;
            font-weight: 700;
            color: #475569;
            margin: 0 0 2px 0;
        }
        .clean-input {
            width: 100%;
            padding: 7px 11px;
            font-size: 0.81rem;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            background: #ffffff;
            color: var(--ink-main);
            outline: none;
            font-family: inherit;
            transition: all 120ms;
        }
        .clean-input:focus {
            border-color: var(--blue-primary);
            box-shadow: 0 0 0 2px rgba(0, 102, 214, 0.1);
        }
        .clean-input::placeholder {
            color: #94a3b8;
            font-size: 0.78rem;
        }
        .phone-input-group {
            display: flex;
            align-items: center;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            background: #ffffff;
            overflow: hidden;
        }
        .phone-input-group:focus-within {
            border-color: var(--blue-primary);
            box-shadow: 0 0 0 2px rgba(0, 102, 214, 0.1);
        }
        .phone-prefix-select {
            padding: 7px 8px;
            font-size: 0.78rem;
            font-weight: 600;
            background: #f8fafc;
            border: none;
            border-right: 1px solid var(--line-light);
            color: var(--ink-main);
            outline: none;
            cursor: pointer;
        }
        .phone-input-group input {
            border: none !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            padding: 7px 10px;
        }
        .two-col-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        /* Shipping Details Section */
        .shipping-checkbox-wrap {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            font-weight: 500;
            color: #475569;
        }
        .shipping-checkbox-wrap input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--blue-primary);
            cursor: pointer;
        }
        .shipping-card {
            display: none;
            background: var(--card-bg);
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 22px;
            gap: 10px;
        }
        .shipping-card.show {
            display: flex;
            flex-direction: column;
        }

        /* Toolbar Above Table */
        .table-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }
        .pill-tool-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border: 1px solid var(--line-light);
            border-radius: 20px;
            background: #ffffff;
            color: #334155;
            font-size: 0.78rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 120ms;
        }
        .pill-tool-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: var(--ink-main);
        }
        .currency-selector-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #334155;
        }
        .currency-select {
            padding: 6px 12px;
            font-size: 0.8rem;
            border: 1px solid var(--line-light);
            border-radius: 7px;
            background: #ffffff;
            font-weight: 600;
            color: var(--ink-main);
            outline: none;
            cursor: pointer;
        }
        .currency-select:focus {
            border-color: var(--blue-primary);
        }

        /* Items Table */
        .items-table-container {
            border-radius: 8px 8px 0 0;
            overflow: hidden;
            margin-bottom: 8px;
            border: 1px solid var(--line-light);
        }
        .refrens-table {
            width: 100%;
            border-collapse: collapse;
        }
        .refrens-table th {
            background: var(--blue-primary);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.02em;
            padding: 10px 14px;
            text-align: left;
        }
        .refrens-table th.th-right {
            text-align: right;
        }
        .refrens-table th.th-center {
            text-align: center;
        }
        .refrens-row {
            background: #ffffff;
            border-bottom: 1px solid var(--line-light);
            transition: background 120ms;
        }
        .refrens-row:hover {
            background: #fafcff;
        }
        .refrens-row td {
            padding: 10px 12px;
            vertical-align: top;
        }
        .item-number-col {
            width: 50px;
            text-align: center;
            font-size: 0.82rem;
            font-weight: 600;
            color: #64748b;
            padding-top: 14px !important;
        }
        .item-row-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            margin-top: 4px;
            opacity: 0.4;
            transition: opacity 150ms;
        }
        .refrens-row:hover .item-row-actions {
            opacity: 1;
        }
        .row-action-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 2px;
            color: #64748b;
            border-radius: 3px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .row-action-icon:hover {
            color: #ef4444;
            background: #fee2e2;
        }
        .row-action-icon.clone:hover {
            color: var(--blue-primary);
            background: #dbeafe;
        }

        .item-name-input {
            width: 100%;
            padding: 6px 4px;
            border: none;
            border-bottom: 1px solid transparent;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--ink-main);
            outline: none;
            background: transparent;
            font-family: inherit;
        }
        .item-name-input:focus {
            border-bottom-color: var(--blue-primary);
        }
        .item-name-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }
        .item-desc-textarea {
            width: 100%;
            margin-top: 6px;
            padding: 6px 8px;
            font-size: 0.78rem;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            outline: none;
            font-family: inherit;
            color: #334155;
            resize: vertical;
            min-height: 48px;
            display: none;
        }
        .item-desc-textarea.show {
            display: block;
        }
        .item-micro-actions {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 6px;
        }
        .item-micro-link {
            font-size: 0.72rem;
            font-weight: 600;
            color: #7c3aed;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: none;
            border: none;
            padding: 0;
        }
        .item-micro-link:hover {
            text-decoration: underline;
        }

        .qty-input,
        .rate-input {
            padding: 6px 8px;
            font-size: 0.82rem;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            outline: none;
            color: var(--ink-main);
            font-family: inherit;
            background: #ffffff;
            font-weight: 500;
        }
        .qty-input {
            width: 70px;
            text-align: center;
        }
        .rate-input-wrap {
            display: flex;
            align-items: center;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            background: #ffffff;
            overflow: hidden;
            width: 100px;
            margin-left: auto;
        }
        .rate-input-wrap:focus-within {
            border-color: var(--blue-primary);
        }
        .rate-currency-prefix {
            padding: 6px 6px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            background: #f8fafc;
            border-right: 1px solid var(--line-light);
        }
        .rate-input-wrap input {
            border: none;
            outline: none;
            width: 100%;
            padding: 6px 6px;
            font-size: 0.82rem;
            text-align: right;
            font-weight: 500;
        }
        .line-amount-text {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink-main);
            text-align: right;
            padding-top: 8px;
            display: block;
        }

        /* Add New Line Button */
        .add-row-dashed-btn {
            width: 100%;
            border: 1.5px dashed var(--line-dashed);
            border-radius: 8px;
            padding: 10px;
            background: #fcfdfe;
            color: #475569;
            font-size: 0.82rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            transition: all 150ms;
            margin-bottom: 24px;
        }
        .add-row-dashed-btn:hover {
            border-color: var(--blue-primary);
            color: var(--blue-primary);
            background: #f0f7ff;
        }

        /* Bottom Section: Summary & Action Cards */
        .summary-totals-container {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 24px;
        }
        .totals-card-refrens {
            width: 100%;
            max-width: 340px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .visible-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.78rem;
            font-weight: 700;
            color: #334155;
            padding-bottom: 6px;
            border-bottom: 1px solid var(--line-light);
        }
        .totals-interactive-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #475569;
        }
        .subtotal-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.82rem;
            font-weight: 600;
            color: #334155;
            padding: 4px 0;
        }
        .tax-toggle-box,
        .discount-toggle-box {
            display: none;
            background: #f8fafc;
            border: 1px solid var(--line-light);
            border-radius: 6px;
            padding: 8px 10px;
            margin-top: 4px;
            font-size: 0.78rem;
        }
        .tax-toggle-box.show,
        .discount-toggle-box.show {
            display: block;
        }
        .discount-type-segmented {
            display: inline-flex;
            border: 1px solid #cbd5e1;
            border-radius: 4px;
            overflow: hidden;
            background: #ffffff;
        }
        .discount-unit-btn {
            border: none;
            background: transparent;
            padding: 3px 8px;
            font-size: 0.75rem;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            transition: all 0.15s ease;
            line-height: 1.2;
        }
        .discount-unit-btn.active {
            background: #0284c7;
            color: #ffffff;
        }
        .total-highlight-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px solid var(--line-light);
            margin-top: 4px;
        }
        .total-label {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--ink-main);
            border-bottom: 1.5px dashed #94a3b8;
            padding-bottom: 2px;
        }
        .total-amount-display {
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--ink-main);
        }

        /* In-Words Box */
        .words-box {
            background: #ffffff;
            border: 1px solid var(--line-light);
            border-radius: 8px;
            padding: 10px 14px;
            margin-top: 8px;
        }
        .words-box-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.74rem;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 4px;
        }
        .words-label {
            font-size: 0.72rem;
            color: #64748b;
            margin-bottom: 2px;
        }
        .words-output {
            font-size: 0.82rem;
            font-weight: 600;
            color: #1e293b;
            border-bottom: 1px dashed #cbd5e1;
            padding-bottom: 3px;
        }

        /* Signature Box */
        .signature-dashed-box {
            margin-top: 12px;
            border: 1.5px dashed var(--line-dashed);
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            color: #475569;
            font-size: 0.8rem;
            font-weight: 600;
            background: #fbfcfd;
            transition: all 150ms;
        }
        .signature-dashed-box:hover {
            border-color: #0066d6;
            color: #0066d6;
            background: #eff6ff;
        }
        .signature-dashed-box.has-sig {
            border-color: #10b981;
            background: #f0fdf4;
            color: #047857;
        }
        .signature-content-drawer {
            display: none;
            margin-top: 8px;
            padding: 12px;
            background: #ffffff;
            border: 1px solid var(--line-light);
            border-radius: 8px;
        }
        .signature-content-drawer.show {
            display: block;
        }
        .signature-upload-zone {
            border: 1.5px dashed #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            background: #f8fafc;
            cursor: pointer;
            transition: all 150ms ease;
        }
        .signature-upload-zone:hover {
            border-color: #0066d6;
            background: #eff6ff;
        }
        .sig-upload-icon {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #e2e8f0;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 4px;
        }
        .signature-upload-zone:hover .sig-upload-icon {
            background: #dbeafe;
            color: #0066d6;
        }
        .sig-action-link {
            background: none;
            border: none;
            color: #0066d6;
            font-size: 0.72rem;
            font-weight: 600;
            cursor: pointer;
            padding: 0;
        }
        .sig-action-link:hover {
            text-decoration: underline;
        }

        /* Item Image Upload & Preview */
        .item-image-preview-wrap {
            display: inline-flex;
            position: relative;
            margin-top: 6px;
            margin-bottom: 4px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 2px;
            background: #f8fafc;
            width: 52px;
            height: 52px;
            align-items: center;
            justify-content: center;
        }
        .item-image-preview-thumb {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            border-radius: 4px;
        }
        .item-image-remove-btn {
            position: absolute;
            top: -6px;
            right: -6px;
            width: 18px;
            height: 18px;
            background: #ef4444;
            color: #ffffff;
            border: 1.5px solid #ffffff;
            border-radius: 50%;
            font-size: 11px;
            line-height: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0,0,0,0.2);
            padding: 0;
        }
        .item-image-remove-btn:hover {
            background: #dc2626;
        }

        /* Bottom 5 Add-on Action Buttons */
        .bottom-action-buttons-grid {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
            margin-top: 24px;
            margin-bottom: 24px;
        }
        @media (max-width: 840px) {
            .bottom-action-buttons-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }
        @media (max-width: 540px) {
            .bottom-action-buttons-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }
        .bottom-action-btn {
            border: 1.5px dashed #cbd5e1;
            border-radius: 9px;
            background: #ffffff;
            color: #334155;
            padding: 9px 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            cursor: pointer;
            transition: all 160ms cubic-bezier(0.4, 0, 0.2, 1);
            user-select: none;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
            position: relative;
            outline: none;
        }
        .bottom-action-btn .btn-icon {
            width: 24px;
            height: 24px;
            border-radius: 6px;
            background: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all 160ms ease;
        }
        .bottom-action-btn .btn-text {
            font-size: 0.8rem;
            font-weight: 600;
            white-space: nowrap;
            letter-spacing: -0.01em;
            color: #334155;
            transition: color 160ms ease;
        }
        .bottom-action-btn:hover {
            border-color: #0066d6;
            border-style: solid;
            background: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 102, 214, 0.08);
        }
        .bottom-action-btn:hover .btn-icon {
            background: #eff6ff;
            color: #0066d6;
        }
        .bottom-action-btn:hover .btn-text {
            color: #0066d6;
        }
        .bottom-action-btn.active {
            border-style: solid;
            border-color: #0066d6;
            background: #f0f7ff;
            box-shadow: 0 0 0 1px #0066d6, 0 2px 6px rgba(0, 102, 214, 0.12);
        }
        .bottom-action-btn.active .btn-icon {
            background: #0066d6;
            color: #ffffff;
        }
        .bottom-action-btn.active .btn-text {
            color: #0066d6;
            font-weight: 700;
        }

        /* Collapsible Drawers for Bottom Actions */
        .action-drawer {
            display: none;
            background: var(--card-bg);
            border: 1px solid var(--line-light);
            border-radius: 10px;
            padding: 16px;
            margin-bottom: 16px;
            animation: fadeIn 150ms ease-in-out;
        }
        .action-drawer.show {
            display: block;
        }
        .action-drawer-title {
            font-size: 0.8rem;
            font-weight: 700;
            color: #334155;
            margin: 0 0 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .drawer-close-btn {
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            font-size: 1rem;
            padding: 0 4px;
        }
        .drawer-close-btn:hover { color: #ef4444; }

        /* Save & Continue Button */
        .submit-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 32px;
        }
        .save-continue-btn {
            background: var(--pink-accent);
            color: #ffffff;
            font-size: 0.95rem;
            font-weight: 700;
            padding: 12px 38px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.35);
            transition: all 180ms ease-in-out;
            letter-spacing: 0.01em;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .save-continue-btn:hover {
            background: var(--pink-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(225, 29, 72, 0.42);
        }
        .save-continue-btn:active {
            transform: translateY(0);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Full PDF View Modal */
        .pdf-preview-modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100vw;
            height: 100vh;
            height: 100dvh;
            background: #1e293b;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            animation: modalFadeIn 180ms ease-out;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: scale(0.99); }
            to { opacity: 1; transform: scale(1); }
        }
        .pdf-preview-toolbar {
            height: 58px;
            background: #0f172a;
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.3);
            flex-shrink: 0;
        }
        .preview-btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 8px 18px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 150ms ease;
        }
        .preview-btn-back:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: rgba(255, 255, 255, 0.35);
            transform: translateX(-2px);
        }
        .preview-doc-title {
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: -0.01em;
            color: #f8fafc;
            text-align: center;
        }
        .preview-btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--pink-accent);
            color: #ffffff;
            border: 1px solid rgba(225, 29, 72, 0.8);
            border-radius: 8px;
            padding: 8px 22px;
            font-size: 0.88rem;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(225, 29, 72, 0.4);
            transition: all 150ms ease;
        }
        .preview-btn-download:hover {
            background: var(--pink-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(225, 29, 72, 0.55);
        }
        .pdf-preview-viewport {
            flex: 1;
            width: 100%;
            height: calc(100vh - 58px);
            height: calc(100dvh - 58px);
            background: #334155;
            position: relative;
        }
        .pdf-preview-iframe {
            width: 100%;
            height: 100%;
            border: none;
            display: block;
            background: #ffffff;
        }
        .pdf-preview-loader {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #1e293b;
            z-index: 10;
        }
        .spinner {
            width: 42px;
            height: 42px;
            border: 3.5px solid rgba(255, 255, 255, 0.18);
            border-top-color: var(--pink-accent);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Custom Prompt Modal */
        .custom-prompt-overlay {
            position: fixed;
            inset: 0;
            z-index: 100;
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 16px;
            animation: promptFadeIn 0.18s ease-out;
        }
        @keyframes promptFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .custom-prompt-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.12), 0 8px 10px -6px rgba(0, 0, 0, 0.06);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            animation: promptScaleUp 0.22s cubic-bezier(0.16, 1, 0.3, 1);
        }
        @keyframes promptScaleUp {
            from {
                opacity: 0;
                transform: scale(0.94) translateY(6px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .custom-prompt-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 18px 20px 14px 20px;
            border-bottom: 1px solid #f1f5f9;
        }
        .custom-prompt-icon-badge {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #eff6ff;
            color: #0284c7;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .custom-prompt-title {
            margin: 0;
            font-size: 1rem;
            font-weight: 700;
            color: #0f172a;
            line-height: 1.3;
        }
        .custom-prompt-desc {
            margin: 3px 0 0;
            font-size: 0.78rem;
            color: #64748b;
            line-height: 1.4;
        }
        .custom-prompt-close-btn {
            background: transparent;
            border: none;
            font-size: 1.4rem;
            line-height: 1;
            color: #94a3b8;
            cursor: pointer;
            padding: 0 4px;
            border-radius: 6px;
            transition: color 0.15s, background 0.15s;
        }
        .custom-prompt-close-btn:hover {
            color: #0f172a;
            background: #f1f5f9;
        }
        .custom-prompt-body {
            padding: 16px 20px;
        }
        .custom-prompt-input-label {
            display: block;
            font-size: 0.76rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }
        .custom-prompt-input {
            width: 100%;
            padding: 10px 12px;
            font-size: 0.88rem;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            color: #0f172a;
            background: #ffffff;
            outline: none;
            box-sizing: border-box;
            transition: border-color 0.15s, box-shadow 0.15s;
        }
        .custom-prompt-input:focus {
            border-color: #0066d6;
            box-shadow: 0 0 0 3px rgba(0, 102, 214, 0.15);
        }
        .custom-prompt-error {
            font-size: 0.74rem;
            color: #ef4444;
            margin-top: 5px;
            font-weight: 500;
        }
        .custom-prompt-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .custom-prompt-chip {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 4px 9px;
            font-size: 0.74rem;
            font-weight: 500;
            color: #334155;
            cursor: pointer;
            transition: all 0.15s;
            user-select: none;
        }
        .custom-prompt-chip:hover {
            background: #e2e8f0;
            border-color: #cbd5e1;
            color: #0f172a;
            transform: translateY(-1px);
        }
        .custom-prompt-footer {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 14px 20px;
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
        }
        .custom-prompt-cancel-btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #475569;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, border-color 0.15s;
        }
        .custom-prompt-cancel-btn:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
        }
        .custom-prompt-submit-btn {
            background: #0066d6;
            border: none;
            color: #ffffff;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 1px 3px rgba(0, 102, 214, 0.25);
            transition: background 0.15s, transform 0.15s;
        }
        .custom-prompt-submit-btn:hover {
            background: #0052b3;
            transform: translateY(-1px);
        }

        /* Toast Notification System */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }
        .styled-toast {
            background: #0f172a;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.12);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 12px 18px;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            pointer-events: auto;
            animation: toastSlideIn 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            max-width: 360px;
        }
        @keyframes toastSlideIn {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .styled-toast.toast-warning {
            border-left: 4px solid #f59e0b;
        }
        .styled-toast.toast-error {
            border-left: 4px solid #ef4444;
        }
        .styled-toast.toast-success {
            border-left: 4px solid #10b981;
        }
        .input-error-highlight {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.25) !important;
            animation: errorPulse 0.35s ease-in-out;
        }
        @keyframes errorPulse {
            0%, 100% { transform: translateX(0); }
            20%, 60% { transform: translateX(-4px); }
            40%, 80% { transform: translateX(4px); }
        }

        /* Responsive Breakpoints & Mobile Optimization */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        .top-nav-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .bank-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr));
            gap: 14px;
        }

        @media (max-width: 840px) {
            .bottom-action-buttons-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            /* iOS Auto-zoom prevention: form controls at least 16px */
            .meta-field-input,
            .clean-input,
            .item-name-input,
            .qty-input,
            .rate-input,
            .custom-prompt-input,
            textarea {
                font-size: 16px !important;
            }

            .top-navbar-inner {
                flex-direction: column;
                align-items: stretch;
                gap: 10px;
                padding: 10px 16px;
            }

            .top-nav-left {
                display: flex;
                align-items: center;
                gap: 8px;
                width: 100%;
            }

            .builder-title {
                font-size: 0.92rem;
            }

            .nav-right-actions {
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 8px;
            }

            .template-picker-group {
                flex: 1;
                min-width: 0;
            }

            .template-picker-group label {
                display: none;
            }

            .template-select {
                width: 100%;
                max-width: 100%;
                min-height: 36px;
                font-size: 0.8rem;
            }

            .nav-preview-btn {
                min-height: 36px;
                padding: 6px 12px;
                font-size: 0.8rem;
                flex-shrink: 0;
                white-space: nowrap;
            }

            .nav-download-btn {
                flex-shrink: 0;
                min-height: 36px;
                padding: 7px 14px !important;
                font-size: 0.82rem !important;
                white-space: nowrap !important;
            }

            .canvas-wrapper {
                margin: 14px auto 40px;
                padding: 0 10px;
                width: 100%;
            }

            .doc-sheet {
                padding: 22px 16px;
                border-radius: 12px;
            }

            .sheet-meta-split {
                flex-direction: column-reverse;
                align-items: stretch;
                gap: 18px;
                margin-bottom: 20px;
            }

            .logo-box-wrap {
                display: flex;
                justify-content: center;
                width: 100%;
                margin-bottom: 4px;
            }

            .logo-drop-box {
                width: 100%;
                max-width: 240px;
                height: 110px;
                margin: 0 auto;
            }

            .meta-fields-col {
                max-width: 100%;
                width: 100%;
            }

            .party-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            /* Table Transformation: Desktop Table -> Responsive Mobile Item Cards */
            .items-table-container {
                border: none;
                background: transparent;
                overflow: visible;
                margin-bottom: 12px;
            }

            .refrens-table {
                display: block;
                width: 100%;
                border-collapse: separate;
            }

            .refrens-table thead {
                display: none !important;
            }

            .refrens-table tbody {
                display: block;
                width: 100%;
            }

            .refrens-row.item-row {
                display: grid !important;
                grid-template-columns: 1fr 1fr;
                gap: 10px;
                background: #ffffff;
                border: 1px solid var(--line-light);
                border-radius: 10px;
                padding: 12px 14px;
                margin-bottom: 12px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
                width: 100%;
                box-sizing: border-box;
            }

            .refrens-row.item-row td {
                display: block !important;
                padding: 0 !important;
                border: none !important;
                box-sizing: border-box;
            }

            /* Card Header: Item Number & Clone/Delete Buttons */
            .refrens-row.item-row td.item-number-col {
                grid-column: 1 / -1 !important;
                width: 100% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                padding: 0 0 8px 0 !important;
                border-bottom: 1px dashed var(--line-light) !important;
                text-align: left !important;
            }

            .refrens-row.item-row .row-index-number {
                font-weight: 700;
                color: #475569;
                font-size: 0.85rem;
            }

            .refrens-row.item-row .item-row-actions {
                opacity: 1 !important;
                gap: 8px;
                margin: 0;
            }

            .refrens-row.item-row .row-action-icon {
                padding: 6px 8px;
                border-radius: 6px;
                background: #f1f5f9;
                min-height: 32px;
                min-width: 32px;
            }

            /* Card Body: Item Name & Description */
            .refrens-row.item-row td:nth-child(2) {
                grid-column: 1 / -1 !important;
            }

            .refrens-row.item-row .item-name-input {
                font-size: 16px;
                padding: 6px 2px;
                border-bottom: 1px solid var(--line-light);
                font-weight: 600;
            }

            .refrens-row.item-row .item-desc-textarea {
                font-size: 15px;
            }

            .refrens-row.item-row .item-micro-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 16px;
                margin-top: 8px;
            }

            .refrens-row.item-row .item-micro-link {
                font-size: 0.78rem;
                padding: 4px 0;
            }

            /* Card Column Left: Quantity */
            .refrens-row.item-row td:nth-child(3) {
                grid-column: 1 / 2 !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }

            .refrens-row.item-row td:nth-child(3)::before {
                content: "QUANTITY";
                font-size: 0.68rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                color: var(--ink-muted);
            }

            .refrens-row.item-row .qty-input {
                width: 100% !important;
                min-height: 40px;
                font-size: 16px;
                text-align: left;
                padding: 6px 10px;
            }

            /* Card Column Right: Rate / Unit Price */
            .refrens-row.item-row td:nth-child(4) {
                grid-column: 2 / 3 !important;
                display: flex !important;
                flex-direction: column !important;
                gap: 4px !important;
            }

            .refrens-row.item-row td:nth-child(4)::before {
                content: "UNIT PRICE";
                font-size: 0.68rem;
                font-weight: 700;
                letter-spacing: 0.05em;
                color: var(--ink-muted);
                text-align: right;
            }

            .refrens-row.item-row .rate-input-wrap {
                width: 100% !important;
                margin-left: 0 !important;
                min-height: 40px;
            }

            .refrens-row.item-row .rate-input-wrap input {
                min-height: 38px;
                font-size: 16px;
            }

            /* Card Footer: Line Amount */
            .refrens-row.item-row td:nth-child(5) {
                grid-column: 1 / -1 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                padding-top: 8px !important;
                margin-top: 4px;
                border-top: 1px dashed var(--line-light) !important;
            }

            .refrens-row.item-row td:nth-child(5)::before {
                content: "Line Total:";
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--ink-muted);
            }

            .refrens-row.item-row .line-amount-text {
                font-size: 1.05rem;
                font-weight: 800;
                color: var(--ink-main);
                padding: 0 !important;
            }

            /* Toolbar */
            .table-toolbar {
                flex-direction: column;
                align-items: stretch;
                gap: 8px;
            }

            .table-toolbar .pill-tool-btn {
                width: 100%;
                justify-content: center;
                min-height: 38px;
            }

            .currency-selector-wrap {
                width: 100%;
                justify-content: space-between;
            }

            .currency-select {
                flex: 1;
                min-height: 38px;
                font-size: 15px;
            }

            /* Add New Line Button */
            .add-row-dashed-btn {
                min-height: 44px;
                font-size: 0.88rem;
                margin-bottom: 20px;
            }

            /* Totals Card Full Width */
            .summary-totals-container {
                justify-content: stretch;
                width: 100%;
            }

            .totals-card-refrens {
                max-width: 100%;
                width: 100%;
            }

            .discount-toggle-box .discount-unit-btn {
                padding: 5px 12px;
                font-size: 0.82rem;
            }

            .signature-dashed-box {
                min-height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.85rem;
            }

            /* Primary Action Button Full Width */
            .submit-section {
                width: 100%;
            }

            .submit-section .save-continue-btn {
                width: 100%;
                justify-content: center;
                min-height: 48px;
                font-size: 1rem;
            }
        }

        @media (max-width: 600px) {
            .pdf-preview-toolbar {
                height: 52px;
                padding: 0 10px;
                gap: 8px;
            }

            .pdf-preview-viewport {
                height: calc(100vh - 52px);
                height: calc(100dvh - 52px);
            }

            .preview-btn-back {
                padding: 6px 12px;
                font-size: 0.82rem;
                min-height: 38px;
            }

            .preview-btn-download {
                padding: 6px 14px;
                font-size: 0.82rem;
                min-height: 38px;
            }

            .preview-doc-title {
                font-size: 0.82rem;
                max-width: 130px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }

        @media (max-width: 540px) {
            .bottom-action-buttons-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            .bottom-action-btn {
                min-height: 44px;
            }
        }

        @media (max-width: 520px) {
            .meta-field-row {
                flex-direction: column;
                align-items: stretch;
                gap: 4px;
            }

            .meta-field-label {
                width: auto;
                border-bottom: none;
                font-size: 0.76rem;
            }

            .meta-field-input {
                width: 100%;
                min-height: 40px;
            }

            .toast-container {
                top: 10px;
                right: 10px;
                left: 10px;
            }

            .styled-toast {
                max-width: 100%;
                width: 100%;
                font-size: 0.85rem;
            }
        }

        @media (max-width: 480px) {
            .canvas-wrapper {
                margin: 8px auto 24px;
                padding: 0 6px;
            }

            .doc-sheet {
                padding: 16px 10px;
                border-radius: 10px;
            }

            .editable-doc-title {
                font-size: 1.35rem;
                min-width: 130px;
            }

            .two-col-inputs {
                grid-template-columns: 1fr;
                gap: 8px;
            }

            .party-card {
                padding: 14px 10px;
            }

            .custom-prompt-overlay {
                padding: 10px;
            }

            .custom-prompt-card {
                border-radius: 12px;
                width: 100%;
            }

            .custom-prompt-header {
                padding: 14px 16px 12px;
            }

            .custom-prompt-body {
                padding: 12px 16px;
            }

            .custom-prompt-footer {
                padding: 12px 16px;
                gap: 8px;
            }

            .custom-prompt-cancel-btn,
            .custom-prompt-submit-btn {
                min-height: 40px;
                font-size: 0.88rem;
                flex: 1;
                text-align: center;
                justify-content: center;
            }
        }

        @media (max-width: 380px) {
            .bottom-action-buttons-grid {
                grid-template-columns: 1fr;
            }

            .preview-doc-title {
                display: none;
            }
        }
    </style>
</head>
<body>
    @php
        $oldItems = old('items', [
            ['name' => 'Web Design & Development', 'description' => 'Custom responsive design with modern UX', 'qty' => 1, 'price' => 1500]
        ]);
        $docType = $docType ?? 'Quotation';
        $docPrefix = $docType === 'Invoice' ? 'INV' : ($docType === 'Receipt' ? 'REC' : 'QT');
        $docNoDefault = $docPrefix . '-' . now()->format('Ymd-His');
        $isInvoice = ($docType === 'Invoice');
        $isReceipt = ($docType === 'Receipt');
        $defaultCurrency = old('currency', 'USD');
        $defaultCurrencySymbol = old('currency_symbol', '$');
    @endphp

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <div class="top-navbar-inner">
            <div class="top-nav-left">
                <a href="{{ route('landing') }}" class="back-btn" title="Back to All Documents">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    <span>All Documents</span>
                </a>
                <span class="nav-breadcrumb-sep" aria-hidden="true">/</span>
                <h1 class="builder-title">{{ $docType }} Builder</h1>
            </div>

            <div class="nav-right-actions">
                <div class="template-picker-group">
                    <label for="template">Template:</label>
                    <select id="template" name="template" form="doc-form" class="template-select">
                        <option value="1" {{ old('template') === '1' ? 'selected' : '' }}>Template 1 (Emerald Green Frame)</option>
                        <option value="2" {{ old('template') === '2' ? 'selected' : '' }}>Template 2 (Royal Purple Modern)</option>
                        <option value="3" {{ old('template', '3') === '3' ? 'selected' : '' }}>Template 3 (Teal Corporate Minimal)</option>
                        <option value="4" {{ old('template') === '4' ? 'selected' : '' }}>Template 4 (Emerald Mint Modern)</option>
                    </select>
                </div>

                <button type="button" class="nav-preview-btn" onclick="openPdfPreview()" title="Preview Document PDF">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Preview</span>
                </button>

                <button type="submit" form="doc-form" class="nav-download-btn" title="Download Document as PDF">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                    <span>Download PDF</span>
                </button>
            </div>
        </div>
    </header>

    <main class="canvas-wrapper">
        <form action="{{ route('generate.pdf') }}" method="POST" enctype="multipart/form-data" id="doc-form" class="doc-sheet">
            @csrf
            <input type="hidden" name="doc_type" value="{{ $docType }}">
            <input type="hidden" name="doc_title" id="hidden_doc_title" value="{{ old('doc_title', $docType) }}">
            <input type="hidden" name="currency_symbol" id="hidden_currency_symbol" value="{{ $defaultCurrencySymbol }}">

            @if ($errors->any())
                <div class="error-banner">
                    <strong>Please check the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- 1. Centered Document Title -->
            <div class="sheet-title-row">
                <div class="editable-doc-title-wrap">
                    <input type="text" id="doc_title_display" class="editable-doc-title" value="{{ old('doc_title', $docType) }}" title="Click to rename document title">
                    <button type="button" class="pencil-icon-btn" onclick="document.getElementById('doc_title_display').focus();" title="Edit title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                    </button>
                </div>
            </div>

            <!-- 2. Header Meta (Left) & Business Logo Box (Right) -->
            <div class="sheet-meta-split">
                <!-- Left: Number, Dates, Custom Fields -->
                <div class="meta-fields-col">
                    <div class="meta-field-row">
                        <span class="meta-field-label">{{ $docType }} No*</span>
                        <input type="text" name="quote_no" id="quote_no" class="meta-field-input" value="{{ old('quote_no', $docNoDefault) }}" required placeholder="e.g. A00001">
                    </div>

                    <div class="meta-field-row">
                        <span class="meta-field-label">{{ $docType }} Date*</span>
                        <input type="date" name="quote_date" id="quote_date" class="meta-field-input" value="{{ old('quote_date', now()->toDateString()) }}" required>
                    </div>

                    <!-- Due Date Row -->
                    <div class="meta-field-row" id="due_date_row" style="{{ $isInvoice || old('expiry_date') ? 'display: flex;' : 'display: none;' }}">
                        <span class="meta-field-label">{{ $isInvoice ? 'Due Date*' : 'Expiry Date' }}</span>
                        <input type="date" name="expiry_date" id="expiry_date" class="meta-field-input" value="{{ old('expiry_date', now()->addDays(14)->toDateString()) }}" {{ $isInvoice ? 'required' : '' }}>
                        @if(!$isInvoice)
                        <button type="button" onclick="toggleDueDate(false)" style="background:none;border:none;color:#94a3b8;cursor:pointer;padding:0 4px;" title="Remove due date">&times;</button>
                        @endif
                    </div>

                    <div class="meta-action-links">
                        @if(!$isInvoice && !$isReceipt)
                        <button type="button" class="text-action-link" id="add_due_date_btn" onclick="toggleDueDate(true)" style="{{ old('expiry_date') ? 'display: none;' : '' }}">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Add due date
                        </button>
                        @endif

                        <button type="button" class="text-action-link" id="add_meta_custom_field_btn" onclick="addMetaCustomField()">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Add Custom Fields
                        </button>
                        <div id="meta_custom_fields_container" style="display: flex; flex-direction: column; gap: 6px;"></div>
                    </div>
                </div>

                <!-- Right: Logo Upload Box -->
                <div class="logo-box-wrap">
                    <input type="file" id="logo" name="logo" accept="image/png,image/jpeg,image/webp" style="display: none;">
                    <div class="logo-drop-box" id="logo_drop_box" onclick="document.getElementById('logo').click();" title="Click to upload business logo">
                        <div id="logo_placeholder">
                            <div class="logo-box-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            </div>
                            <div class="logo-box-title">Add Business Logo</div>
                            <div class="logo-box-hint">Resolution up to 1080x1080px. PNG or JPEG file.</div>
                        </div>
                        <img id="logo_preview_img" class="logo-preview-img" alt="Uploaded Logo">
                        <div class="logo-overlay" id="logo_overlay">
                            <button type="button" class="logo-mini-btn" onclick="event.stopPropagation(); document.getElementById('logo').click();">Change</button>
                            <button type="button" class="logo-mini-btn" style="color: #ef4444;" onclick="event.stopPropagation(); removeLogo();">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Two Side-by-Side Party Cards -->
            <div class="party-grid">
                <!-- Left: Your Details -->
                <div class="party-card">
                    <h3 class="party-card-title">Your Details</h3>
                    <select name="seller_country" id="seller_country" class="clean-input" onchange="syncPhoneCode(this, 'seller_phone_code')">
                        <option value="United States of America (USA)">United States of America (USA)</option>
                        <option value="Zambia" selected>Zambia (ZMW)</option>
                        <option value="United Kingdom">United Kingdom (UK)</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="India">India</option>
                        <option value="Germany">Germany (EU)</option>
                    </select>

                    <input type="text" name="seller_name" id="seller_name" class="clean-input" placeholder="Your Business Name (required)" value="{{ old('seller_name', 'Ori Studio Limited') }}" required>

                    <div class="phone-input-group">
                        <select id="seller_phone_code" class="phone-prefix-select">
                            <option value="+260" selected>🇿🇲 +260</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+27">🇿🇦 +27</option>
                            <option value="+91">🇮🇳 +91</option>
                            <option value="+61">🇦🇺 +61</option>
                        </select>
                        <input type="text" name="seller_phone" id="seller_phone" class="clean-input" placeholder="Phone number (e.g. 0971234567)" value="{{ old('seller_phone') }}">
                    </div>

                    <input type="text" name="seller_address" id="seller_address" class="clean-input" placeholder="Address (e.g. Plot 123, Great East Rd)" value="{{ old('seller_address') }}">

                    <div class="two-col-inputs">
                        <input type="text" name="seller_city" id="seller_city" class="clean-input" placeholder="City (optional)" value="{{ old('seller_city') }}">
                        <input type="text" name="seller_zip" id="seller_zip" class="clean-input" placeholder="Postal Code / ZIP Code" value="{{ old('seller_zip') }}">
                    </div>

                    <input type="text" name="seller_state" id="seller_state" class="clean-input" placeholder="State / Province (optional)" value="{{ old('seller_state') }}">

                    <!-- Collapsible Email Field -->
                    <div id="seller_email_wrap" style="{{ old('seller_email') ? 'display: block;' : 'display: none;' }}">
                        <input type="email" name="seller_email" id="seller_email" class="clean-input" placeholder="Your Email Address" value="{{ old('seller_email') }}">
                    </div>

                    <!-- Collapsible Custom Fields (TPIN, PACRA) -->
                    <div id="seller_custom_fields_wrap" style="{{ old('seller_tpin') || old('seller_pacra') ? 'display: block;' : 'display: none;' }}; display: flex; flex-direction: column; gap: 8px;">
                        <input type="text" name="seller_tpin" id="seller_tpin" class="clean-input" placeholder="TPIN (Tax Payer ID)" value="{{ old('seller_tpin') }}">
                        <input type="text" name="seller_pacra" id="seller_pacra" class="clean-input" placeholder="PACRA Reg. No." value="{{ old('seller_pacra') }}">
                    </div>

                    <div style="display: flex; gap: 14px; margin-top: 4px;">
                        <button type="button" class="text-action-link" onclick="toggleElement('seller_email_wrap')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Add Email
                        </button>
                        <button type="button" class="text-action-link" onclick="toggleElement('seller_custom_fields_wrap')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Add Custom Fields
                        </button>
                    </div>
                </div>

                <!-- Right: Client's Details -->
                <div class="party-card">
                    <h3 class="party-card-title">Client's Details</h3>
                    <select name="customer_country" id="customer_country" class="clean-input" onchange="syncPhoneCode(this, 'customer_phone_code')">
                        <option value="United States of America (USA)">United States of America (USA)</option>
                        <option value="Zambia" selected>Zambia (ZMW)</option>
                        <option value="United Kingdom">United Kingdom (UK)</option>
                        <option value="South Africa">South Africa</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="India">India</option>
                        <option value="Germany">Germany (EU)</option>
                    </select>

                    <input type="text" name="customer_name" id="customer_name" class="clean-input" placeholder="Client's Business Name (e.g. Acme Corp)" value="{{ old('customer_name') }}">

                    <div class="phone-input-group">
                        <select id="customer_phone_code" class="phone-prefix-select">
                            <option value="+260" selected>🇿🇲 +260</option>
                            <option value="+1">🇺🇸 +1</option>
                            <option value="+44">🇬🇧 +44</option>
                            <option value="+27">🇿🇦 +27</option>
                            <option value="+91">🇮🇳 +91</option>
                            <option value="+61">🇦🇺 +61</option>
                        </select>
                        <input type="text" name="customer_phone" id="customer_phone" class="clean-input" placeholder="Phone number (e.g. 0961234567)" value="{{ old('customer_phone') }}">
                    </div>

                    <input type="text" name="customer_address" id="customer_address" class="clean-input" placeholder="Address (e.g. Cairo Road, Lusaka)" value="{{ old('customer_address') }}">

                    <div class="two-col-inputs">
                        <input type="text" name="customer_city" id="customer_city" class="clean-input" placeholder="City (optional)" value="{{ old('customer_city') }}">
                        <input type="text" name="customer_zip" id="customer_zip" class="clean-input" placeholder="Postal Code / ZIP Code" value="{{ old('customer_zip') }}">
                    </div>

                    <input type="text" name="customer_state" id="customer_state" class="clean-input" placeholder="State / Province (optional)" value="{{ old('customer_state') }}">

                    <!-- Collapsible Email Field -->
                    <div id="customer_email_wrap" style="{{ old('customer_email') ? 'display: block;' : 'display: none;' }}">
                        <input type="email" name="customer_email" id="customer_email" class="clean-input" placeholder="Client Email Address" value="{{ old('customer_email') }}">
                    </div>

                    <!-- Collapsible Custom Fields (Customer TPIN) -->
                    <div id="customer_custom_fields_wrap" style="{{ old('customer_tpin') ? 'display: block;' : 'display: none;' }}; display: flex; flex-direction: column; gap: 8px;">
                        <input type="text" name="customer_tpin" id="customer_tpin" class="clean-input" placeholder="Client TPIN / Tax ID" value="{{ old('customer_tpin') }}">
                    </div>

                    <div style="display: flex; gap: 14px; margin-top: 4px;">
                        <button type="button" class="text-action-link" onclick="toggleElement('customer_email_wrap')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            Add Email
                        </button>
                        <button type="button" class="text-action-link" onclick="toggleElement('customer_custom_fields_wrap')">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                            Add Custom Fields
                        </button>
                    </div>
                </div>
            </div>

            <!-- 4. Shipping Details Checkbox Option -->
            <div class="shipping-checkbox-wrap">
                <input type="checkbox" id="add_shipping_details" onchange="document.getElementById('shipping_card_drawer').classList.toggle('show', this.checked)">
                <label for="add_shipping_details" style="cursor: pointer;">Add Shipping Details</label>
            </div>
            <div id="shipping_card_drawer" class="shipping-card">
                <h4 style="margin: 0; font-size: 0.8rem; font-weight: 700; color: #475569;">Shipping Information</h4>
                <div class="two-col-inputs">
                    <input type="text" name="shipping_name" class="clean-input" placeholder="Ship to Name">
                    <input type="text" name="shipping_phone" class="clean-input" placeholder="Recipient Phone">
                </div>
                <input type="text" name="shipping_address" class="clean-input" placeholder="Shipping Address">
                <div class="two-col-inputs">
                    <input type="text" name="shipping_city" class="clean-input" placeholder="City">
                    <input type="text" name="shipping_zip" class="clean-input" placeholder="Postal Code">
                </div>
            </div>

            <!-- 5. Table Toolbar -->
            <div class="table-toolbar">
                <button type="button" class="pill-tool-btn" onclick="toggleTaxRow()">
                    <span style="font-weight: 700;">%</span> Add Tax
                </button>

                <div class="currency-selector-wrap">
                    <span>Currency*</span>
                    <select name="currency" id="currency" class="currency-select" onchange="handleCurrencyChange(this)">
                        <option value="USD" data-symbol="$" {{ $defaultCurrency === 'USD' ? 'selected' : '' }}>US Dollar(USD, $)</option>
                        <option value="ZMW" data-symbol="K" {{ $defaultCurrency === 'ZMW' ? 'selected' : '' }}>Zambian Kwacha(ZMW, K)</option>
                        <option value="EUR" data-symbol="€" {{ $defaultCurrency === 'EUR' ? 'selected' : '' }}>Euro(EUR, €)</option>
                        <option value="GBP" data-symbol="£" {{ $defaultCurrency === 'GBP' ? 'selected' : '' }}>British Pound(GBP, £)</option>
                        <option value="ZAR" data-symbol="R" {{ $defaultCurrency === 'ZAR' ? 'selected' : '' }}>South African Rand(ZAR, R)</option>
                        <option value="CAD" data-symbol="$" {{ $defaultCurrency === 'CAD' ? 'selected' : '' }}>Canadian Dollar(CAD, $)</option>
                        <option value="AUD" data-symbol="$" {{ $defaultCurrency === 'AUD' ? 'selected' : '' }}>Australian Dollar(AUD, $)</option>
                        <option value="INR" data-symbol="₹" {{ $defaultCurrency === 'INR' ? 'selected' : '' }}>Indian Rupee(INR, ₹)</option>
                    </select>
                </div>

                <button type="button" class="pill-tool-btn" onclick="toggleDiscountRow()">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                    Edit Columns/Formulas
                </button>
            </div>

            <!-- 6. Items Table -->
            <div class="items-table-container">
                <table class="refrens-table">
                    <thead>
                        <tr>
                            <th style="width: 48px;">#</th>
                            <th>Item</th>
                            <th class="th-center" style="width: 110px;">Quantity</th>
                            <th class="th-right" style="width: 140px;">Rate</th>
                            <th class="th-right" style="width: 130px;">Amount</th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        @foreach ($oldItems as $index => $item)
                        <tr class="refrens-row item-row">
                            <td class="item-number-col">
                                <span class="row-index-number">{{ $index + 1 }}.</span>
                                <div class="item-row-actions">
                                    <button type="button" class="row-action-icon clone" onclick="cloneRow(this)" title="Duplicate item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                    </button>
                                    <button type="button" class="row-action-icon remove-item" title="Remove item">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="items[{{ $index }}][name]" class="item-name-input" value="{{ $item['name'] ?? $item['description'] ?? '' }}" placeholder="Item Name" required>
                                <textarea name="items[{{ $index }}][description]" class="item-desc-textarea {{ !empty($item['description']) && !empty($item['name']) ? 'show' : '' }}" placeholder="Add detailed description, specifications, or notes...">{{ !empty($item['name']) ? ($item['description'] ?? '') : '' }}</textarea>

                                <input type="file" name="items[{{ $index }}][image]" accept="image/*" class="item-file-input" style="display: none;" onchange="handleItemImageChange(this)">
                                <input type="hidden" name="items[{{ $index }}][image_data_uri]" class="item-image-data-uri" value="{{ $item['image_data_uri'] ?? '' }}">

                                <div class="item-image-preview-wrap" style="{{ !empty($item['image_data_uri']) ? 'display: inline-flex;' : 'display: none;' }}">
                                    <img src="{{ $item['image_data_uri'] ?? '' }}" class="item-image-preview-thumb" alt="Item preview">
                                    <button type="button" class="item-image-remove-btn" onclick="removeItemImage(this)" title="Remove image">&times;</button>
                                </div>

                                <div class="item-micro-actions">
                                    <button type="button" class="item-micro-link" onclick="toggleRowDescription(this)">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                                        Add Description
                                    </button>
                                    <button type="button" class="item-micro-link item-add-image-btn" onclick="triggerItemImageUpload(this)">
                                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                        <span class="item-image-btn-label">{{ !empty($item['image_data_uri']) ? 'Change Image' : 'Add Image' }}</span>
                                    </button>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <input type="number" step="1" min="1" name="items[{{ $index }}][qty]" class="qty-input" value="{{ $item['qty'] ?? 1 }}" required>
                            </td>
                            <td>
                                <div class="rate-input-wrap">
                                    <span class="rate-currency-prefix curr-symbol">{{ $defaultCurrencySymbol }}</span>
                                    <input type="number" step="0.01" min="0" name="items[{{ $index }}][price]" class="rate-input" value="{{ $item['price'] ?? 0 }}" required>
                                </div>
                            </td>
                            <td>
                                <span class="line-amount-text"><span class="curr-symbol">{{ $defaultCurrencySymbol }}</span> <span class="amount-val">0.00</span></span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Full Width Add New Line Button -->
            <button type="button" class="add-row-dashed-btn" id="add-row-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                Add New Line
            </button>

            <!-- 7. Summary & Totals Box (Right Aligned) -->
            <div class="summary-totals-container">
                <div class="totals-card-refrens">
                    <div class="visible-header-row">
                        <span>Visible In Quotation</span>
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </div>

                    <!-- Sub Total -->
                    <div class="subtotal-row">
                        <span>Subtotal</span>
                        <span><span class="curr-symbol">{{ $defaultCurrencySymbol }}</span> <span id="summary-subtotal">0.00</span></span>
                    </div>

                    <!-- Tax Link & Collapsible Options -->
                    <div class="totals-interactive-row">
                        <button type="button" class="text-action-link" onclick="toggleTaxRow()">
                            <span style="font-weight: 700;">%</span> Add TAX
                        </button>
                        <span id="tax-line-amount" style="font-weight: 600; color: #334155;">+ <span class="curr-symbol">{{ $defaultCurrencySymbol }}</span> <span id="summary-tax">0.00</span></span>
                    </div>
                    <div class="tax-toggle-box" id="tax_toggle_box" style="{{ old('vat_registered') ? 'display: block;' : '' }}">
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                            <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; font-size: 0.75rem;">
                                <input type="checkbox" name="vat_registered" id="vat_registered" value="1" {{ old('vat_registered', '1') ? 'checked' : '' }} onchange="calculateTotals()">
                                <span>Apply VAT / Tax</span>
                            </label>
                            <div style="display: flex; align-items: center; gap: 4px;">
                                <input type="number" step="0.5" min="0" max="100" name="vat_rate" id="vat_rate" value="{{ old('vat_rate', 16) }}" style="width: 50px; padding: 2px 4px; font-size: 0.75rem; border: 1px solid #cbd5e1; border-radius: 4px;" oninput="calculateTotals()">
                                <span>%</span>
                            </div>
                        </div>
                    </div>

                    <!-- Discounts Link & Collapsible Options -->
                    <div class="totals-interactive-row">
                        <button type="button" class="text-action-link" onclick="toggleDiscountRow()">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                            Add Discounts ⌵
                        </button>
                        <span id="discount-line-amount" style="font-weight: 600; color: #16a34a;">- <span class="curr-symbol">{{ $defaultCurrencySymbol }}</span> <span id="summary-discount">0.00</span></span>
                    </div>
                    <div class="discount-toggle-box {{ old('discount_value', old('discount_rate')) > 0 ? 'show' : '' }}" id="discount_toggle_box">
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 8px;">
                            <span style="font-weight: 600; color: #475569;">Discount:</span>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <input type="number" step="any" min="0" {{ old('discount_type', 'percent') === 'percent' ? 'max="100"' : '' }} id="discount_value_input" name="discount_value" value="{{ old('discount_value', old('discount_rate', 0)) }}" style="width: 72px; padding: 3px 6px; font-size: 0.8rem; border: 1px solid #cbd5e1; border-radius: 4px; text-align: right;" oninput="calculateTotals()">
                                <input type="hidden" id="discount_type_input" name="discount_type" value="{{ old('discount_type', 'percent') }}">
                                <div class="discount-type-segmented">
                                    <button type="button" id="discount_type_percent_btn" class="discount-unit-btn {{ old('discount_type', 'percent') === 'percent' ? 'active' : '' }}" onclick="setDiscountType('percent')">%</button>
                                    <button type="button" id="discount_type_amount_btn" class="discount-unit-btn {{ old('discount_type') === 'amount' ? 'active' : '' }}" onclick="setDiscountType('amount')"><span class="curr-symbol">{{ $defaultCurrencySymbol }}</span></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summarise Total Quantity Checkbox -->
                    <div style="display: flex; align-items: center; gap: 6px; font-size: 0.76rem; color: #64748b; margin: 2px 0;">
                        <input type="checkbox" id="summarise_qty" onchange="document.getElementById('qty_summary_span').style.display = this.checked ? 'inline' : 'none';">
                        <label for="summarise_qty" style="cursor: pointer;">Summarise Total Quantity</label>
                        <span id="qty_summary_span" style="display: none; margin-left: auto; font-weight: 600; color: #334155;">(Qty: <span id="total-qty-val">1</span>)</span>
                    </div>

                    <!-- Total Row -->
                    <div class="total-highlight-row">
                        <span class="total-label">Total (<span id="total-currency-code">{{ $defaultCurrency }}</span>)</span>
                        <span class="total-amount-display"><span class="curr-symbol">{{ $defaultCurrencySymbol }}</span> <span id="summary-grandtotal">0.00</span></span>
                    </div>

                    <button type="button" class="text-action-link" style="margin-top: 4px;" onclick="addSummaryCustomField()">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        Add Custom Fields
                    </button>
                    <div id="summary_custom_fields_container" style="display: flex; flex-direction: column; gap: 6px;"></div>

                    <!-- Total in Words Box -->
                    <div class="words-box">
                        <div class="words-box-header">
                            <span>Visible In Quotation</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                        </div>
                        <div class="words-label">Total (in words)</div>
                        <div class="words-output" id="words_output_text">One Dollar Only</div>
                        <input type="hidden" name="total_in_words" id="total_in_words" value="{{ old('total_in_words') }}">
                    </div>

                    <!-- Add Signature Box -->
                    <div class="signature-dashed-box {{ old('signature_data_uri') ? 'has-sig' : '' }}" id="signature_dashed_box" onclick="toggleSignatureDrawer()">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="display:inline;vertical-align:middle;margin-right:4px;"><polyline points="20 6 9 17 4 12"/></svg>
                        <span id="signature_dashed_box_label">{{ old('signature_data_uri') ? 'Signature Added ✓' : 'Add Signature' }}</span>
                    </div>
                    <div class="signature-content-drawer {{ old('signature_data_uri') ? 'show' : '' }}" id="signature_drawer">
                        <input type="file" id="signature_input" name="signature" accept="image/png,image/jpeg,image/webp" style="display: none;" onchange="handleSignatureFileChange(this)">
                        <input type="hidden" id="signature_data_uri" name="signature_data_uri" value="{{ old('signature_data_uri') }}">

                        <div class="signature-upload-zone" id="signature_upload_zone" onclick="document.getElementById('signature_input').click()">
                            <div id="sig_placeholder" style="{{ old('signature_data_uri') ? 'display: none;' : '' }}">
                                <div class="sig-upload-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><circle cx="11" cy="11" r="2"/></svg>
                                </div>
                                <div style="font-size: 0.78rem; font-weight: 600; color: #334155;">Upload Signature Image</div>
                                <div style="font-size: 0.68rem; color: #64748b;">PNG with transparent background or JPEG (Max 2MB)</div>
                            </div>
                            <div id="sig_preview_container" style="{{ old('signature_data_uri') ? 'display: block;' : 'display: none;' }}; position: relative; text-align: center;">
                                <img id="sig_preview_img" src="{{ old('signature_data_uri') }}" style="max-height: 60px; max-width: 180px; object-fit: contain; margin: 4px auto;" alt="Signature Preview">
                                <div style="display: flex; justify-content: center; gap: 8px; margin-top: 6px;">
                                    <button type="button" class="sig-action-link" onclick="event.stopPropagation(); document.getElementById('signature_input').click();">Change</button>
                                    <span style="color:#cbd5e1;">|</span>
                                    <button type="button" class="sig-action-link" style="color: #ef4444;" onclick="event.stopPropagation(); removeSignature();">Remove</button>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;">
                            <label for="signee_name_input" style="font-size: 0.72rem; font-weight: 600; color: #475569; display: block; margin-bottom: 3px;">Signee Name &amp; Designation (Appended on PDF)</label>
                            <input type="text" id="signee_name_input" name="signee_name" class="clean-input" placeholder="e.g. Mutale Kabamba, Managing Director" value="{{ old('signee_name', 'Authorized Signatory') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. Five Bottom Action Buttons -->
            <div class="bottom-action-buttons-grid">
                <button type="button" class="bottom-action-btn {{ old('terms_conditions') ? 'active' : '' }}" id="btn_drawer_terms" onclick="toggleDrawer('drawer_terms', this)">
                    <span class="btn-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                    </span>
                    <span class="btn-text">+ T&Cs</span>
                </button>

                <button type="button" class="bottom-action-btn {{ old('notes') ? 'active' : '' }}" id="btn_drawer_notes" onclick="toggleDrawer('drawer_notes', this)">
                    <span class="btn-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    </span>
                    <span class="btn-text">+ Notes</span>
                </button>

                <button type="button" class="bottom-action-btn" id="btn_drawer_attachments" onclick="toggleDrawer('drawer_attachments', this)">
                    <span class="btn-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                    </span>
                    <span class="btn-text">+ Attachments</span>
                </button>

                <button type="button" class="bottom-action-btn {{ old('additional_info') ? 'active' : '' }}" id="btn_drawer_additional_info" onclick="toggleDrawer('drawer_additional_info', this)">
                    <span class="btn-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    </span>
                    <span class="btn-text">+ Additional Info</span>
                </button>

                <button type="button" class="bottom-action-btn {{ old('bank_name') || old('mobile_network_provider') || old('payment_method_received') ? 'active' : '' }}" id="btn_drawer_contact_details" onclick="toggleDrawer('drawer_contact_details', this)">
                    <span class="btn-icon">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v4M12 14v4M16 14v4"/></svg>
                    </span>
                    <span class="btn-text">+ Bank Details</span>
                </button>
            </div>

            <!-- Drawers for Bottom Actions -->
            <!-- Terms & Conditions Drawer -->
            <div class="action-drawer {{ old('terms_conditions') ? 'show' : '' }}" id="drawer_terms">
                <div class="action-drawer-title">
                    <span>Terms & Conditions</span>
                    <button type="button" class="drawer-close-btn" onclick="toggleDrawer('drawer_terms')">&times;</button>
                </div>
                <textarea name="terms_conditions" id="terms_conditions" class="clean-input" style="min-height: 80px; resize: vertical;" placeholder="1. Payment is required within 14 days of invoice date.&#10;2. Goods once delivered remain property of seller until paid in full.&#10;3. Warranty covers technical defects for 12 months.">{{ old('terms_conditions') }}</textarea>
            </div>

            <!-- Notes Drawer -->
            <div class="action-drawer {{ old('notes') ? 'show' : '' }}" id="drawer_notes">
                <div class="action-drawer-title">
                    <span>Notes</span>
                    <button type="button" class="drawer-close-btn" onclick="toggleDrawer('drawer_notes')">&times;</button>
                </div>
                <textarea name="notes" id="notes" class="clean-input" style="min-height: 60px; resize: vertical;" placeholder="Enter any extra notes or instructions for the recipient...">{{ old('notes') }}</textarea>
            </div>

            <!-- Attachments Drawer -->
            <div class="action-drawer" id="drawer_attachments">
                <div class="action-drawer-title">
                    <span>Attachments</span>
                    <button type="button" class="drawer-close-btn" onclick="toggleDrawer('drawer_attachments')">&times;</button>
                </div>
                <input type="file" name="attachments[]" id="attachments_input" multiple accept=".pdf,image/png,image/jpeg,image/webp,image/gif" class="clean-input" style="padding: 10px;" onchange="handleAttachmentsChange(this)">
                <small style="color: #64748b; font-size: 0.72rem; display: block; margin-top: 4px;">Attach contract copies, delivery specs, or receipts (PDF, PNG, JPG, WebP up to 10MB each).</small>
                <div id="attachments_file_list" style="margin-top: 10px; display: flex; flex-direction: column; gap: 6px;"></div>
            </div>

            <!-- Additional Info Drawer -->
            <div class="action-drawer" id="drawer_additional_info">
                <div class="action-drawer-title">
                    <span>Additional Information</span>
                    <button type="button" class="drawer-close-btn" onclick="toggleDrawer('drawer_additional_info')">&times;</button>
                </div>
                <textarea name="additional_info" class="clean-input" style="min-height: 60px; resize: vertical;" placeholder="Additional tax numbers, VAT registration details, delivery timelines...">{{ old('additional_info') }}</textarea>
            </div>

            <!-- Contact & Payment Details Drawer -->
            <div class="action-drawer {{ old('bank_name') || old('mobile_network_provider') || old('payment_method_received') ? 'show' : '' }}" id="drawer_contact_details">
                <div class="action-drawer-title">
                    <span>{{ $isReceipt ? 'Payment Received Details' : 'Bank & Payment Details' }}</span>
                    <button type="button" class="drawer-close-btn" onclick="toggleDrawer('drawer_contact_details')">&times;</button>
                </div>

                @if($isReceipt)
                <!-- Receipt: Method Used to Pay -->
                <div style="background: #ffffff; border: 1px solid var(--line-light); border-radius: 8px; padding: 14px; margin-bottom: 10px;">
                    <h4 style="margin: 0 0 10px; font-size: 0.78rem; font-weight: 700; color: #1e293b; text-transform: uppercase;">Method Used to Pay</h4>
                    <div style="display: flex; flex-direction: column; gap: 10px;">
                        <div>
                            <label style="font-size: 0.75rem; font-weight: 600; color: #475569; display: block; margin-bottom: 4px;">Payment Received Method</label>
                            <select id="payment_method_received" name="payment_method_received" class="clean-input" onchange="handlePaymentMethodChange(this.value)">
                                <option value="">-- Select Payment Method --</option>
                                <option value="Cash" {{ old('payment_method_received', 'Cash') === 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Bank Transfer" {{ old('payment_method_received') === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="Mobile Money (MTN)" {{ old('payment_method_received') === 'Mobile Money (MTN)' ? 'selected' : '' }}>Mobile Money (MTN)</option>
                                <option value="Mobile Money (Airtel)" {{ old('payment_method_received') === 'Mobile Money (Airtel)' ? 'selected' : '' }}>Mobile Money (Airtel)</option>
                                <option value="Mobile Money (Zamtel)" {{ old('payment_method_received') === 'Mobile Money (Zamtel)' ? 'selected' : '' }}>Mobile Money (Zamtel)</option>
                                <option value="Debit / Credit Card" {{ old('payment_method_received') === 'Debit / Credit Card' ? 'selected' : '' }}>Debit / Credit Card</option>
                                <option value="Cheque" {{ old('payment_method_received') === 'Cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="EFT (Electronic Funds Transfer)" {{ old('payment_method_received') === 'EFT (Electronic Funds Transfer)' ? 'selected' : '' }}>EFT (Electronic Funds Transfer)</option>
                                <option value="Other" {{ old('payment_method_received') === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div id="other_method_group" style="{{ old('payment_method_received') === 'Other' || old('payment_method_received_other') ? 'display: block;' : 'display: none;' }}">
                            <label style="font-size: 0.75rem; font-weight: 600; color: #475569; display: block; margin-bottom: 4px;">Specify Payment Method</label>
                            <input id="payment_method_received_other" name="payment_method_received_other" type="text" class="clean-input" placeholder="e.g. Visa Debit Card, Direct Deposit, PayPal" value="{{ old('payment_method_received_other') }}">
                        </div>
                    </div>
                </div>
                @else
                <!-- Quotation & Invoice: Bank Transfer and Mobile Money -->
                <div class="bank-details-grid">
                    <!-- Bank Transfer -->
                    <div style="background: #ffffff; border: 1px solid var(--line-light); border-radius: 8px; padding: 14px;">
                        <h4 style="margin: 0 0 10px; font-size: 0.78rem; font-weight: 700; color: #1e293b; text-transform: uppercase;">Bank Transfer</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <div>
                                <label style="font-size: 0.72rem; font-weight: 600; color: #64748b; display: block; margin-bottom: 2px;">Bank Name</label>
                                <select id="bank_name" name="bank_name" class="clean-input" onchange="handleBankNameChange(this.value)">
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
                            <div id="bank_name_other_group" style="{{ old('bank_name') === 'Other' || old('bank_name_other') ? 'display: block;' : 'display: none;' }}">
                                <label style="font-size: 0.72rem; font-weight: 600; color: #64748b; display: block; margin-bottom: 2px;">Specify Bank Name</label>
                                <input id="bank_name_other" name="bank_name_other" type="text" class="clean-input" placeholder="Enter bank name" value="{{ old('bank_name_other') }}">
                            </div>
                            <div class="two-col-inputs">
                                <input id="account_name" name="account_name" type="text" class="clean-input" placeholder="Account Name" value="{{ old('account_name') }}">
                                <input id="account_no" name="account_no" type="text" class="clean-input" placeholder="Account Number" value="{{ old('account_no') }}">
                            </div>
                            <div class="two-col-inputs">
                                <input id="branch" name="branch" type="text" class="clean-input" placeholder="Branch" value="{{ old('branch') }}">
                                <input id="swift_code" name="swift_code" type="text" class="clean-input" placeholder="Swift Code" value="{{ old('swift_code') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Money -->
                    <div style="background: #ffffff; border: 1px solid var(--line-light); border-radius: 8px; padding: 14px;">
                        <h4 style="margin: 0 0 10px; font-size: 0.78rem; font-weight: 700; color: #1e293b; text-transform: uppercase;">Mobile Money</h4>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <div>
                                <label style="font-size: 0.72rem; font-weight: 600; color: #64748b; display: block; margin-bottom: 2px;">Network Provider</label>
                                <select id="mobile_network_provider" name="mobile_network_provider" class="clean-input" onchange="updateMobileProviderHint(this.value)">
                                    <option value="">-- Select Network --</option>
                                    <option value="MTN" {{ old('mobile_network_provider') === 'MTN' ? 'selected' : '' }}>MTN</option>
                                    <option value="Airtel" {{ old('mobile_network_provider') === 'Airtel' ? 'selected' : '' }}>Airtel</option>
                                    <option value="Zamtel" {{ old('mobile_network_provider') === 'Zamtel' ? 'selected' : '' }}>Zamtel</option>
                                </select>
                            </div>
                            <div>
                                <input id="mobile_phone_no" name="mobile_phone_no" type="text" class="clean-input" placeholder="Mobile Money Phone No (e.g. 0961234567)" value="{{ old('mobile_phone_no') }}">
                                <small id="mobile_hint" style="color: #64748b; font-size: 0.7rem; display: block; margin-top: 2px;"></small>
                            </div>
                            <input id="mobile_account_name" name="mobile_account_name" type="text" class="clean-input" placeholder="Registered Account Name" value="{{ old('mobile_account_name') }}">
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- 9. Center Bottom Primary Action Button: Preview -->
            <div class="submit-section">
                <button type="button" class="save-continue-btn" id="preview_doc_btn" onclick="openPdfPreview()">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Preview</span>
                </button>
            </div>
        </form>
    </main>

    <!-- Full PDF View Overlay -->
    <div id="pdf_preview_modal" class="pdf-preview-modal" style="display: none;">
        <div class="pdf-preview-toolbar">
            <button type="button" class="preview-btn-back" onclick="closePdfPreview()" title="Back to editor">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"/><polyline points="12 19 5 12 12 5"/></svg>
                <span>Back</span>
            </button>

            <div class="preview-doc-title" id="preview_modal_title">
                Document Preview
            </div>

            <button type="button" class="preview-btn-download" onclick="downloadPreviewPdf()" title="Download PDF document">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                <span>Download</span>
            </button>
        </div>
        
        <div class="pdf-preview-viewport">
            <div id="pdf_preview_loader" class="pdf-preview-loader" style="display: none;">
                <div class="spinner"></div>
                <div style="font-size: 0.9rem; font-weight: 600; color: #cbd5e1; margin-top: 14px;">Generating PDF preview...</div>
            </div>
            <iframe id="pdf_preview_iframe" class="pdf-preview-iframe" title="PDF Document Preview"></iframe>
        </div>
    </div>

    <!-- Custom Prompt / Input Modal -->
    <div id="custom_prompt_modal" class="custom-prompt-overlay" style="display: none;" onclick="handlePromptOverlayClick(event)">
        <div class="custom-prompt-card" role="dialog" aria-modal="true" aria-labelledby="custom_prompt_title">
            <div class="custom-prompt-header">
                <div class="custom-prompt-icon-badge" id="custom_prompt_icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"/>
                    </svg>
                </div>
                <div style="flex: 1;">
                    <h3 class="custom-prompt-title" id="custom_prompt_title">Add Custom Field</h3>
                    <p class="custom-prompt-desc" id="custom_prompt_desc">Enter custom field label (e.g. PO Number, Project Ref):</p>
                </div>
                <button type="button" class="custom-prompt-close-btn" onclick="closeCustomPrompt()" title="Close">&times;</button>
            </div>
            
            <div class="custom-prompt-body">
                <label for="custom_prompt_input" class="custom-prompt-input-label" id="custom_prompt_input_label">Field Label</label>
                <input type="text" id="custom_prompt_input" class="custom-prompt-input" placeholder="e.g. PO Number, Project Ref">
                
                <div id="custom_prompt_error" class="custom-prompt-error" style="display: none;">
                    Please enter a field label to continue.
                </div>

                <!-- Quick suggestion chips -->
                <div id="custom_prompt_chips_section" style="margin-top: 12px;">
                    <div style="font-size: 0.72rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em; margin-bottom: 6px;">Suggested Labels:</div>
                    <div id="custom_prompt_chips" class="custom-prompt-chips"></div>
                </div>
            </div>

            <div class="custom-prompt-footer">
                <button type="button" class="custom-prompt-cancel-btn" onclick="closeCustomPrompt()">Cancel</button>
                <button type="button" class="custom-prompt-submit-btn" id="custom_prompt_submit_btn" onclick="submitCustomPrompt()">
                    <span id="custom_prompt_submit_text">Add Field</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification Container -->
    <div id="toast_container" class="toast-container"></div>

    <!-- Template for adding new item rows -->
    <template id="row-template">
        <tr class="refrens-row item-row">
            <td class="item-number-col">
                <span class="row-index-number">__INDEX_PLUS_1__.</span>
                <div class="item-row-actions">
                    <button type="button" class="row-action-icon clone" onclick="cloneRow(this)" title="Duplicate item">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                    </button>
                    <button type="button" class="row-action-icon remove-item" title="Remove item">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                    </button>
                </div>
            </td>
            <td>
                <input type="text" name="items[__INDEX__][name]" class="item-name-input" placeholder="Item Name" required>
                <textarea name="items[__INDEX__][description]" class="item-desc-textarea" placeholder="Add detailed description, specifications, or notes..."></textarea>
                
                <input type="file" name="items[__INDEX__][image]" accept="image/*" class="item-file-input" style="display: none;" onchange="handleItemImageChange(this)">
                <input type="hidden" name="items[__INDEX__][image_data_uri]" class="item-image-data-uri" value="">

                <div class="item-image-preview-wrap" style="display: none;">
                    <img src="" class="item-image-preview-thumb" alt="Item preview">
                    <button type="button" class="item-image-remove-btn" onclick="removeItemImage(this)" title="Remove image">&times;</button>
                </div>

                <div class="item-micro-actions">
                    <button type="button" class="item-micro-link" onclick="toggleRowDescription(this)">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                        Add Description
                    </button>
                    <button type="button" class="item-micro-link item-add-image-btn" onclick="triggerItemImageUpload(this)">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <span class="item-image-btn-label">Add Image</span>
                    </button>
                </div>
            </td>
            <td style="text-align: center;">
                <input type="number" step="1" min="1" name="items[__INDEX__][qty]" class="qty-input" value="1" required>
            </td>
            <td>
                <div class="rate-input-wrap">
                    <span class="rate-currency-prefix curr-symbol">__CURR_SYMBOL__</span>
                    <input type="number" step="0.01" min="0" name="items[__INDEX__][price]" class="rate-input" value="0" required>
                </div>
            </td>
            <td>
                <span class="line-amount-text"><span class="curr-symbol">__CURR_SYMBOL__</span> <span class="amount-val">0.00</span></span>
            </td>
        </tr>
    </template>

    <script>
        (function () {
            let activeCurrency = '{{ $defaultCurrency }}';
            let activeCurrencySymbol = '{{ $defaultCurrencySymbol }}';

            const itemsBody = document.getElementById('items-body');
            const addRowBtn = document.getElementById('add-row-btn');
            const rowTemplate = document.getElementById('row-template').innerHTML;
            const docTitleInput = document.getElementById('doc_title_display');
            const hiddenDocTitle = document.getElementById('hidden_doc_title');
            const logoInput = document.getElementById('logo');
            const logoPreviewImg = document.getElementById('logo_preview_img');
            const logoPlaceholder = document.getElementById('logo_placeholder');
            const logoOverlay = document.getElementById('logo_overlay');

            // Synchronize document title
            docTitleInput.addEventListener('input', function() {
                hiddenDocTitle.value = this.value;
            });

            // Toggle element visibility
            window.toggleElement = function(id) {
                const el = document.getElementById(id);
                if (!el) return;
                el.style.display = (el.style.display === 'none' || el.style.display === '') ? 'flex' : 'none';
            };

            window.toggleDrawer = function(id, btn) {
                const el = document.getElementById(id);
                if (!el) return;
                const isShowing = el.classList.toggle('show');
                if (btn) {
                    btn.classList.toggle('active', isShowing);
                } else {
                    const matchBtn = document.getElementById('btn_' + id);
                    if (matchBtn) matchBtn.classList.toggle('active', isShowing);
                }
            };

            window.toggleTaxRow = function() {
                const box = document.getElementById('tax_toggle_box');
                box.classList.toggle('show');
                calculateTotals();
            };

            window.toggleDiscountRow = function() {
                const box = document.getElementById('discount_toggle_box');
                box.classList.toggle('show');
                calculateTotals();
            };

            window.setDiscountType = function(type) {
                const typeInput = document.getElementById('discount_type_input');
                const percentBtn = document.getElementById('discount_type_percent_btn');
                const amountBtn = document.getElementById('discount_type_amount_btn');
                const valInput = document.getElementById('discount_value_input');

                if (typeInput) typeInput.value = type;
                if (percentBtn) percentBtn.classList.toggle('active', type === 'percent');
                if (amountBtn) amountBtn.classList.toggle('active', type === 'amount');

                if (valInput) {
                    if (type === 'percent') {
                        valInput.max = 100;
                        if (parseFloat(valInput.value) > 100) {
                            valInput.value = 100;
                        }
                    } else {
                        valInput.removeAttribute('max');
                    }
                }
                calculateTotals();
            };

            window.toggleSignatureDrawer = function() {
                const drawer = document.getElementById('signature_drawer');
                if (drawer) drawer.classList.toggle('show');
            };

            window.handleSignatureFileChange = function(input) {
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const sigDataInput = document.getElementById('signature_data_uri');
                        const sigImg = document.getElementById('sig_preview_img');
                        const sigContainer = document.getElementById('sig_preview_container');
                        const sigPlaceholder = document.getElementById('sig_placeholder');
                        const sigBoxLabel = document.getElementById('signature_dashed_box_label');
                        const sigBox = document.getElementById('signature_dashed_box');

                        if (sigDataInput) sigDataInput.value = e.target.result;
                        if (sigImg) sigImg.src = e.target.result;
                        if (sigContainer) sigContainer.style.display = 'block';
                        if (sigPlaceholder) sigPlaceholder.style.display = 'none';
                        if (sigBoxLabel) sigBoxLabel.textContent = 'Signature Added ✓';
                        if (sigBox) sigBox.classList.add('has-sig');
                    };
                    reader.readAsDataURL(file);
                }
            };

            window.removeSignature = function() {
                const sigInput = document.getElementById('signature_input');
                const sigDataInput = document.getElementById('signature_data_uri');
                const sigImg = document.getElementById('sig_preview_img');
                const sigContainer = document.getElementById('sig_preview_container');
                const sigPlaceholder = document.getElementById('sig_placeholder');
                const sigBoxLabel = document.getElementById('signature_dashed_box_label');
                const sigBox = document.getElementById('signature_dashed_box');

                if (sigInput) sigInput.value = '';
                if (sigDataInput) sigDataInput.value = '';
                if (sigImg) sigImg.removeAttribute('src');
                if (sigContainer) sigContainer.style.display = 'none';
                if (sigPlaceholder) sigPlaceholder.style.display = 'block';
                if (sigBoxLabel) sigBoxLabel.textContent = 'Add Signature';
                if (sigBox) sigBox.classList.remove('has-sig');
            };

            // Attachments Handling
            window.handleAttachmentsChange = function(input) {
                const list = document.getElementById('attachments_file_list');
                const btn = document.getElementById('btn_drawer_attachments');
                const btnText = btn ? btn.querySelector('.btn-text') : null;
                if (!list) return;

                list.innerHTML = '';
                const files = input.files ? Array.from(input.files) : [];

                if (files.length === 0) {
                    if (btnText) btnText.textContent = '+ Attachments';
                    if (btn) btn.classList.remove('active');
                    return;
                }

                if (btnText) btnText.textContent = `+ Attachments (${files.length})`;
                if (btn) btn.classList.add('active');

                files.forEach((file) => {
                    const item = document.createElement('div');
                    item.style.cssText = 'display: flex; align-items: center; justify-content: space-between; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 10px; font-size: 0.75rem;';
                    
                    const isPdf = file.name.toLowerCase().endsWith('.pdf');
                    const sizeKb = (file.size / 1024).toFixed(1);
                    const sizeStr = (file.size > 1024 * 1024) ? (file.size / (1024 * 1024)).toFixed(2) + ' MB' : sizeKb + ' KB';

                    item.innerHTML = `
                        <div style="display: flex; align-items: center; gap: 8px; overflow: hidden;">
                            <span style="font-weight: 700; color: ${isPdf ? '#e11d48' : '#0284c7'}; font-size: 0.7rem; text-transform: uppercase;">${isPdf ? 'PDF' : 'IMG'}</span>
                            <span style="font-weight: 500; color: #1e293b; text-overflow: ellipsis; overflow: hidden; white-space: nowrap; max-width: 260px;" title="${file.name}">${file.name}</span>
                            <span style="color: #64748b; font-size: 0.7rem;">(${sizeStr})</span>
                        </div>
                    `;
                    list.appendChild(item);
                });
            };

            // Item Image Upload Handlers
            window.triggerItemImageUpload = function(btn) {
                const cell = btn.closest('td');
                const fileInput = cell.querySelector('.item-file-input');
                if (fileInput) fileInput.click();
            };

            window.handleItemImageChange = function(input) {
                const cell = input.closest('td');
                const previewWrap = cell.querySelector('.item-image-preview-wrap');
                const previewThumb = cell.querySelector('.item-image-preview-thumb');
                const dataUriInput = cell.querySelector('.item-image-data-uri');
                const btnLabel = cell.querySelector('.item-image-btn-label');

                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (previewThumb) previewThumb.src = e.target.result;
                        if (dataUriInput) dataUriInput.value = e.target.result;
                        if (previewWrap) previewWrap.style.display = 'inline-flex';
                        if (btnLabel) btnLabel.textContent = 'Change Image';
                    };
                    reader.readAsDataURL(file);
                }
            };

            window.removeItemImage = function(btn) {
                const cell = btn.closest('td');
                const fileInput = cell.querySelector('.item-file-input');
                const previewWrap = cell.querySelector('.item-image-preview-wrap');
                const previewThumb = cell.querySelector('.item-image-preview-thumb');
                const dataUriInput = cell.querySelector('.item-image-data-uri');
                const btnLabel = cell.querySelector('.item-image-btn-label');

                if (fileInput) fileInput.value = '';
                if (previewThumb) previewThumb.removeAttribute('src');
                if (dataUriInput) dataUriInput.value = '';
                if (previewWrap) previewWrap.style.display = 'none';
                if (btnLabel) btnLabel.textContent = 'Add Image';
            };

            window.toggleDueDate = function(show) {
                const row = document.getElementById('due_date_row');
                const btn = document.getElementById('add_due_date_btn');
                const input = document.getElementById('expiry_date');
                if (row) row.style.display = show ? 'flex' : 'none';
                if (btn) btn.style.display = show ? 'none' : 'inline-flex';
                if (!show && input) {
                    input.value = '';
                }
            };

            // Styled Custom Modal Prompt Controller
            let promptResolveCallback = null;

            window.openStyledPrompt = function(options) {
                return new Promise((resolve) => {
                    promptResolveCallback = resolve;
                    const modal = document.getElementById('custom_prompt_modal');
                    const titleEl = document.getElementById('custom_prompt_title');
                    const descEl = document.getElementById('custom_prompt_desc');
                    const labelEl = document.getElementById('custom_prompt_input_label');
                    const inputEl = document.getElementById('custom_prompt_input');
                    const errorEl = document.getElementById('custom_prompt_error');
                    const submitTextEl = document.getElementById('custom_prompt_submit_text');
                    const chipsContainer = document.getElementById('custom_prompt_chips');
                    const chipsSection = document.getElementById('custom_prompt_chips_section');

                    titleEl.textContent = options.title || 'Add Custom Field';
                    descEl.textContent = options.description || 'Enter custom field label (e.g. PO Number, Project Ref):';
                    labelEl.textContent = options.inputLabel || 'Field Label';
                    inputEl.placeholder = options.placeholder || 'e.g. PO Number, Project Ref';
                    inputEl.value = options.defaultValue || '';
                    submitTextEl.textContent = options.buttonText || 'Add Field';
                    errorEl.style.display = 'none';

                    chipsContainer.innerHTML = '';
                    if (options.suggestions && options.suggestions.length > 0) {
                        chipsSection.style.display = 'block';
                        options.suggestions.forEach(suggestion => {
                            const chip = document.createElement('button');
                            chip.type = 'button';
                            chip.className = 'custom-prompt-chip';
                            chip.textContent = suggestion;
                            chip.onclick = function() {
                                inputEl.value = suggestion;
                                errorEl.style.display = 'none';
                                inputEl.focus();
                            };
                            chipsContainer.appendChild(chip);
                        });
                    } else {
                        chipsSection.style.display = 'none';
                    }

                    modal.style.display = 'flex';
                    setTimeout(() => inputEl.focus(), 60);
                });
            };

            window.closeCustomPrompt = function() {
                const modal = document.getElementById('custom_prompt_modal');
                if (modal) modal.style.display = 'none';
                if (promptResolveCallback) {
                    promptResolveCallback(null);
                    promptResolveCallback = null;
                }
            };

            window.handlePromptOverlayClick = function(event) {
                if (event.target.id === 'custom_prompt_modal') {
                    closeCustomPrompt();
                }
            };

            window.submitCustomPrompt = function() {
                const inputEl = document.getElementById('custom_prompt_input');
                const errorEl = document.getElementById('custom_prompt_error');
                const val = inputEl ? inputEl.value.trim() : '';
                if (!val) {
                    if (errorEl) errorEl.style.display = 'block';
                    if (inputEl) inputEl.focus();
                    return;
                }
                const modal = document.getElementById('custom_prompt_modal');
                if (modal) modal.style.display = 'none';
                if (promptResolveCallback) {
                    const cb = promptResolveCallback;
                    promptResolveCallback = null;
                    cb(val);
                }
            };

            // Keyboard navigation for prompt modal
            document.addEventListener('keydown', function(e) {
                const modal = document.getElementById('custom_prompt_modal');
                if (modal && modal.style.display !== 'none') {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        submitCustomPrompt();
                    } else if (e.key === 'Escape') {
                        e.preventDefault();
                        closeCustomPrompt();
                    }
                }
            });

            // Modern Toast Notification
            window.showToast = function(message, type = 'info') {
                let container = document.getElementById('toast_container');
                if (!container) {
                    container = document.createElement('div');
                    container.id = 'toast_container';
                    container.className = 'toast-container';
                    document.body.appendChild(container);
                }
                const toast = document.createElement('div');
                toast.className = `styled-toast toast-${type}`;
                
                let iconSvg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>';
                if (type === 'warning') {
                    iconSvg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.5"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>';
                } else if (type === 'error') {
                    iconSvg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>';
                } else if (type === 'success') {
                    iconSvg = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#10b981" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>';
                }

                toast.innerHTML = `
                    <span style="display:flex;align-items:center;">${iconSvg}</span>
                    <span style="flex:1;">${message}</span>
                `;
                container.appendChild(toast);

                setTimeout(() => {
                    toast.style.transition = 'all 0.25s ease';
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(20px)';
                    setTimeout(() => toast.remove(), 250);
                }, 3200);
            };

            window.addMetaCustomField = async function() {
                const name = await openStyledPrompt({
                    title: 'Add Custom Field',
                    description: 'Enter custom field label (e.g. PO Number, Project Ref):',
                    inputLabel: 'Field Label / Name',
                    placeholder: 'e.g. PO Number, Project Ref, LPO',
                    buttonText: 'Add Field',
                    suggestions: ['PO Number', 'Project Ref', 'Delivery Note #', 'Sales Rep', 'Vehicle Reg', 'Order No']
                });
                if (!name || !name.trim()) return;
                const container = document.getElementById('meta_custom_fields_container');
                const row = document.createElement('div');
                row.className = 'meta-field-row';
                row.innerHTML = `
                    <span class="meta-field-label">${name.trim()}</span>
                    <input type="text" class="meta-field-input" placeholder="Enter value">
                    <button type="button" onclick="this.parentElement.remove()" style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:1.15rem;padding:0 4px;line-height:1;" title="Remove field">&times;</button>
                `;
                container.appendChild(row);
            };

            window.addSummaryCustomField = async function() {
                const label = await openStyledPrompt({
                    title: 'Add Summary Extra Field',
                    description: 'Enter summary field label (e.g. Shipping Fee, Packaging):',
                    inputLabel: 'Adjustment Label',
                    placeholder: 'e.g. Shipping Fee, Packaging, Installation',
                    buttonText: 'Add Amount Field',
                    suggestions: ['Shipping Fee', 'Packaging', 'Handling Fee', 'Installation', 'Labor Charges', 'Consultation']
                });
                if (!label || !label.trim()) return;
                const container = document.getElementById('summary_custom_fields_container');
                const row = document.createElement('div');
                row.className = 'totals-interactive-row';
                row.innerHTML = `
                    <span style="font-size:0.8rem;color:#475569;font-weight:500;">${label.trim()}</span>
                    <div style="display:flex;align-items:center;gap:4px;">
                        <span class="curr-symbol">${activeCurrencySymbol}</span>
                        <input type="number" step="0.01" style="width:70px;padding:3px 6px;font-size:0.78rem;border:1px solid #cbd5e1;border-radius:4px;text-align:right;" value="0.00" oninput="calculateTotals()">
                        <button type="button" onclick="this.parentElement.parentElement.remove();calculateTotals();" style="background:none;border:none;color:#94a3b8;cursor:pointer;font-size:1.15rem;padding:0 4px;line-height:1;" title="Remove field">&times;</button>
                    </div>
                `;
                container.appendChild(row);
                calculateTotals();
            };

            window.syncPhoneCode = function(select, targetId) {
                const codeSelect = document.getElementById(targetId);
                if (!codeSelect) return;
                const map = {
                    'Zambia': '+260',
                    'United States of America (USA)': '+1',
                    'United Kingdom': '+44',
                    'South Africa': '+27',
                    'India': '+91',
                    'Australia': '+61',
                    'Canada': '+1'
                };
                if (map[select.value]) {
                    codeSelect.value = map[select.value];
                }
            };

            // Currency Switcher
            window.handleCurrencyChange = function(select) {
                activeCurrency = select.value;
                const selectedOpt = select.options[select.selectedIndex];
                activeCurrencySymbol = selectedOpt.getAttribute('data-symbol') || '$';

                document.getElementById('hidden_currency_symbol').value = activeCurrencySymbol;
                document.getElementById('total-currency-code').textContent = activeCurrency;

                // Update all currency symbol badges
                document.querySelectorAll('.curr-symbol').forEach(function(el) {
                    el.textContent = activeCurrencySymbol;
                });

                calculateTotals();
            };

            // Items Table Logic
            function reindexRows() {
                const rows = itemsBody.querySelectorAll('.item-row');
                rows.forEach(function (row, index) {
                    const numSpan = row.querySelector('.row-index-number');
                    if (numSpan) numSpan.textContent = (index + 1) + '.';

                    row.querySelectorAll('input, textarea').forEach(function (input) {
                        if (!input.name) return;
                        input.name = input.name.replace(/items\[\d+\]/, 'items[' + index + ']');
                    });
                });
            }

            function addNewRow() {
                const index = itemsBody.querySelectorAll('.item-row').length;
                let html = rowTemplate
                    .replace(/__INDEX_PLUS_1__/g, index + 1)
                    .replace(/__INDEX__/g, index)
                    .replace(/__CURR_SYMBOL__/g, activeCurrencySymbol);

                itemsBody.insertAdjacentHTML('beforeend', html);
                calculateTotals();
            }

            addRowBtn.addEventListener('click', addNewRow);

            window.cloneRow = function(btn) {
                const row = btn.closest('.item-row');
                const clone = row.cloneNode(true);
                const fileInput = clone.querySelector('.item-file-input');
                const previewWrap = clone.querySelector('.item-image-preview-wrap');
                const previewThumb = clone.querySelector('.item-image-preview-thumb');
                const dataUriInput = clone.querySelector('.item-image-data-uri');
                const btnLabel = clone.querySelector('.item-image-btn-label');

                if (fileInput) fileInput.value = '';
                if (dataUriInput) dataUriInput.value = '';
                if (previewThumb) previewThumb.removeAttribute('src');
                if (previewWrap) previewWrap.style.display = 'none';
                if (btnLabel) btnLabel.textContent = 'Add Image';

                row.after(clone);
                reindexRows();
                calculateTotals();
            };

            window.toggleRowDescription = function(btn) {
                const cell = btn.closest('td');
                const textarea = cell.querySelector('.item-desc-textarea');
                if (textarea) {
                    textarea.classList.toggle('show');
                    if (textarea.classList.contains('show')) {
                        textarea.focus();
                    }
                }
            };

            itemsBody.addEventListener('click', function(e) {
                const removeBtn = e.target.closest('.remove-item');
                if (!removeBtn) return;
                const rows = itemsBody.querySelectorAll('.item-row');
                if (rows.length <= 1) {
                    showToast('Your document must have at least one line item.', 'warning');
                    return;
                }
                removeBtn.closest('.item-row').remove();
                reindexRows();
                calculateTotals();
            });

            // Calculate Totals & Words
            function calculateTotals() {
                const rows = itemsBody.querySelectorAll('.item-row');
                let subTotal = 0;
                let totalQty = 0;

                rows.forEach(function(row) {
                    const qtyInput = row.querySelector('input[name*="[qty]"]');
                    const priceInput = row.querySelector('input[name*="[price]"]');
                    const amountVal = row.querySelector('.amount-val');

                    const qty = parseFloat(qtyInput ? qtyInput.value : 1) || 0;
                    const price = parseFloat(priceInput ? priceInput.value : 0) || 0;
                    const lineAmount = qty * price;

                    subTotal += lineAmount;
                    totalQty += qty;

                    if (amountVal) {
                        amountVal.textContent = lineAmount.toLocaleString(undefined, {
                            minimumFractionDigits: 2,
                            maximumFractionDigits: 2
                        });
                    }
                });

                document.getElementById('total-qty-val').textContent = totalQty;

                // Discount calculation
                const discountTypeInput = document.getElementById('discount_type_input');
                const discountType = discountTypeInput ? discountTypeInput.value : 'percent';
                const discountValInput = document.getElementById('discount_value_input') || document.getElementById('discount_rate_input');
                const discountVal = parseFloat(discountValInput ? discountValInput.value : 0) || 0;
                let discountAmount = 0;
                if (discountType === 'percent') {
                    discountAmount = subTotal * (Math.min(100, Math.max(0, discountVal)) / 100);
                } else {
                    discountAmount = Math.min(subTotal, Math.max(0, discountVal));
                }
                const subAfterDiscount = Math.max(0, subTotal - discountAmount);

                // Tax calculation
                const vatCheckbox = document.getElementById('vat_registered');
                const vatRateInput = document.getElementById('vat_rate');
                const isVat = vatCheckbox ? vatCheckbox.checked : false;
                const vatRate = parseFloat(vatRateInput ? vatRateInput.value : 16) || 0;
                const taxAmount = isVat ? (subAfterDiscount * (vatRate / 100)) : 0;

                const grandTotal = subAfterDiscount + taxAmount;

                document.getElementById('summary-subtotal').textContent = subTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                document.getElementById('summary-discount').textContent = discountAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                document.getElementById('summary-tax').textContent = taxAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                document.getElementById('summary-grandtotal').textContent = grandTotal.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2 });

                // Update Total In Words
                const words = numberToWords(grandTotal, activeCurrency);
                document.getElementById('words_output_text').textContent = words;
                const totalInWordsInput = document.getElementById('total_in_words');
                if (totalInWordsInput) {
                    totalInWordsInput.value = words;
                }
            }

            // Real-time Number to Words converter
            function numberToWords(amount, currencyCode) {
                const unitsInfo = getCurrencyUnits(currencyCode);
                amount = Math.round(Number(amount) * 100) / 100;

                if (isNaN(amount) || amount <= 0) {
                    return 'Zero ' + unitsInfo.majorPlural + ' Only';
                }

                let wholePart = Math.floor(amount);
                let decimalPart = Math.round((amount - wholePart) * 100);
                if (decimalPart >= 100) {
                    wholePart += 1;
                    decimalPart = 0;
                }

                const units = ['', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine'];
                const teens = ['Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'];
                const tens = ['', '', 'Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety'];

                function convertChunk(num) {
                    let str = '';
                    if (num >= 100) {
                        str += units[Math.floor(num / 100)] + ' Hundred ';
                        num %= 100;
                    }
                    if (num >= 20) {
                        str += tens[Math.floor(num / 10)] + ' ';
                        num %= 10;
                    } else if (num >= 10) {
                        str += teens[num - 10] + ' ';
                        num = 0;
                    }
                    if (num > 0) {
                        str += units[num] + ' ';
                    }
                    return str.trim();
                }

                let words = '';
                let remaining = wholePart;

                if (remaining >= 1000000000) {
                    words += convertChunk(Math.floor(remaining / 1000000000)) + ' Billion ';
                    remaining %= 1000000000;
                }
                if (remaining >= 1000000) {
                    words += convertChunk(Math.floor(remaining / 1000000)) + ' Million ';
                    remaining %= 1000000;
                }
                if (remaining >= 1000) {
                    words += convertChunk(Math.floor(remaining / 1000)) + ' Thousand ';
                    remaining %= 1000;
                }
                if (remaining > 0) {
                    words += convertChunk(remaining);
                }

                words = words.trim();
                if (!words) words = 'Zero';

                let majorName = (wholePart === 1) ? unitsInfo.majorSingle : unitsInfo.majorPlural;
                let result = words + ' ' + majorName;

                if (decimalPart > 0) {
                    let minorName = (decimalPart === 1) ? unitsInfo.minorSingle : unitsInfo.minorPlural;
                    result += ' and ' + convertChunk(decimalPart) + ' ' + minorName;
                }

                return result + ' Only';
            }

            function getCurrencyUnits(code) {
                const map = {
                    USD: { majorSingle: 'Dollar', majorPlural: 'Dollars', minorSingle: 'Cent', minorPlural: 'Cents' },
                    ZMW: { majorSingle: 'Kwacha', majorPlural: 'Kwacha', minorSingle: 'Ngwee', minorPlural: 'Ngwee' },
                    EUR: { majorSingle: 'Euro', majorPlural: 'Euros', minorSingle: 'Cent', minorPlural: 'Cents' },
                    GBP: { majorSingle: 'Pound', majorPlural: 'Pounds', minorSingle: 'Penny', minorPlural: 'Pence' },
                    ZAR: { majorSingle: 'Rand', majorPlural: 'Rand', minorSingle: 'Cent', minorPlural: 'Cents' },
                    CAD: { majorSingle: 'Dollar', majorPlural: 'Dollars', minorSingle: 'Cent', minorPlural: 'Cents' },
                    AUD: { majorSingle: 'Dollar', majorPlural: 'Dollars', minorSingle: 'Cent', minorPlural: 'Cents' },
                    INR: { majorSingle: 'Rupee', majorPlural: 'Rupees', minorSingle: 'Paisa', minorPlural: 'Paise' },
                    KES: { majorSingle: 'Shilling', majorPlural: 'Shillings', minorSingle: 'Cent', minorPlural: 'Cents' },
                    NGN: { majorSingle: 'Naira', majorPlural: 'Naira', minorSingle: 'Kobo', minorPlural: 'Kobo' },
                    GHS: { majorSingle: 'Cedi', majorPlural: 'Cedis', minorSingle: 'Pesewa', minorPlural: 'Pesewas' },
                    UGX: { majorSingle: 'Shilling', majorPlural: 'Shillings', minorSingle: 'Cent', minorPlural: 'Cents' },
                    TZS: { majorSingle: 'Shilling', majorPlural: 'Shillings', minorSingle: 'Cent', minorPlural: 'Cents' },
                    BWP: { majorSingle: 'Pula', majorPlural: 'Pula', minorSingle: 'Thebe', minorPlural: 'Thebe' },
                    MWK: { majorSingle: 'Kwacha', majorPlural: 'Kwacha', minorSingle: 'Tambala', minorPlural: 'Tambala' },
                    AED: { majorSingle: 'Dirham', majorPlural: 'Dirhams', minorSingle: 'Fils', minorPlural: 'Fils' },
                    SAR: { majorSingle: 'Riyal', majorPlural: 'Riyals', minorSingle: 'Halala', minorPlural: 'Halalas' },
                    JPY: { majorSingle: 'Yen', majorPlural: 'Yen', minorSingle: 'Sen', minorPlural: 'Sen' },
                    CNY: { majorSingle: 'Yuan', majorPlural: 'Yuan', minorSingle: 'Fen', minorPlural: 'Fen' },
                    NZD: { majorSingle: 'Dollar', majorPlural: 'Dollars', minorSingle: 'Cent', minorPlural: 'Cents' },
                    CHF: { majorSingle: 'Franc', majorPlural: 'Francs', minorSingle: 'Rappen', minorPlural: 'Rappen' },
                };
                map.ZK = map.ZMW;
                map.K = map.ZMW;
                map['$'] = map.USD;
                map['€'] = map.EUR;
                map['£'] = map.GBP;
                map['₹'] = map.INR;
                map['R'] = map.ZAR;

                const key = (code || '').toUpperCase().trim();
                return map[key] || {
                    majorSingle: code,
                    majorPlural: code,
                    minorSingle: 'Cent',
                    minorPlural: 'Cents',
                };
            }

            function getCurrencyName(code) {
                return getCurrencyUnits(code).majorPlural;
            }

            // Logo Handling
            logoInput.addEventListener('change', function() {
                const file = logoInput.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function(e) {
                    logoPreviewImg.src = e.target.result;
                    logoPreviewImg.style.display = 'block';
                    logoPlaceholder.style.display = 'none';
                    logoOverlay.classList.add('active');
                };
                reader.readAsDataURL(file);
            });

            window.removeLogo = function() {
                logoInput.value = '';
                logoPreviewImg.removeAttribute('src');
                logoPreviewImg.style.display = 'none';
                logoPlaceholder.style.display = 'block';
                logoOverlay.classList.remove('active');
            };

            // Payment / Bank Handlers
            window.handlePaymentMethodChange = function(val) {
                const group = document.getElementById('other_method_group');
                if (group) {
                    group.style.display = (val === 'Other') ? 'block' : 'none';
                }
            };

            window.handleBankNameChange = function(val) {
                const group = document.getElementById('bank_name_other_group');
                if (group) {
                    group.style.display = (val === 'Other') ? 'block' : 'none';
                }
            };

            window.updateMobileProviderHint = function(val) {
                const hint = document.getElementById('mobile_hint');
                if (!hint) return;
                const hints = {
                    'MTN': 'MTN prefix: 096, 076, or 056 (10 digits total)',
                    'Airtel': 'Airtel prefix: 097, 077, or 057 (10 digits total)',
                    'Zamtel': 'Zamtel prefix: 095, 075, or 055 (10 digits total)'
                };
                hint.textContent = hints[val] || '';
            };

            // Listeners for totals calculation
            document.getElementById('doc-form').addEventListener('input', function(e) {
                if (e.target.matches('input[name*="[qty]"], input[name*="[price]"], #vat_rate, #discount_rate_input, #discount_value_input')) {
                    calculateTotals();
                }
            });

            // PDF Preview Modal Logic
            let currentPreviewBlob = null;
            let currentPreviewFilename = 'document.pdf';

            window.openPdfPreview = async function() {
                const form = document.getElementById('doc-form');
                if (!form.checkValidity()) {
                    form.reportValidity();
                    return;
                }

                const previewModal = document.getElementById('pdf_preview_modal');
                const loader = document.getElementById('pdf_preview_loader');
                const iframe = document.getElementById('pdf_preview_iframe');
                const titleSpan = document.getElementById('preview_modal_title');
                const previewBtn = document.getElementById('preview_doc_btn');

                const docType = document.querySelector('input[name="doc_type"]')?.value || 'Document';
                const quoteNo = document.querySelector('input[name="quote_no"]')?.value || '';
                const docTitle = quoteNo ? `${docType} - ${quoteNo}` : `${docType} Preview`;
                titleSpan.textContent = docTitle;
                currentPreviewFilename = `${docType.toLowerCase()}-${quoteNo || 'document'}.pdf`;

                previewModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
                loader.style.display = 'flex';
                iframe.style.display = 'none';

                if (previewBtn) {
                    previewBtn.disabled = true;
                    previewBtn.style.opacity = '0.7';
                }

                try {
                    const formData = new FormData(form);
                    formData.set('action', 'preview');

                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json, application/pdf'
                        }
                    });

                    if (!response.ok) {
                        let errorMsg = 'Could not generate PDF preview (Status ' + response.status + ')';
                        try {
                            const errorData = await response.json();
                            if (errorData && errorData.errors) {
                                const errList = [];
                                for (const [field, msgs] of Object.entries(errorData.errors)) {
                                    msgs.forEach(m => errList.push(m));
                                }
                                errorMsg = errList.join(' • ') || errorData.message || errorMsg;

                                const firstKey = Object.keys(errorData.errors)[0];
                                const fieldBase = firstKey.replace(/\..*$/, '');
                                const invalidField = form.querySelector(`[name="${firstKey}"]`) || 
                                                     form.querySelector(`[name="${fieldBase}"]`) ||
                                                     form.querySelector(`[name^="${fieldBase}"]`);
                                if (invalidField) {
                                    invalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    invalidField.focus();
                                    invalidField.classList.add('input-error-highlight');
                                    setTimeout(() => invalidField.classList.remove('input-error-highlight'), 3500);
                                }
                            } else if (errorData && errorData.message) {
                                errorMsg = errorData.message;
                            }
                        } catch (jsonErr) {
                            // Non-JSON response
                        }

                        closePdfPreview();
                        showToast(errorMsg, 'error');
                        return;
                    }

                    const blob = await response.blob();
                    currentPreviewBlob = blob;

                    if (iframe.src && iframe.src.startsWith('blob:')) {
                        URL.revokeObjectURL(iframe.src);
                    }

                    const pdfUrl = URL.createObjectURL(blob);
                    iframe.src = pdfUrl;
                    iframe.onload = function() {
                        loader.style.display = 'none';
                        iframe.style.display = 'block';
                    };
                    setTimeout(function() {
                        loader.style.display = 'none';
                        iframe.style.display = 'block';
                    }, 800);
                } catch (err) {
                    closePdfPreview();
                    showToast('Could not generate PDF preview: ' + err.message, 'error');
                } finally {
                    if (previewBtn) {
                        previewBtn.disabled = false;
                        previewBtn.style.opacity = '1';
                    }
                }
            };

            window.closePdfPreview = function() {
                const previewModal = document.getElementById('pdf_preview_modal');
                const iframe = document.getElementById('pdf_preview_iframe');
                if (previewModal) previewModal.style.display = 'none';
                document.body.style.overflow = '';
                if (iframe && iframe.src && iframe.src.startsWith('blob:')) {
                    URL.revokeObjectURL(iframe.src);
                    iframe.removeAttribute('src');
                }
            };

            window.downloadPreviewPdf = function() {
                if (!currentPreviewBlob) {
                    const form = document.getElementById('doc-form');
                    form.submit();
                    return;
                }

                const url = URL.createObjectURL(currentPreviewBlob);
                const a = document.createElement('a');
                a.href = url;
                a.download = currentPreviewFilename;
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
                setTimeout(function() {
                    URL.revokeObjectURL(url);
                }, 1000);
            };

            // Keyboard shortcut: Escape to close preview
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const previewModal = document.getElementById('pdf_preview_modal');
                    if (previewModal && previewModal.style.display !== 'none') {
                        closePdfPreview();
                    }
                }
            });

            // Initial calculation
            calculateTotals();
        })();
    </script>
</body>
</html>
