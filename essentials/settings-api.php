<?php
header('Content-Type: application/json');
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION['admin_logged_in'])) {
    echo json_encode(['success' => false, 'error' => 'Unauthorized']);
    exit;
}

$action = $_GET['action'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($action === 'get') {
        try {
            $stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
            $settings = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'settings' => $settings]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'update_info') {
        $phone_1 = $_POST['phone_1'] ?? '';
        $phone_2 = $_POST['phone_2'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';
        $currency = $_POST['currency'] ?? 'ALL';
        $rate = $_POST['eur_to_all_rate'] ?? 103.50;

        try {
            $stmt = $pdo->prepare("UPDATE settings SET phone_1 = ?, phone_2 = ?, email = ?, address = ?, currency = ?, eur_to_all_rate = ? WHERE id = 1");
            $stmt->execute([$phone_1, $phone_2, $email, $address, $currency, $rate]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    } elseif ($action === 'change_password') {
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($new !== $confirm) {
            echo json_encode(['success' => false, 'error' => 'Passwords do not match']);
            exit;
        }

        try {
            $access_key = $_SESSION['admin_access_key'] ?? 'agro2026';
            $stmt = $pdo->prepare("SELECT password, id FROM users WHERE access_key = ?");
            $stmt->execute([$access_key]);
            $user = $stmt->fetch();

            if (!$user) {
                echo json_encode(['success' => false, 'error' => 'User not found']);
                exit;
            }

            // Check if current password is correct (supports both hash and plain for migration)
            $isValid = password_verify($current, $user['password']) || $current === $user['password'];

            if (!$isValid) {
                echo json_encode(['success' => false, 'error' => 'Current password incorrect']);
                exit;
            }

            $hashed = password_hash($new, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ? WHERE access_key = ?");
            $update->execute([$hashed, $access_key]);
            echo json_encode(['success' => true]);
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
