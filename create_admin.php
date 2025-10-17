<?php
// create_admin.php - run once to create admin then delete the file or protect it
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
    $stmt->execute([$user, $pass]);
    echo "Admin created. Delete this file after use.";
    exit;
}
?>
<!doctype html><html><body>
<h3>Create Admin (One-time)</h3>
<form method="post">
  <input name="username" placeholder="username" required><br><br>
  <input name="password" placeholder="password" required><br><br>
  <button type="submit">Create</button>
</form>
</body></html>
