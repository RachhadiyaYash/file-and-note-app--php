<?php
$host = 'sql301.infinityfree.com';
$db = 'if0_37735628_easyshare'; 
$username = 'if0_37735628';
$password = 'Fg0Nu8NQBapeKS'; 

try {
    // Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $username, $password);
    
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set the time zone to 'Asia/Kolkata' (Indian Standard Time)
    $pdo->exec("SET time_zone = '+05:30'");

    
    // Alternatively, you could use: $pdo->exec("SET time_zone = '+05:30'");
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
