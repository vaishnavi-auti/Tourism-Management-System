<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// Check booking ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: bookings.php");
    exit();
}

$booking_id = intval($_GET['id']);


// Delete booking
$sql = "DELETE FROM bookings WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $booking_id
);


if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: bookings.php?deleted=success");
    exit();

} else {

    mysqli_stmt_close($stmt);

    header("Location: bookings.php?deleted=error");
    exit();
}

?>
