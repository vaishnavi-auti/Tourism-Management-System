<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: contact-messages.php");
    exit();
}


// Check message ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: contact-messages.php");
    exit();
}

$message_id = intval($_GET['id']);


// Delete contact message
$sql = "DELETE FROM contact_messages WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $message_id
);


if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: contact-messages.php?deleted=success");
    exit();

} else {

    mysqli_stmt_close($stmt);

    header("Location: contact-messages.php?deleted=error");
    exit();
}

?>
