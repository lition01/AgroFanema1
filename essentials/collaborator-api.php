<?php
/**
 * Collaborator Backend API — AgroFanema
 * Handles DB operations for Partner Companies
 */
header('Content-Type: application/json');
require_once 'db_connect.php';

$uploadDir = __DIR__ . '/../images/collaborators/';
if (!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

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

        $imagePath = '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            $filename = uniqid('collab_') . '.' . $ext;
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $filename)) {
                $imagePath = 'images/collaborators/' . $filename;
            }
        }

        try {
            $sql = "INSERT INTO collaborators (name, logo, website) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $imagePath, $website]);
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
            $params = [$name, $website, $id];
            $pdo->prepare($sql)->execute($params);

            if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                $filename = uniqid('collab_') . '.' . $ext;
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $filename)) {
                    $img = 'images/collaborators/' . $filename;
                    $pdo->prepare("UPDATE collaborators SET logo = ? WHERE id = ?")->execute([$img, $id]);
                }
            }
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
