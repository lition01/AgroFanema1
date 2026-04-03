<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}

// Simple configuration - you should change these!
$ACCESS_KEY = "agro2026";
$PASSWORD = "fanema123";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_key = $_POST['access_key'] ?? '';
    $input_pass = $_POST['password'] ?? '';

    if ($input_key === $ACCESS_KEY && $input_pass === $PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin-dashboard.php");
        exit;
    } else {
        $error = "Invalid Access Key or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgroFanema | Admin Access</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0D2117;
            --accent: #C8A84B;
            --bg: #F5F2EA;
            --text: #1A1A1A;
            --error: #EF4444;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text);
            height: 100vh;
            display: flex;
            overflow: hidden;
        }

        /* Split Screen Layout */
        .login-container {
            display: flex;
            width: 100%;
            height: 100%;
        }

        /* Image Side */
        .login-visual {
            flex: 1.2;
            position: relative;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .login-visual::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('https://images.unsplash.com/photo-1592982537447-7440770cbfc9?q=80&w=2000&auto=format&fit=crop') center/cover no-repeat;
            opacity: 0.5;
            filter: grayscale(10%) contrast(1.1);
        }

        .visual-content {
            position: relative;
            z-index: 10;
            text-align: center;
            padding: 40px;
            color: #F5F2EA;
        }

        .visual-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 24px;
            filter: brightness(0) invert(1);
        }

        .visual-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 3.5rem;
            font-weight: 600;
            line-height: 1.1;
            margin-bottom: 16px;
        }

        .visual-subtitle {
            font-size: 1.1rem;
            opacity: 0.8;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Form Side */
        .login-form-side {
            flex: 1;
            background: #FFFFFF;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px clamp(40px, 8vw, 100px);
            position: relative;
        }

        .form-header {
            margin-bottom: 48px;
        }

        .brand-mobile {
            display: none;
            margin-bottom: 32px;
        }

        .form-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 8px;
        }

        .form-desc {
            color: #6B6B62;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #4B5563;
            letter-spacing: 0.5px;
        }

        .input-wrap {
            position: relative;
        }

        .input {
            width: 100%;
            padding: 16px 20px;
            border-radius: 12px;
            border: 1.5px solid #E2E0DA;
            background: #FAFAFA;
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            transition: all 0.3s ease;
            outline: none;
            color: var(--text);
        }

        .input:focus {
            border-color: var(--accent);
            background: #FFF;
            box-shadow: 0 0 0 4px rgba(200, 168, 75, 0.1);
        }

        .btn-submit {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: #FFF;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-submit:hover {
            background: var(--accent);
            color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(200, 168, 75, 0.2);
        }

        .error-msg {
            background: rgba(239, 68, 68, 0.08);
            color: var(--error);
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 32px;
            border: 1px solid rgba(239, 68, 68, 0.15);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .back-link {
            margin-top: 40px;
            text-align: center;
        }

        .back-link a {
            color: #6B6B62;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .back-link a:hover {
            color: var(--primary);
        }

        /* Mobile Responsive */
        @media (max-width: 1024px) {
            .login-visual { display: none; }
            .login-form-side { flex: 1; padding: 40px 24px; align-items: center; }
            .login-form-side form { width: 100%; max-width: 400px; }
            .form-header { text-align: center; width: 100%; max-width: 400px; }
            .brand-mobile { display: block; text-align: center; }
            .brand-mobile img { width: 80px; }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Visual Side -->
        <div class="login-visual">
            <div class="visual-content">
                <img src="images/logo.svg" alt="Logo" class="visual-logo">
                <h1 class="visual-title">Cultivating<br>Excellence.</h1>
                <p class="visual-subtitle">Management Dashboard</p>
            </div>
        </div>

        <!-- Form Side -->
        <div class="login-form-side">
            <div class="brand-mobile">
                <img src="images/logo.svg" alt="AgroFanema">
            </div>

            <div class="form-header">
                <h2 class="form-title">Admin Access</h2>
                <p class="form-desc">Secure entrance for authorized personnel only.</p>
            </div>

            <?php if ($error): ?>
                <div class="error-msg">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label class="label">ACCESS KEY</label>
                    <div class="input-wrap">
                        <input type="text" name="access_key" class="input" placeholder="Enter security key" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label">PASSWORD</label>
                    <div class="input-wrap">
                        <input type="password" name="password" class="input" placeholder="••••••••" required>
                    </div>
                </div>
                <button type="submit" class="btn-submit">
                    Unlock Dashboard
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </button>
            </form>

            <div class="back-link">
                <a href="index.php">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Return to Website
                </a>
            </div>
        </div>
    </div>
</body>
</html>