<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'himavo_microit';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Koneksi database gagal: ' . $e->getMessage()]);
    exit;
}

$sql = "CREATE TABLE IF NOT EXISTS pengajuan_kerjasama (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jenis_kerjasama VARCHAR(50) NOT NULL,
    nama_instansi VARCHAR(255) NOT NULL,
    pic VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telepon VARCHAR(20) NOT NULL,
    deskripsi TEXT NOT NULL,
    harapan TEXT,
    status ENUM('pending', 'disetujui', 'ditolak') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$pdo->exec($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $jenis_kerjasama = $_POST['jenis_kerjasama'] ?? '';
    $nama_instansi = $_POST['nama_instansi'] ?? '';
    $pic = $_POST['pic'] ?? '';
    $email = $_POST['email'] ?? '';
    $telepon = $_POST['telepon'] ?? '';
    $deskripsi = $_POST['deskripsi'] ?? '';
    $harapan = $_POST['harapan'] ?? '';

    if (empty($jenis_kerjasama) || empty($nama_instansi) || empty($pic) || empty($email) || empty($telepon) || empty($deskripsi)) {
        echo json_encode(['success' => false, 'message' => 'Semua field wajib harus diisi!']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO pengajuan_kerjasama 
            (jenis_kerjasama, nama_instansi, pic, email, telepon, deskripsi, harapan, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pending')");
        
        if ($stmt->execute([$jenis_kerjasama, $nama_instansi, $pic, $email, $telepon, $deskripsi, $harapan])) {
            echo json_encode([
                'success' => true, 
                'message' => 'Pengajuan kerja sama berhasil dikirim! Menunggu verifikasi admin.'
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error database: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method tidak diizinkan']);
}
?>