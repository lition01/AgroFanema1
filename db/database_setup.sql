-- 1. Create the Database
CREATE DATABASE IF NOT EXISTS agrofanema;
USE agrofanema;

-- 2. Products Table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name_sq VARCHAR(255) NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    desc_sq TEXT,
    desc_en TEXT,
    quantity INT DEFAULT 0,
    category ENUM('biostimulants', 'crystalline', 'granular', 'soil_improvers') NOT NULL,
    image VARCHAR(255),
    is_visible TINYINT(1) DEFAULT 1, -- 1 = Shown on frontend, 0 = Hidden
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


-- 4. Collaborators (Partners Carousel)
CREATE TABLE IF NOT EXISTS collaborators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    website VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 5. Contact Form Submissions (Leads)
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(50),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 6. Admin Users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    access_key VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- 7. Sales History
CREATE TABLE IF NOT EXISTS sales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10, 2) NOT NULL,
    total_price DECIMAL(10, 2) NOT NULL,
    note TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- 8. Business Settings
CREATE TABLE IF NOT EXISTS settings (
    id INT PRIMARY KEY DEFAULT 1,
    phone_1 VARCHAR(50),
    phone_2 VARCHAR(50),
    email VARCHAR(150),
    address TEXT,
    currency ENUM('ALL', 'EUR') DEFAULT 'ALL',
    eur_to_all_rate DECIMAL(10, 2) DEFAULT 103.50, -- Current approximate rate
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert initial business settings if not exists
INSERT IGNORE INTO settings (id, phone_1, phone_2, email, address, currency, eur_to_all_rate) 
VALUES (1, '+355 693334644', '+355 682071125', 'agrofanema@gmail.com', 'Kozare, Kuçovë', 'ALL', 103.50);

-- 9. Initial Administrative Account
-- This seeds the database with the default access_key and password: agro2026
-- Verify the password hash matches 'agro2026' exactly
INSERT IGNORE INTO users (access_key, password) 
VALUES ('agro2026', 'agro2026'); 
