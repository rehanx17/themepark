<?php
// contact_submit.php
require 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?,?,?)");
    $stmt->execute([$name, $email, $message]);

    header("Location: index.php?contact=success");
    exit;
}
header("Location: index.php");
exit;
