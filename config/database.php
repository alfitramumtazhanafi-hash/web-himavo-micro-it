<?php
$host = 'localhost';
$dbname = 'himavo_microit';  
$username = 'root';           
$password = '';              

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Koneksi berhasil!"; 
} catch(PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>