<?php

session_start();

include "config/database.php";

// User login आहे का ते check करा
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Logged-in user च्या bookings मिळवा
$sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY id DESC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Bookings - Tourism Management System</title>

<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/my-bookings.css">

</head>

<body>

<header>

<nav class="navbar">

<div class="logo">
Tourism<span>MS</span>
</div>

<div class="nav-links">

<a href="index.php">Home</a>
<a href="places.php">Places</a>
<a href="packages.php">Packages</a>
<a href="about.php">About</a>

<a href="my-bookings.php" class="active">
My Bookings
</a>

<a href="logout.php" class="logout-btn">
Logout
</a>

</div>

</nav>

</header>


<section class="bookings-section">

<div class="bookings-container">

<div class="page-title">

<h1>My Bookings</h1>

<p>View all your tour bookings.</p>

</div>


<div class="table-box">

<table>

<thead>

<tr>

<th>ID</th>
<th>Package</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Travel Date</th>
<th>Persons</th>
<th>Message</th>
<th>Booking Date</th>

</tr>

</thead>


<tbody>

<?php

if (mysqli_num_rows($result) > 0) {

    while ($booking = mysqli_fetch_assoc($result)) {

?>

<tr>

<td>
<?php echo $booking['id']; ?>
</td>

<td>
<?php echo htmlspecialchars($booking['package_name']); ?>
</td>

<td>
<?php echo htmlspecialchars($booking['name']); ?>
</td>

<td>
<?php echo htmlspecialchars($booking['email']); ?>
</td>

<td>
<?php echo htmlspecialchars($booking['phone']); ?>
</td>

<td>
<?php echo htmlspecialchars($booking['travel_date']); ?>
</td>

<td>
<?php echo htmlspecialchars($booking['persons']); ?>
</td>

<td>

<?php

echo !empty($booking['message'])
    ? htmlspecialchars($booking['message'])
    : "No message";

?>

</td>

<td>
<?php echo htmlspecialchars($booking['booking_date']); ?>
</td>

</tr>

<?php

    }

} else {

?>

<tr>

<td colspan="9" class="no-data">

You have not made any bookings yet.

</td>

</tr>

<?php

}

?>

</tbody>

</table>

</div>

</div>

</section>


<footer>

<p>
© 2026 Tourism Management System. All Rights Reserved.
</p>

</footer>

</body>

</html>