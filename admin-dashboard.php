<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

require_once 'essentials/db_connect.php';

// Fetch settings for language
try {
    $stmt = $pdo->query("SELECT admin_language FROM settings WHERE id = 1");
    $settings = $stmt->fetch();
    $admin_lang = $settings['admin_language'] ?? 'en';
} catch (PDOException $e) {
    $admin_lang = 'en';
}

require_once 'essentials/admin-translations.php';
?>
<script>
    const adminLang = '<?php echo $admin_lang; ?>';
    const T = <?php echo getTranslationsJson(); ?>;
</script>
<!DOCTYPE html>
<html lang="<?php echo $admin_lang; ?>">

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
            --bg-primary: #0c0e14;
            --bg-secondary: rgba(18, 21, 30, 0.85);
            --bg-surface: rgba(22, 26, 38, 0.75);
            --bg-elevated: #1a1f2e;
            --text-primary: #E8ECF4;
            --text-secondary: #8B95A8;
            --text-muted: #525E73;
            --accent-gold: #E8B94F;
            --accent-gold-hover: #D4A43A;
            --primary-dark: #0f1219;
            --border-color: rgba(136, 165, 216, 0.08);
            --success: #34D399;
            --warning: #FBBF24;
            --danger: #F87171;
            --info: #60A5FA;
            --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.35);
            --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.45);
            --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.55);
        }

        /* Active nav link = gold/yellow accent (both themes) */

        /* Dark mode: sidebar logo span color adjustment */
        html[data-theme="dark"] .sidebar-header .logo span {
            color: #ffffff !important;
        }

        /* Keep logo as is in dark mode (user says it is white) */
        html[data-theme="dark"] .sidebar-header .logo-icon img {
            filter: none;
        }

        /* Custom Scrollbar Styles */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-primary);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--text-muted);
            border-radius: 20px;
            border: 2px solid var(--bg-primary);
            transition: background 0.2s ease;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }
        
        /* Firefox */
        * {
            scrollbar-width: thin;
            scrollbar-color: var(--text-muted) var(--bg-primary);
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
            background: rgba(232, 185, 79, 0.08);
            color: var(--accent-gold);
        }

        .nav-item.active {
            background: rgba(232, 185, 79, 0.12);
            color: var(--accent-gold);
            box-shadow: inset 3px 0 0 var(--accent-gold), 0 2px 8px rgba(232, 185, 79, 0.08);
        }

        .nav-item.active .nav-icon {
            color: var(--accent-gold);
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
            gap: 2px;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        /* ── Dropdown Components ── */
        .dropdown-wrapper {
            position: relative;
        }

        .dropdown-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: 100px;
            color: var(--text-primary);
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
            z-index: 10;
        }

        .dropdown-btn:hover {
            border-color: var(--accent-gold);
            box-shadow: var(--shadow-md);
        }

        .dropdown-panel {
            position: absolute;
            top: calc(100% + 8px);
            left: 0;
            min-width: 220px;
            background: var(--bg-elevated);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 8px;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1001;
            backdrop-filter: blur(10px);
        }

        .dropdown-wrapper.active .dropdown-panel {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .dropdown-option {
            display: flex;
            align-items: center;
            width: 100%;
            border: none;
            background: transparent;
            padding: 10px 14px;
            border-radius: 10px;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-align: left;
        }

        .dropdown-option:hover {
            background: rgba(200, 168, 75, 0.05);
            color: var(--accent-gold);
        }

        .dropdown-option.active {
            background: var(--accent-gold);
            color: white;
        }

        @media (max-width: 768px) {
            .controls-bar {
                flex-direction: row !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 16px !important;
            }

            .search-pill-wrapper {
                order: -1 !important;
                width: 100% !important;
                max-width: none !important;
            }

            .controls-group-left {
                order: 1 !important;
                display: grid !important;
                grid-template-columns: 1fr 1fr;
                gap: 8px !important;
                flex: 1 !important;
            }

            .status-badge-wrapper {
                order: 2 !important;
                flex: 1 !important;
            }

            .dropdown-panel {
                position: fixed;
                bottom: 0;
                left: 0;
                right: 0;
                top: auto;
                width: 100%;
                border-radius: 20px 20px 0 0;
                transform: translateY(100%);
            }

            .dropdown-wrapper.active .dropdown-panel {
                transform: translateY(0);
            }
        }

        @media (min-width: 769px) {
            .controls-bar {
                justify-content: flex-start !important;
                gap: 16px !important;
            }

            .search-pill-wrapper {
                margin-left: 0 !important;
                flex: none !important;
                width: 350px !important;
            }

            .status-badge-wrapper {
                margin-left: auto !important;
            }
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
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 12px;
            max-height: 350px;
            overflow-y: auto;
            padding-right: 4px;
            margin-bottom: 16px;
        }

        .product-selector::-webkit-scrollbar {
            width: 4px;
        }

        .product-selector::-webkit-scrollbar-thumb {
            background: var(--text-muted);
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
            grid-template-columns: 1fr;
            gap: 24px;
            align-items: start;
            width: 100%;
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
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 12px;
        }

        .category-option {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 16px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 12px;
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
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .category-option-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent-gold);
            width: 24px;
            height: 24px;
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
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 3000;
            backdrop-filter: blur(12px);
            opacity: 0;
            visibility: hidden;
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 32px;
            max-width: 440px;
            width: 90%;
            transform: scale(0.92) translateY(30px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        html[data-theme="light"] .modal {
            background: rgba(255, 255, 255, 0.8);
            border-color: rgba(0, 0, 0, 0.05);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .modal-overlay.active .modal {
            transform: scale(1) translateY(0);
            opacity: 1;
        }

        .modal-icon {
            width: 72px;
            height: 72px;
            border-radius: 20px;
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            transition: transform 0.3s ease;
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

        /* ── Collaborator Specific Premium Styles ── */
        .collab-modal {
            max-width: 580px !important;
            padding: 0 !important;
            overflow: hidden;
            border: 1px solid var(--accent-gold) !important;
            box-shadow: 0 0 40px rgba(212, 168, 83, 0.15) !important;
        }

        .collab-modal-header {
            padding: 28px 32px;
            background: rgba(200, 168, 75, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(212, 168, 83, 0.1);
        }

        .collab-modal-title h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--accent-gold);
            margin: 0;
            letter-spacing: -0.5px;
        }

        .collab-modal-body {
            padding: 36px 32px;
            text-align: left;
        }

        .collab-form-group {
            margin-bottom: 28px;
        }

        .collab-form-label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: var(--accent-gold);
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            opacity: 0.8;
        }

        .collab-form-group .form-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            padding: 14px 18px;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        html[data-theme="light"] .collab-form-group .form-input {
            background: #fff;
            border-color: rgba(0, 0, 0, 0.1);
            color: var(--text-primary);
        }

        .collab-form-group .form-input:focus {
            background: rgba(212, 168, 83, 0.03);
            border-color: var(--accent-gold);
            box-shadow: 0 0 0 4px rgba(212, 168, 83, 0.15);
            transform: translateY(-1px);
        }

        .collab-form-group .search-input-wrap .search-icon {
            color: var(--accent-gold);
            opacity: 0.6;
            left: 18px;
        }

        .collab-form-group .search-input-wrap .form-input {
            padding-left: 48px;
        }

        .collab-input-preview {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-top: 12px;
            padding: 12px;
            background: var(--bg-primary);
            border-radius: 12px;
            border: 1px dashed var(--border-color);
        }

        .collab-logo-preview {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            object-fit: contain;
            background: #fff;
            padding: 4px;
            border: 1px solid var(--border-color);
        }

        .collab-modal-footer {
            padding: 20px 32px;
            background: var(--bg-surface);
            border-top: 1px solid var(--border-color);
            display: flex;
            justify-content: flex-end;
            gap: 12px;
        }

        @media (max-width: 600px) {
            .collab-modal-body {
                padding: 20px;
            }

            .collab-modal-header {
                padding: 16px 20px;
            }

            .collab-modal-footer {
                padding: 16px 20px;
            }

            .collab-modal-title h2 {
                font-size: 1.4rem;
            }
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
                z-index: 2000;
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.4);
                backdrop-filter: blur(4px);
                z-index: 1999;
            }

            .sidebar-overlay.active {
                display: block;
            }

            .main {
                margin-left: 0;
            }

            .topbar {
                left: 0;
                padding: 0 16px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
                background: var(--bg-surface);
                border: 1px solid var(--border-color);
                color: var(--text-primary);
                width: 40px;
                height: 40px;
                border-radius: 10px;
                cursor: pointer;
            }

            .date-label, .time-label {
                display: none !important;
            }

            .metrics-grid,
            .cards-grid,
            .sales-metrics-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 16px;
            }
        }

        @media(min-width:769px) {
            .menu-toggle, .sidebar-overlay {
                display: none !important;
            }
        }

        /* ── Print Receipt Styles ── */
        @media print {
            body * { visibility: hidden !important; }
            #receiptPrintFrame, #receiptPrintFrame * { visibility: visible !important; }
            #receiptPrintFrame { position: fixed; left: 0; top: 0; width: 100%; }
        }
    </style>
</head>

