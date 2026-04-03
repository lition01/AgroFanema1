<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --bg-primary: #F3F1EC;
            --bg-secondary: rgba(255, 255, 255, 0.7);
            --bg-surface: rgba(253, 252, 248, 0.6);
            --bg-elevated: #FFFFFF;
            --text-primary: #111827;
            --text-secondary: #4B5563;
            --text-muted: #9CA3AF;
            --accent-gold: #D4A853;
            --accent-gold-hover: #b89146;
            --primary-dark: #1F2937;
            --border-color: rgba(226, 224, 218, 0.5);
            --success: #10B981;
            --warning: #F59E0B;
            --danger: #EF4444;
            --info: #3B82F6;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            --blur: blur(16px);
            --radius: 16px;
        }

        html[data-theme="dark"] {
            --bg-primary: #0F1115;
            --bg-secondary: rgba(26, 29, 36, 0.6);
            --bg-surface: rgba(31, 35, 43, 0.6);
            --bg-elevated: #272B36;
            --text-primary: #F9FAFB;
            --text-secondary: #9CA3AF;
            --text-muted: #6B7280;
            --accent-gold: #FCD34D;
            --accent-gold-hover: #FBBF24;
            --primary-dark: #111827;
            --border-color: rgba(255, 255, 255, 0.06);
            --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.2);
            --shadow-md: 0 8px 16px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 16px 32px rgba(0, 0, 0, 0.4);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            transition: var(--transition);
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 260px;
            background: var(--bg-secondary);
            border-right: 1px solid var(--border-color);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            backdrop-filter: var(--blur);
        }

        .sidebar-header {
            height: 64px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid var(--border-color);
            box-sizing: border-box;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 20px;
            font-weight: 600;
            color: var(--text-primary);
            font-family: 'Cormorant Garamond', serif;
        }

        .logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary-dark);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .nav-section {
            padding: 16px 12px;
            flex: 1;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .nav-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 8px 12px;
            margin-top: 8px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 2px;
            font-weight: 500;
        }

        .nav-item:hover {
            background: var(--bg-primary);
            color: var(--text-primary);
        }

        .nav-item.active {
            background: var(--primary-dark);
            color: #fff;
            box-shadow: var(--shadow-sm);
        }

        .nav-item.active .nav-icon {
            color: #fff;
            opacity: 1;
        }

        .nav-item.danger {
            color: var(--danger);
        }

        .nav-item.danger:hover {
            background: rgba(248, 113, 113, 0.1);
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .nav-divider {
            height: 1px;
            background: var(--border-color);
            margin: 16px 12px;
        }

        .user-profile {
            padding: 16px;
            border-top: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--accent-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: #fff;
            flex-shrink: 0;
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
        }

        .user-role {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ── Main ── */
        .main {
            flex: 1;
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            height: 64px;
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 50;
            backdrop-filter: var(--blur);
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--bg-primary);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 10px 16px;
            width: 320px;
            transition: var(--transition);
        }

        .search-box:focus-within {
            border-color: var(--accent-gold);
        }

        .search-box input {
            background: none;
            border: none;
            outline: none;
            color: var(--text-primary);
            font-size: 14px;
            width: 100%;
            font-family: 'Outfit', sans-serif;
        }

        .search-box input::placeholder {
            color: var(--text-muted);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-btn {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            color: var(--text-secondary);
        }

        .icon-btn:hover {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
        }

        .content {
            padding: 32px;
        }

        .page-header {
            margin-bottom: 32px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 4px;
        }

        .page-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
        }

        .section {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .section.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Metric Cards ── */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .metric-card {
            background: var(--bg-surface);
            backdrop-filter: var(--blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            cursor: pointer;
        }

        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
            border-color: var(--text-muted);
        }

        .metric-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .metric-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .metric-icon.revenue {
            background: rgba(212, 168, 83, 0.15);
            color: var(--accent-gold);
        }

        .metric-icon.orders {
            background: rgba(96, 165, 250, 0.15);
            color: var(--info);
        }

        .metric-icon.customers {
            background: rgba(52, 211, 153, 0.15);
            color: var(--success);
        }

        .metric-icon.growth {
            background: rgba(251, 191, 36, 0.15);
            color: var(--warning);
        }

        .metric-trend {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 12px;
            font-weight: 500;
            padding: 4px 8px;
            border-radius: 20px;
        }

        .metric-trend.up {
            background: rgba(52, 211, 153, 0.15);
            color: var(--success);
        }

        .metric-trend.down {
            background: rgba(248, 113, 113, 0.15);
            color: var(--danger);
        }

        .metric-trend.neutral {
            background: var(--bg-surface);
            color: var(--text-muted);
        }

        .metric-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .metric-label {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* ── Buttons ── */
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-family: 'Outfit', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--accent-gold);
            color: #1a1008;
        }

        .btn-primary:hover {
            background: var(--accent-gold-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: var(--bg-surface);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            border-color: var(--text-muted);
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 13px;
        }

        .btn-icon {
            width: 32px;
            height: 32px;
            padding: 0;
            border-radius: 6px;
            justify-content: center;
        }

        /* ── Table ── */
        .table-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 12px 20px;
            font-size: 12px;
            font-weight: 500;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border-color);
        }

        td {
            padding: 14px 20px;
            font-size: 14px;
            border-bottom: 1px solid var(--border-color);
        }

        tr:last-child td {
            border-bottom: none;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pill.active {
            background: rgba(52, 211, 153, 0.15);
            color: var(--success);
        }

        .status-pill.pending {
            background: rgba(251, 191, 36, 0.15);
            color: var(--warning);
        }

        .status-pill.inactive {
            background: rgba(248, 113, 113, 0.15);
            color: var(--danger);
        }

        .status-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ── Form Elements ── */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            color: var(--text-secondary);
            margin-bottom: 8px;
            font-weight: 500;
        }

        .form-input {
            width: 100%;
            padding: 11px 16px;
            background: var(--bg-primary);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 14px;
            transition: var(--transition);
            font-family: 'Outfit', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 3px rgba(212, 168, 83, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%239CA3AF' stroke-width='2'%3E%3Cpolyline points='6,9 12,15 18,9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
            cursor: pointer;
        }

        /* ── Qty Control ── */
        .qty-control {
            display: flex;
            align-items: center;
            background: var(--bg-primary);
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            overflow: hidden;
        }

        .search-input-wrap {
            position: relative;
            width: 100%;
        }

        .search-input-wrap .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            transition: var(--transition);
        }

        .search-input-wrap .form-input {
            padding-left: 40px;
        }

        .search-input-wrap .form-input:focus+.search-icon {
            color: var(--accent-gold);
        }

        .qty-btn {
            width: 40px;
            height: 44px;
            border: none;
            background: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary);
            transition: var(--transition);
            font-size: 18px;
            font-family: 'Outfit', sans-serif;
        }

        .qty-btn:hover {
            background: var(--bg-surface);
            color: var(--accent-gold);
        }

        .qty-input {
            flex: 1;
            border: none;
            outline: none;
            background: none;
            text-align: center;
            font-size: 16px;
            font-weight: 600;
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            padding: 0;
        }

        /* ── Products ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 24px;
        }

        .product-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .product-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.06);
            border-color: var(--accent-gold);
        }

        .product-card-img {
            width: 100%;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-surface);
            border-bottom: 1px solid var(--border-color);
            color: var(--text-muted);
            overflow: hidden;
        }

        .product-card-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .product-card-sku {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 12px;
        }

        .product-card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
            margin-bottom: 16px;
            font-size: 13px;
        }

        .product-card-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        /* ── Sales ── */
        .sales-metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 28px;
        }

        .sales-metric-card {
            background: var(--bg-surface);
            backdrop-filter: var(--blur);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 24px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .sales-metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .sales-metric-card.sold::before {
            background: linear-gradient(90deg, var(--info), #93c5fd);
        }

        .sales-metric-card.profit::before {
            background: linear-gradient(90deg, var(--success), #6ee7b7);
        }

        .sales-metric-card.stock::before {
            background: linear-gradient(90deg, var(--accent-gold), #fde68a);
        }

        .sales-metric-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .smc-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .smc-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .smc-icon.sold {
            background: rgba(96, 165, 250, 0.15);
            color: var(--info);
        }

        .smc-icon.profit {
            background: rgba(52, 211, 153, 0.15);
            color: var(--success);
        }

        .smc-icon.stock {
            background: rgba(212, 168, 83, 0.15);
            color: var(--accent-gold);
        }

        .smc-badge {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 8px;
            border-radius: 20px;
            background: var(--bg-elevated);
            color: var(--text-secondary);
        }

        .smc-value {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
            font-family: 'Cormorant Garamond', serif;
        }

        .smc-label {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* ── Add Sale Form Layout ── */
        .add-sale-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            align-items: start;
        }

        .sale-form-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .sale-form-header {
            background: linear-gradient(135deg, #0f4c35 0%, #166534 100%);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        html[data-theme="dark"] .sale-form-header {
            background: linear-gradient(135deg, #052e16 0%, #14532d 100%);
        }

        .sale-form-header-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(52, 211, 153, 0.2);
            border: 1px solid rgba(52, 211, 153, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #34d399;
        }

        .sale-form-header h3 {
            font-size: 16px;
            font-weight: 600;
            color: #fff;
        }

        .sale-form-header p {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.5);
        }

        .sale-form-body {
            padding: 24px;
        }

        /* ── Product Selector ── */
        .product-selector {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            max-height: 220px;
            overflow-y: auto;
            padding-right: 4px;
            margin-bottom: 16px;
        }

        .product-selector::-webkit-scrollbar {
            width: 4px;
        }

        .product-selector::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }

        .ps-option {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 12px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 2px;
        }

        .ps-option:hover {
            border-color: var(--success);
        }

        .ps-option.selected {
            border-color: var(--success);
            background: rgba(52, 211, 153, 0.08);
        }

        .ps-option.out-of-stock {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .ps-option-name {
            font-size: 13px;
            font-weight: 600;
        }

        .ps-option-meta {
            font-size: 11px;
            color: var(--text-muted);
            display: flex;
            justify-content: space-between;
        }

        .sale-qty-row {
            display: flex;
            gap: 12px;
            align-items: flex-end;
        }

        .sale-qty-row .form-group {
            flex: 1;
            margin-bottom: 0;
        }

        .form-section-divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0 20px;
        }

        .form-section-divider span {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .form-section-divider::before,
        .form-section-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border-color);
        }

        /* ── Recent Sales widget ── */
        .recent-sales-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .rsw-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            font-weight: 600;
        }

        .rsw-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .rsw-item:last-child {
            border-bottom: none;
        }

        .rsw-item:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .rsw-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: rgba(52, 211, 153, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
            flex-shrink: 0;
        }

        .rsw-info {
            flex: 1;
            min-width: 0;
        }

        .rsw-name {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rsw-qty {
            font-size: 11px;
            color: var(--text-muted);
        }

        .rsw-profit {
            font-size: 14px;
            font-weight: 700;
            color: var(--success);
        }

        .rsw-empty {
            padding: 24px 20px;
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }

        /* ── Sales Table ── */
        .sales-table-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .sales-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .sales-table-title {
            font-size: 16px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sales-count-badge {
            background: var(--accent-gold);
            color: #1a1008;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
        }

        .sales-empty {
            padding: 60px 20px;
            text-align: center;
            color: var(--text-muted);
        }

        .sales-empty-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            background: var(--bg-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: var(--text-muted);
        }

        .sales-empty h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
            color: var(--text-secondary);
        }

        /* ── View Sales Section ── */
        .view-sales-filters {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-chip {
            padding: 7px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            border: 1.5px solid var(--border-color);
            background: var(--bg-surface);
            color: var(--text-secondary);
            transition: var(--transition);
        }

        .filter-chip:hover {
            border-color: var(--accent-gold);
            color: var(--accent-gold);
        }

        .filter-chip.active {
            background: var(--accent-gold);
            color: #1a1008;
            border-color: var(--accent-gold);
        }

        .search-inline {
            flex: 1;
            max-width: 300px;
        }

        /* ── Overview bottom ── */
        .overview-bottom {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .activity-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            overflow: hidden;
        }

        .activity-header {
            padding: 18px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .activity-title {
            font-size: 15px;
            font-weight: 600;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border-color);
            transition: var(--transition);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-item:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .activity-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .activity-info {
            flex: 1;
        }

        .activity-name {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .activity-sub {
            font-size: 12px;
            color: var(--text-muted);
        }

        .activity-val {
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
        }

        .quick-stat-row {
            display: flex;
            gap: 8px;
            padding: 14px 20px;
            border-bottom: 1px solid var(--border-color);
            align-items: center;
        }

        .quick-stat-row:last-child {
            border-bottom: none;
        }

        .quick-stat-bar {
            flex: 1;
            height: 6px;
            background: var(--bg-surface);
            border-radius: 3px;
            overflow: hidden;
        }

        .quick-stat-fill {
            height: 100%;
            border-radius: 3px;
        }

        .quick-stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            width: 90px;
        }

        .quick-stat-val {
            font-size: 12px;
            font-weight: 600;
            width: 40px;
            text-align: right;
        }

        /* ── Analytics ── */
        .analytics-card {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .analytics-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .analytics-card-title {
            font-size: 15px;
            font-weight: 600;
        }

        .bar-chart-wrap {
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 220px;
            padding-top: 20px;
            position: relative;
        }

        .chart-bar-group {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
        }

        .chart-bar-container {
            display: flex;
            gap: 3px;
            align-items: flex-end;
            height: 170px;
        }

        .chart-bar {
            width: 100%;
            min-width: 18px;
            max-width: 40px;
            border-radius: 5px 5px 0 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
        }

        .chart-bar:hover {
            opacity: 0.85;
        }

        .chart-bar-label {
            font-size: 10px;
            color: var(--text-muted);
            white-space: nowrap;
        }

        .chart-y-labels {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 30px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 4px 0;
        }

        .chart-y-label {
            font-size: 10px;
            color: var(--text-muted);
            width: 36px;
            text-align: right;
        }

        .bar-chart-inner {
            flex: 1;
            display: flex;
            align-items: flex-end;
            gap: 6px;
            height: 170px;
            border-bottom: 1px solid var(--border-color);
            padding: 0 4px;
        }

        .month-bar {
            flex: 1;
            border-radius: 5px 5px 0 0;
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            position: relative;
            min-width: 14px;
        }

        .month-bar:hover {
            opacity: 0.8;
            transform: scaleY(1.02);
            transform-origin: bottom;
        }

        .month-bar-tooltip {
            position: absolute;
            bottom: calc(100% + 6px);
            left: 50%;
            transform: translateX(-50%);
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 5px 10px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
            box-shadow: var(--shadow-md);
            font-weight: 600;
            z-index: 10;
        }

        .month-bar:hover .month-bar-tooltip {
            opacity: 1;
        }

        .bar-month-label {
            font-size: 9px;
            color: var(--text-muted);
            text-align: center;
            margin-top: 6px;
        }

        .bar-chart-x-labels {
            display: flex;
            gap: 6px;
            padding: 0 4px;
        }

        .bar-x-label {
            flex: 1;
            font-size: 9px;
            color: var(--text-muted);
            text-align: center;
            min-width: 14px;
        }

        /* ── Pie / Donut ── */
        .analytics-two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .donut-container {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .donut-chart-wrap {
            position: relative;
            flex-shrink: 0;
        }

        .donut-chart-wrap svg {
            transform: rotate(-90deg);
        }

        .donut-center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .donut-value {
            font-size: 22px;
            font-weight: 700;
        }

        .donut-label {
            font-size: 10px;
            color: var(--text-muted);
        }

        .donut-legend {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .donut-legend-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .donut-legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 3px;
            flex-shrink: 0;
        }

        .donut-legend-text {
            font-size: 13px;
            color: var(--text-secondary);
            flex: 1;
        }

        .donut-legend-value {
            font-size: 13px;
            font-weight: 600;
        }

        .donut-legend-pct {
            font-size: 12px;
            color: var(--text-muted);
            margin-left: 4px;
        }

        /* ── Top sold products ── */
        .top-product-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .top-product-row:last-child {
            border-bottom: none;
        }

        .top-product-rank {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .top-product-bar {
            flex: 2;
            height: 6px;
            background: var(--bg-surface);
            border-radius: 3px;
            overflow: hidden;
        }

        .top-product-fill {
            height: 100%;
            border-radius: 3px;
            background: var(--accent-gold);
            transition: width 0.8s ease;
        }

        /* ── Add Product Form ── */
        .add-product-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 24px;
            align-items: start;
        }

        .form-panel {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .form-panel-header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, #374151 100%);
            padding: 24px 28px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        html[data-theme="dark"] .form-panel-header {
            background: linear-gradient(135deg, #1a1d24 0%, #272B36 100%);
        }

        .form-panel-header-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(212, 168, 83, 0.2);
            border: 1px solid rgba(212, 168, 83, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-gold);
        }

        .form-panel-header-text h3 {
            font-size: 18px;
            font-weight: 600;
            color: #fff;
            margin-bottom: 2px;
        }

        .form-panel-header-text p {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .form-panel-body {
            padding: 28px;
        }

        .lang-tabs {
            display: flex;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 4px;
            margin-bottom: 16px;
            gap: 4px;
        }

        .lang-tab {
            flex: 1;
            padding: 8px;
            text-align: center;
            font-size: 13px;
            font-weight: 500;
            border-radius: 7px;
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-secondary);
            border: none;
            background: none;
            font-family: 'Outfit', sans-serif;
        }

        .lang-tab.active {
            background: var(--accent-gold);
            color: #1a1008;
            font-weight: 600;
        }

        .lang-content {
            display: none;
        }

        .lang-content.active {
            display: block;
        }

        .image-upload-zone {
            border: 2px dashed var(--border-color);
            border-radius: 14px;
            padding: 32px 20px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .image-upload-zone:hover,
        .image-upload-zone.dragover {
            border-color: var(--accent-gold);
            background: rgba(212, 168, 83, 0.04);
        }

        .image-upload-zone input[type="file"] {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
        }

        .upload-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background: rgba(212, 168, 83, 0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: var(--accent-gold);
        }

        .upload-title {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 4px;
        }

        .upload-sub {
            font-size: 12px;
            color: var(--text-muted);
        }

        .upload-preview {
            display: none;
            position: relative;
        }

        .upload-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }

        .upload-preview-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.6);
            border: none;
            color: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-sidebar-panel {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .sidebar-widget {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
        }

        .sidebar-widget-header {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--text-secondary);
        }

        .sidebar-widget-header svg {
            color: var(--accent-gold);
        }

        .sidebar-widget-body {
            padding: 20px;
        }

        .category-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .category-option {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 12px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 4px;
            position: relative;
        }

        .category-option:hover {
            border-color: var(--accent-gold);
        }

        .category-option.selected {
            border-color: var(--accent-gold);
            background: rgba(212, 168, 83, 0.08);
        }

        .category-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .category-option-name {
            font-size: 13px;
            font-weight: 600;
        }

        .category-option-desc {
            font-size: 11px;
            color: var(--text-muted);
        }

        .category-option-icon {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            margin-top: 4px;
        }

        /* ── Settings ── */
        .settings-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
        }

        .settings-nav {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 16px;
            align-self: start;
        }

        .settings-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 8px;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
            margin-bottom: 4px;
            font-size: 14px;
        }

        .settings-nav-item:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-primary);
        }

        .settings-nav-item.active {
            background: rgba(212, 168, 83, 0.15);
            color: var(--accent-gold);
        }

        .settings-content {
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 32px;
        }

        .settings-section {
            margin-bottom: 32px;
        }

        .settings-section:last-child {
            margin-bottom: 0;
        }

        .settings-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        .toggle-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 14px 0;
            border-bottom: 1px solid var(--border-color);
        }

        .toggle-row:last-child {
            border-bottom: none;
        }

        .toggle-label {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .toggle-label-title {
            font-size: 14px;
            font-weight: 500;
        }

        .toggle-label-desc {
            font-size: 12px;
            color: var(--text-muted);
        }

        .toggle {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            background: var(--border-color);
            border-radius: 24px;
            cursor: pointer;
            transition: var(--transition);
        }

        .toggle-slider::before {
            content: '';
            position: absolute;
            width: 18px;
            height: 18px;
            left: 3px;
            top: 3px;
            background: #fff;
            border-radius: 50%;
            transition: var(--transition);
        }

        .toggle input:checked+.toggle-slider {
            background: var(--accent-gold);
        }

        .toggle input:checked+.toggle-slider::before {
            transform: translateX(20px);
        }

        .avatar-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .avatar-large {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: var(--accent-gold);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .avatar-actions {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .avatar-actions p {
            font-size: 12px;
            color: var(--text-muted);
        }

        /* ── Modal & Toast ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 200;
            backdrop-filter: blur(4px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            border-radius: var(--radius);
            padding: 32px;
            max-width: 400px;
            text-align: center;
            transform: scale(0.9) translateY(20px);
            filter: blur(10px);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .modal-overlay.active .modal {
            transform: scale(1) translateY(0);
            filter: blur(0);
            opacity: 1;
        }

        .modal-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: rgba(248, 113, 113, 0.15);
            color: var(--danger);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .modal-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .modal-desc {
            font-size: 14px;
            color: var(--text-secondary);
            margin-bottom: 24px;
        }

        .modal-actions {
            display: flex;
            gap: 12px;
            justify-content: center;
        }

        .toast {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 14px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-lg);
            z-index: 300;
            transform: translateY(80px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 13px;
            font-weight: 500;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success {
            border-left: 3px solid var(--success);
        }

        .toast.error {
            border-left: 3px solid var(--danger);
        }

        .toast-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* ── Empty States ── */
        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: var(--bg-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: var(--text-muted);
        }

        .empty-state h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--text-secondary);
        }

        .empty-state p {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 20px;
        }

        /* ── Chart legend ── */
        .chart-legend {
            display: flex;
            gap: 20px;
            margin-top: 12px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-secondary);
        }

        .legend-dot {
            width: 10px;
            height: 10px;
            border-radius: 2px;
        }

        /* ── No data placeholder ── */
        .no-data-msg {
            padding: 60px 20px;
            text-align: center;
            color: var(--text-muted);
        }

        .no-data-msg h4 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 6px;
            color: var(--text-secondary);
        }

        @media(max-width:1200px) {

            .metrics-grid,
            .sales-metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .add-sale-layout,
            .add-product-layout,
            .analytics-two-col {
                grid-template-columns: 1fr;
            }

            .settings-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width:768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main {
                margin-left: 0;
            }

            .metrics-grid,
            .cards-grid,
            .sales-metrics-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo" style="gap: 0; align-items: center; display: flex;">
                <div class="logo-icon" style="background: none; width: 44px; height: 44px;">
                    <img src="images/logo.svg" alt="AgroFanema Logo"
                        style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <span
                    style="font-family: 'Cormorant Garamond', serif; font-size: 1.5rem; font-weight: 800; color: #000000; margin-left: -5px; line-height: 1;">AgroFanema</span>
            </div>
        </div>
        <nav class="nav-section">
            <div class="nav-label">Main</div>
            <div class="nav-item active" data-section="overview">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9" rx="1" />
                    <rect x="14" y="3" width="7" height="5" rx="1" />
                    <rect x="14" y="12" width="7" height="9" rx="1" />
                    <rect x="3" y="16" width="7" height="5" rx="1" />
                </svg>
                <span>Overview</span>
            </div>
            <div class="nav-item" data-section="view-products">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 01-8 0" />
                </svg>
                <span>View Products</span>
            </div>
            <div class="nav-item" data-section="add-product">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span>Add Product</span>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-label">Sales</div>
            <div class="nav-item" data-section="add-sale">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" />
                </svg>
                <span>Add Sale</span>
            </div>
            <div class="nav-item" data-section="view-sales">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                    <polyline points="17,6 23,6 23,12" />
                </svg>
                <span>View Sales</span>
            </div>
            <div class="nav-item" data-section="messages">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                </svg>
                <span>Messages</span>
            </div>
            <div class="nav-item" data-section="collaborators">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span>Collaborators</span>
            </div>
            <div class="nav-item" data-section="analytics">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
                <span>Analytics</span>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-label">Account</div>
            <div class="nav-item" data-section="settings">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3" />
                    <path
                        d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                </svg>
                <span>Settings</span>
            </div>
            <div class="nav-item danger" data-section="logout">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                    <polyline points="16,17 21,12 16,7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                <span>Logout</span>
            </div>
            <a href="index.php" class="nav-item"
                style="text-decoration: none; margin-top: auto; border-top: 1px solid var(--border-color); padding-top: 16px;">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span>Return to Home</span>
            </a>
        </nav>
        <div class="user-profile">
            <div class="user-avatar" id="sidebarAvatar">JD</div>
            <div class="user-info">
                <div class="user-name" id="sidebarName">John Doe</div>
                <div class="user-role">Administrator</div>
            </div>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left"></div>
            <div class="topbar-actions">
                <div class="date-label" id="currentDate"
                    style="display: flex; align-items: center; background: var(--bg-primary); padding: 8px 16px; border-radius: 10px; border: 1px solid var(--border-color); margin-right: 8px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="margin-right: 10px; color: var(--accent-gold);">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    <span id="dateText"
                        style="font-weight: 600; font-size: 0.95rem; color: var(--text-secondary); font-family: 'Outfit', sans-serif; letter-spacing: 0.5px;">Loading
                        date...</span>
                </div>
                <div class="time-label" id="currentTime"
                    style="display: flex; align-items: center; background: var(--bg-primary); padding: 8px 16px; border-radius: 10px; border: 1px solid var(--border-color); margin-right: 16px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="margin-right: 10px; color: var(--accent-gold);">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span id="clockText"
                        style="font-weight: 600; font-size: 0.95rem; color: var(--text-secondary); font-family: 'Outfit', sans-serif; letter-spacing: 0.5px;">Loading
                        time...</span>
                </div>
                <div class="user-avatar" style="width:32px;height:32px;font-size:12px;" id="topbarAvatar">JD</div>
            </div>
        </header>

        <div class="content">

            <!-- ── OVERVIEW ── -->
            <div class="section active" id="section-overview">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Dashboard Overview</h1>
                        <p class="page-subtitle" id="overviewDate">Loading...</p>
                    </div>
                    <button class="btn btn-secondary btn-sm" onclick="refreshOverview()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="23,4 23,11 16,11" />
                            <polyline points="1,20 1,13 8,13" />
                            <path d="M3.51 9a9 9 0 0114.85-3.36L23 11M1 13l4.64 4.36A9 9 0 0020.49 15" />
                        </svg>
                        Refresh
                    </button>
                </div>
                <div class="metrics-grid">
                    <div class="metric-card" onclick="switchSection('view-sales')">
                        <div class="metric-header">
                            <div class="metric-icon revenue"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-revenue-trend">0 sales</span>
                        </div>
                        <div class="metric-value" id="ov-revenue">$0.00</div>
                        <div class="metric-label">Total Revenue</div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-sales')">
                        <div class="metric-header">
                            <div class="metric-icon orders"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                    <polyline points="17,6 23,6 23,12" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-units-trend">0 transactions</span>
                        </div>
                        <div class="metric-value" id="ov-units">0</div>
                        <div class="metric-label">Units Sold</div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-products')">
                        <div class="metric-header">
                            <div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-stock-trend">0 products</span>
                        </div>
                        <div class="metric-value" id="ov-stock">0</div>
                        <div class="metric-label">Items in Stock</div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-products')">
                        <div class="metric-header">
                            <div class="metric-icon growth"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-low-trend">warning</span>
                        </div>
                        <div class="metric-value" id="ov-low">0</div>
                        <div class="metric-label">Low Stock Items</div>
                    </div>
                </div>
                <div class="overview-bottom">
                    <div class="activity-card">
                        <div class="activity-header"><span class="activity-title">🏆 Best Sellers</span></div>
                        <div id="ov-best-sellers">
                            <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">No sales
                                yet.</div>
                        </div>
                    </div>
                    <div class="activity-card">
                        <div class="activity-header"><span class="activity-title">📦 Inventory Breakdown</span></div>
                        <div id="ov-inventory">
                            <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">No
                                products added yet.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── VIEW PRODUCTS ── -->
            <div class="section" id="section-view-products">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">View Products</h1>
                        <p class="page-subtitle">Manage your product inventory</p>
                    </div>
                    <button class="btn btn-primary" onclick="switchSection('add-product')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Add Product
                    </button>
                </div>
                <div class="cards-grid" style="margin-bottom:24px;">
                    <div class="metric-card filter-trigger" data-filter="all">
                        <div class="metric-header">
                            <div class="metric-icon revenue"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                                    <line x1="3" y1="6" x2="21" y2="6" />
                                </svg></div>
                        </div>
                        <div class="metric-value" id="totalProductsCount">0</div>
                        <div class="metric-label">Total Products</div>
                    </div>
                    <div class="metric-card filter-trigger" data-filter="active">
                        <div class="metric-header">
                            <div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20,6 9,17 4,12" />
                                </svg></div>
                        </div>
                        <div class="metric-value" id="activeProductsCount">0</div>
                        <div class="metric-label">In Stock</div>
                    </div>
                    <div class="metric-card filter-trigger" data-filter="low-stock">
                        <div class="metric-header">
                            <div class="metric-icon" style="background:rgba(248,113,113,0.15);color:var(--danger);"><svg
                                    width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg></div>
                        </div>
                        <div class="metric-value" id="lowStockCount">0</div>
                        <div class="metric-label">Low Stock</div>
                    </div>
                </div>

                <div class="filter-container" id="categoryFilters"
                    style="display:flex;gap:12px;margin-bottom:32px;overflow-x:auto;padding-bottom:8px;">
                    <div class="filter-pill active" data-category="all">All Categories</div>
                    <div class="filter-pill" data-category="biostimulants">Biostimulants</div>
                    <div class="filter-pill" data-category="crystalline">Crystalline Fertilizers</div>
                    <div class="filter-pill" data-category="granular">Granular Fertilizers</div>
                    <div class="filter-pill" data-category="soil_improvers">Soil Improvers</div>
                </div>

                <div class="product-cards-grid" id="productsGrid"></div>
            </div>

            <!-- ── ADD PRODUCT ── -->
            <div class="section" id="section-add-product">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Add New Product</h1>
                        <p class="page-subtitle">Fill in the details below to add a product to your catalogue.</p>
                    </div>
                </div>
                <form id="productForm">
                    <input type="hidden" name="action" value="add">
                    <div class="add-product-layout">
                        <div class="form-panel">
                            <div class="form-panel-header">
                                <div class="form-panel-header-icon"><svg width="22" height="22" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg></div>
                                <div class="form-panel-header-text">
                                    <h3>Product Details</h3>
                                    <p>Basic information &amp; content</p>
                                </div>
                            </div>
                            <div class="form-panel-body">
                                <div class="form-section-divider"><span>Product Names</span></div>
                                <div class="lang-tabs" id="nameLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 Albanian</button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 English</button>
                                </div>
                                <div class="lang-content active" id="name-sq-content">
                                    <div class="form-group"><label class="form-label">Product Name
                                            (Albanian)</label><input type="text" name="name_sq" id="name_sq"
                                            class="form-input" placeholder="p.sh. Pleh Granular Premium" required></div>
                                </div>
                                <div class="lang-content" id="name-en-content">
                                    <div class="form-group"><label class="form-label">Product Name
                                            (English)</label><input type="text" name="name_en" id="name_en"
                                            class="form-input" placeholder="e.g. Premium Granular Fertilizer" required>
                                    </div>
                                </div>
                                <div class="form-section-divider"><span>Descriptions</span></div>
                                <div class="lang-tabs" id="descLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 Albanian</button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 English</button>
                                </div>
                                <div class="lang-content active" id="desc-sq-content">
                                    <div class="form-group"><label class="form-label">Description
                                            (Albanian)</label><textarea name="desc_sq" id="desc_sq" class="form-input"
                                            style="height:90px;resize:vertical;"
                                            placeholder="Shkruani përshkrimin..."></textarea></div>
                                </div>
                                <div class="lang-content" id="desc-en-content">
                                    <div class="form-group"><label class="form-label">Description
                                            (English)</label><textarea name="desc_en" id="desc_en" class="form-input"
                                            style="height:90px;resize:vertical;"
                                            placeholder="Write a product description..."></textarea></div>
                                </div>
                                <div class="form-section-divider"><span>Product Image</span></div>
                                <div class="image-upload-zone" id="uploadZone">
                                    <input type="file" name="image" id="image" accept="image/*"
                                        onchange="handleImagePreview(event)">
                                    <div id="uploadPlaceholder">
                                        <div class="upload-icon"><svg width="26" height="26" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21,15 16,10 5,21" />
                                            </svg></div>
                                        <div class="upload-title">Drop image or click to browse</div>
                                        <div class="upload-sub">PNG, JPG, WEBP up to 5MB</div>
                                    </div>
                                    <div class="upload-preview" id="uploadPreview"><img id="previewImg" src=""
                                            alt="Preview"><button type="button" class="upload-preview-remove"
                                            onclick="removePreview()">✕</button></div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary" id="saveProductBtn">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                                            <polyline points="17,21 17,13 7,13 7,21" />
                                            <polyline points="7,3 7,8 15,8" />
                                        </svg>
                                        Save Product
                                    </button>
                                    <button type="button" class="btn btn-secondary"
                                        id="cancelProductBtn">Cancel</button>
                                </div>
                            </div>
                        </div>
                        <div class="product-sidebar-panel">
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>Category</div>
                                <div class="sidebar-widget-body">
                                    <div class="category-grid" id="categoryGrid">
                                        <label class="category-option selected"><input type="radio" name="category"
                                                value="biostimulants" checked>
                                            <div class="category-option-icon">🧬</div>
                                            <div class="category-option-name">Biostimulants</div>
                                            <div class="category-option-desc">Growth enhancers</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="crystalline">
                                            <div class="category-option-icon">💎</div>
                                            <div class="category-option-name">Crystalline Fertilizers</div>
                                            <div class="category-option-desc">Soluble crystals</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="granular">
                                            <div class="category-option-icon">🌾</div>
                                            <div class="category-option-name">Granular Fertilizers</div>
                                            <div class="category-option-desc">Dry granules</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="soil_improvers">
                                            <div class="category-option-icon">🪴</div>
                                            <div class="category-option-name">Soil Improvers</div>
                                            <div class="category-option-desc">Structure & Health</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                    </svg>Stock Quantity</div>
                                <div class="sidebar-widget-body">
                                    <p style="font-size:13px;color:var(--text-muted);margin-bottom:14px;">Set the
                                        available stock for this product.</p>
                                    <div class="qty-control"><button type="button" class="qty-btn"
                                            id="qtyMinus">−</button><input type="number" name="quantity" id="quantity"
                                            class="qty-input" value="0" min="0"><button type="button" class="qty-btn"
                                            id="qtyPlus">+</button></div>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="12" r="10" />
                                        <line x1="12" y1="8" x2="12" y2="12" />
                                        <line x1="12" y1="16" x2="12.01" y2="16" />
                                    </svg>Tips</div>
                                <div class="sidebar-widget-body" style="display:flex;flex-direction:column;gap:10px;">
                                    <p style="font-size:12px;color:var(--text-secondary);line-height:1.6;">• Add names
                                        in both Albanian and English for multilingual support.</p>
                                    <p style="font-size:12px;color:var(--text-secondary);line-height:1.6;">• Images
                                        should be at least 600×600px for best quality.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- ── ADD SALE ── -->
            <div class="section" id="section-add-sale">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Add Sale</h1>
                        <p class="page-subtitle">Record a new product sale</p>
                    </div>
                </div>
                <div class="sales-metrics-grid">
                    <div class="sales-metric-card sold">
                        <div class="smc-top">
                            <div class="smc-icon sold"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                    <polyline points="17,6 23,6 23,12" />
                                </svg></div><span class="smc-badge">All time</span>
                        </div>
                        <div class="smc-value" id="totalUnitsSold">0</div>
                        <div class="smc-label">Total Units Sold</div>
                    </div>
                    <div class="sales-metric-card profit">
                        <div class="smc-top">
                            <div class="smc-icon profit"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                                </svg></div><span class="smc-badge">Revenue</span>
                        </div>
                        <div class="smc-value" id="totalProfit">$0.00</div>
                        <div class="smc-label">Total Revenue</div>
                    </div>
                    <div class="sales-metric-card stock">
                        <div class="smc-top">
                            <div class="smc-icon stock"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                </svg></div><span class="smc-badge">Inventory</span>
                        </div>
                        <div class="smc-value" id="totalStockRemaining">0</div>
                        <div class="smc-label">Items in Stock</div>
                    </div>
                </div>
                <div class="add-sale-layout">
                    <div class="sale-form-card">
                        <div class="sale-form-header">
                            <div class="sale-form-header-icon"><svg width="20" height="20" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg></div>
                            <div>
                                <h3>Record a Sale</h3>
                                <p>Select a product and enter quantity</p>
                            </div>
                        </div>
                        <div class="sale-form-body">
                            <div class="form-group" style="margin-bottom:12px;">
                                <label class="form-label">Choose Product</label>
                                <div class="search-input-wrap">
                                    <input type="text" id="salesProductSearch" class="form-input"
                                        placeholder="Search products by name or category..." autocomplete="off">
                                    <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </div>
                            <div class="product-selector" id="salesProductSelector">
                                <div
                                    style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">
                                    Loading products…</div>
                            </div>
                            <div class="form-section-divider" style="margin:16px 0 14px;"><span>Sale Details</span>
                            </div>
                            <div class="sale-qty-row">
                                <div class="form-group"><label class="form-label">Quantity Sold</label>
                                    <div class="qty-control"><button type="button" class="qty-btn"
                                            id="saleQtyMinus">−</button><input type="number" id="saleQty"
                                            class="qty-input" value="1" min="1"><button type="button" class="qty-btn"
                                            id="saleQtyPlus">+</button></div>
                                </div>
                                <div class="form-group"><label class="form-label">Unit Price (optional)</label><input
                                        type="number" id="salePrice" class="form-input" placeholder="0.00" min="0"
                                        step="0.01"></div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;margin-top:4px;"><label
                                    class="form-label">Note (optional)</label><input type="text" id="saleNote"
                                    class="form-input" placeholder="e.g. Wholesale order, cash payment..."></div>
                            <div style="margin-top:20px;">
                                <button type="button" class="btn btn-primary" style="width:100%;justify-content:center;"
                                    onclick="recordSale()">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <polyline points="20,6 9,17 4,12" />
                                    </svg>
                                    Record Sale
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="recent-sales-card">
                        <div class="rsw-header">Recent Sales</div>
                        <div id="recentSalesList">
                            <div class="rsw-empty">No sales recorded yet.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── VIEW SALES ── -->
            <div class="section" id="section-view-sales">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">View Sales</h1>
                        <p class="page-subtitle">Browse and manage all your recorded sales</p>
                    </div>
                    <button class="btn btn-danger btn-sm" onclick="clearSalesHistory()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="3,6 5,6 21,6" />
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        </svg>
                        Clear All
                    </button>
                </div>
                <div class="sales-metrics-grid" style="margin-bottom:20px;">
                    <div class="sales-metric-card sold">
                        <div class="smc-top">
                            <div class="smc-icon sold"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                </svg></div>
                        </div>
                        <div class="smc-value" id="vs-units">0</div>
                        <div class="smc-label">Total Units Sold</div>
                    </div>
                    <div class="sales-metric-card profit">
                        <div class="smc-top">
                            <div class="smc-icon profit"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                                </svg></div>
                        </div>
                        <div class="smc-value" id="vs-revenue">$0.00</div>
                        <div class="smc-label">Total Revenue</div>
                    </div>
                    <div class="sales-metric-card stock">
                        <div class="smc-top">
                            <div class="smc-icon stock"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="1" y="4" width="22" height="16" rx="2" />
                                    <line x1="1" y1="10" x2="23" y2="10" />
                                </svg></div>
                        </div>
                        <div class="smc-value" id="vs-count">0</div>
                        <div class="smc-label">Total Transactions</div>
                    </div>
                </div>
                <!-- Filters -->
                <div class="view-sales-filters">
                    <div class="filter-chip active" data-vsfilter="all">All</div>
                    <div class="filter-chip" data-vsfilter="granular">🌾 Granular</div>
                    <div class="filter-chip" data-vsfilter="liquid">💧 Liquid</div>
                    <div class="filter-chip" data-vsfilter="organic">🌿 Organic</div>
                    <div class="filter-chip" data-vsfilter="specialty">⭐ Specialty</div>
                    <input type="text" id="salesSearch" class="form-input search-inline"
                        placeholder="🔍 Search sales..." oninput="renderSalesTable()">
                </div>
                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title">Sales History <span class="sales-count-badge"
                                id="salesCountBadge">0</span></div>
                    </div>
                    <div id="salesTableContainer">
                        <div class="sales-empty">
                            <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                    <polyline points="17,6 23,6 23,12" />
                                </svg></div>
                            <h4>No Sales Yet</h4>
                            <p>Go to <strong>Add Sale</strong> to record your first sale.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── COLLABORATORS ── -->
            <div class="section" id="section-collaborators">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Collaborator Companies</h1>
                        <p class="page-subtitle">Manage companies that collaborate with AgroFanema</p>
                    </div>
                    <div style="display:flex; gap:12px;">
                        <button class="btn btn-primary btn-sm" onclick="showAddCollaboratorModal()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Add Collaborator
                        </button>
                    </div>
                </div>

                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title">Collaborators <span class="sales-count-badge"
                                id="collaboratorCountBadge">0</span></div>
                    </div>
                    <div id="collaboratorsTableContainer" style="overflow-x:auto;">
                        <!-- Collaborators table will be rendered here -->
                        <div class="sales-empty">
                            <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg></div>
                            <h4>No Collaborators Yet</h4>
                            <p>Add companies that collaborate with AgroFanema.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ANALYTICS ── -->
            <div class="section" id="section-analytics">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Analytics</h1>
                        <p class="page-subtitle">Visual insights from your actual sales data</p>
                    </div>
                </div>

                <!-- Monthly Sales Bar Chart -->
                <div class="analytics-card">
                    <div class="analytics-card-header">
                        <h3 class="analytics-card-title">📈 Monthly Sales Revenue</h3>
                        <div style="display:flex;gap:16px;">
                            <div class="chart-legend">
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:var(--accent-gold);"></div>Revenue
                                </div>
                                <div class="legend-item">
                                    <div class="legend-dot" style="background:var(--info);border-radius:50%;"></div>
                                    Units
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monthlySalesChart" style="min-height:240px;"></div>
                    <div id="monthlySalesEmpty" class="no-data-msg" style="display:none;">
                        <h4>No sales data yet</h4>
                        <p>Record some sales to see your monthly performance chart.</p>
                    </div>
                </div>

                <!-- Category Pie + Top Products -->
                <div class="analytics-two-col">
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title">🥧 Sales by Category</h3>
                        </div>
                        <div id="categoryPieWrap">
                            <div class="no-data-msg">
                                <h4>No sales data yet</h4>
                                <p>Record sales to see category breakdown.</p>
                            </div>
                        </div>
                    </div>
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title">🏆 Top Products by Units</h3>
                        </div>
                        <div id="topProductsChart">
                            <div class="no-data-msg">
                                <h4>No sales data yet</h4>
                                <p>Record sales to see your top performers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="metrics-grid" style="margin-top:20px;margin-bottom:0;" id="analyticsSummary"></div>
            </div>

            <!-- ── MESSAGES ── -->
            <div class="section" id="section-messages">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Inquiry Messages</h1>
                        <p class="page-subtitle">Manage messages from the contact form</p>
                    </div>
                    <div style="display:flex; gap:12px;">
                        <button class="btn btn-secondary btn-sm" onclick="clearAllMessages()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </polyline>
                            </svg>
                            Clear All
                        </button>
                    </div>
                </div>

                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title">Recent Inquiries <span class="sales-count-badge"
                                id="messageCountBadge">0</span></div>
                    </div>
                    <div id="messagesTableContainer" style="overflow-x:auto;">
                        <!-- Messages table will be rendered here -->
                        <div class="sales-empty">
                            <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                    <polyline points="22,6 12,13 2,6" />
                                </svg></div>
                            <h4>No Messages Yet</h4>
                            <p>Inquiries from the website will appear here.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── SETTINGS ── -->
            <div class="section" id="section-settings">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Settings</h1>
                        <p class="page-subtitle">Manage your dashboard preferences</p>
                    </div>
                </div>
                <div class="settings-content" style="max-width: 800px; margin: 0 auto;">
                    <!-- Appearance Section -->
                    <div class="settings-section">
                        <h3 class="settings-section-title">Appearance</h3>
                        <div class="toggle-row">
                            <div class="toggle-label">
                                <div class="toggle-label-title">Dark Mode</div>
                                <div class="toggle-label-desc">Switch between light and dark themes</div>
                            </div>
                            <label class="toggle">
                                <input type="checkbox" id="settingsThemeToggle">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>

                    <!-- Danger Zone Section -->
                    <div class="settings-section" style="margin-top: 48px;">
                        <h3 class="settings-section-title"
                            style="color:var(--danger); border-color: rgba(239,68,68,0.2);">Danger Zone</h3>
                        <div
                            style="border:1px solid rgba(239,68,68,0.3); border-radius:12px; overflow:hidden; background: rgba(239,68,68,0.02);">
                            <div
                                style="padding:20px; border-bottom:1px solid rgba(239,68,68,0.1); display:flex; align-items:center; justify-content:space-between;">
                                <div>
                                    <div style="font-size:14px; font-weight:600;">Clear All Sales Data</div>
                                    <div style="font-size:12px; color:var(--text-muted);">Permanently delete all
                                        recorded sales history</div>
                                </div>
                                <button class="btn btn-danger btn-sm" onclick="clearSalesHistory()">Clear Data</button>
                            </div>
                            <div style="padding:20px; display:flex; align-items:center; justify-content:space-between;">
                                <div>
                                    <div style="font-size:14px; font-weight:600;">Delete All Products</div>
                                    <div style="font-size:12px; color:var(--text-muted);">Remove every product from your
                                        inventory</div>
                                </div>
                                <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm('Delete ALL products? This cannot be undone.')){products=[];saveProducts();renderProducts();renderSalesProductSelector();updateAllMetrics();showToast('All products deleted','error');}">Delete
                                    All</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>

    <!-- Logout Modal -->
    <!-- Edit Product Modal -->
    <div class="modal-overlay" id="editProductModal">
        <div class="modal" style="max-width:1000px; width:95%; padding:0; overflow:hidden;">
            <div class="modal-header"
                style="padding:20px 30px; background:var(--bg-secondary); border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center;">
                <div>
                    <h2 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; color:var(--text-primary);">
                        Edit Product</h2>
                    <p style="font-size:13px; color:var(--text-muted);" id="editModalSubtitle">Update product
                        information</p>
                </div>
                <button class="btn-close" onclick="closeEditModal()"
                    style="background:none; border:none; color:var(--text-muted); cursor:pointer;"><svg width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg></button>
            </div>
            <div class="modal-body" style="padding:0; max-height:80vh; overflow-y:auto;">
                <form id="editProductForm">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editProductId">
                    <div class="add-product-layout" style="padding:30px; gap:30px; grid-template-columns: 1.5fr 1fr;">
                        <div class="form-panel" style="background:none; border:none; padding:0; box-shadow:none;">
                            <div class="form-panel-body" style="padding:0;">
                                <div class="form-section-divider" style="margin-top:0;"><span>Product Names</span></div>
                                <div class="lang-tabs" id="editNameLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 Albanian</button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 English</button>
                                </div>
                                <div class="lang-content active" id="edit-name-sq-content">
                                    <div class="form-group"><label class="form-label">Product Name
                                            (Albanian)</label><input type="text" name="name_sq" id="edit_name_sq"
                                            class="form-input" required></div>
                                </div>
                                <div class="lang-content" id="edit-name-en-content">
                                    <div class="form-group"><label class="form-label">Product Name
                                            (English)</label><input type="text" name="name_en" id="edit_name_en"
                                            class="form-input" required></div>
                                </div>

                                <div class="form-section-divider"><span>Descriptions</span></div>
                                <div class="lang-tabs" id="editDescLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 Albanian</button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 English</button>
                                </div>
                                <div class="lang-content active" id="edit-desc-sq-content">
                                    <div class="form-group"><label class="form-label">Description
                                            (Albanian)</label><textarea name="desc_sq" id="edit_desc_sq"
                                            class="form-input" style="height:90px;resize:vertical;"></textarea></div>
                                </div>
                                <div class="lang-content" id="edit-desc-en-content">
                                    <div class="form-group"><label class="form-label">Description
                                            (English)</label><textarea name="desc_en" id="edit_desc_en"
                                            class="form-input" style="height:90px;resize:vertical;"></textarea></div>
                                </div>

                                <div class="form-section-divider"><span>Product Image</span></div>
                                <div class="image-upload-zone" id="editUploadZone">
                                    <input type="file" name="image" id="editImageInput" accept="image/*"
                                        onchange="handleEditImagePreview(event)">
                                    <div id="editUploadPlaceholder">
                                        <div class="upload-icon"><svg width="26" height="26" viewBox="0 0 24 24"
                                                fill="none" stroke="currentColor" stroke-width="2">
                                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                                <circle cx="8.5" cy="8.5" r="1.5" />
                                                <polyline points="21,15 16,10 5,21" />
                                            </svg></div>
                                        <div class="upload-title">Click to change image</div>
                                    </div>
                                    <div class="upload-preview" id="editUploadPreview"><img id="editPreviewImg" src=""
                                            alt="Preview"><button type="button" class="upload-preview-remove"
                                            onclick="removeEditPreview()">✕</button></div>
                                </div>
                            </div>
                        </div>
                        <div class="product-sidebar-panel">
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M4 6h16M4 12h16M4 18h7" />
                                    </svg>Category</div>
                                <div class="sidebar-widget-body">
                                    <div class="category-grid" id="editCategoryGrid">
                                        <label class="category-option"><input type="radio" name="category"
                                                value="biostimulants">
                                            <div class="category-option-icon">🧬</div>
                                            <div class="category-option-name">Biostimulants</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="crystalline">
                                            <div class="category-option-icon">💎</div>
                                            <div class="category-option-name">Crystalline Fertilizers</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="granular">
                                            <div class="category-option-icon">🌾</div>
                                            <div class="category-option-name">Granular Fertilizers</div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="soil_improvers">
                                            <div class="category-option-icon">🪴</div>
                                            <div class="category-option-name">Soil Improvers</div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                    </svg>Stock Quantity</div>
                                <div class="sidebar-widget-body">
                                    <div class="qty-control"><button type="button" class="qty-btn"
                                            onclick="adjustEditQty(-1)">−</button><input type="number" name="quantity"
                                            id="edit_quantity" class="qty-input" value="0" min="0"><button type="button"
                                            class="qty-btn" onclick="adjustEditQty(1)">+</button></div>
                                </div>
                            </div>
                            <div
                                style="margin-top:auto; padding-top:20px; display:flex; flex-direction:column; gap:12px;">
                                <button type="submit" class="btn btn-primary"
                                    style="width:100%; justify-content:center;">Save Changes</button>
                                <button type="button" class="btn btn-secondary" onclick="closeEditModal()"
                                    style="width:100%; justify-content:center;">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal-overlay" id="logoutModal">
        <div class="modal">
            <div class="modal-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                    <polyline points="16,17 21,12 16,7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg></div>
            <div class="modal-title">Sign Out</div>
            <div class="modal-desc">Are you sure you want to sign out of the dashboard?</div>
            <div class="modal-actions">
                <button class="btn btn-secondary"
                    onclick="document.getElementById('logoutModal').classList.remove('active')">Cancel</button>
                <button class="btn btn-danger" onclick="window.location.href='login.php?logout=1'">Sign Out</button>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast">
        <svg class="toast-icon" id="toastIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="20,6 9,17 4,12" />
        </svg>
        <span id="toastMsg">Saved!</span>
    </div>

    <script>
        /* ═══════════════════════════════════════════════════
           PERSISTENCE
        ═══════════════════════════════════════════════════ */
        const STORAGE_KEYS = {
            sales: 'agro_sales_v2',
            products: 'agro_products_v2'
        };

        function loadFromStorage(key, fallback = []) {
            try {
                const raw = localStorage.getItem(key);
                if (!raw) return fallback;
                const parsed = JSON.parse(raw);
                return Array.isArray(parsed) ? parsed : fallback;
            } catch {
                return fallback;
            }
        }

        function saveToStorage(key, data) {
            try {
                localStorage.setItem(key, JSON.stringify(data));
            } catch (e) {
                console.error('Storage error', e);
            }
        }

        /* ═══════════════════════════════════════════════════
           STATE — start completely empty (no demo data)
        ═══════════════════════════════════════════════════ */
        let products = loadFromStorage(STORAGE_KEYS.products);
        let salesHistory = loadFromStorage(STORAGE_KEYS.sales);
        let selectedSaleProductId = null;
        let nextProductId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
        let vsFilter = 'all';

        function saveProducts() {
            saveToStorage(STORAGE_KEYS.products, products);
        }

        function saveSales() {
            saveToStorage(STORAGE_KEYS.sales, salesHistory);
        }

        /* ═══════════════════════════════════════════════════
           TOAST
        ═══════════════════════════════════════════════════ */
        function showToast(msg, type = 'success') {
            const t = document.getElementById('toast');
            const icon = document.getElementById('toastIcon');
            document.getElementById('toastMsg').textContent = msg;
            t.className = `toast ${type}`;
            icon.innerHTML = type === 'success' ? '<polyline points="20,6 9,17 4,12"/>' : '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>';
            t.classList.add('show');
            setTimeout(() => t.classList.remove('show'), 3000);
        }

        /* ═══════════════════════════════════════════════════
           NAVIGATION
        ═══════════════════════════════════════════════════ */
        function switchSection(id) {
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            const nav = document.querySelector(`.nav-item[data-section="${id}"]`);
            if (nav) nav.classList.add('active');
            document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
            const target = document.getElementById(`section-${id}`);
            if (target) {
                target.classList.add('active');
                window.scrollTo(0, 0);
            }
            if (id === 'overview') updateOverviewMetrics();
            if (id === 'analytics') renderAnalytics();
            if (id === 'add-sale') {
                renderSalesProductSelector();
                renderRecentSales();
                updateSalesMetrics();
            }
            if (id === 'view-sales') renderSalesTable();
            if (id === 'messages') renderMessagesTable();
            if (id === 'collaborators') renderCollaboratorsTable();
            if (id === 'add-product') resetProductForm();
        }

        document.querySelectorAll('.nav-item[data-section]').forEach(item => {
            item.addEventListener('click', function () {
                const s = this.dataset.section;
                if (s === 'logout') {
                    document.getElementById('logoutModal').classList.add('active');
                    return;
                }
                switchSection(s);
            });
        });

        /* ═══════════════════════════════════════════════════
           THEME
        ═══════════════════════════════════════════════════ */
        let dark = localStorage.getItem('admin-theme') === 'dark';
        const themeIcon = document.getElementById('theme-icon');
        const moonSVG = '<path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>';
        const sunSVG = '<circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>';

        function applyTheme() {
            document.documentElement.setAttribute('data-theme', dark ? 'dark' : 'light');
            if (themeIcon) themeIcon.innerHTML = dark ? moonSVG : sunSVG;
            const st = document.getElementById('settingsThemeToggle');
            if (st) st.checked = dark;
            localStorage.setItem('admin-theme', dark ? 'dark' : 'light');
        }
        document.getElementById('settingsThemeToggle')?.addEventListener('change', function () {
            dark = this.checked;
            applyTheme();
        });
        applyTheme();

        /* ═══════════════════════════════════════════════════
           LIVE CLOCK
        ═══════════════════════════════════════════════════ */
        function updateClock() {
            const clockEl = document.getElementById('clockText');
            const dateEl = document.getElementById('dateText');
            if (!clockEl || !dateEl) return;
            const now = new Date();
            const timeStr = now.toLocaleTimeString('en-US', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            clockEl.textContent = timeStr;
            dateEl.textContent = now.toLocaleDateString('en-US', {
                weekday: 'short',
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
        }
        setInterval(updateClock, 1000);
        updateClock();

        /* ═══════════════════════════════════════════════════
           SETTINGS TABS
        ═══════════════════════════════════════════════════ */
        function saveProfile() {
            const fn = document.getElementById('settingsFirstName').value;
            const ln = document.getElementById('settingsLastName').value;
            const full = `${fn} ${ln}`.trim();
            const initials = ((fn[0] || '') + (ln[0] || '')).toUpperCase();
            ['sidebarName'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = full;
            });
            ['sidebarAvatar', 'topbarAvatar', 'settingsAvatar'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = initials;
            });
            showToast('Profile updated', 'success');
        }

        /* ═══════════════════════════════════════════════════
           LANG TABS
        ═══════════════════════════════════════════════════ */
        function setupLangTabs(tabsId, prefix) {
            const tabs = document.getElementById(tabsId);
            if (!tabs) return;
            tabs.querySelectorAll('.lang-tab').forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.querySelectorAll('.lang-tab').forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    const lang = this.dataset.lang;
                    document.querySelectorAll(`[id^="${prefix}-"][id$="-content"]`).forEach(c => c.classList.remove('active'));
                    const target = document.getElementById(`${prefix}-${lang}-content`);
                    if (target) target.classList.add('active');
                });
            });
        }
        setupLangTabs('nameLangTabs', 'name');
        setupLangTabs('descLangTabs', 'desc');

        /* ═══════════════════════════════════════════════════
           CATEGORY SELECTOR
        ═══════════════════════════════════════════════════ */
        document.querySelectorAll('.category-option').forEach(opt => {
            opt.addEventListener('click', function () {
                document.querySelectorAll('.category-option').forEach(o => o.classList.remove('selected'));
                this.classList.add('selected');
                this.querySelector('input[type="radio"]').checked = true;
            });
        });

        /* ═══════════════════════════════════════════════════
           QTY CONTROLS
        ═══════════════════════════════════════════════════ */
        document.getElementById('qtyMinus').addEventListener('click', () => {
            const i = document.getElementById('quantity');
            i.value = Math.max(0, (+i.value || 0) - 1);
        });
        document.getElementById('qtyPlus').addEventListener('click', () => {
            const i = document.getElementById('quantity');
            i.value = (+i.value || 0) + 1;
        });
        document.getElementById('saleQtyMinus').addEventListener('click', () => {
            const i = document.getElementById('saleQty');
            i.value = Math.max(1, (+i.value || 1) - 1);
        });
        document.getElementById('saleQtyPlus').addEventListener('click', () => {
            const i = document.getElementById('saleQty');
            i.value = (+i.value || 0) + 1;
        });

        /* ═══════════════════════════════════════════════════
           IMAGE UPLOAD
        ═══════════════════════════════════════════════════ */
        function handleImagePreview(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('uploadPlaceholder').style.display = 'none';
                document.getElementById('uploadPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function removePreview() {
            document.getElementById('image').value = '';
            document.getElementById('previewImg').src = '';
            document.getElementById('uploadPlaceholder').style.display = 'block';
            document.getElementById('uploadPreview').style.display = 'none';
        }
        const zone = document.getElementById('uploadZone');
        zone.addEventListener('dragover', e => {
            e.preventDefault();
            zone.classList.add('dragover');
        });
        zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
        zone.addEventListener('drop', e => {
            e.preventDefault();
            zone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                document.getElementById('image').files = dt.files;
                handleImagePreview({
                    target: {
                        files: [file]
                    }
                });
            }
        });

        /* ═══════════════════════════════════════════════════
           MESSAGES (CONTACT FORM)
        ═══════════════════════════════════════════════════ */
        let messages = loadFromStorage('agro_messages_v2');

        function saveMessages() {
            saveToStorage('agro_messages_v2', messages);
        }

        function renderMessagesTable() {
            const container = document.getElementById('messagesTableContainer');
            const badge = document.getElementById('messageCountBadge');
            if (!container) return;

            if (badge) badge.textContent = messages.length;

            if (messages.length === 0) {
                container.innerHTML = `
                    <div class="sales-empty">
                        <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg></div>
                        <h4>No Messages Yet</h4>
                        <p>Inquiries from the website will appear here.</p>
                    </div>`;
                return;
            }

            container.innerHTML = `
                <table>
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${messages.map(m => `
                            <tr style="${m.read ? 'opacity:0.7;' : 'font-weight:600; background:rgba(200,168,75,0.03);'}">
                                <td>
                                    <span class="status-pill ${m.read ? 'inactive' : 'active'}" style="font-size:10px; padding:2px 8px;">
                                        <span class="status-dot"></span>${m.read ? 'Read' : 'New'}
                                    </span>
                                </td>
                                <td>${m.name}</td>
                                <td><a href="mailto:${m.email}" style="color:var(--accent-gold); text-decoration:none;">${m.email}</a></td>
                                <td><a href="tel:${m.phone}" style="color:var(--accent-gold); text-decoration:none;">${m.phone || '—'}</a></td>
                                <td>${m.subject || '—'}</td>
                                <td style="max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:var(--text-muted); font-size:13px;" title="${m.message}">
                                    ${m.message}
                                </td>
                                <td style="font-size:12px; color:var(--text-muted); white-space:nowrap;">${m.date}</td>
                                <td>
                                    <div style="display:flex; gap:8px;">
                                        <button class="btn btn-danger btn-sm btn-icon" onclick="deleteMessage('${m.id}')" title="Delete Message">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;
        }

        function toggleMessageRead(id) {
            const msg = messages.find(m => m.id === id);
            if (msg) {
                msg.read = !msg.read;
                saveMessages();
                renderMessagesTable();
            }
        }

        function deleteMessage(id) {
            if (!confirm('Delete this message?')) return;
            messages = messages.filter(m => m.id !== id);
            saveMessages();
            renderMessagesTable();
            showToast('Message deleted', 'error');
        }

        function clearAllMessages() {
            if (!confirm('Delete ALL messages? This cannot be undone.')) return;
            messages = [];
            saveMessages();
            renderMessagesTable();
            showToast('All messages deleted', 'error');
        }

        /* ═══════════════════════════════════════════════════
           COLLABORATORS
        ═══════════════════════════════════════════════════ */
        let collaborators = [];

        async function fetchCollaborators() {
            try {
                const r = await fetch('essentials/collaborator-api.php?action=list');
                const d = await r.json();
                if (d.success) {
                    collaborators = d.collaborators;
                }
            } catch (err) {
                console.error('Error fetching collaborators:', err);
            }
            renderCollaboratorsTable();
        }

        // Initialize collaborators
        fetchCollaborators();

        function renderCollaboratorsTable() {
            const container = document.getElementById('collaboratorsTableContainer');
            const badge = document.getElementById('collaboratorCountBadge');
            if (!container) return;

            if (badge) badge.textContent = collaborators.length;

            if (collaborators.length === 0) {
                container.innerHTML = `
                    <div class="sales-empty">
                        <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg></div>
                        <h4>No Collaborators Yet</h4>
                        <p>Add companies that collaborate with AgroFanema.</p>
                    </div>`;
                return;
            }

            container.innerHTML = `
                <table>
                    <thead>
                        <tr>
                            <th>Logo</th>
                            <th>Company Name</th>
                            <th>Description</th>
                            <th>Website</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${collaborators.map(c => `
                            <tr>
                                <td><img src="${c.logo}" alt="${c.name}" style="width:40px; height:40px; object-fit:contain; border-radius:4px;"></td>
                                <td>${c.name}</td>
                                <td style="max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:var(--text-muted); font-size:13px;" title="${c.description || ''}">${c.description || '—'}</td>
                                <td><a href="${c.website}" target="_blank" style="color:var(--accent-gold); text-decoration:none;">${c.website}</a></td>
                                <td>
                                    <div style="display:flex; gap:8px;">
                                        <button class="btn btn-secondary btn-sm btn-icon" onclick="editCollaborator('${c.id}')" title="Edit Collaborator">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                        </button>
                                        <button class="btn btn-danger btn-sm btn-icon" onclick="deleteCollaborator('${c.id}')" title="Delete Collaborator">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;
        }

        function showAddCollaboratorModal() {
            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal" style="max-width:500px;">
                    <div class="modal-header" style="padding:20px 30px; background:var(--bg-secondary); border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <h2 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; color:var(--text-primary);">Add Collaborator</h2>
                            <p style="font-size:13px; color:var(--text-muted);">Add a new collaborator company</p>
                        </div>
                        <button class="btn-close" onclick="this.closest('.modal-overlay').remove()" style="background:none; border:none; color:var(--text-muted); cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
                    </div>
                    <div class="modal-body" style="padding:30px;">
                        <form id="collaboratorForm">
                            <input type="hidden" name="action" value="add">
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Company Name *</label>
                                <input type="text" name="name" required style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Description</label>
                                <textarea name="description" rows="3" style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary); resize:vertical;"></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Website URL *</label>
                                <input type="url" name="website" required placeholder="https://example.com" style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Logo Image *</label>
                                <input type="file" name="logo" accept="image/*" required style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="padding:20px 30px; background:var(--bg-secondary); border-top:1px solid var(--border-color); display:flex; justify-content:flex-end; gap:12px;">
                        <button class="btn btn-secondary" onclick="this.closest('.modal-overlay').remove()">Cancel</button>
                        <button class="btn btn-primary" onclick="saveCollaborator()">Add Collaborator</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('active'), 10);
        }

        function editCollaborator(id) {
            const collab = collaborators.find(c => c.id === id);
            if (!collab) return;

            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.innerHTML = `
                <div class="modal" style="max-width:500px;">
                    <div class="modal-header" style="padding:20px 30px; background:var(--bg-secondary); border-bottom:1px solid var(--border-color); display:flex; justify-content:space-between; align-items:center;">
                        <div>
                            <h2 style="font-family:'Cormorant Garamond',serif; font-size:1.8rem; color:var(--text-primary);">Edit Collaborator</h2>
                            <p style="font-size:13px; color:var(--text-muted);">Update collaborator information</p>
                        </div>
                        <button class="btn-close" onclick="this.closest('.modal-overlay').remove()" style="background:none; border:none; color:var(--text-muted); cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
                    </div>
                    <div class="modal-body" style="padding:30px;">
                        <form id="collaboratorForm">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="${id}">
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Company Name *</label>
                                <input type="text" name="name" value="${collab.name}" required style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Description</label>
                                <textarea name="description" rows="3" style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary); resize:vertical;">${collab.description || ''}</textarea>
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Website URL *</label>
                                <input type="url" name="website" value="${collab.website}" required style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                            </div>
                            <div class="form-group" style="margin-bottom:20px;">
                                <label style="display:block; font-weight:500; margin-bottom:8px; color:var(--text-primary);">Logo Image (leave empty to keep current)</label>
                                <input type="file" name="logo" accept="image/*" style="width:100%; padding:12px; border:1px solid var(--border-color); border-radius:8px; background:var(--bg-elevated); color:var(--text-primary);">
                                <div style="margin-top:8px;"><img src="${collab.logo}" alt="Current Logo" style="height:30px; object-fit:contain; border-radius:4px; opacity:0.6;"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="padding:20px 30px; background:var(--bg-secondary); border-top:1px solid var(--border-color); display:flex; justify-content:flex-end; gap:12px;">
                        <button class="btn btn-secondary" onclick="this.closest('.modal-overlay').remove()">Cancel</button>
                        <button class="btn btn-primary" onclick="updateCollaborator()">Update Collaborator</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('active'), 10);
        }

        async function saveCollaborator() {
            const form = document.getElementById('collaboratorForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);
            try {
                const res = await fetch('essentials/collaborator-api.php', {
                    method: 'POST',
                    body: formData
                });
                const d = await res.json();
                if (d.success) {
                    await fetchCollaborators();
                    document.querySelector('.modal-overlay').remove();
                    showToast('Collaborator added successfully', 'success');
                } else {
                    showToast(d.error || 'Error adding collaborator', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast('Server error', 'error');
            }
        }

        async function updateCollaborator() {
            const form = document.getElementById('collaboratorForm');
            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);
            try {
                const res = await fetch('essentials/collaborator-api.php', {
                    method: 'POST',
                    body: formData
                });
                const d = await res.json();
                if (d.success) {
                    await fetchCollaborators();
                    document.querySelector('.modal-overlay').remove();
                    showToast('Collaborator updated successfully', 'success');
                } else {
                    showToast(d.error || 'Error updating collaborator', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast('Server error', 'error');
            }
        }

        async function deleteCollaborator(id) {
            if (!confirm('Delete this collaborator?')) return;
            const formData = new FormData();
            formData.append('action', 'delete');
            formData.append('id', id);

            try {
                const res = await fetch('essentials/collaborator-api.php', {
                    method: 'POST',
                    body: formData
                });
                const d = await res.json();
                if (d.success) {
                    await fetchCollaborators();
                    showToast('Collaborator deleted', 'error');
                }
            } catch (err) {
                console.error(err);
            }
        }


        /* ═══════════════════════════════════════════════════
           PRODUCTS CRUD
        ═══════════════════════════════════════════════════ */
        function updateInventoryMetrics() {
            const total = products.length;
            const active = products.filter(p => p.quantity > 0).length;
            const low = products.filter(p => p.quantity > 0 && p.quantity <= 10).length;
            const el = id => document.getElementById(id);
            if (el('totalProductsCount')) el('totalProductsCount').textContent = total;
            if (el('activeProductsCount')) el('activeProductsCount').textContent = active;
            if (el('lowStockCount')) el('lowStockCount').textContent = low;
        }

        function renderProducts() {
            const grid = document.getElementById('productsGrid');
            if (!grid) return;
            grid.innerHTML = '';
            updateInventoryMetrics();
            if (products.length === 0) {
                grid.innerHTML = `<div style="grid-column:1/-1;"><div class="empty-state"><div class="empty-state-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg></div><h3>No products yet</h3><p>Start by adding your first product to the catalogue.</p><button class="btn btn-primary" onclick="switchSection('add-product')">Add First Product</button></div></div>`;
                return;
            }
            products.forEach((product, index) => {
                const stockStatus = product.quantity > 10 ? 'active' : (product.quantity > 0 ? 'pending' : 'inactive');
                const stockLabel = product.quantity > 10 ? 'In Stock' : (product.quantity > 0 ? 'Low Stock' : 'Out of Stock');
                const card = document.createElement('div');
                card.className = 'product-card';
                card.onclick = (e) => {
                    if (e.target.closest('.product-card-actions')) return;
                    window.open(`product-view.php?id=${product.id}`, '_blank');
                };
                card.innerHTML = `
      <div class="product-card-img">${product.image ? `<img src="${product.image}" alt="">` : `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:0.3;"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>`}</div>
      <div class="product-card-body">
        <div class="product-card-title">${product.name_en || product.name_sq}</div>
        <div class="product-card-sku">${product.name_sq ? product.name_sq + ' · ' : ''}#${product.id}</div>
        <div class="product-card-meta">
          <span style="background:var(--bg-surface);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;text-transform:capitalize;">${product.category}</span>
          <span class="status-pill ${stockStatus}"><span class="status-dot"></span>${stockLabel} (${product.quantity})</span>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-secondary btn-sm edit-product" data-index="${index}"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>Edit</button>
          <button class="btn btn-danger btn-sm delete-product" data-id="${product.id}"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>Delete</button>
        </div>
      </div>`;
                grid.appendChild(card);
            });

            document.querySelectorAll('.edit-product').forEach(btn => {
                btn.addEventListener('click', function () {
                    openModalForEdit(products[+this.dataset.index]);
                });
            });
            document.querySelectorAll('.delete-product').forEach(btn => {
                btn.addEventListener('click', function () {
                    if (!confirm('Delete this product?')) return;
                    const id = +this.dataset.id;
                    products = products.filter(p => p.id !== id);
                    saveProducts();
                    renderProducts();
                    renderSalesProductSelector();
                    updateAllMetrics();
                    showToast('Product deleted', 'error');
                });
            });
        }

        function closeEditModal() {
            document.getElementById('editProductModal').classList.remove('active');
            document.getElementById('editProductForm').reset();
            removeEditPreview();
        }

        function handleEditImagePreview(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = ev => {
                document.getElementById('editPreviewImg').src = ev.target.result;
                document.getElementById('editUploadPlaceholder').style.display = 'none';
                document.getElementById('editUploadPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function removeEditPreview() {
            document.getElementById('editImageInput').value = '';
            document.getElementById('editPreviewImg').src = '';
            document.getElementById('editUploadPlaceholder').style.display = 'block';
            document.getElementById('editUploadPreview').style.display = 'none';
        }

        function adjustEditQty(amt) {
            const el = document.getElementById('edit_quantity');
            el.value = Math.max(0, (+el.value || 0) + amt);
        }

        // Edit Modal Tabs
        document.querySelectorAll('#editProductModal .lang-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                const group = tab.parentElement.id.includes('Name') ? 'name' : 'desc';
                const lang = tab.dataset.lang;
                tab.parentElement.querySelectorAll('.lang-tab').forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                document.getElementById(`edit-${group}-sq-content`).classList.toggle('active', lang === 'sq');
                document.getElementById(`edit-${group}-en-content`).classList.toggle('active', lang === 'en');
            });
        });

        // Edit Modal Category Selection
        document.querySelectorAll('#editCategoryGrid .category-option').forEach(opt => {
            opt.addEventListener('click', () => {
                document.querySelectorAll('#editCategoryGrid .category-option').forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                opt.querySelector('input').checked = true;
            });
        });

        function openModalForEdit(product) {
            const form = document.getElementById('editProductForm');
            document.getElementById('editProductId').value = product.id;
            document.getElementById('edit_name_sq').value = product.name_sq || '';
            document.getElementById('edit_name_en').value = product.name_en || '';
            document.getElementById('edit_desc_sq').value = product.desc_sq || '';
            document.getElementById('edit_desc_en').value = product.desc_en || '';
            document.getElementById('edit_quantity').value = product.quantity || 0;

            document.querySelectorAll('#editCategoryGrid .category-option').forEach(o => {
                const radio = o.querySelector('input[type="radio"]');
                const match = radio.value === product.category;
                o.classList.toggle('selected', match);
                radio.checked = match;
            });

            if (product.image) {
                document.getElementById('editPreviewImg').src = product.image;
                document.getElementById('editUploadPlaceholder').style.display = 'none';
                document.getElementById('editUploadPreview').style.display = 'block';
            } else {
                removeEditPreview();
            }

            document.getElementById('editModalSubtitle').textContent = `Editing: ${product.name_en || product.name_sq}`;
            document.getElementById('editProductModal').classList.add('active');
        }

        // Edit Form Submission
        document.getElementById('editProductForm').addEventListener('submit', async e => {
            e.preventDefault();
            const fd = new FormData(e.target);
            const id = fd.get('id');

            try {
                const res = await fetch('essentials/product-api.php', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.success) {
                    closeEditModal();
                    await fetchProducts();
                    showToast('Product updated', 'success');
                    return;
                }
            } catch { }

            // Fallback
            let imageData = '';
            const imgFile = document.getElementById('editImageInput').files[0];
            if (imgFile) {
                imageData = await new Promise(res => {
                    const r = new FileReader();
                    r.onload = ev => res(ev.target.result);
                    r.readAsDataURL(imgFile);
                });
            } else {
                const existing = products.find(p => p.id === +id);
                if (existing) imageData = existing.image || '';
            }

            const updatedProd = {
                id: +id,
                name_sq: fd.get('name_sq') || '',
                name_en: fd.get('name_en') || '',
                desc_sq: fd.get('desc_sq') || '',
                desc_en: fd.get('desc_en') || '',
                category: fd.get('category') || 'granular',
                quantity: +fd.get('quantity') || 0,
                image: imageData
            };

            const idx = products.findIndex(p => p.id === +id);
            if (idx >= 0) products[idx] = updatedProd;
            saveProducts();
            closeEditModal();
            renderProducts();
            renderSalesProductSelector();
            updateAllMetrics();
            showToast('Product updated', 'success');
        });

        document.getElementById('cancelProductBtn').addEventListener('click', () => {
            resetProductForm();
            switchSection('view-products');
        });

        function resetProductForm() {
            document.getElementById('productForm').reset();
            document.querySelectorAll('#categoryGrid .category-option').forEach((o, i) => {
                o.classList.toggle('selected', i === 0);
                o.querySelector('input[type="radio"]').checked = (i === 0);
            });
            ['nameLangTabs', 'descLangTabs'].forEach(tabId => {
                const tabs = document.getElementById(tabId);
                if (!tabs) return;
                tabs.querySelectorAll('.lang-tab').forEach((t, i) => t.classList.toggle('active', i === 0));
            });
            document.querySelectorAll('[id^="name-"], [id^="desc-"]').forEach(c => c.classList.remove('active'));
            document.getElementById('name-sq-content').classList.add('active');
            document.getElementById('desc-sq-content').classList.add('active');
            removePreview();
        }

        document.getElementById('productForm').addEventListener('submit', async e => {
            e.preventDefault();
            const fd = new FormData(e.target);

            // Try API first
            try {
                const res = await fetch('essentials/product-api.php', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.success) {
                    resetProductForm();
                    switchSection('view-products');
                    await fetchProducts();
                    showToast('Product added', 'success');
                    return;
                }
            } catch { }

            // Fallback: local storage
            let imageData = '';
            const imgFile = document.getElementById('image').files[0];
            if (imgFile) {
                imageData = await new Promise(res => {
                    const r = new FileReader();
                    r.onload = ev => res(ev.target.result);
                    r.readAsDataURL(imgFile);
                });
            }

            const newProd = {
                id: nextProductId++,
                name_sq: fd.get('name_sq') || '',
                name_en: fd.get('name_en') || '',
                desc_sq: fd.get('desc_sq') || '',
                desc_en: fd.get('desc_en') || '',
                category: fd.get('category') || 'granular',
                quantity: +fd.get('quantity') || 0,
                image: imageData
            };

            products.push(newProd);
            saveProducts();
            resetProductForm();
            switchSection('view-products');
            renderProducts();
            renderSalesProductSelector();
            updateAllMetrics();
            showToast('Product added', 'success');
        });

        async function fetchProducts() {
            try {
                const r = await fetch('essentials/product-api.php?action=list');
                const d = await r.json();
                if (d.success) {
                    products = d.products;
                    saveProducts();
                }
            } catch { }
            nextProductId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
            renderProducts();
            renderSalesProductSelector();
            updateAllMetrics();
        }

        /* ═══════════════════════════════════════════════════
           SALES
        ═══════════════════════════════════════════════════ */
        function renderSalesProductSelector() {
            const c = document.getElementById('salesProductSelector');
            const searchInput = document.getElementById('salesProductSearch');
            if (!c) return;

            const query = searchInput ? searchInput.value.toLowerCase().trim() : '';
            c.innerHTML = '';

            if (products.length === 0) {
                c.innerHTML = `<div style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">No products found. <a href="#" onclick="switchSection('add-product');return false;" style="color:var(--accent-gold);">Add a product first →</a></div>`;
                return;
            }

            const filtered = products.filter(p => {
                const nameSq = (p.name_sq || '').toLowerCase();
                const nameEn = (p.name_en || '').toLowerCase();
                const cat = (p.category || '').toLowerCase();
                return nameSq.includes(query) || nameEn.includes(query) || cat.includes(query);
            });

            if (filtered.length === 0) {
                c.innerHTML = `<div style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">No products match your search "${query}".</div>`;
                return;
            }

            filtered.forEach(p => {
                const oos = p.quantity <= 0;
                const opt = document.createElement('div');
                opt.className = `ps-option${oos ? ' out-of-stock' : ''}${selectedSaleProductId === p.id ? ' selected' : ''}`;
                opt.dataset.id = p.id;
                opt.innerHTML = `<div class="ps-option-name">${p.name_en || p.name_sq}</div><div class="ps-option-meta"><span style="text-transform:capitalize;">${p.category}</span><span>${oos ? '❌ Out of stock' : 'Qty: ' + p.quantity}</span></div>`;
                if (!oos) {
                    opt.addEventListener('click', () => {
                        selectedSaleProductId = p.id;
                        document.querySelectorAll('.ps-option').forEach(o => o.classList.remove('selected'));
                        opt.classList.add('selected');
                        const qtyEl = document.getElementById('saleQty');
                        qtyEl.max = p.quantity;
                        qtyEl.value = Math.min(+qtyEl.value || 1, p.quantity);
                    });
                }
                c.appendChild(opt);
            });
        }

        function updateSalesMetrics() {
            const totalUnits = salesHistory.reduce((s, sale) => s + sale.qty, 0);
            const totalRevenue = salesHistory.reduce((s, sale) => s + (sale.price * sale.qty), 0);
            const totalStock = products.reduce((s, p) => s + Number(p.quantity), 0);

            ['totalUnitsSold', 'vs-units'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = totalUnits.toLocaleString();
            });
            ['totalProfit', 'vs-revenue'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = '$' + totalRevenue.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            });
            ['totalStockRemaining'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = totalStock.toLocaleString();
            });
            const vcEl = document.getElementById('vs-count');
            if (vcEl) vcEl.textContent = salesHistory.length;
        }

        function updateAllMetrics() {
            updateInventoryMetrics();
            updateSalesMetrics();
            updateOverviewMetrics();
        }

        function recordSale() {
            if (!selectedSaleProductId) {
                showToast('Please select a product first', 'error');
                return;
            }
            const qty = +document.getElementById('saleQty').value || 1;
            const priceInput = +document.getElementById('salePrice').value || 0;
            const note = document.getElementById('saleNote').value.trim();
            const product = products.find(p => p.id === selectedSaleProductId);
            if (!product) {
                showToast('Product not found', 'error');
                return;
            }
            if (qty > product.quantity) {
                showToast(`Only ${product.quantity} units available`, 'error');
                return;
            }
            if (qty <= 0) {
                showToast('Quantity must be at least 1', 'error');
                return;
            }

            product.quantity -= qty;
            const now = new Date();
            const sale = {
                id: 'SALE-' + Date.now(),
                productId: product.id,
                productName: product.name_en || product.name_sq,
                category: product.category,
                qty,
                price: priceInput,
                total: priceInput * qty,
                note,
                date: now.toLocaleString(),
                dateObj: now.toISOString(),
                month: now.getMonth(),
                year: now.getFullYear()
            };
            salesHistory.unshift(sale);
            saveSales();
            saveProducts();

            selectedSaleProductId = null;
            document.getElementById('saleQty').value = 1;
            document.getElementById('salePrice').value = '';
            document.getElementById('saleNote').value = '';
            renderSalesProductSelector();
            renderRecentSales();
            updateAllMetrics();
            showToast(`✅ Recorded: ${qty}× ${product.name_en || product.name_sq}`, 'success');
        }

        function renderRecentSales() {
            const c = document.getElementById('recentSalesList');
            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = '<div class="rsw-empty">No sales recorded yet.</div>';
                return;
            }
            c.innerHTML = salesHistory.slice(0, 8).map(sale => `
    <div class="rsw-item">
      <div class="rsw-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg></div>
      <div class="rsw-info">
        <div class="rsw-name">${sale.productName}</div>
        <div class="rsw-qty">${sale.qty} unit${sale.qty > 1 ? 's' : ''} · ${sale.date}</div>
      </div>
      <div class="rsw-profit" style="${sale.price > 0 ? '' : 'color:var(--text-muted);font-size:12px;'}">${sale.price > 0 ? '$' + sale.total.toFixed(2) : 'No price'}</div>
    </div>`).join('');
        }

        function renderSalesTable() {
            const c = document.getElementById('salesTableContainer');
            const badge = document.getElementById('salesCountBadge');

            // Apply filters
            const searchQ = (document.getElementById('salesSearch')?.value || '').toLowerCase();
            let filtered = salesHistory.filter(s => {
                const matchCat = vsFilter === 'all' || s.category === vsFilter;
                const matchSearch = !searchQ || s.productName.toLowerCase().includes(searchQ) || s.id.toLowerCase().includes(searchQ) || (s.note || '').toLowerCase().includes(searchQ);
                return matchCat && matchSearch;
            });

            if (badge) badge.textContent = filtered.length;
            updateSalesMetrics();

            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = `<div class="sales-empty"><div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,6 13.5,15.5 8.5,10.5 1,18"/><polyline points="17,6 23,6 23,12"/></svg></div><h4>No Sales Yet</h4><p>Go to <strong>Add Sale</strong> to record your first sale.</p></div>`;
                return;
            }
            if (filtered.length === 0) {
                c.innerHTML = `<div style="padding:40px;text-align:center;color:var(--text-muted);">No sales match your filter.</div>`;
                return;
            }

            c.innerHTML = `<table>
    <thead><tr>
      <th>Sale ID</th><th>Product</th><th>Category</th><th>Qty</th><th>Unit Price</th><th>Total</th><th>Note</th><th>Date</th><th></th>
    </tr></thead>
    <tbody>${filtered.map((sale, idx) => `
      <tr>
        <td><strong style="color:var(--accent-gold);">${sale.id}</strong></td>
        <td><span style="font-weight:500;">${sale.productName}</span></td>
        <td><span style="text-transform:capitalize;font-size:12px;background:var(--bg-surface);padding:3px 8px;border-radius:12px;">${sale.category}</span></td>
        <td><strong>${sale.qty}</strong></td>
        <td>${sale.price > 0 ? '$' + Number(sale.price).toFixed(2) : '<span style="color:var(--text-muted);">—</span>'}</td>
        <td><strong style="color:var(--success);">${sale.price > 0 ? '$' + Number(sale.total).toFixed(2) : '<span style="color:var(--text-muted);">—</span>'}</strong></td>
        <td style="color:var(--text-muted);font-size:13px;">${sale.note || '—'}</td>
        <td style="font-size:12px;color:var(--text-muted);white-space:nowrap;">${sale.date}</td>
        <td><button class="btn btn-danger btn-sm btn-icon" onclick="deleteSale('${sale.id}')" title="Delete sale"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg></button></td>
      </tr>`).join('')}
    </tbody>
  </table>`;
        }

        // View Sales filter chips
        document.querySelectorAll('.filter-chip[data-vsfilter]').forEach(chip => {
            chip.addEventListener('click', function () {
                document.querySelectorAll('.filter-chip[data-vsfilter]').forEach(c => c.classList.remove('active'));
                this.classList.add('active');
                vsFilter = this.dataset.vsfilter;
                renderSalesTable();
            });
        });

        function deleteSale(saleId) {
            const idx = salesHistory.findIndex(s => s.id === saleId);
            if (idx < 0) return;
            const sale = salesHistory[idx];
            const product = products.find(p => p.id === sale.productId);
            if (product) product.quantity += sale.qty;
            salesHistory.splice(idx, 1);
            saveSales();
            saveProducts();
            renderSalesTable();
            renderRecentSales();
            updateAllMetrics();
            showToast('Sale removed', 'error');
        }

        function clearSalesHistory() {
            if (salesHistory.length === 0) {
                showToast('No sales to clear', 'error');
                return;
            }
            if (!confirm('Clear all sales history? Stock quantities will be restored.')) return;
            salesHistory.forEach(sale => {
                const p = products.find(p => p.id === sale.productId);
                if (p) p.quantity += sale.qty;
            });
            salesHistory = [];
            saveSales();
            saveProducts();
            renderSalesTable();
            renderRecentSales();
            updateAllMetrics();
            showToast('Sales history cleared', 'error');
        }

        /* ═══════════════════════════════════════════════════
           OVERVIEW
        ═══════════════════════════════════════════════════ */
        function refreshOverview() {
            updateOverviewMetrics();
            showToast('Dashboard refreshed', 'success');
        }

        function updateOverviewMetrics() {
            const now = new Date();
            const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            const dateEl = document.getElementById('overviewDate');
            if (dateEl) dateEl.textContent = `${days[now.getDay()]}, ${months[now.getMonth()]} ${now.getDate()}, ${now.getFullYear()}`;

            const totalRevenue = salesHistory.reduce((s, sale) => s + (sale.price * sale.qty), 0);
            const totalUnits = salesHistory.reduce((s, sale) => s + sale.qty, 0);
            const totalStock = products.reduce((s, p) => s + Number(p.quantity), 0);
            const lowStock = products.filter(p => p.quantity > 0 && p.quantity <= 10).length;

            const setEl = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            };
            setEl('ov-revenue', '$' + totalRevenue.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }));
            setEl('ov-revenue-trend', salesHistory.length + ' sales');
            setEl('ov-units', totalUnits.toLocaleString());
            setEl('ov-units-trend', salesHistory.length + ' transactions');
            setEl('ov-stock', totalStock.toLocaleString());
            setEl('ov-stock-trend', products.length + ' products');
            setEl('ov-low', lowStock);
            setEl('ov-low-trend', lowStock > 0 ? '⚠ Needs restock' : '✓ OK');

            // Update metric trend classes
            ['ov-revenue-trend', 'ov-units-trend', 'ov-stock-trend'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.className = 'metric-trend';
                    el.classList.add(salesHistory.length > 0 ? 'up' : 'neutral');
                }
            });
            const lowTrend = document.getElementById('ov-low-trend');
            if (lowTrend) {
                lowTrend.className = 'metric-trend';
                lowTrend.classList.add(lowStock > 0 ? 'down' : 'up');
            }

            // Best sellers
            const bsc = document.getElementById('ov-best-sellers');
            if (bsc) {
                if (salesHistory.length === 0) {
                    bsc.innerHTML = '<div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">No sales yet. Go to Add Sale to get started.</div>';
                } else {
                    const agg = {};
                    salesHistory.forEach(sale => {
                        if (!agg[sale.productName]) agg[sale.productName] = {
                            name: sale.productName,
                            qty: 0,
                            revenue: 0
                        };
                        agg[sale.productName].qty += Number(sale.qty);
                        agg[sale.productName].revenue += Number(sale.total);
                    });
                    const best = Object.values(agg).sort((a, b) => b.qty - a.qty).slice(0, 5);
                    bsc.innerHTML = best.map(p => `
        <div class="activity-item">
          <div class="activity-icon" style="background:rgba(212,168,83,0.12);color:var(--accent-gold);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
          </div>
          <div class="activity-info">
            <div class="activity-name">${p.name}</div>
            <div class="activity-sub">${p.qty} unit${p.qty > 1 ? 's' : ''} sold</div>
          </div>
          <div class="activity-val" style="color:var(--accent-gold);">$${p.revenue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
        </div>`).join('');
                }
            }

            // Inventory breakdown
            const ibc = document.getElementById('ov-inventory');
            if (ibc) {
                if (products.length === 0) {
                    ibc.innerHTML = '<div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">No products added yet.</div>';
                } else {
                    const cats = {};
                    products.forEach(p => {
                        cats[p.category] = (cats[p.category] || 0) + Number(p.quantity);
                    });
                    const total = Object.values(cats).reduce((s, v) => s + v, 0) || 1;
                    const catColors = {
                        granular: 'var(--accent-gold)',
                        liquid: 'var(--info)',
                        organic: 'var(--success)',
                        specialty: 'var(--warning)'
                    };
                    ibc.innerHTML = Object.entries(cats).map(([cat, qty]) => `
        <div class="quick-stat-row">
          <div class="quick-stat-label" style="text-transform:capitalize;">${cat}</div>
          <div class="quick-stat-bar"><div class="quick-stat-fill" style="width:${Math.round(qty / total * 100)}%;background:${catColors[cat] || 'var(--info)'}"></div></div>
          <div class="quick-stat-val">${qty}</div>
        </div>`).join('');
                }
            }
        }

        /* ═══════════════════════════════════════════════════
           ANALYTICS — fully driven by real sales data
        ═══════════════════════════════════════════════════ */
        function renderAnalytics() {
            renderMonthlySalesChart();
            renderCategoryPie();
            renderTopProducts();
            renderAnalyticsSummary();
        }

        function renderMonthlySalesChart() {
            const container = document.getElementById('monthlySalesChart');
            const empty = document.getElementById('monthlySalesEmpty');
            if (!container) return;

            if (salesHistory.length === 0) {
                container.style.display = 'none';
                if (empty) empty.style.display = 'block';
                return;
            }
            container.style.display = 'block';
            if (empty) empty.style.display = 'none';

            // Aggregate by month for current year
            const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const currentYear = new Date().getFullYear();
            const byMonth = Array(12).fill(null).map(() => ({
                revenue: 0,
                units: 0
            }));

            salesHistory.forEach(sale => {
                let month = sale.month;
                let year = sale.year;
                // Handle older format without month/year
                if (month === undefined || year === undefined) {
                    try {
                        const d = new Date(sale.dateObj || sale.date);
                        month = d.getMonth();
                        year = d.getFullYear();
                    } catch {
                        month = new Date().getMonth();
                        year = currentYear;
                    }
                }
                if (year === currentYear) {
                    byMonth[month].revenue += Number(sale.total) || 0;
                    byMonth[month].units += Number(sale.qty) || 0;
                }
            });

            const maxRevenue = Math.max(...byMonth.map(m => m.revenue), 1);
            const maxUnits = Math.max(...byMonth.map(m => m.units), 1);

            container.innerHTML = `
    <div style="padding:0 24px 16px;">
      <div style="display:flex;align-items:flex-end;gap:4px;height:200px;border-bottom:1px solid var(--border-color);padding-bottom:0;position:relative;">
        ${byMonth.map((m, i) => {
                const revH = maxRevenue > 0 ? Math.max(2, (m.revenue / maxRevenue) * 170) : 2;
                const unitH = maxUnits > 0 ? Math.max(2, (m.units / maxUnits) * 170) : 2;
                const hasData = m.revenue > 0 || m.units > 0;
                return `
          <div style="flex:1;display:flex;flex-direction:column;align-items:center;gap:2px;position:relative;cursor:${hasData ? 'pointer' : 'default'};" class="month-col">
            <div style="display:flex;align-items:flex-end;gap:1px;height:170px;">
              <div style="width:calc(50% - 1px);height:${revH}px;background:var(--accent-gold);border-radius:3px 3px 0 0;transition:all 0.7s ease;position:relative;" 
                   title="${monthNames[i]}: $${m.revenue.toFixed(2)} revenue"
                   onmouseover="showBarTip(event,'${monthNames[i]}: $${m.revenue.toFixed(2)}')"
                   onmouseout="hideBarTip()"></div>
              <div style="width:calc(50% - 1px);height:${unitH}px;background:var(--info);border-radius:3px 3px 0 0;transition:all 0.7s ease;opacity:0.7;"
                   title="${monthNames[i]}: ${m.units} units"
                   onmouseover="showBarTip(event,'${monthNames[i]}: ${m.units} units sold')"
                   onmouseout="hideBarTip()"></div>
            </div>
          </div>`;
            }).join('')}
      </div>
      <div style="display:flex;gap:4px;margin-top:6px;">
        ${monthNames.map(m => `<div style="flex:1;text-align:center;font-size:9px;color:var(--text-muted);">${m}</div>`).join('')}
      </div>
      <div style="display:flex;gap:20px;margin-top:12px;">
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-secondary);"><div style="width:10px;height:10px;border-radius:2px;background:var(--accent-gold);"></div>Revenue ($)</div>
        <div style="display:flex;align-items:center;gap:6px;font-size:12px;color:var(--text-secondary);"><div style="width:10px;height:10px;border-radius:2px;background:var(--info);opacity:0.7;"></div>Units Sold</div>
      </div>
    </div>
  `;
        }

        let tipTimeout;

        function showBarTip(event, text) {
            let tip = document.getElementById('barTip');
            if (!tip) {
                tip = document.createElement('div');
                tip.id = 'barTip';
                tip.style.cssText = 'position:fixed;background:var(--bg-elevated);border:1px solid var(--border-color);border-radius:6px;padding:6px 12px;font-size:12px;font-weight:600;pointer-events:none;z-index:999;box-shadow:var(--shadow-md);transition:opacity 0.15s;';
                document.body.appendChild(tip);
            }
            tip.textContent = text;
            tip.style.opacity = '1';
            tip.style.left = (event.clientX + 10) + 'px';
            tip.style.top = (event.clientY - 30) + 'px';
        }

        function hideBarTip() {
            const tip = document.getElementById('barTip');
            if (tip) tip.style.opacity = '0';
        }

        function renderCategoryPie() {
            const wrap = document.getElementById('categoryPieWrap');
            if (!wrap) return;

            if (salesHistory.length === 0) {
                wrap.innerHTML = '<div class="no-data-msg"><h4>No sales data yet</h4><p>Record sales to see category breakdown.</p></div>';
                return;
            }

            // Aggregate by category
            const cats = {};
            salesHistory.forEach(sale => {
                const cat = sale.category || 'other';
                if (!cats[cat]) cats[cat] = {
                    units: 0,
                    revenue: 0
                };
                cats[cat].units += Number(sale.qty);
                cats[cat].revenue += Number(sale.total);
            });

            const catColors = {
                granular: '#D4A853',
                liquid: '#3B82F6',
                organic: '#10B981',
                specialty: '#F59E0B',
                other: '#8B5CF6'
            };
            const catEmojis = {
                granular: '🌾',
                liquid: '💧',
                organic: '🌿',
                specialty: '⭐',
                other: '📦'
            };
            const entries = Object.entries(cats).sort((a, b) => b[1].units - a[1].units);
            const totalUnits = entries.reduce((s, [, v]) => s + v.units, 0);

            // SVG donut
            const r = 60,
                cx = 80,
                cy = 80,
                sw = 24,
                circ = 2 * Math.PI * r;
            let offset = 0;
            const segments = entries.map(([cat, data]) => {
                const pct = data.units / totalUnits;
                const sda = pct * circ;
                const seg = {
                    cat,
                    data,
                    pct,
                    sda,
                    offset
                };
                offset += sda;
                return seg;
            });

            const svgCircles = segments.map(seg =>
                `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${catColors[seg.cat] || '#888'}" stroke-width="${sw}" stroke-dasharray="${seg.sda} ${circ}" stroke-dashoffset="${-seg.offset}" style="transition:all 0.6s ease;"/>`
            ).join('');

            const legend = entries.map(([cat, data]) => {
                const pct = Math.round(data.units / totalUnits * 100);
                return `<div class="donut-legend-item">
      <div class="donut-legend-dot" style="background:${catColors[cat] || '#888'};"></div>
      <span class="donut-legend-text">${catEmojis[cat] || '📦'} ${cat.charAt(0).toUpperCase() + cat.slice(1)}</span>
      <span class="donut-legend-value">${data.units} units</span>
      <span class="donut-legend-pct">${pct}%</span>
    </div>`;
            }).join('');

            wrap.innerHTML = `
    <div class="donut-container">
      <div class="donut-chart-wrap" style="width:160px;height:160px;flex-shrink:0;">
        <svg width="160" height="160" viewBox="0 0 160 160" style="transform:rotate(-90deg);">
          ${svgCircles}
        </svg>
        <div class="donut-center">
          <div class="donut-value">${totalUnits}</div>
          <div class="donut-label">units sold</div>
        </div>
      </div>
      <div class="donut-legend">${legend}</div>
    </div>`;
        }

        function renderTopProducts() {
            const c = document.getElementById('topProductsChart');
            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = '<div class="no-data-msg"><h4>No sales data yet</h4><p>Record sales to see your top performers.</p></div>';
                return;
            }
            const agg = {};
            salesHistory.forEach(sale => {
                const key = sale.productName;
                if (!agg[key]) agg[key] = {
                    name: key,
                    category: sale.category,
                    qty: 0,
                    revenue: 0
                };
                agg[key].qty += Number(sale.qty);
                agg[key].revenue += Number(sale.total);
            });
            const sorted = Object.values(agg).sort((a, b) => b.qty - a.qty).slice(0, 6);
            const maxQty = sorted[0]?.qty || 1;
            const rankColors = ['#D4A853', '#C0C0C0', '#CD7F32', '#3B82F6', '#10B981', '#8B5CF6'];

            c.innerHTML = sorted.map((p, i) => `
    <div class="top-product-row">
      <div class="top-product-rank" style="background:${rankColors[i] || 'var(--bg-surface)'};color:${i < 3 ? '#fff' : 'var(--text-secondary)'};">${i + 1}</div>
      <div style="flex:1;min-width:0;">
        <div style="font-size:13px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${p.name}</div>
        <div class="top-product-bar" style="margin-top:4px;">
          <div class="top-product-fill" style="width:${(p.qty / maxQty * 100).toFixed(1)}%;background:${rankColors[i] || 'var(--accent-gold)'};"></div>
        </div>
      </div>
      <div style="text-align:right;margin-left:8px;">
        <div style="font-size:13px;font-weight:700;">${p.qty} <span style="font-size:11px;font-weight:400;color:var(--text-muted);">units</span></div>
        ${p.revenue > 0 ? `<div style="font-size:11px;color:var(--success);">$${p.revenue.toFixed(2)}</div>` : ''}
      </div>
    </div>`).join('');
        }

        function renderAnalyticsSummary() {
            const c = document.getElementById('analyticsSummary');
            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = '';
                return;
            }

            const totalRevenue = salesHistory.reduce((s, sale) => s + (sale.price * sale.qty), 0);
            const totalUnits = salesHistory.reduce((s, sale) => s + sale.qty, 0);
            const avgOrderValue = salesHistory.length > 0 ? totalRevenue / salesHistory.length : 0;
            const topCat = (() => {
                const cats = {};
                salesHistory.forEach(s => {
                    cats[s.category] = (cats[s.category] || 0) + s.qty;
                });
                return Object.entries(cats).sort((a, b) => b[1] - a[1])[0]?.[0] || '—';
            })();

            const catEmojis = {
                granular: '🌾',
                liquid: '💧',
                organic: '🌿',
                specialty: '⭐',
                other: '📦'
            };

            c.innerHTML = `
    <div class="metric-card"><div class="metric-header"><div class="metric-icon revenue"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6"/></svg></div></div><div class="metric-value">$${totalRevenue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div><div class="metric-label">Total Revenue</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon orders"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,6 13.5,15.5 8.5,10.5 1,18"/></svg></div></div><div class="metric-value">${totalUnits.toLocaleString()}</div><div class="metric-label">Total Units Sold</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div></div><div class="metric-value">$${avgOrderValue.toFixed(2)}</div><div class="metric-label">Avg. Sale Value</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon growth"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div></div><div class="metric-value">${catEmojis[topCat] || ''} ${topCat.charAt(0).toUpperCase() + topCat.slice(1)}</div><div class="metric-label">Top Category</div></div>
  `;
        }

        /* ═══════════════════════════════════════════════════
           INIT
        ═══════════════════════════════════════════════════ */
        (async function init() {
            // Try to load from API, fallback to localStorage
            try {
                const r = await fetch('essentials/product-api.php?action=list');
                const d = await r.json();
                if (d.success) {
                    products = d.products;
                    saveProducts();
                }
            } catch { }

            nextProductId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
            renderProducts();
            renderSalesProductSelector();
            renderRecentSales();
            updateAllMetrics();
            updateOverviewMetrics();

            // Add search listener for sales product selector
            const salesSearch = document.getElementById('salesProductSearch');
            if (salesSearch) {
                salesSearch.addEventListener('input', () => {
                    renderSalesProductSelector();
                });
            }
        })();
    </script>
</body>

</html>