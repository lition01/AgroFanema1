<?php
/**
 * Collaborator Backend API — AgroFanema
 * Handles DB operations for Partner Companies (Typography-focused, no logos)
 */
header('Content-Type: application/json');
require_once 'db_connect.php';

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'list':
        try {
            $stmt = $pdo->query("SELECT * FROM collaborators ORDER BY created_at DESC");
            $collaborators = $stmt->fetchAll();
            echo json_encode(['success' => true, 'collaborators' => $collaborators]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'add':
        $name = trim($_POST['name'] ?? '');
        $website = trim($_POST['website'] ?? '');
        if (empty($name)) die(json_encode(['success' => false, 'error' => 'Name required']));

        try {
            $sql = "INSERT INTO collaborators (name, website) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $website]);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'delete':
        $id = (int)$_POST['id'];
        try {
            $pdo->prepare("DELETE FROM collaborators WHERE id = ?")->execute([$id]);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    case 'edit':
        $id = (int)$_POST['id'];
        $name = trim($_POST['name'] ?? '');
        $website = trim($_POST['website'] ?? '');
        
        try {
            $sql = "UPDATE collaborators SET name = ?, website = ? WHERE id = ?";
            $pdo->prepare($sql)->execute([$name, $website, $id]);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
