<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}


// Check package ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: packages.php");
    exit();
}

$package_id = intval($_GET['id']);


// Delete package
$sql = "DELETE FROM packages WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "i",
    $package_id
);


if (mysqli_stmt_execute($stmt)) {

    mysqli_stmt_close($stmt);

    header("Location: packages.php?deleted=success");
    exit();

} else {

    mysqli_stmt_close($stmt);

    header("Location: packages.php?deleted=error");
    exit();
}

?>