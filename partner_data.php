<?php
header('Content-Type: application/json');
require_once 'config/database.php';

$sql = "CREATE TABLE IF NOT EXISTS partner (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category ENUM('perusahaan', 'komunitas', 'pendidikan', 'media', 'sponsor') NOT NULL,
    description TEXT,
    logo VARCHAR(255),
    website VARCHAR(255),
    since YEAR,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);
$stmt = $pdo->query("SELECT * FROM partner WHERE status = 'active' ORDER BY category, name");
$partners = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($partners);
?>