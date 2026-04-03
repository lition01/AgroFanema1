<?php
header('Content-Type: application/json');

$dataFile = __DIR__ . '/collaborators.json';
$uploadDir = __DIR__ . '/../images/collaborators/';

// Ensure directories exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Initialize collaborators file if not exists
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

function getCollaborators() {
    global $dataFile;
    $data = file_get_contents($dataFile);
    return json_decode($data, true) ?: [];
}

function saveCollaborators($collaborators) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($collaborators, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'list':
        echo json_encode(['success' => true, 'collaborators' => getCollaborators()]);
        break;

    case 'add':
        $name = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $website = trim($_POST['website'] ?? '');

        if (empty($name)) {
            echo json_encode(['success' => false, 'error' => 'Collaborator name is required']);
            exit;
        }

        $imagePath = '';
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'svg', 'gif'];
            if (!in_array($ext, $allowed)) {
                echo json_encode(['success' => false, 'error' => 'Invalid image format']);
                exit;
            }
            $filename = uniqid('collab_') . '.' . $ext;
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $filename)) {
                $imagePath = 'images/collaborators/' . $filename;
            }
        }

        $collaborators = getCollaborators();
        $newCollaborator = [
            'id' => uniqid(),
            'name' => $name,
            'description' => $description,
            'website' => $website,
            'logo' => $imagePath,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $collaborators[] = $newCollaborator;
        saveCollaborators($collaborators);

        echo json_encode(['success' => true, 'collaborator' => $newCollaborator]);
        break;

    case 'delete':
        $id = $_POST['id'] ?? '';
        $collaborators = getCollaborators();
        $collaborators = array_values(array_filter($collaborators, function($c) use ($id) {
            return $c['id'] !== $id;
        }));
        saveCollaborators($collaborators);
        echo json_encode(['success' => true]);
        break;

    case 'edit':
        $id = $_POST['id'] ?? '';
        $collaborators = getCollaborators();
        foreach ($collaborators as &$c) {
            if ($c['id'] === $id) {
                if (isset($_POST['name'])) $c['name'] = trim($_POST['name']);
                if (isset($_POST['description'])) $c['description'] = trim($_POST['description']);
                if (isset($_POST['website'])) $c['website'] = trim($_POST['website']);
                
                if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
                    $filename = uniqid('collab_') . '.' . $ext;
                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadDir . $filename)) {
                        $c['logo'] = 'images/collaborators/' . $filename;
                    }
                }
                break;
            }
        }
        saveCollaborators($collaborators);
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
