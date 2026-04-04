<?php
/**
 * Product Backend API — AgroFanema
 * Handles DB operations for Products and their Features
 */
header('Content-Type: application/json');
require_once 'db_connect.php';

// Check for Action
$action = isset($_GET['action']) ? $_GET['action'] : '';

// --- AUTOMATIC DATABASE CLEANUP/PATCH ---
// Ensures tables and columns exist for the dashboard
try {
    // 1. Patch image column
    $pdo->exec("ALTER TABLE products MODIFY image LONGTEXT");
    
    // 2. Create sales table
    $pdo->exec("CREATE TABLE IF NOT EXISTS sales (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        quantity INT NOT NULL,
        unit_price DECIMAL(10, 2) NOT NULL,
        total_price DECIMAL(10, 2) NOT NULL,
        note TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )");
} catch (Exception $e) { /* silent fail if already exists */ }

switch($action) {

    // 1. FETCH ALL PRODUCTS
    case 'list':
        try {
            // Fetch products
            $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
            $products = $stmt->fetchAll();


            echo json_encode(['status' => 'success', 'products' => $products]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 2. CREATE PRODUCT
    case 'create':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();
        
        try {
            // Handle uploaded image
            $imagePath = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if (!is_dir(__DIR__ . '/../images')) mkdir(__DIR__ . '/../images', 0755, true);
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imagePath = 'images/' . uniqid('p_') . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../' . $imagePath);
            } else if (isset($_POST['image'])) {
                $imagePath = $_POST['image']; // Base64 or existing path
            }

            $pdo->beginTransaction();
            $sql = "INSERT INTO products (name_sq, name_en, desc_sq, desc_en, quantity, category, image) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['name_sq'], $_POST['name_en'], 
                $_POST['desc_sq'], $_POST['desc_en'],
                (int)$_POST['quantity'], $_POST['category'],
                $imagePath
            ]);
            $productId = $pdo->lastInsertId();
            $pdo->commit();
            echo json_encode(['status' => 'success', 'id' => $productId, 'image' => $imagePath]);
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 2.1 EDIT PRODUCT
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();
        $id = (int)$_POST['id'];

        try {
            // Check for new image
            $imagePath = $_POST['image'] ?? ''; 
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                if (!is_dir(__DIR__ . '/../images')) mkdir(__DIR__ . '/../images', 0755, true);
                $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $imagePath = 'images/' . uniqid('p_') . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . '/../' . $imagePath);
            }

            $sql = "UPDATE products SET name_sq = ?, name_en = ?, desc_sq = ?, desc_en = ?, quantity = ?, category = ?, image = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $_POST['name_sq'], $_POST['name_en'], 
                $_POST['desc_sq'], $_POST['desc_en'],
                (int)$_POST['quantity'], $_POST['category'],
                $imagePath,
                $id
            ]);

            echo json_encode(['status' => 'success', 'id' => $id, 'image' => $imagePath]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 3. MIGRATE DATA FROM JSON (One-Time Tool)
    case 'migrate':
        $jsonPath = __DIR__ . '/products.json';
        if (!file_exists($jsonPath)) {
            echo json_encode(['status' => 'error', 'message' => 'JSON not found']);
            break;
        }

        $jsonProducts = json_decode(file_get_contents($jsonPath), true);
        $count = 0;

        try {
            $pdo->beginTransaction();
            foreach ($jsonProducts as $jp) {
                // Insert Product
                $stmt = $pdo->prepare("INSERT INTO products (name_sq, name_en, desc_sq, desc_en, quantity, category, image, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $jp['name_sq'], $jp['name_en'], $jp['desc_sq'], $jp['desc_en'],
                    $jp['quantity'], $jp['category'], $jp['image'], $jp['created_at']
                ]);
                $newId = $pdo->lastInsertId();

                $count++;
            }
            $pdo->commit();
            echo json_encode(['status' => 'success', 'migrated' => $count]);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 4. DELETE PRODUCT (STILL IN DB, BUT CAN BE REMOVED COMPLETELY)
    case 'delete_permanent':
        $id = isset($_REQUEST['id']) ? (int)$_REQUEST['id'] : 0;
        try {
            $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
            echo json_encode(['status' => 'success', 'message' => 'Product deleted forever']);
        } catch (Exception $e) { echo json_encode(['status' => 'error', 'message' => $e->getMessage()]); }
        break;

    // 5. GET DASHBOARD METRICS
    case 'metrics':
        try {
            // Units & Revenue
            $s = $pdo->query("SELECT SUM(quantity) as units, SUM(total_price) as revenue, COUNT(*) as count FROM sales")->fetch();
            
            // Stock stats
            $inv = $pdo->query("SELECT SUM(quantity) as total_stock, COUNT(*) as total_items FROM products")->fetch();
            $low = $pdo->query("SELECT COUNT(*) as low_count FROM products WHERE quantity <= 5")->fetch();
            
            // Recent Activity (joined)
            $recent = $pdo->query("SELECT s.*, p.name_en, p.name_sq, p.category 
                                  FROM sales s 
                                  JOIN products p ON s.product_id = p.id 
                                  ORDER BY s.created_at DESC LIMIT 10")->fetchAll();

            echo json_encode([
                'status' => 'success',
                'revenue' => (float)($s['revenue'] ?? 0),
                'units' => (int)($s['units'] ?? 0),
                'sale_count' => (int)($s['count'] ?? 0),
                'total_stock' => (int)($inv['total_stock'] ?? 0),
                'low_stock_count' => (int)($low['low_count'] ?? 0),
                'total_items' => (int)($inv['total_items'] ?? 0),
                'recent_sales' => $recent
            ]);
        } catch (Exception $e) { echo json_encode(['status' => 'error', 'message' => $e->getMessage()]); }
        break;

    // 6. RECORD SALE
    case 'record_sale':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die();
        $pid = (int)$_POST['product_id'];
        $qty = (int)$_POST['quantity'];
        $price = (float)$_POST['unit_price'];
        $note = $_POST['note'] ?? '';

        try {
            $pdo->beginTransaction();
            
            // Check stock
            $p = $pdo->prepare("SELECT quantity FROM products WHERE id = ?");
            $p->execute([$pid]);
            $curr = $p->fetch();
            if (!$curr || $curr['quantity'] < $qty) throw new Exception("Insufficient stock");

            // Insert sale
            $stmt = $pdo->prepare("INSERT INTO sales (product_id, quantity, unit_price, total_price, note) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$pid, $qty, $price, $qty * $price, $note]);

            // Update product qty
            $pdo->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?")->execute([$qty, $pid]);

            $pdo->commit();
            echo json_encode(['status' => 'success', 'message' => 'Sale recorded']);
        } catch (Exception $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
        break;

    // 7. DELETE SALE
    case 'delete_sale':
        $id = (int)$_GET['id'];
        try {
            $pdo->beginTransaction();
            $s = $pdo->prepare("SELECT product_id, quantity FROM sales WHERE id = ?");
            $s->execute([$id]);
            $sale = $s->fetch();
            if ($sale) {
                $pdo->prepare("UPDATE products SET quantity = quantity + ? WHERE id = ?")->execute([$sale['quantity'], $sale['product_id']]);
                $pdo->prepare("DELETE FROM sales WHERE id = ?")->execute([$id]);
            }
            $pdo->commit();
            echo json_encode(['status' => 'success']);
        } catch (Exception $e) { if ($pdo->inTransaction()) $pdo->rollBack(); echo json_encode(['status' => 'error', 'message' => $e->getMessage()]); }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'No valid action provided']);
}
?>