<body>

    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="logo" style="gap: 2px; align-items: center; display: flex;">
                <div class="logo-icon" style="background: none; width: 54px; height: 54px;">
                    <img src="images/logo.svg" alt="AgroFanema Logo"
                        style="width: 100%; height: 100%; object-fit: contain;">
                </div>
                <span
                    style="font-family: 'Cormorant Garamond', serif; font-size: 1.6rem; font-weight: 800; color: var(--text-primary); margin-left: -6px; line-height: 1;">AgroFanema</span>
            </div>
        </div>
        <nav class="nav-section">
            <div class="nav-label"><?php echo at('main_section'); ?></div>
            <div class="nav-item active" data-section="overview">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="9" rx="1" />
                    <rect x="14" y="3" width="7" height="5" rx="1" />
                    <rect x="14" y="12" width="7" height="9" rx="1" />
                    <rect x="3" y="16" width="7" height="5" rx="1" />
                </svg>
                <span><?php echo at('overview'); ?></span>
            </div>
            <div class="nav-item" data-section="view-products">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" />
                    <line x1="3" y1="6" x2="21" y2="6" />
                    <path d="M16 10a4 4 0 01-8 0" />
                </svg>
                <span><?php echo at('inventory'); ?></span>
            </div>
            <div class="nav-item" data-section="add-product">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                <span><?php echo at('add_product'); ?></span>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-label"><?php echo at('sales_section'); ?></div>
            <div class="nav-item" data-section="add-sale">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="9" cy="21" r="1" />
                    <circle cx="20" cy="21" r="1" />
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6" />
                </svg>
                <span><?php echo at('record_sale'); ?></span>
            </div>
            <div class="nav-item" data-section="view-sales">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                    <polyline points="17,6 23,6 23,12" />
                </svg>
                <span><?php echo at('sales_history'); ?></span>
            </div>
            <div class="nav-item" data-section="messages">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                    <polyline points="22,6 12,13 2,6" />
                </svg>
                <span style="display:flex; align-items:center; gap:8px;">
                    <?php echo at('leads'); ?> <span class="badge" id="sidebarMsgBadge"
                        style="display:none; background:var(--accent-gold); color:var(--primary-dark); font-size:10px; font-weight:800; padding:2px 6px; border-radius:100px;">0</span>
                </span>
            </div>
            <div class="nav-item" data-section="collaborators">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                <span><?php echo at('collaborators'); ?></span>
            </div>
            <div class="nav-item" data-section="analytics">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
                <span><?php echo at('analytics'); ?></span>
            </div>
            <div class="nav-divider"></div>
            <div class="nav-label"><?php echo at('account'); ?></div>
            <div class="nav-item" data-section="settings">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="3" />
                    <path
                        d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z" />
                </svg>
                <span><?php echo at('settings'); ?></span>
            </div>
            <div class="nav-item danger" data-section="logout">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4" />
                    <polyline points="16,17 21,12 16,7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                <span><?php echo at('logout'); ?></span>
            </div>
            <a href="index.php" class="nav-item"
                style="text-decoration: none; margin-top: auto; border-top: 1px solid var(--border-color); padding-top: 16px;">
                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                <span><?php echo at('return_home'); ?></span>
            </a>
        </nav>
        <div class="user-profile">
            <div class="user-avatar" id="sidebarAvatar">NM</div>
            <div class="user-info">
                <div class="user-name" id="sidebarName">NM</div>
                <div class="user-role"><?php echo at('administrator'); ?></div>
            </div>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" id="menuToggle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
            </div>
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
                        style="font-weight: 600; font-size: 0.95rem; color: var(--text-secondary); font-family: 'Outfit', sans-serif; letter-spacing: 0.5px;"><?php echo at('loading_date'); ?></span>
                </div>
                <div class="time-label" id="currentTime"
                    style="display: flex; align-items: center; background: var(--bg-primary); padding: 8px 16px; border-radius: 10px; border: 1px solid var(--border-color); margin-right: 16px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="margin-right: 10px; color: var(--accent-gold);">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <span id="clockText"
                        style="font-weight: 600; font-size: 0.95rem; color: var(--text-secondary); font-family: 'Outfit', sans-serif; letter-spacing: 0.5px;"><?php echo at('loading_time'); ?></span>
                </div>
                <div class="user-avatar" style="width:32px;height:32px;font-size:12px;" id="topbarAvatar">NM</div>
            </div>
        </header>

        <div class="content">

            <!-- ── OVERVIEW ── -->
            <div class="section active" id="section-overview">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('overview'); ?></h1>
                        <p class="page-subtitle" id="overviewDate">Loading...</p>
                    </div>
                    <button class="btn btn-secondary btn-sm" onclick="refreshOverview()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="23,4 23,11 16,11" />
                            <polyline points="1,20 1,13 8,13" />
                            <path d="M3.51 9a9 9 0 0114.85-3.36L23 11M1 13l4.64 4.36A9 9 0 0020.49 15" />
                        </svg>
                        <?php echo at('refresh'); ?>
                    </button>
                    <script>
                        async function refreshOverview() {
                            await updateAllMetrics();
                            await updateOverviewMetrics();
                            await fetchMessages();
                            showToast(T.toast_overview_refreshed);
                        }
                    </script>
                </div>
                <div class="metrics-grid">
                    <div class="metric-card" onclick="switchSection('view-sales')">
                        <div class="metric-header">
                            <div class="metric-icon revenue"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/><path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/></svg></div>
                            <span class="metric-trend neutral" id="ov-revenue-trend">0 <?php echo at('sales'); ?></span>
                        </div>
                        <div class="metric-value" id="ov-revenue">0.00</div>
                        <div class="metric-label"><?php echo at('revenue'); ?></div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-sales')">
                        <div class="metric-header">
                            <div class="metric-icon orders"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                    <polyline points="17,6 23,6 23,12" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-units-trend">0 <?php echo at('total_transactions'); ?></span>
                        </div>
                        <div class="metric-value" id="ov-units">0</div>
                        <div class="metric-label"><?php echo at('products_sold'); ?></div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-products')">
                        <div class="metric-header">
                            <div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path
                                        d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-stock-trend">0 <?php echo at('total_products'); ?></span>
                        </div>
                        <div class="metric-value" id="ov-stock">0</div>
                        <div class="metric-label"><?php echo at('items_in_stock'); ?></div>
                    </div>
                    <div class="metric-card" onclick="switchSection('view-products')">
                        <div class="metric-header">
                            <div class="metric-icon growth"><svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" y1="8" x2="12" y2="12" />
                                    <line x1="12" y1="16" x2="12.01" y2="16" />
                                </svg></div>
                            <span class="metric-trend neutral" id="ov-low-trend"><?php echo at('stock_low'); ?></span>
                        </div>
                        <div class="metric-value" id="ov-low">0</div>
                        <div class="metric-label"><?php echo at('stock_low'); ?></div>
                    </div>
                </div>
                <div class="overview-bottom">
                    <div class="activity-card">
                        <div class="activity-header">
                            <span class="activity-title">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px; vertical-align:text-bottom;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6M18 9h1.5a2.5 2.5 0 0 0 0-5H18M4 22h16M10 14.66V17c0 .55.45 1 1 1h2c.55 0 1-.45 1-1v-2.34c0-.5-.37-.91-.87-.98a10.007 10.007 0 0 1-2.26 0c-.5.07-.87.48-.87.98ZM15 7c0-1.66-1.34-3-3-3s-3 1.34-3 3c0 1.25.77 2.3 1.83 2.76A10.003 10.003 0 0 0 12 11c.06 0 .11 0 .17-.01A3.003 3.003 0 0 0 15 7Z"/></svg>
                                <?php echo at('best_sellers'); ?>
                            </span>
                        </div>
                        <div id="ov-best-sellers">
                            <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;"><?php echo at('no_sales_yet_overview'); ?></div>
                        </div>
                    </div>
                    <div class="activity-card">
                        <div class="activity-header">
                            <span class="activity-title">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px; vertical-align:text-bottom;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                <?php echo at('inventory_breakdown'); ?>
                            </span>
                        </div>
                        <div id="ov-inventory">
                            <div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;"><?php echo at('no_products_added'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── VIEW PRODUCTS ── -->
            <div class="section" id="section-view-products">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('view_products'); ?></h1>
                        <p class="page-subtitle"><?php echo at('inventory'); ?></p>
                    </div>
                    <button class="btn btn-primary" onclick="switchSection('add-product')">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        <?php echo at('add_product'); ?>
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
                        <div class="metric-label"><?php echo at('total_products'); ?></div>
                    </div>
                    <div class="metric-card filter-trigger" data-filter="active">
                        <div class="metric-header">
                            <div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <polyline points="20,6 9,17 4,12" />
                                </svg></div>
                        </div>
                        <div class="metric-value" id="activeProductsCount">0</div>
                        <div class="metric-label"><?php echo at('in_stock'); ?></div>
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
                        <div class="metric-label"><?php echo at('stock_low'); ?></div>
                    </div>
                </div>



                <!-- Premium Controls Bar -->
                <div class="controls-bar"
                    style="display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:32px; padding-bottom:24px; border-bottom:1px solid var(--border-color); flex-wrap:wrap;">

                    <!-- Left: Dropdowns -->
                    <div class="controls-group-left" style="display:flex; align-items:center; gap:12px; order:1;">
                        <!-- Category Filter Dropdown -->
                        <div class="dropdown-wrapper" id="filterDropdownWrapper">
                            <button class="dropdown-btn" id="filterDropdownBtn">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" style="opacity:0.6;">
                                    <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                                </svg>
                                <span class="dropdown-label"
                                    style="opacity:0.6; font-weight:400; font-size:13px;"><?php echo at('filter'); ?>:</span>
                                <span class="dropdown-current" id="currentFilterLabel"
                                    style="font-weight:600; font-size:13px;"><?php echo at('all_products'); ?></span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" style="opacity:0.4;">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </button>
                            <div class="dropdown-panel" id="filterDropdownPanel">
                                <button class="dropdown-option active" data-category="all"><?php echo at('all_products'); ?></button>
                                <div style="height:1px; background:var(--border-color); margin:5px 8px;"></div>
                                <button class="dropdown-option" data-category="biostimulants"><?php echo at('biostimulants'); ?></button>
                                <button class="dropdown-option" data-category="crystalline"><?php echo at('crystalline'); ?></button>
                                <button class="dropdown-option" data-category="granular"><?php echo at('granular'); ?></button>
                                <button class="dropdown-option" data-category="soil_improvers"><?php echo at('soil_improvers'); ?></button>
                            </div>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="dropdown-wrapper" id="sortDropdownWrapper">
                            <button class="dropdown-btn" id="sortDropdownBtn">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" style="opacity:0.6;">
                                    <path d="M11 5L6 9l5 4M13 19l5-4-5-4" />
                                    <path d="M6 9h12M18 15H6" />
                                </svg>
                                <span class="dropdown-label"
                                    style="opacity:0.6; font-weight:400; font-size:13px;"><?php echo at('sort'); ?>:</span>
                                <span class="dropdown-current" id="currentSortLabel"
                                    style="font-weight:600; font-size:13px;"><?php echo at('newest_first'); ?></span>
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" style="opacity:0.4;">
                                    <polyline points="6 9 12 15 18 9" />
                                </svg>
                            </button>
                            <div class="dropdown-panel" id="sortDropdownPanel">
                                <button class="dropdown-option active" data-sort="newest"><?php echo at('newest_first'); ?></button>
                                <button class="dropdown-option" data-sort="oldest"><?php echo at('oldest_first'); ?></button>
                                <div style="height:1px; background:var(--border-color); margin:5px 8px;"></div>
                                <button class="dropdown-option" data-sort="az"><?php echo at('name_az'); ?></button>
                                <button class="dropdown-option" data-sort="za"><?php echo at('name_za'); ?></button>
                                <button class="dropdown-option" data-sort="stock-low"><?php echo at('low_stock_first'); ?></button>
                                <button class="dropdown-option" data-sort="stock-high"><?php echo at('high_stock_first'); ?></button>
                            </div>
                        </div>
                    </div>

                    <!-- Center: Search -->
                    <div class="search-pill-wrapper" style="position:relative; width:400px; order:2;">
                        <input type="text" id="productSearchInput" class="form-input"
                            placeholder="<?php echo at('search_by_name_desc'); ?>"
                            style="width:100%; padding-left:38px; height:45px; border-radius:100px; background:var(--bg-surface); border:1px solid var(--border-color); font-size:13px; box-shadow:var(--shadow-sm);">
                        <div
                            style="position:absolute; left:14px; top:50%; transform:translateY(-50%); color:var(--text-muted); pointer-events:none;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </div>
                    </div>

                    <!-- Right: Count -->
                    <div class="status-badge-wrapper"
                        style="background:rgba(200,168,75,0.1); color:var(--accent-gold); padding:9px 18px; border-radius:100px; font-size:12px; font-weight:600; border:1px solid rgba(200,168,75,0.2); white-space:nowrap; order:3; min-width:120px; text-align:center;">
                        <span id="filteredCount" style="font-weight:800;">0</span> <?php echo at('products_available'); ?>
                    </div>
                </div>

                <div class="product-cards-grid" id="productsGrid"></div>
            </div>

            <!-- ── ADD PRODUCT ── -->
            <div class="section" id="section-add-product">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('add_product'); ?></h1>
                        <p class="page-subtitle"><?php echo at('fill_details_add_product'); ?></p>
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
                                    <h3><?php echo at('product_details'); ?></h3>
                                    <p><?php echo at('basic_info_content'); ?></p>
                                </div>
                            </div>
                            <div class="form-panel-body">
                                <div class="form-section-divider"><span><?php echo at('product_names'); ?></span></div>
                                <div class="lang-tabs" id="nameLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq"><?php echo at('albanian'); ?></button>
                                    <button type="button" class="lang-tab" data-lang="en"><?php echo at('english'); ?></button>
                                </div>
                                <div class="lang-content active" id="name-sq-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('product_name_sq'); ?></label><input type="text" name="name_sq" id="name_sq"
                                            class="form-input" placeholder="p.sh. Pleh Granular Premium" required></div>
                                </div>
                                <div class="lang-content" id="name-en-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('product_name_en'); ?></label><input type="text" name="name_en" id="name_en"
                                            class="form-input" placeholder="e.g. Premium Granular Fertilizer" required>
                                    </div>
                                </div>
                                
                                <div class="form-section-divider"><span><?php echo at('category'); ?></span></div>
                                <div class="category-grid" id="categoryGrid" style="margin-bottom:24px;">
                                    <label class="category-option selected"><input type="radio" name="category" value="biostimulants" checked>
                                        <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 2 4 10-4 10-4-10z"/></svg></div>
                                        <div class="category-option-name"><?php echo at('biostimulants'); ?></div>
                                    </label>
                                    <label class="category-option"><input type="radio" name="category" value="crystalline">
                                        <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 13L2 9z"/></svg></div>
                                        <div class="category-option-name"><?php echo at('crystalline'); ?></div>
                                    </label>
                                    <label class="category-option"><input type="radio" name="category" value="granular">
                                        <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20M5.45 5.45l13.1 13.1M18.55 5.45 5.45 18.55"/></svg></div>
                                        <div class="category-option-name"><?php echo at('granular'); ?></div>
                                    </label>
                                    <label class="category-option"><input type="radio" name="category" value="soil_improvers">
                                        <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 7c0-1.1.9-2 2-2s2 .9 2 2M11 11c0-1.1.9-2 2-2s2 .9 2 2"/><path d="M3 13a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V6"/><path d="m11 21-2-2 2-2 2 2-2 2z"/></svg></div>
                                        <div class="category-option-name"><?php echo at('soil_improvers'); ?></div>
                                    </label>
                                </div>

                                <div class="form-section-divider"><span><?php echo at('stock_quantity'); ?></span></div>
                                <div class="form-group" style="margin-bottom:24px;">
                                    <div class="qty-control" style="width:100%; height:48px;"><button type="button" class="qty-btn" id="qtyMinus">−</button>
                                        <input type="number" name="quantity" id="quantity" class="qty-input" value="0" min="0">
                                        <button type="button" class="qty-btn" id="qtyPlus">+</button>
                                    </div>
                                </div>
                                <div class="form-section-divider"><span><?php echo at('desc'); ?></span></div>
                                <div class="lang-tabs" id="descLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq"><?php echo at('albanian'); ?></button>
                                    <button type="button" class="lang-tab" data-lang="en"><?php echo at('english'); ?></button>
                                </div>
                                <div class="lang-content active" id="desc-sq-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('description_sq'); ?></label><textarea name="desc_sq" id="desc_sq" class="form-input"
                                            style="height:90px;resize:vertical;"
                                            placeholder="Shkruani përshkrimin..."></textarea></div>
                                </div>
                                <div class="lang-content" id="desc-en-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('description_en'); ?></label><textarea name="desc_en" id="desc_en" class="form-input"
                                            style="height:90px;resize:vertical;"
                                            placeholder="Write a product description..."></textarea></div>
                                </div>
                                <div class="form-section-divider"><span><?php echo at('image'); ?></span></div>
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
                                        <div class="upload-title"><?php echo at('drop_image_browse'); ?></div>
                                    </div>
                                    <div class="upload-preview" id="uploadPreview"><img id="previewImg" src=""
                                            alt="Preview"><button type="button" class="upload-preview-remove"
                                            onclick="removePreview()">✕</button></div>
                                </div>
                                </div>
                                <div class="form-actions" style="margin-top:32px; padding-top:24px; border-top:1px solid var(--border-color);">
                                    <button type="submit" class="btn btn-primary" id="saveProductBtn" style="height:50px; padding:0 32px;">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" style="margin-right:8px;">
                                            <path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                                            <polyline points="17,21 17,13 7,13 7,21" />
                                            <polyline points="7,3 7,8 15,8" />
                                        </svg>
                                        <?php echo at('save_product'); ?>
                                    </button>
                                    <button type="button" class="btn btn-secondary" id="cancelProductBtn" style="height:50px;"><?php echo at('cancel'); ?></button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>

            <!-- ── ADD SALE ── -->
            <div class="section" id="section-add-sale">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('record_sale'); ?></h1>
                        <p class="page-subtitle"><?php echo at('record_sale_desc'); ?></p>
                    </div>
                </div>

                <div class="add-sale-layout" style="display:flex; flex-direction:column; gap:32px; width:100%; margin:0;">
                    <div class="sale-form-card" style="width:100%; box-shadow:var(--shadow-lg);">
                        <div class="sale-form-header" style="padding:28px 32px; border-bottom:1px solid rgba(255,255,255,0.1);">
                            <div class="sale-form-header-icon" style="width:48px; height:48px; background:rgba(255,255,255,0.15); border:1px solid rgba(255,255,255,0.2); color:#fff;"><svg width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg></div>
                            <div>
                                <h3 style="font-size:20px; font-weight:700; color:#fff;"><?php echo at('record_sale'); ?></h3>
                                <p style="font-size:13px; color:rgba(255,255,255,0.7);"><?php echo at('record_sale_desc'); ?></p>
                            </div>
                        </div>
                        <div class="sale-form-body" style="padding:32px;">
                            <div class="form-group" style="margin-bottom:24px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">
                                    <label class="form-label" style="margin-bottom:0; font-weight:700;"><?php echo at('choose_product'); ?></label>
                                    <div id="selectionStatus" style="font-size:12px; font-weight:600; color:var(--text-muted);"><?php echo at('no_product_selected'); ?></div>
                                </div>
                                <div class="search-input-wrap">
                                    <input type="text" id="salesProductSearch" class="form-input"
                                        placeholder="<?php echo at('search_products_name'); ?>" autocomplete="off">
                                    <svg class="search-icon" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </div>
                            </div>
                            <div class="product-selector" id="salesProductSelector">
                                <div style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">
                                    <?php echo at('loading_products'); ?></div>
                            </div>
                            <div class="form-section-divider" style="margin:24px 0 20px;"><span style="background:var(--bg-secondary); padding:0 15px; font-weight:700; font-size:12px; color:var(--accent-gold); text-transform:uppercase; letter-spacing:1px;"><?php echo at('sale_details'); ?></span>
                            </div>
                            <div class="sale-qty-row" style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">
                                <div class="form-group"><label class="form-label" style="font-weight:600;"><?php echo at('quantity_sold'); ?></label>
                                    <div class="qty-control" style="height:48px; background:var(--bg-surface);"><button type="button" class="qty-btn"
                                            id="saleQtyMinus" style="font-size:18px;">−</button><input type="number" id="saleQty"
                                            class="qty-input" value="1" min="1" style="font-size:16px; font-weight:700;"><button type="button" class="qty-btn"
                                            id="saleQtyPlus" style="font-size:18px;">+</button></div>
                                </div>
                                <div class="form-group"><label class="form-label" style="font-weight:600;"><?php echo at('unit_price'); ?></label>
                                    <div style="position:relative;">
                                        <div style="position:absolute; left:14px; top:14px; font-weight:700; color:var(--text-muted); font-size:14px;" id="saleCurrencySymbol">Lek</div>
                                        <input type="number" id="salePrice" class="form-input" placeholder="0.00" min="0" step="0.01" style="height:48px; padding-left:48px; font-weight:700; font-size:16px; border-radius:12px; background:var(--bg-surface);">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom:0;"><label
                                    class="form-label" style="font-weight:600;"><?php echo at('note_optional'); ?></label><input type="text" id="saleNote"
                                    class="form-input" placeholder="<?php echo at('note_placeholder'); ?>" style="height:48px; border-radius:12px; background:var(--bg-surface);"></div>
                            <div style="margin-top:32px;">
                                <button type="button" class="btn btn-primary" style="width:100%; justify-content:center; height:56px; font-size:16px; font-weight:700; border-radius:12px; box-shadow:0 4px 15px rgba(212,168,83,0.3);"
                                    onclick="recordSale()">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2.5" style="margin-right:10px;">
                                        <polyline points="20,6 9,17 4,12" />
                                    </svg>
                                    <?php echo at('record_sale_btn'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="recent-sales-card" style="width:100%; background:var(--bg-secondary); border-radius:16px; border:1px solid var(--border-color); padding:24px;">
                        <div class="rsw-header" style="margin-bottom:20px; font-weight:700; font-size:16px; display:flex; align-items:center; gap:10px;"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg><?php echo at('recent_sales'); ?></div>
                        <div id="recentSalesList">
                            <div class="rsw-empty"><?php echo at('sales_history_empty'); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── VIEW SALES ── -->
            <div class="section" id="section-view-sales">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('view_sales'); ?></h1>
                        <p class="page-subtitle"><?php echo at('browse_manage_sales'); ?></p>
                    </div>
                    <button class="btn btn-danger btn-sm" onclick="clearSalesHistory()">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <polyline points="3,6 5,6 21,6" />
                            <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6" />
                        </svg>
                        <?php echo at('clear_all'); ?>
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
                        <div class="smc-label"><?php echo at('total_units_sold'); ?></div>
                    </div>
                    <div class="sales-metric-card profit">
                        <div class="smc-top">
                            <div class="smc-icon profit"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/><path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/></svg></div>
                        </div>
                        <div class="smc-value" id="vs-revenue">0.00</div>
                        <div class="smc-label"><?php echo at('total_revenue_short'); ?></div>
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
                        <div class="smc-label"><?php echo at('total_transactions'); ?></div>
                    </div>
                </div>
                <!-- Filters -->
                <div class="view-sales-filters">
                    <div class="filter-chip active" data-vsfilter="all"><?php echo at('all_categories'); ?></div>
                    <div class="filter-chip" data-vsfilter="biostimulants"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="m12 2 4 10-4 10-4-10z"/></svg><?php echo at('biostimulants'); ?></div>
                    <div class="filter-chip" data-vsfilter="crystalline"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="M6 3h12l4 6-10 13L2 9z"/></svg><?php echo at('crystalline'); ?></div>
                    <div class="filter-chip" data-vsfilter="granular"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="M12 2v20M2 12h20M5.45 5.45l13.1 13.1M18.55 5.45 5.45 18.55"/></svg><?php echo at('granular'); ?></div>
                    <div class="filter-chip" data-vsfilter="soil_improvers"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:6px;"><path d="M7 7c0-1.1.9-2 2-2s2 .9 2 2M11 11c0-1.1.9-2 2-2s2 .9 2 2"/><path d="M3 13a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V6"/><path d="m11 21-2-2 2-2 2 2-2 2z"/></svg><?php echo at('soil_improvers'); ?></div>
                    <input type="text" id="salesSearch" class="form-input search-inline"
                        placeholder="<?php echo at('search'); ?>..." oninput="renderSalesTable()">
                </div>
                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title"><?php echo at('sales_history'); ?> <span class="sales-count-badge"
                                id="salesCountBadge">0</span></div>
                    </div>
                    <div id="salesTableContainer">
                        <div class="sales-empty">
                            <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <polyline points="23,6 13.5,15.5 8.5,10.5 1,18" />
                                    <polyline points="17,6 23,6 23,12" />
                                </svg></div>
                            <h4><?php echo at('no_sales_yet'); ?></h4>
                            <p><?php echo at('go_add_sale'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── COLLABORATORS ── -->
            <div class="section" id="section-collaborators">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('collaborator_companies'); ?></h1>
                        <p class="page-subtitle"><?php echo at('manage_collaborators_desc'); ?></p>
                    </div>
                    <div style="display:flex; gap:12px;">
                        <button class="btn btn-primary btn-sm" onclick="showAddCollaboratorModal()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <?php echo at('add_collaborator'); ?>
                        </button>
                    </div>
                </div>

                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title"><?php echo at('collaborators'); ?> <span class="sales-count-badge"
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
                            <h4><?php echo at('no_collaborators_yet'); ?></h4>
                            <p><?php echo at('add_collaborators_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── ANALYTICS ── -->
            <div class="section" id="section-analytics">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('analytics'); ?></h1>
                        <p class="page-subtitle"><?php echo at('visual_insights'); ?></p>
                    </div>
                </div>

                <!-- Monthly Sales Bar Chart -->
                <div class="analytics-two-col" style="margin-bottom:20px;">
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:text-top;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><?php echo at('revenue_distribution'); ?></h3>
                        </div>
                        <div id="revenuePieWrap"><div class="no-data-msg"><?php echo at('no_sales_recorded'); ?></div></div>
                    </div>
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:text-top;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg><?php echo at('inquiry_response_status'); ?></h3>
                        </div>
                        <div id="messagePieWrap"><div class="no-data-msg"><?php echo at('no_messages'); ?></div></div>
                    </div>
                </div>

                <!-- Category Pie + Top Products -->
                <div class="analytics-two-col">
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:text-top;"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"/><path d="M22 12A10 10 0 0 0 12 2v10z"/></svg><?php echo at('inventory_health'); ?></h3>
                        </div>
                        <div id="categoryPieWrap">
                            <div class="no-data-msg">
                                <h4><?php echo at('no_sales_data'); ?></h4>
                                <p><?php echo at('record_sales_category'); ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="analytics-card" style="margin-bottom:0;">
                        <div class="analytics-card-header">
                            <h3 class="analytics-card-title"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-right:8px;vertical-align:text-top;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6M18 9h1.5a2.5 2.5 0 0 0 0-5H18M4 22h16M10 14.66V17c0 .55.45 1 1 1h2c.55 0 1-.45 1-1v-2.34c0-.5-.37-.91-.87-.98a10.007 10.007 0 0 1-2.26 0c-.5.07-.87.48-.87.98ZM15 7c0-1.66-1.34-3-3-3s-3 1.34-3 3c0 1.25.77 2.3 1.83 2.76A10.003 10.003 0 0 0 12 11c.06 0 .11 0 .17-.01A3.003 3.003 0 0 0 15 7Z"/></svg><?php echo at('top_products'); ?></h3>
                        </div>
                        <div id="topProductsChart">
                            <div class="no-data-msg">
                                <h4><?php echo at('no_sales_data'); ?></h4>
                                <p><?php echo at('record_sales_top'); ?></p>
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
                        <h1 class="page-title"><?php echo at('inquiry_messages'); ?></h1>
                        <p class="page-subtitle"><?php echo at('manage_messages_desc'); ?></p>
                    </div>
                    <div style="display:flex; gap:12px;">
                        <button class="btn btn-secondary btn-sm" onclick="clearAllMessages()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3 6 5 6 21 6"></polyline>
                                <path
                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                </path>
                                <line x1="14" y1="11" x2="14" y2="17"></line>
                            </svg>
                            <?php echo at('clear_all'); ?>
                        </button>
                    </div>
                </div>

                <div class="sales-table-card">
                    <div class="sales-table-header">
                        <div class="sales-table-title"><?php echo at('recent_inquiries'); ?> <span class="sales-count-badge"
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
                            <h4><?php echo at('no_messages_yet'); ?></h4>
                            <p><?php echo at('inquiries_web_desc'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── SETTINGS ── -->
            <div class="section" id="section-settings">
                <div class="page-header">
                    <div>
                        <h1 class="page-title"><?php echo at('settings'); ?></h1>
                        <p class="page-subtitle"><?php echo at('manage_preferences'); ?></p>
                    </div>
                </div>
                <div class="settings-content">
                    <!-- Business Information Section -->
                    <div class="settings-section">
                        <h3 class="settings-section-title"><?php echo at('business_info'); ?></h3>
                        <form id="businessInfoForm">
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label"><?php echo at('phone_1'); ?></label>
                                    <input type="text" name="phone_1" id="set_phone_1" class="form-input"
                                        placeholder="+383 49 000 000">
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo at('phone_2'); ?></label>
                                    <input type="text" name="phone_2" id="set_phone_2" class="form-input"
                                        placeholder="+383 44 000 000">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo at('email'); ?></label>
                                <input type="email" name="email" id="set_email" class="form-input"
                                    placeholder="info@agrofanema.com">
                            </div>
                            <div class="form-group">
                                <label class="form-label"><?php echo at('address'); ?></label>
                                <textarea name="address" id="set_address" class="form-input"
                                    style="height: 80px; resize: none;"
                                    placeholder="<?php echo at('enter_address'); ?>"></textarea>
                            </div>

                            <div class="settings-section-divider"></div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label class="form-label"><?php echo at('primary_currency'); ?></label>
                                    <select name="currency" id="set_currency" class="form-input"
                                        style="background-image: none;">
                                        <option value="ALL"><?php echo at('albanian_lek'); ?> (ALL)</option>
                                        <option value="EUR"><?php echo at('euro'); ?> (EUR)</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label"><?php echo at('dashboard_language'); ?></label>
                                    <select name="admin_language" id="set_admin_lang" class="form-input"
                                        style="background-image: none;">
                                        <option value="en" <?php echo $admin_lang == 'en' ? 'selected' : ''; ?>>
                                            <?php echo at('english'); ?></option>
                                        <option value="sq" <?php echo $admin_lang == 'sq' ? 'selected' : ''; ?>>
                                            <?php echo at('albanian'); ?></option>
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary" style="margin-top: 20px;"><?php echo at('save_all_settings'); ?></button>
                        </form>
                    </div>

                    <!-- Security Section -->
                    <div class="settings-section">
                        <h3 class="settings-section-title"><?php echo at('security'); ?></h3>
                        <form id="changePasswordForm">
                            <div class="form-group">
                                <div style="position: relative;">
                                    <input type="password" id="current_password" name="current_password"
                                        class="form-input" placeholder="Enter current password" required>
                                    <button type="button" class="password-toggle" data-target="current_password"
                                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted); display: flex; align-items: center; justify-content: center; padding: 4px;">
                                        <svg class="eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        <svg class="eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" style="display: none;">
                                            <path
                                                d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                            </path>
                                            <line x1="1" y1="1" x2="23" y2="23"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <div style="position: relative;">
                                        <input type="password" id="new_password" name="new_password" class="form-input"
                                            placeholder="<?php echo at('enter_new_password'); ?>" required>
                                        <button type="button" class="password-toggle" data-target="new_password"
                                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted); display: flex; align-items: center; justify-content: center; padding: 4px;">
                                            <svg class="eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <svg class="eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" style="display: none;">
                                                <path
                                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                                </path>
                                                <line x1="1" y1="1" x2="23" y2="23"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div style="position: relative;">
                                        <input type="password" id="confirm_password" name="confirm_password"
                                            class="form-input" placeholder="Confirm new password" required>
                                        <button type="button" class="password-toggle" data-target="confirm_password"
                                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--text-muted); display: flex; align-items: center; justify-content: center; padding: 4px;">
                                            <svg class="eye-show" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            <svg class="eye-hide" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" style="display: none;">
                                                <path
                                                    d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                                </path>
                                                <line x1="1" y1="1" x2="23" y2="23"></line>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary"
                                style="background: var(--primary-dark); color: #fff;"><?php echo at('change_password'); ?></button>
                        </form>
                    </div>

                    <!-- Appearance Section (Moved Above Danger Zone) -->
                    <div class="settings-section" style="margin-top: 48px;">
                        <h3 class="settings-section-title"><?php echo at('appearance'); ?></h3>
                        <div class="toggle-row">
                            <div class="toggle-label">
                                <div class="toggle-label-title"><?php echo at('dark_mode'); ?></div>
                                <div class="toggle-label-desc"><?php echo at('theme_switch_desc'); ?></div>
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
                            style="color:var(--danger); border-color: rgba(239,68,68,0.2);"><?php echo at('danger_zone'); ?></h3>
                        <div
                            style="border:1px solid rgba(239,68,68,0.3); border-radius:12px; overflow:hidden; background: rgba(239,68,68,0.02);">
                            <div
                                style="padding:20px; border-bottom:1px solid rgba(239,68,68,0.1); display:flex; align-items:center; justify-content:space-between;">
                                <div>
                                    <div style="font-size:14px; font-weight:600;"><?php echo at('clear_sales'); ?></div>
                                    <div style="font-size:12px; color:var(--text-muted);"><?php echo at('permanently_delete_sales'); ?></div>
                                </div>
                                <button class="btn btn-danger btn-sm" onclick="clearSalesHistory()"><?php echo at('clear_data'); ?></button>
                            </div>
                            <div style="padding:20px; display:flex; align-items:center; justify-content:space-between;">
                                <div>
                                    <div style="font-size:14px; font-weight:600;"><?php echo at('delete_products'); ?></div>
                                    <div style="font-size:12px; color:var(--text-muted);"><?php echo at('remove_all_products'); ?></div>
                                </div>
                                <button class="btn btn-danger btn-sm"
                                    onclick="if(confirm(T.confirm_delete_all_products)){products=[];saveProducts();renderProducts();renderSalesProductSelector();updateAllMetrics();showToast(T.delete_all,'error');}"><?php echo at('delete_all'); ?></button>
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
                        <?php echo at('edit_product'); ?></h2>
                    <p style="font-size:13px; color:var(--text-muted);" id="editModalSubtitle"><?php echo at('update_product_info'); ?></p>
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
                    <input type="hidden" name="image" id="editProductImageHidden">
                    <div class="add-product-layout" style="padding:30px; gap:30px; grid-template-columns: 1.5fr 1fr;">
                        <div class="form-panel" style="background:none; border:none; padding:0; box-shadow:none;">
                            <div class="form-panel-body" style="padding:0;">
                                <div class="form-section-divider" style="margin-top:0;"><span><?php echo at('product_names'); ?></span></div>
                                <div class="lang-tabs" id="editNameLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 <?php echo at('albanian'); ?></button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 <?php echo at('english'); ?></button>
                                </div>
                                <div class="lang-content active" id="edit-name-sq-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('product_name_sq'); ?></label><input type="text" name="name_sq" id="edit_name_sq"
                                            class="form-input" required></div>
                                </div>
                                <div class="lang-content" id="edit-name-en-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('product_name_en'); ?></label><input type="text" name="name_en" id="edit_name_en"
                                            class="form-input" required></div>
                                </div>

                                <div class="form-section-divider"><span><?php echo at('descriptions'); ?></span></div>
                                <div class="lang-tabs" id="editDescLangTabs">
                                    <button type="button" class="lang-tab active" data-lang="sq">🇦🇱 <?php echo at('albanian'); ?></button>
                                    <button type="button" class="lang-tab" data-lang="en">🇬🇧 <?php echo at('english'); ?></button>
                                </div>
                                <div class="lang-content active" id="edit-desc-sq-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('description_sq'); ?></label><textarea name="desc_sq" id="edit_desc_sq"
                                            class="form-input" style="height:90px;resize:vertical;"></textarea></div>
                                </div>
                                <div class="lang-content" id="edit-desc-en-content">
                                    <div class="form-group"><label class="form-label"><?php echo at('description_en'); ?></label><textarea name="desc_en" id="edit_desc_en"
                                            class="form-input" style="height:90px;resize:vertical;"></textarea></div>
                                </div>

                                <div class="form-section-divider"><span><?php echo at('product_image'); ?></span></div>
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
                                        <div class="upload-title"><?php echo at('click_change_image'); ?></div>
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
                                    </svg><?php echo at('category'); ?></div>
                                <div class="sidebar-widget-body">
                                    <div class="category-grid" id="editCategoryGrid">
                                        <label class="category-option"><input type="radio" name="category"
                                                value="biostimulants">
                                            <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m12 2 4 10-4 10-4-10z"/></svg></div>
                                            <div class="category-option-name"><?php echo at('biostimulants'); ?></div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="crystalline">
                                            <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 13L2 9z"/></svg></div>
                                            <div class="category-option-name"><?php echo at('crystalline'); ?></div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="granular">
                                            <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M2 12h20M5.45 5.45l13.1 13.1M18.55 5.45 5.45 18.55"/></svg></div>
                                            <div class="category-option-name"><?php echo at('granular'); ?></div>
                                        </label>
                                        <label class="category-option"><input type="radio" name="category"
                                                value="soil_improvers">
                                            <div class="category-option-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 7c0-1.1.9-2 2-2s2 .9 2 2M11 11c0-1.1.9-2 2-2s2 .9 2 2"/><path d="M3 13a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V6"/><path d="m11 21-2-2 2-2 2 2-2 2z"/></svg></div>
                                            <div class="category-option-name"><?php echo at('soil_improvers'); ?></div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-widget">
                                <div class="sidebar-widget-header"><svg width="16" height="16" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2">
                                        <path
                                            d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" />
                                    </svg><?php echo at('stock_quantity'); ?></div>
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
                                    style="width:100%; justify-content:center;"><?php echo at('save'); ?></button>
                                <button type="button" class="btn btn-secondary" onclick="closeEditModal()"
                                    style="width:100%; justify-content:center;"><?php echo at('cancel'); ?></button>
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
            <div class="modal-title"><?php echo at('sign_out'); ?></div>
            <div class="modal-desc"><?php echo at('sign_out_desc'); ?></div>
            <div class="modal-actions">
                <button class="btn btn-secondary"
                    onclick="document.getElementById('logoutModal').classList.remove('active')"><?php echo at('cancel'); ?></button>
                <button class="btn btn-danger" onclick="window.location.href='login.php?logout=1'"><?php echo at('logout'); ?></button>
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
           STATE — Managed via Database API
        ═══════════════════════════════════════════════════ */
        let products = [];
        let salesHistory = [];
        let dashboardStats = {
            revenue: 0,
            units: 0,
            sale_count: 0,
            total_stock: 0,
            low_stock_count: 0,
            total_items: 0,
            recent_sales: []
        };
        let selectedSaleProductId = null;
        let vsFilter = 'all';

        // Removed local storage save functions

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
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (menuToggle && sidebar && overlay) {
            menuToggle.addEventListener('click', () => {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            });
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        document.querySelectorAll('.nav-item[data-section]').forEach(item => {
            item.addEventListener('click', function () {
                const s = this.dataset.section;
                if (s === 'logout') {
                    document.getElementById('logoutModal').classList.add('active');
                    return;
                }
                switchSection(s);
                if (window.innerWidth <= 768 && sidebar && overlay) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                }
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
            const locale = adminLang === 'sq' ? 'sq-AL' : 'en-US';
            const timeStr = now.toLocaleTimeString(locale, {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
            clockEl.textContent = timeStr;

            if (adminLang === 'sq') {
                const sqDays = ['E Diel', 'E Hënë', 'E Martë', 'E Mërkurë', 'E Enjte', 'E Premte', 'E Shtunë'];
                const sqMonths = ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nëntor', 'Dhjetor'];
                dateEl.textContent = `${sqDays[now.getDay()]}, ${now.getDate()} ${sqMonths[now.getMonth()]} ${now.getFullYear()}`;
            } else {
                dateEl.textContent = now.toLocaleDateString('en-US', {
                    weekday: 'long',
                    day: 'numeric',
                    month: 'long',
                    year: 'numeric'
                });
            }
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
            showToast(T.toast_profile_updated, 'success');
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
           SETTINGS LOAD & SAVE
        ═══════════════════════════════════════════════════ */
        let siteSettings = { currency: 'ALL', rate: 100 };

        async function fetchSettings() {
            try {
                const res = await fetch('essentials/settings-api.php?action=get');
                const d = await res.json();
                if (d.success && d.settings) {
                    const s = d.settings;
                    siteSettings.currency = s.currency || 'ALL';
                    siteSettings.rate = 100; // Fixed rate as requested

                    document.getElementById('set_phone_1').value = s.phone_1 || '';
                    document.getElementById('set_phone_2').value = s.phone_2 || '';
                    document.getElementById('set_email').value = s.email || '';
                    document.getElementById('set_address').value = s.address || '';
                    document.getElementById('set_currency').value = siteSettings.currency;
                    document.getElementById('set_admin_lang').value = s.admin_language || 'en';

                    // Re-render components that might depend on currency
                    updateAllMetrics();
                    renderSalesTable();
                }
            } catch (err) { console.error('Error fetching settings:', err); }
        }

        function formatCurrency(val) {
            const num = parseFloat(val) || 0;
            if (siteSettings.currency === 'EUR') {
                return (num / siteSettings.rate).toLocaleString('en-IE', { style: 'currency', currency: 'EUR' });
            }
            return num.toLocaleString('sq-AL') + ' ALL';
        }

        document.getElementById('businessInfoForm').addEventListener('submit', async e => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.textContent;
            btn.textContent = 'Saving...';
            btn.disabled = true;

            const fd = new FormData(e.target);
            try {
                const res = await fetch('essentials/settings-api.php?action=update_info', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.success) {
                    showToast(T.toast_business_updated, 'success');
                    setTimeout(() => window.location.reload(), 1000);
                } else showToast(d.error || 'Error updating info', 'error');
            } catch (err) { showToast(T.toast_connection_error, 'error'); }
            finally { btn.textContent = originalText; btn.disabled = false; }
        });

        document.getElementById('changePasswordForm').addEventListener('submit', async e => {
            e.preventDefault();
            const btn = e.target.querySelector('button');
            const originalText = btn.textContent;
            btn.textContent = 'Changing...';
            btn.disabled = true;

            const fd = new FormData(e.target);
            try {
                const res = await fetch('essentials/settings-api.php?action=change_password', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.success) {
                    showToast(T.toast_password_changed, 'success');
                    e.target.reset();
                } else {
                    showToast(d.error || 'Error changing password', 'error');
                }
            } catch (err) { showToast(T.toast_connection_error, 'error'); }
            finally { btn.textContent = originalText; btn.disabled = false; }
        });

        // Password Visibility Toggles
        document.querySelectorAll('.password-toggle').forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.dataset.target;
                const input = document.getElementById(targetId);
                const eyeShow = this.querySelector('.eye-show');
                const eyeHide = this.querySelector('.eye-hide');

                if (input.type === 'password') {
                    input.type = 'text';
                    eyeShow.style.display = 'none';
                    eyeHide.style.display = 'block';
                } else {
                    input.type = 'password';
                    eyeShow.style.display = 'block';
                    eyeHide.style.display = 'none';
                }
            });
        });

        // Initialize Settings
        fetchSettings();

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
        let messages = [];

        async function fetchMessages() {
            try {
                const r = await fetch('essentials/contact-api.php?action=list');
                const d = await r.json();
                if (d.status === 'success') {
                    messages = d.messages;
                    renderMessagesTable();
                }
            } catch { }
        }

        async function deleteMessage(id) {
            if (!confirm(T.confirm_delete_message)) return;
            try {
                const r = await fetch(`essentials/contact-api.php?action=delete&id=${id}`);
                const d = await r.json();
                if (d.status === 'success') {
                    showToast(T.toast_message_deleted, 'error');
                    await fetchMessages();
                }
            } catch (err) { console.error('Delete message error:', err); }
        }

        async function markMessageRead(id) {
            try {
                const r = await fetch(`essentials/contact-api.php?action=update_status&id=${id}&status=read`);
                const d = await r.json();
                if (d.status === 'success') {
                    await fetchMessages();
                }
            } catch (err) { console.error('Update message error:', err); }
        }

        function renderMessagesTable() {
            const container = document.getElementById('messagesTableContainer');
            const badge = document.getElementById('messageCountBadge');
            if (!container) return;

            if (badge) badge.textContent = messages.length;

            // Updated sidebar badge
            const sideBadge = document.getElementById('sidebarMsgBadge');
            if (sideBadge) {
                const newCount = messages.filter(m => m.status === 'new').length;
                sideBadge.textContent = newCount;
                sideBadge.style.display = newCount > 0 ? 'inline-block' : 'none';
            }

            if (messages.length === 0) {
                container.innerHTML = `
                    <div class="sales-empty">
                        <div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" /><polyline points="22,6 12,13 2,6" /></svg></div>
                        <h4>${T.no_messages_yet}</h4>
                        <p>${T.inquiries_web_desc}</p>
                    </div>`;
                return;
            }

            container.innerHTML = `
                <table>
                    <thead>
                        <tr>
                            <th><?php echo at('status'); ?></th>
                            <th><?php echo at('name'); ?></th>
                            <th><?php echo at('email'); ?></th>
                            <th><?php echo at('phone'); ?></th>
                            <th><?php echo at('message'); ?></th>
                            <th><?php echo at('date'); ?></th>
                            <th><?php echo at('actions'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        ${messages.map(m => `
                            <tr style="${m.status === 'read' ? 'opacity:0.7;' : 'font-weight:600; background:rgba(200,168,75,0.03);'}">
                                <td>
                                    <span class="status-pill ${m.status === 'new' ? 'active' : 'inactive'}" style="font-size:10px; padding:2px 8px;">
                                        <span class="status-dot"></span>${m.status === 'new' ? T.new_status : T.read_status}
                                    </span>
                                </td>
                                <td>${m.first_name || ''} ${m.last_name || ''}</td>
                                <td><a href="mailto:${m.email}" style="color:var(--accent-gold); text-decoration:none;">${m.email}</a></td>
                                <td><a href="tel:${m.phone}" style="color:var(--accent-gold); text-decoration:none;">${m.phone || '—'}</a></td>
                                <td style="max-width:300px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; color:var(--text-muted); font-size:13px;" title="${m.message}">
                                    ${m.message}
                                </td>
                                <td style="font-size:12px; color:var(--text-muted); white-space:nowrap;">${new Date(m.created_at).toLocaleString()}</td>
                                <td>
                                    <div style="display:flex; gap:8px;">
                                        ${m.status === 'new' ? `<button class="btn btn-secondary btn-sm" onclick="markMessageRead(${m.id})">${T.read_status}</button>` : ''}
                                        <button class="btn btn-danger btn-sm btn-icon" onclick="deleteMessage(${m.id})" title="Delete Message">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        `).join('')}
                    </tbody>
                </table>`;
        }

        async function clearAllMessages() {
            if (!confirm(T.confirm_delete_all_messages)) return;
            try {
                const r = await fetch('essentials/contact-api.php?action=delete_all');
                const d = await r.json();
                if (d.status === 'success') {
                    showToast(T.toast_messages_cleared, 'error');
                    await fetchMessages();
                }
            } catch (err) { console.error('Clear messages error:', err); }
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
                        <h4>${T.no_collaborators_yet}</h4>
                        <p>${T.add_collaborators_desc}</p>
                    </div>`;
                return;
            }

            container.innerHTML = `
                <table>
                    <thead>
                        <tr>
                            <th>${T.company_name}</th>
                            <th>${T.website}</th>
                            <th>${T.actions}</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${collaborators.map(c => `
                            <tr>
                                <td><div style="display:flex; align-items:center; gap:10px;">
                                    <div style="width:32px; height:32px; border-radius:50%; background:var(--accent-gold); display:flex; align-items:center; justify-content:center; color:#fff; font-weight:800; font-size:14px;">${c.name.charAt(0)}</div>
                                    <span>${c.name}</span>
                                </div></td>
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
            modal.id = 'active-collab-modal';
            modal.innerHTML = `
                <div class="modal collab-modal">
                    <div class="collab-modal-header">
                        <div class="collab-modal-title">
                            <h2>${T.new_partner}</h2>
                            <p style="font-size:12px; opacity:0.7; color:${dark ? '#fff' : 'var(--text-muted)'}; margin-top:4px;">${T.add_partner_desc}</p>
                        </div>
                        <button class="btn-close" onclick="closeActiveCollabModal()" style="background:none; border:none; color:${dark ? '#fff' : 'var(--text-muted)'}; cursor:pointer; opacity:0.6; transition:0.2s;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
                    </div>
                    <div class="collab-modal-body">
                        <form id="collaboratorForm">
                            <input type="hidden" name="action" value="add">
                            <div class="collab-form-group">
                                <label class="collab-form-label">${T.company_name}</label>
                                <input type="text" name="name" class="form-input" placeholder="e.g. AgroCorp Ltd" required>
                            </div>
                            <div class="collab-form-group">
                                <label class="collab-form-label">${T.website_url}</label>
                                <div class="search-input-wrap">
                                    <input type="url" name="website" class="form-input" placeholder="https://example.com" required style="padding-left:44px;">
                                    <svg class="search-icon" style="left:16px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                </div>
                            </div>
                            <div class="collab-form-group" style="margin-bottom:0;">
                                <div style="display:flex; align-items:center; gap:12px; padding:15px; background:rgba(0,0,0,0.05); border-radius:8px; border:1px solid rgba(0,0,0,0.1);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--accent-gold)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                    <div style="font-size:12px; line-height:1.4;">${T.partner_display_note}</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="collab-modal-footer">
                        <button class="btn btn-secondary" onclick="closeActiveCollabModal()">${T.dismiss}</button>
                        <button class="btn btn-primary" onclick="saveCollaborator()" style="padding:10px 28px;">${T.add_partner}</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            setTimeout(() => modal.classList.add('active'), 10);
        }

        function closeActiveCollabModal() {
            const m = document.getElementById('active-collab-modal');
            if (m) {
                m.classList.remove('active');
                setTimeout(() => m.remove(), 400);
            }
        }
        function editCollaborator(id) {
            const collab = collaborators.find(c => Number(c.id) === Number(id));
            if (!collab) return;

            const modal = document.createElement('div');
            modal.className = 'modal-overlay';
            modal.id = 'active-collab-modal';
            modal.innerHTML = `
                <div class="modal collab-modal">
                    <div class="collab-modal-header">
                        <div class="collab-modal-title">
                            <h2>${T.edit_partner}</h2>
                            <p style="font-size:12px; opacity:0.7; color:${dark ? '#fff' : 'var(--text-muted)'}; margin-top:4px;">${T.update_details_for} ${collab.name}</p>
                        </div>
                        <button class="btn-close" onclick="closeActiveCollabModal()" style="background:none; border:none; color:${dark ? '#fff' : 'var(--text-muted)'}; cursor:pointer; opacity:0.6;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg></button>
                    </div>
                    <div class="collab-modal-body">
                        <form id="collaboratorForm">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="${id}">
                            <div class="collab-form-group">
                                <label class="collab-form-label">${T.company_name}</label>
                                <input type="text" name="name" value="${collab.name}" class="form-input" required>
                            </div>
                            <div class="collab-form-group">
                                <label class="collab-form-label">${T.website_url}</label>
                                <div class="search-input-wrap">
                                    <input type="url" name="website" value="${collab.website}" class="form-input" required style="padding-left:44px;">
                                    <svg class="search-icon" style="left:16px;" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                                </div>
                            </div>
                            <div class="collab-form-group" style="margin-bottom:0;">
                                <div style="display:flex; align-items:center; gap:12px; padding:15px; background:rgba(0,0,0,0.05); border-radius:8px; border:1px solid rgba(0,0,0,0.1);">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--accent-gold)" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4"/><path d="M12 8h.01"/></svg>
                                    <div style="font-size:12px; line-height:1.4;">${T.partner_typography_note}</div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="collab-modal-footer">
                        <button class="btn btn-secondary" onclick="closeActiveCollabModal()">${T.cancel}</button>
                        <button class="btn btn-primary" onclick="updateCollaborator()" style="padding:10px 28px;">${T.save}</button>
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
                    closeActiveCollabModal();
                    showToast(T.toast_collab_added, 'success');
                } else {
                    showToast(d.error || 'Error adding collaborator', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast(T.toast_server_error, 'error');
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
                    closeActiveCollabModal();
                    showToast(T.toast_collab_updated, 'success');
                } else {
                    showToast(d.error || 'Error updating collaborator', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast(T.toast_server_error, 'error');
            }
        }

        async function deleteCollaborator(id) {
            if (!confirm(T.confirm_delete_collaborator)) return;
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
                    showToast(T.toast_collab_deleted, 'error');
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
                grid.innerHTML = `<div style="grid-column:1/-1;"><div class="empty-state"><div class="empty-state-icon"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/></svg></div><h3>${T.no_products_yet}</h3><p>${T.start_adding_product}</p><button class="btn btn-primary" onclick="switchSection('add-product')">${T.add_first_product}</button></div></div>`;
                return;
            }

            // FILTERING & SORTING LOGIC
            const searchQuery = document.getElementById('productSearchInput')?.value.toLowerCase() || '';
            const activeFilterOption = document.querySelector('#filterDropdownPanel .dropdown-option.active');
            const categoryFilter = activeFilterOption ? activeFilterOption.dataset.category : 'all';
            const activeSortOption = document.querySelector('#sortDropdownPanel .dropdown-option.active');
            const sortMethod = activeSortOption ? activeSortOption.dataset.sort : 'newest';

            let filteredProducts = products.filter(p => {
                const matchesSearch = !searchQuery ||
                    (p.name_en || '').toLowerCase().includes(searchQuery) ||
                    (p.name_sq || '').toLowerCase().includes(searchQuery) ||
                    (p.desc_en || '').toLowerCase().includes(searchQuery) ||
                    (p.desc_sq || '').toLowerCase().includes(searchQuery) ||
                    (p.category || '').toLowerCase().includes(searchQuery);

                const matchesCategory = categoryFilter === 'all' || p.category === categoryFilter;

                return matchesSearch && matchesCategory;
            });

            // Sorting
            filteredProducts.sort((a, b) => {
                if (sortMethod === 'az') return (a.name_en || a.name_sq).localeCompare(b.name_en || b.name_sq);
                if (sortMethod === 'za') return (b.name_en || b.name_sq).localeCompare(a.name_en || a.name_sq);
                if (sortMethod === 'stock-low') return a.quantity - b.quantity;
                if (sortMethod === 'stock-high') return b.quantity - a.quantity;
                if (sortMethod === 'oldest') return a.id - b.id;
                return b.id - a.id; // newest (default)
            });

            const countEl = document.getElementById('filteredCount');
            if (countEl) countEl.textContent = filteredProducts.length;

            if (filteredProducts.length === 0) {
                grid.innerHTML = `<div style="grid-column:1/-1;text-align:center;padding:40px;color:var(--text-muted);">${T.no_products_found}</div>`;
                return;
            }

            filteredProducts.forEach((product, index) => {
                const stockStatus = product.quantity > 10 ? 'active' : (product.quantity > 0 ? 'pending' : 'inactive');
                const stockLabel = product.quantity > 10 ? T.in_stock : (product.quantity > 0 ? T.stock_low : T.out_of_stock);
                const card = document.createElement('div');
                card.className = 'product-card';
                card.onclick = (e) => {
                    if (e.target.closest('.product-card-actions')) return;
                    window.open(`product-view.php?id=${product.id}`, '_blank');
                };
                card.innerHTML = `
      <div class="product-card-img">${product.image ? `<img src="${product.image}" alt="">` : `<svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="opacity:0.3;"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>`}</div>
      <div class="product-card-body">
        <div class="product-card-title">${adminLang === 'sq' ? (product.name_sq || product.name_en) : (product.name_en || product.name_sq)}</div>
        <div class="product-card-sku">${adminLang === 'sq' ? (product.name_en || '') : (product.name_sq || '')} · #${product.id}</div>
        <div class="product-card-meta">
          <span style="background:var(--bg-surface);padding:3px 10px;border-radius:20px;font-size:11px;font-weight:600;text-transform:capitalize;">${product.category}</span>
          <span class="status-pill ${stockStatus}"><span class="status-dot"></span>${stockLabel} (${product.quantity})</span>
        </div>
        <div class="product-card-actions">
          <button class="btn btn-secondary btn-sm edit-product" data-index="${index}"><svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>${T.edit}</button>
          <button class="btn btn-danger btn-sm delete-product" data-id="${product.id}">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/></svg>${T.delete}
          </button>
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
                btn.addEventListener('click', async function () {
                    const id = this.dataset.id;
                    if (!confirm(T.confirm_delete_product)) return;

                    try {
                        const res = await fetch(`essentials/product-api.php?action=delete_permanent&id=${id}`);
                        const d = await res.json();

                        if (d.status === 'success') {
                            await fetchProducts(); // Refresh list
                            showToast(T.toast_product_deleted, 'success');
                        } else {
                            showToast(d.message || 'Error deleting product', 'error');
                        }
                    } catch (err) {
                        console.error('Delete error:', err);
                        showToast(T.toast_server_error, 'error');
                    }
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
            document.getElementById('editProductImageHidden').value = product.image || '';

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
            const btn = e.target.querySelector('button[type="submit"]');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Updating...';
            btn.disabled = true;

            const fd = new FormData(e.target);

            // Note: FormData(e.target) automatically includes the file from the input[type="file"]
            // No manual Base64 conversion needed now that product-api handles files.

            try {
                const res = await fetch('essentials/product-api.php?action=edit', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.status === 'success') {
                    closeEditModal();
                    await fetchProducts();
                    showToast(T.toast_product_updated, 'success');
                } else {
                    showToast(d.message || 'Error updating product', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast(T.toast_api_error, 'error');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
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
            const btn = document.getElementById('saveProductBtn');
            const originalText = btn.innerHTML;
            btn.innerHTML = 'Saving...';
            btn.disabled = true;

            const fd = new FormData(e.target);
            // standard multi-part upload

            try {
                const res = await fetch('essentials/product-api.php?action=create', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.status === 'success') {
                    resetProductForm();
                    switchSection('view-products');
                    await fetchProducts();
                    showToast(T.toast_product_added, 'success');
                } else {
                    showToast(d.message || 'Error adding product', 'error');
                }
            } catch (err) {
                console.error(err);
                showToast(T.toast_api_error, 'error');
            } finally {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }
        });

        async function fetchProducts() {
            try {
                const r = await fetch('essentials/product-api.php?action=list');
                const d = await r.json();
                if (d.status === 'success') {
                    products = d.products;
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
                c.innerHTML = `<div style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">${T.no_products_found}. <a href="#" onclick="switchSection('add-product');return false;" style="color:var(--accent-gold);">${T.add_product_first}</a></div>`;
                return;
            }

            const filtered = products.filter(p => {
                const nameSq = (p.name_sq || '').toLowerCase();
                const nameEn = (p.name_en || '').toLowerCase();
                const cat = (p.category || '').toLowerCase();
                return nameSq.includes(query) || nameEn.includes(query) || cat.includes(query);
            });

            if (filtered.length === 0) {
                c.innerHTML = `<div style="color:var(--text-muted);font-size:13px;grid-column:1/-1;padding:20px;text-align:center;">${T.no_match_search} "${query}".</div>`;
                return;
            }

            filtered.forEach(p => {
                const oos = p.quantity <= 0;
                const opt = document.createElement('div');
                opt.className = `ps-option${oos ? ' out-of-stock' : ''}${selectedSaleProductId === p.id ? ' selected' : ''}`;
                opt.dataset.id = p.id;
                opt.innerHTML = `<div class="ps-option-name">${adminLang === 'sq' ? (p.name_sq || p.name_en) : (p.name_en || p.name_sq)}</div><div class="ps-option-meta"><span style="text-transform:capitalize;">${p.category}</span><span>${oos ? (adminLang === 'sq' ? 'Pa gjendje' : 'Out of stock') : (adminLang === 'sq' ? 'Sasia: ' : 'Qty: ') + p.quantity}</span></div>`;
                if (!oos) {
                    opt.addEventListener('click', () => {
                        selectedSaleProductId = p.id;
                        document.querySelectorAll('.ps-option').forEach(o => o.classList.remove('selected'));
                        opt.classList.add('selected');
                        const qtyEl = document.getElementById('saleQty');
                        qtyEl.max = p.quantity;
                        qtyEl.value = Math.min(+qtyEl.value || 1, p.quantity);
                        
                        const status = document.getElementById('selectionStatus');
                        if (status) status.innerHTML = `<span style="color:var(--success)">Selected:</span> ${adminLang === 'sq' ? (p.name_sq || p.name_en) : (p.name_en || p.name_sq)}`;
                    });
                }
                c.appendChild(opt);
            });
        }

        function updateSalesMetrics() {
            const totalUnits = dashboardStats.units;
            const totalRevenue = dashboardStats.revenue;
            const totalStock = dashboardStats.total_stock;

            ['totalUnitsSold', 'vs-units'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = totalUnits.toLocaleString();
            });
            ['totalProfit', 'vs-revenue', 'totalRevenue'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = formatCurrency(totalRevenue);
            });
            const curSymbolEl = document.getElementById('saleCurrencySymbol');
            if (curSymbolEl) curSymbolEl.textContent = siteSettings.currency;
            ['totalStockRemaining'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.textContent = totalStock.toLocaleString();
            });
            const vcEl = document.getElementById('vs-count');
            if (vcEl) vcEl.textContent = dashboardStats.sale_count;
        }

        async function updateAllMetrics() {
            try {
                const res = await fetch('essentials/product-api.php?action=metrics');
                const d = await res.json();
                if (d.status === 'success') {
                    dashboardStats = d;
                    salesHistory = d.recent_sales.map(s => ({
                        id: 'SALE-' + s.id,
                        dbId: s.id,
                        productId: s.product_id,
                        productName: adminLang === 'sq' ? (s.name_sq || s.name_en) : (s.name_en || s.name_sq),
                        category: s.category,
                        qty: parseInt(s.quantity),
                        price: parseFloat(s.unit_price),
                        total: parseFloat(s.total_price),
                        note: s.note,
                        date: new Date(s.created_at).toLocaleString()
                    }));

                    updateInventoryMetrics();
                    updateSalesMetrics();
                    updateOverviewMetrics();
                }
            } catch (err) { console.error('Metrics error:', err); }
        }

        async function recordSale() {
            if (!selectedSaleProductId) {
                showToast(T.select_product_first, 'error');
                return;
            }
            const qty = parseInt(document.getElementById('saleQty').value) || 1;
            const priceInput = parseFloat(document.getElementById('salePrice').value) || 0;
            const note = document.getElementById('saleNote').value.trim();

            const btn = document.querySelector('.btn-record-sale');
            if (btn) btn.disabled = true;

            const fd = new FormData();
            fd.append('product_id', selectedSaleProductId);
            fd.append('quantity', qty);
            fd.append('unit_price', priceInput);
            fd.append('note', note);

            try {
                const res = await fetch('essentials/product-api.php?action=record_sale', {
                    method: 'POST',
                    body: fd
                });
                const d = await res.json();
                if (d.status === 'success') {
                    showToast(T.toast_sale_recorded.replace('{qty}', qty), 'success');

                    // Reset fields
                    selectedSaleProductId = null;
                    document.getElementById('saleQty').value = 1;
                    document.getElementById('salePrice').value = '';
                    document.getElementById('saleNote').value = '';

                    // Refresh data
                    await fetchProducts();
                    await updateAllMetrics();
                    renderRecentSales();
                    renderSalesTable();
                } else {
                    showToast(d.message || 'Error recording sale', 'error');
                }
            } catch (err) {
                showToast(T.toast_sale_error, 'error');
            } finally {
                if (btn) btn.disabled = false;
            }
        }

        function renderRecentSales() {
            const c = document.getElementById('recentSalesList');
            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = `<div class="rsw-empty">${T.no_sales_yet}</div>`;
                return;
            }
            c.innerHTML = salesHistory.slice(0, 8).map(sale => `
    <div class="rsw-item">
      <div class="rsw-icon"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20,6 9,17 4,12"/></svg></div>
      <div class="rsw-info">
        <div class="rsw-name">${sale.productName}</div>
        <div class="rsw-qty">${sale.qty} ${T.units} · ${sale.date}</div>
      </div>
      <div class="rsw-profit" style="${sale.price > 0 ? '' : 'color:var(--text-muted);font-size:12px;'}">${sale.price > 0 ? formatCurrency(sale.total) : T.no_price}</div>
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
                c.innerHTML = `<div class="sales-empty"><div class="sales-empty-icon"><svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,6 13.5,15.5 8.5,10.5 1,18"/><polyline points="17,6 23,6 23,12"/></svg></div><h4>${T.no_sales_yet}</h4><p>${T.go_add_sale}</p></div>`;
                return;
            }
            if (filtered.length === 0) {
                c.innerHTML = `<div style="padding:40px;text-align:center;color:var(--text-muted);">${T.no_sales_match_filter}</div>`;
                return;
            }

            c.innerHTML = `<table>
    <thead><tr>
      <th><?php echo at('sale_id'); ?></th><th><?php echo at('product'); ?></th><th><?php echo at('category'); ?></th><th><?php echo at('qty'); ?></th><th><?php echo at('unit_price'); ?></th><th><?php echo at('total'); ?></th><th><?php echo at('note'); ?></th><th><?php echo at('date'); ?></th><th><?php echo at('actions'); ?></th>
    </tr></thead>
    <tbody>${filtered.map((sale, idx) => `
      <tr>
        <td><strong style="color:var(--accent-gold);">${sale.id}</strong></td>
        <td><span style="font-weight:500;">${sale.productName}</span></td>
        <td><span style="text-transform:capitalize;font-size:12px;background:var(--bg-surface);padding:3px 8px;border-radius:12px;">${sale.category}</span></td>
        <td><strong>${sale.qty}</strong></td>
        <td>${sale.price > 0 ? formatCurrency(sale.price) : '<span style="color:var(--text-muted);">—</span>'}</td>
        <td><strong style="color:var(--success);">${sale.price > 0 ? formatCurrency(sale.total) : '<span style="color:var(--text-muted);">—</span>'}</strong></td>
        <td style="color:var(--text-muted);font-size:13px;">${sale.note || '—'}</td>
        <td style="font-size:12px;color:var(--text-muted);white-space:nowrap;">${sale.date}</td>
        <td><div style="display:flex;gap:6px;"><button class="btn btn-secondary btn-sm btn-icon" onclick="printReceipt('${sale.id}')" title="<?php echo at('print_receipt'); ?>"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg></button><button class="btn btn-danger btn-sm btn-icon" onclick="deleteSale('${sale.id}')" title="Delete sale"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3,6 5,6 21,6"/><path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/></svg></button></div></td>
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

        async function deleteSale(saleId) {
            const sale = salesHistory.find(s => s.id === saleId);
            if (!sale || !sale.dbId) return;
            if (!confirm(T.confirm_delete_sale)) return;

            try {
                const res = await fetch(`essentials/product-api.php?action=delete_sale&id=${sale.dbId}`);
                const d = await res.json();
                if (d.status === 'success') {
                    showToast(T.toast_sale_removed, 'error');
                    await fetchProducts();
                    await updateAllMetrics();
                    renderRecentSales();
                    renderSalesTable();
                }
            } catch (err) { console.error('Delete sale error:', err); }
        }

        function printReceipt(saleId) {
            const sale = salesHistory.find(s => s.id === saleId);
            if (!sale) return;

            const bizPhone = document.getElementById('set_phone_1')?.value || '';
            const bizEmail = document.getElementById('set_email')?.value || '';
            const bizAddress = document.getElementById('set_address')?.value || '';
            const currLabel = siteSettings.currency === 'EUR' ? '€' : 'Lek';

            const receiptHTML = `
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Faturë Tatimore ${sale.id}</title>
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: 'Outfit', sans-serif;
    background: #fff;
    color: #111827;
    padding: 20px;
    max-width: 300px;
    margin: 0 auto;
    font-size: 13px;
    line-height: 1.4;
  }
  .receipt-header {
    text-align: center;
    padding-bottom: 15px;
    border-bottom: 1.5px solid #000;
    margin-bottom: 15px;
  }
  .receipt-logo {
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 2px;
    text-transform: uppercase;
  }
  .receipt-logo span { color: #D4A853; }
  .receipt-contact {
    font-size: 10px;
    color: #4B5563;
  }
  .receipt-title {
    text-align: center;
    font-size: 14px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 15px 0;
    padding: 8px;
    border: 1px solid #111;
  }
  .receipt-meta {
    font-size: 11px;
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
    gap: 4px;
  }
  .receipt-meta-row {
    display: flex;
    justify-content: space-between;
  }
  .receipt-items {
    width: 100%;
    margin-bottom: 15px;
    border-bottom: 1px solid #E5E7EB;
  }
  .receipt-items table {
    width: 100%;
    border-collapse: collapse;
  }
  .receipt-items th {
    text-align: left;
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    padding: 6px 0;
    border-bottom: 1px solid #000;
  }
  .receipt-items td {
    padding: 8px 0;
    font-size: 11px;
  }
  .receipt-totals {
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1.5px solid #000;
  }
  .receipt-total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
  }
  .receipt-total-row.grand {
    font-size: 16px;
    font-weight: 900;
    border-top: 1px dashed #000;
    padding-top: 10px;
    margin-top: 5px;
  }
  .receipt-footer {
    text-align: center;
    margin-top: 30px;
    padding-top: 15px;
    border-top: 1px dashed #D1D5DB;
  }
  .thank-you {
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 5px;
  }
  .legal-text {
    font-size: 8px;
    color: #9CA3AF;
    text-transform: uppercase;
  }
  @media print {
    body { padding: 5px; }
  }
</style>
</head>
<body>
  <div class="receipt-header">
    <div class="receipt-logo">Agro<span>Fanema</span></div>
    <div class="receipt-contact">
      ${bizAddress ? bizAddress + '<br>' : ''}
      KOSOVË | ${bizPhone ? bizPhone : ''}${bizPhone && bizEmail ? ' | ' : ''}${bizEmail ? bizEmail : ''}
    </div>
  </div>

  <div class="receipt-title">Faturë Tatimore</div>

  <div class="receipt-meta">
    <div class="receipt-meta-row"><span>Nr. Faturës:</span> <strong>${sale.id}</strong></div>
    <div class="receipt-meta-row"><span>Data:</span> <strong>${new Date().toLocaleDateString('sq-AL')}</strong></div>
    <div class="receipt-meta-row"><span>Koha:</span> <strong>${new Date().toLocaleTimeString('sq-AL', { hour: '2-digit', minute: '2-digit' })}</strong></div>
  </div>

  <div class="receipt-items">
    <table>
      <thead>
        <tr>
          <th>Përshkrimi</th>
          <th style="text-align:center">Sasia</th>
          <th style="text-align:right">Total</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style="font-weight:700;">${sale.productName}<br><span style="font-size:9px; font-weight:400; color:#6B7280;">Kategoria: ${sale.category}</span></td>
          <td style="text-align:center">${sale.qty}</td>
          <td style="text-align:right"><strong>${sale.total.toLocaleString('sq-AL')}</strong></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="receipt-totals">
    <div class="receipt-total-row">
      <span>Nëntotali:</span>
      <span>${sale.total.toLocaleString('sq-AL')} ${currLabel}</span>
    </div>
    <div class="receipt-total-row">
      <span>TVSH (0%):</span>
      <span>0.00 ${currLabel}</span>
    </div>
    <div class="receipt-total-row grand">
      <span>TOTAL-I:</span>
      <span>${sale.total.toLocaleString('sq-AL')} ${currLabel}</span>
    </div>
  </div>

  <div class="receipt-footer">
    <p class="thank-you">Ju faleminderit për besimin tuaj!</p>
    <p class="legal-text">Kjo faturë është gjeneruar në mënyrë elektronike.</p>
  </div>
</body>
</html>`;

            const printWindow = window.open('', '_blank', 'width=340,height=550');
            printWindow.document.write(receiptHTML);
            printWindow.document.close();
            printWindow.onload = () => {
                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 300);
            };
        }

        function clearSalesHistory() {
            if (salesHistory.length === 0) {
                showToast(T.toast_no_sales, 'error');
                return;
            }
            if (!confirm(T.confirm_clear_sales)) return;
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
            showToast(T.toast_sales_cleared, 'error');
        }

        /* ═══════════════════════════════════════════════════
           OVERVIEW
        ═══════════════════════════════════════════════════ */
        function refreshOverview() {
            updateOverviewMetrics();
            showToast(T.toast_dashboard_refreshed, 'success');
        }

        function updateOverviewMetrics() {
            const now = new Date();
            const dateEl = document.getElementById('overviewDate');
            if (dateEl) {
                if (adminLang === 'sq') {
                    const sqDays = ['E Diel', 'E Hënë', 'E Martë', 'E Mërkurë', 'E Enjte', 'E Premte', 'E Shtunë'];
                    const sqMonths = ['Janar', 'Shkurt', 'Mars', 'Prill', 'Maj', 'Qershor', 'Korrik', 'Gusht', 'Shtator', 'Tetor', 'Nëntor', 'Dhjetor'];
                    dateEl.textContent = `${sqDays[now.getDay()]}, ${now.getDate()} ${sqMonths[now.getMonth()]} ${now.getFullYear()}`;
                } else {
                    dateEl.textContent = now.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
                }
            }

            const totalRevenue = dashboardStats.revenue;
            const totalUnits = dashboardStats.units;
            const totalStock = dashboardStats.total_stock;
            const lowStock = dashboardStats.low_stock_count;

            const setEl = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.textContent = val;
            };
            setEl('ov-revenue', formatCurrency(totalRevenue));
            setEl('ov-revenue-trend', dashboardStats.sale_count + ' ' + T.sales);
            setEl('ov-units', totalUnits.toLocaleString());
            setEl('ov-units-trend', dashboardStats.sale_count + ' ' + T.total_transactions);
            setEl('ov-stock', totalStock.toLocaleString());
            setEl('ov-stock-trend', dashboardStats.total_items + ' ' + T.total_products);
            setEl('ov-low', lowStock);
            setEl('ov-low-trend', lowStock > 0 ? T.stock_low : T.in_stock);

            // Update metric trend classes
            ['ov-revenue-trend', 'ov-units-trend', 'ov-stock-trend'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.className = 'metric-trend';
                    el.classList.add(dashboardStats.sale_count > 0 ? 'up' : 'neutral');
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
                    bsc.innerHTML = `<div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">${T.no_sales_yet_overview}</div>`;
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
            <div class="activity-sub">${p.qty} ${T.units_sold_label}</div>
          </div>
          <div class="activity-val" style="color:var(--accent-gold);">$${p.revenue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</div>
        </div>`).join('');
                }
            }

            // Inventory breakdown
            const ibc = document.getElementById('ov-inventory');
            if (ibc) {
                if (products.length === 0) {
                    ibc.innerHTML = `<div style="padding:20px;text-align:center;color:var(--text-muted);font-size:13px;">${T.no_products_added}</div>`;
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
            renderRevenuePie();
            renderMessagePie();
        }

        function renderRevenuePie() {
            const wrap = document.getElementById('revenuePieWrap');
            if (!wrap) return;

            if (salesHistory.length === 0) {
                wrap.innerHTML = `<div class="no-data-msg">${T.no_sales_recorded}</div>`;
                return;
            }

            const catRev = {};
            salesHistory.forEach(s => {
                catRev[s.category] = (catRev[s.category] || 0) + (Number(s.total) || 0);
            });

            const total = Object.values(catRev).reduce((a, b) => a + b, 0);
            const colors = { biostimulants: '#D4A853', crystalline: '#3B82F6', granular: '#10B981', soil_improvers: '#F59E0B' };
            
            const r = 50, cx = 60, cy = 60, sw = 18, circ = 2 * Math.PI * r;
            let offset = 0;
            const entries = Object.entries(catRev).sort((a,b) => b[1] - a[1]);

            const svgCircles = entries.map(([cat, val]) => {
                const sda = (val / total) * circ;
                const c = `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${colors[cat] || '#888'}" stroke-width="${sw}" stroke-dasharray="${sda} ${circ}" stroke-dashoffset="${-offset}" style="transition:all 0.6s ease;"/>`;
                offset += sda;
                return c;
            }).join('');

            const legend = entries.map(([cat, val]) => {
                const pct = Math.round((val / total) * 100);
                return `<div class="donut-legend-item" style="gap:8px;margin-bottom:6px;">
                    <div class="donut-legend-dot" style="background:${colors[cat] || '#888'};"></div>
                    <span style="font-size:12px;flex:1;">${cat.replace('_',' ').charAt(0).toUpperCase()+cat.replace('_',' ').slice(1)}</span>
                    <span style="font-size:11px;font-weight:700;">${pct}%</span>
                </div>`;
            }).join('');

            wrap.innerHTML = `<div style="display:flex;align-items:center;gap:20px;">
                <svg width="120" height="120" viewBox="0 0 120 120" style="transform:rotate(-90deg);flex-shrink:0;">${svgCircles}</svg>
                <div style="flex:1;">${legend}</div>
            </div>`;
        }

        function renderMessagePie() {
            const wrap = document.getElementById('messagePieWrap');
            if (!wrap) return;

            if (messages.length === 0) {
                wrap.innerHTML = `<div class="no-data-msg">${T.no_messages}</div>`;
                return;
            }

            const read = messages.filter(m => m.status === 'read' || m.status === 'replied').length;
            const unread = messages.length - read;
            const total = messages.length;

            const r = 50, cx = 60, cy = 60, sw = 18, circ = 2 * Math.PI * r;
            const readSda = (read / total) * circ;
            const unreadSda = (unread / total) * circ;

            wrap.innerHTML = `<div style="display:flex;align-items:center;gap:20px;">
                <svg width="120" height="120" viewBox="0 0 120 120" style="transform:rotate(-90deg);flex-shrink:0;">
                    <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="var(--success)" stroke-width="${sw}" stroke-dasharray="${readSda} ${circ}" stroke-dashoffset="0" />
                    <circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="var(--danger)" stroke-width="${sw}" stroke-dasharray="${unreadSda} ${circ}" stroke-dashoffset="${-readSda}" />
                </svg>
                <div style="flex:1;">
                    <div class="donut-legend-item" style="gap:8px;margin-bottom:8px;"><div class="donut-legend-dot" style="background:var(--success);"></div><span style="font-size:12px;flex:1;">${T.read_replied}</span><span style="font-size:11px;font-weight:700;">${read} ${T.items}</span></div>
                    <div class="donut-legend-item" style="gap:8px;"><div class="donut-legend-dot" style="background:var(--danger);"></div><span style="font-size:12px;flex:1;">${T.new_unread}</span><span style="font-size:11px;font-weight:700;">${unread} ${T.items}</span></div>
                </div>
            </div>`;
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

            if (products.length === 0) {
                wrap.innerHTML = `<div class="no-data-msg"><h4>${T.no_products_yet_analytics}</h4><p>${T.add_products_health}</p></div>`;
                return;
            }

            const status = {
                in_stock: { label: T.in_stock, count: 0, color: '#10B981', icon: '✅' },
                low_stock: { label: T.stock_low, count: 0, color: '#F59E0B', icon: '⚠' },
                out_of_stock: { label: T.out_of_stock, count: 0, color: '#EF4444', icon: '❌' }
            };

            products.forEach(p => {
                if (p.quantity <= 0) status.out_of_stock.count++;
                else if (p.quantity <= 10) status.low_stock.count++;
                else status.in_stock.count++;
            });

            const entries = Object.entries(status).filter(([, v]) => v.count > 0);
            const total = products.length;

            const r = 60, cx = 80, cy = 80, sw = 24, circ = 2 * Math.PI * r;
            let offset = 0;
            const segments = entries.map(([key, data]) => {
                const pct = data.count / total;
                const sda = pct * circ;
                const seg = { key, data, pct, sda, offset };
                offset += sda;
                return seg;
            });

            const svgCircles = segments.map(seg =>
                `<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${seg.data.color}" stroke-width="${sw}" stroke-dasharray="${seg.sda} ${circ}" stroke-dashoffset="${-seg.offset}" style="transition:all 0.6s ease;"/>`
            ).join('');

            const legend = entries.map(([key, data]) => {
                const pct = Math.round(data.count / total * 100);
                return `<div class="donut-legend-item">
                    <div class="donut-legend-dot" style="background:${data.color};"></div>
                    <span class="donut-legend-text">${data.icon} ${data.label}</span>
                    <span class="donut-legend-value">${data.count} ${T.items}</span>
                    <span class="donut-legend-pct">${pct}%</span>
                </div>`;
            }).join('');

            wrap.innerHTML = `
                <div class="donut-container">
                  <div class="donut-chart-wrap" style="width:160px;height:160px;flex-shrink:0;">
                    <svg width="160" height="160" viewBox="0 0 160 160" style="transform:rotate(-90deg);">
                      ${svgCircles}
                    </svg>
                    <div class="donut-center" style="width:100px;">
                      <div class="donut-value">${total}</div>
                      <div class="donut-label" style="font-size:9px;">${T.total_products_label}</div>
                    </div>
                  </div>
                  <div class="donut-legend" style="flex:1;">${legend}</div>
                </div>`;
        }

        function renderTopProducts() {
            const c = document.getElementById('topProductsChart');
            if (!c) return;
            if (salesHistory.length === 0) {
                c.innerHTML = `<div class="no-data-msg"><h4>${T.no_sales_data}</h4><p>${T.record_sales_top}</p></div>`;
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
        ${p.revenue > 0 ? `<div style="font-size:11px;color:var(--success);">${formatCurrency(p.revenue)}</div>` : ''}
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

            const catIcons = {
                granular: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M12 2v20M2 12h20M5.45 5.45l13.1 13.1M18.55 5.45 5.45 18.55"/></svg>',
                crystalline: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M6 3h12l4 6-10 13L2 9z"/></svg>',
                biostimulants: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="m12 2 4 10-4 10-4-10z"/></svg>',
                soil_improvers: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M7 7c0-1.1.9-2 2-2s2 .9 2 2M11 11c0-1.1.9-2 2-2s2 .9 2 2"/><path d="M3 13a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V6"/><path d="m11 21-2-2 2-2 2 2-2 2z"/></svg>',
                other: '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;margin-right:4px;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/></svg>'
            };

            c.innerHTML = `
    <div class="metric-card"><div class="metric-header"><div class="metric-icon revenue"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 12V8H6a2 2 0 0 1-2-2c0-1.1.9-2 2-2h12v4"/><path d="M4 6v12c0 1.1.9 2 2 2h14v-4"/><path d="M18 12a2 2 0 0 0-2 2c0 1.1.9 2 2 2h4v-4h-4z"/></svg></div></div><div class="metric-value">${formatCurrency(totalRevenue)}</div><div class="metric-label">${T.total_revenue_short}</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon orders"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23,6 13.5,15.5 8.5,10.5 1,18"/></svg></div></div><div class="metric-value">${totalUnits.toLocaleString()}</div><div class="metric-label">${T.total_units_sold}</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon customers"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg></div></div><div class="metric-value">${formatCurrency(avgOrderValue)}</div><div class="metric-label">${T.avg_sale_value}</div></div>
    <div class="metric-card"><div class="metric-header"><div class="metric-icon growth"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg></div></div><div class="metric-value">${catIcons[topCat] || ''} ${topCat.charAt(0).toUpperCase() + topCat.slice(1)}</div><div class="metric-label">${T.top_category}</div></div>
  `;
        }

        /* ═══════════════════════════════════════════════════
           INIT
        ═══════════════════════════════════════════════════ */
        (async function init() {
            try {
                const r = await fetch('essentials/product-api.php?action=list');
                const d = await r.json();
                if (d.status === 'success') {
                    products = d.products;
                }
            } catch { }

            nextProductId = products.length > 0 ? Math.max(...products.map(p => p.id)) + 1 : 1;
            renderProducts();
            renderSalesProductSelector();
            renderRecentSales();
            updateAllMetrics();
            updateOverviewMetrics();
            await fetchMessages();

            // Dropdown Handlers
            const setupDropdown = (btnId, wrapperId, panelId, labelId) => {
                const btn = document.getElementById(btnId);
                const wrapper = document.getElementById(wrapperId);
                const panel = document.getElementById(panelId);
                const label = document.getElementById(labelId);
                if (!btn || !wrapper) return;

                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    document.querySelectorAll('.dropdown-wrapper').forEach(w => {
                        if (w.id !== wrapperId) w.classList.remove('active');
                    });
                    wrapper.classList.toggle('active');
                });

                panel.querySelectorAll('.dropdown-option').forEach(opt => {
                    opt.addEventListener('click', () => {
                        panel.querySelectorAll('.dropdown-option').forEach(o => o.classList.remove('active'));
                        opt.classList.add('active');
                        if (label) label.textContent = opt.textContent;
                        wrapper.classList.remove('active');
                        renderProducts();
                    });
                });
            };

            setupDropdown('filterDropdownBtn', 'filterDropdownWrapper', 'filterDropdownPanel', 'currentFilterLabel');
            setupDropdown('sortDropdownBtn', 'sortDropdownWrapper', 'sortDropdownPanel', 'currentSortLabel');

            document.addEventListener('click', () => {
                document.querySelectorAll('.dropdown-wrapper').forEach(w => w.classList.remove('active'));
            });

            // Category filter listeners (Legacy - removing as we now use dropdowns)

            // Add search listener for main product list
            const productSearch = document.getElementById('productSearchInput');
            if (productSearch) {
                productSearch.addEventListener('input', () => {
                    renderProducts();
                });
            }

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