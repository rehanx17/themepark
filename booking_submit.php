<?php
// booking_submit.php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone'] ?? '');
    $attraction_id = intval($_POST['attraction_id']);
    $visit_date = $_POST['visit_date'];
    $tickets = max(1, intval($_POST['tickets']));

    // ✅ Fetch attraction price
    $stmt = $pdo->prepare("SELECT price, name FROM attractions WHERE id = ?");
    $stmt->execute([$attraction_id]);
    $attraction = $stmt->fetch();

    if ($attraction) {
        $price = $attraction['price'];
        $attraction_name = $attraction['name'];
        $total_price = $price * $tickets;

        // ✅ Insert booking with total_price
        $insert = $pdo->prepare("
            INSERT INTO bookings (full_name, email, phone, attraction_id, visit_date, tickets, total_price)
            VALUES (?,?,?,?,?,?,?)
        ");
        $insert->execute([$full_name, $email, $phone, $attraction_id, $visit_date, $tickets, $total_price]);

        // ✅ Show success alert and redirect
        echo "<script>
                alert('Booking Confirmed for $attraction_name!\\nTotal Amount: ₹$total_price');
                window.location = 'index.php';
              </script>";
        exit;
    } else {
        echo "<script>
                alert('Invalid attraction selected.');
                window.location = 'index.php';
              </script>";
        exit;
    }
}

// If not POST, go back to home
header("Location: index.php");
exit;
?>
