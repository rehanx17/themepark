<?php
// db.php
$host = 'localhost';
$db   = 'themepark';
$user = 'root';
$pass = ''; // XAMPP default; change if needed
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // friendly error for dev - change for production
    die("Database Connection Failed: " . $e->getMessage());
}
