<?php

session_start();

include "../config/database.php";

// Admin login check
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

// First get package image name
$select_sql = "SELECT image FROM packages WHERE id = ?";

$select_stmt = mysqli_prepare($conn, $select_sql);

if (!$select_stmt) {
    header("Location: packages.php?deleted=error");
    exit();
}

mysqli_stmt_bind_param(
    $select_stmt,
    "i",
    $package_id
);

mysqli_stmt_execute($select_stmt);

$result = mysqli_stmt_get_result($select_stmt);

$package = mysqli_fetch_assoc($result);

mysqli_stmt_close($select_stmt);

// Check package exists
if (!$package) {
    header("Location: packages.php?deleted=notfound");
    exit();
}

// Delete package from database
$delete_sql = "DELETE FROM packages WHERE id = ?";

$delete_stmt = mysqli_prepare($conn, $delete_sql);

if (!$delete_stmt) {
    header("Location: packages.php?deleted=error");
    exit();
}

mysqli_stmt_bind_param(
    $delete_stmt,
    "i",
    $package_id
);

if (mysqli_stmt_execute($delete_stmt)) {

    mysqli_stmt_close($delete_stmt);

    // Delete image file if image exists
    if (!empty($package['image'])) {

        $image_path = "../images/" . $package['image'];

        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }

    header("Location: packages.php?deleted=success");
    exit();

} else {

    mysqli_stmt_close($delete_stmt);

    header("Location: packages.php?deleted=error");
    exit();
}

?>