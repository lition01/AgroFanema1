<?php
header('Content-Type: application/json');

$dataFile = __DIR__ . '/products.json';
$uploadDir = __DIR__ . '/../images/products/';

// Ensure directories exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Initialize products file if not exists
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

function getProducts() {
    global $dataFile;
    $data = file_get_contents($dataFile);
    return json_decode($data, true) ?: [];
}

function saveProducts($products) {
    global $dataFile;
    file_put_contents($dataFile, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

$action = $_GET['action'] ?? $_POST['action'] ?? '';

switch ($action) {
    case 'list':
        echo json_encode(['success' => true, 'products' => getProducts()]);
        break;

    case 'add':
        $name_sq = trim($_POST['name_sq'] ?? '');
        $name_en = trim($_POST['name_en'] ?? '');
        $desc_sq = trim($_POST['desc_sq'] ?? '');
        $desc_en = trim($_POST['desc_en'] ?? '');
        $quantity = intval($_POST['quantity'] ?? 0);
        $category = trim($_POST['category'] ?? 'general');
        $features_sq = trim($_POST['features_sq'] ?? '');
        $features_en = trim($_POST['features_en'] ?? '');

        if (empty($name_sq) || empty($name_en)) {
            echo json_encode(['success' => false, 'error' => 'Product names are required']);
            exit;
        }

        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
            if (!in_array($ext, $allowed)) {
                echo json_encode(['success' => false, 'error' => 'Invalid image format']);
                exit;
            }
            $filename = uniqid('prod_') . '.' . $ext;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                $imagePath = 'images/products/' . $filename;
            }
        }

        $products = getProducts();
        $newProduct = [
            'id' => uniqid(),
            'name_sq' => $name_sq,
            'name_en' => $name_en,
            'desc_sq' => $desc_sq,
            'desc_en' => $desc_en,
            'quantity' => $quantity,
            'category' => $category,
            'features_sq' => array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $features_sq))))),
            'features_en' => array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $features_en))))),
            'image' => $imagePath,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $products[] = $newProduct;
        saveProducts($products);

        echo json_encode(['success' => true, 'product' => $newProduct]);
        break;

    case 'delete':
        $id = $_POST['id'] ?? '';
        $products = getProducts();
        $products = array_values(array_filter($products, function($p) use ($id) {
            return $p['id'] !== $id;
        }));
        saveProducts($products);
        echo json_encode(['success' => true]);
        break;

    case 'edit':
        $id = $_POST['id'] ?? '';
        $products = getProducts();
        foreach ($products as &$p) {
            if ($p['id'] === $id) {
                if (!empty($_POST['name_sq'])) $p['name_sq'] = trim($_POST['name_sq']);
                if (!empty($_POST['name_en'])) $p['name_en'] = trim($_POST['name_en']);
                if (!empty($_POST['desc_sq'])) $p['desc_sq'] = trim($_POST['desc_sq']);
                if (!empty($_POST['desc_en'])) $p['desc_en'] = trim($_POST['desc_en']);
                if (isset($_POST['quantity'])) $p['quantity'] = intval($_POST['quantity']);
                if (!empty($_POST['category'])) $p['category'] = trim($_POST['category']);
                if (isset($_POST['features_sq'])) $p['features_sq'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $_POST['features_sq'])))));
                if (isset($_POST['features_en'])) $p['features_en'] = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $_POST['features_en'])))));
                
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $filename = uniqid('prod_') . '.' . $ext;
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                        $p['image'] = 'images/products/' . $filename;
                    }
                }
                break;
            }
        }
        saveProducts($products);
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
}
?>
