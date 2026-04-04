<?php
/**
 * Contact Backend API — AgroFanema
 * Handles DB operations for Inquiries / Contact Form
 */
header('Content-Type: application/json');
require_once 'db_connect.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {

    // 1. FETCH ALL MESSAGES
    case 'list':
        try {
            $stmt = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
            $messages = $stmt->fetchAll();
            echo json_encode(['status' => 'success', 'messages' => $messages]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 2. SUBMIT MESSAGE (From Website)
    case 'submit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();
        try {
            $sql = "INSERT INTO contacts (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['first_name'], $_POST['last_name'], 
                $_POST['email'], $_POST['phone'] ?? '', 
                $_POST['message']
            ]);
            echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 3. DELETE MESSAGE
    case 'delete':
        $id = (int)$_GET['id'];
        try {
            $pdo->prepare("DELETE FROM contacts WHERE id = ?")->execute([$id]);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 4. UPDATE STATUS (Read/Replied)
    case 'update_status':
        $id = (int)$_GET['id'];
        $status = $_GET['status']; // 'read', 'replied', etc.
        try {
            $pdo->prepare("UPDATE contacts SET status = ? WHERE id = ?")->execute([$status, $id]);
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 5. DELETE ALL MESSAGES
    case 'delete_all':
        try {
            $pdo->query("DELETE FROM contacts");
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'API Endpoint Not Defined']);
}
?>
