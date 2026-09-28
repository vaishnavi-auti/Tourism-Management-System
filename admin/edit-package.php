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


// Fetch package details
$query = mysqli_query(
    $conn,
    "SELECT * FROM packages WHERE id = $package_id"
);


// Check package exists
if (mysqli_num_rows($query) == 0) {

    header("Location: packages.php");
    exit();

}

$package = mysqli_fetch_assoc($query);


// Message
$message = "";
$message_type = "";


// Update package
if (isset($_POST['update_package'])) {

    $package_name = trim($_POST['package_name']);
    $destination = trim($_POST['destination']);
    $duration = trim($_POST['duration']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);


    // Validation
    if (
        empty($package_name) ||
        empty($destination) ||
        empty($duration) ||
        empty($price)
    ) {

        $message = "Please fill all required fields.";
        $message_type = "error";

    } else {

        $sql = "UPDATE packages
                SET package_name = ?,
                    destination = ?,
                    duration = ?,
                    price = ?,
                    description = ?,
                    image = ?
                WHERE id = ?";


        $stmt = mysqli_prepare($conn, $sql);


        mysqli_stmt_bind_param(
            $stmt,
            "sssdssi",
            $package_name,
            $destination,
            $duration,
            $price,
            $description,
            $image,
            $package_id
        );


        if (mysqli_stmt_execute($stmt)) {

            $message = "Package updated successfully!";
            $message_type = "success";


            // Fetch updated package
            $query = mysqli_query(
                $conn,
                "SELECT * FROM packages WHERE id = $package_id"
            );

            $package = mysqli_fetch_assoc($query);

        } else {

            $message = "Something went wrong. Please try again.";
            $message_type = "error";

        }


        mysqli_stmt_close($stmt);

    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Package - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-edit-package.css">

</head>


<body>


<header>

    <nav class="admin-navbar">

        <div class="admin-logo">
            Tourism<span>MS</span>
        </div>


        <div class="admin-right">

            <a href="dashboard.php">
                Dashboard
            </a>

            <a href="users.php">
                Users
            </a>

            <a href="bookings.php">
                Bookings
            </a>

            <a href="contact-messages.php">
                Messages
            </a>

            <a href="logout.php" class="admin-logout">
                Logout
            </a>

        </div>

    </nav>

</header>


<section class="edit-package-section">

    <div class="edit-package-container">


        <div class="page-heading">

            <h1>
                Edit Package
            </h1>

            <p>
                Update tour package details
            </p>

        </div>


        <?php if (!empty($message)) { ?>

            <div class="<?php echo $message_type; ?>-message">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php } ?>


        <div class="edit-package-card">


            <form method="POST" action="">


                <div class="form-group">

                    <label>
                        Package Name
                    </label>

                    <input
                        type="text"
                        name="package_name"
                        value="<?php echo htmlspecialchars($package['package_name']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Destination
                    </label>

                    <input
                        type="text"
                        name="destination"
                        value="<?php echo htmlspecialchars($package['destination']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Duration
                    </label>

                    <input
                        type="text"
                        name="duration"
                        value="<?php echo htmlspecialchars($package['duration']); ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Price
                    </label>

                    <input
                        type="number"
                        name="price"
                        value="<?php echo htmlspecialchars($package['price']); ?>"
                        step="0.01"
                        min="0"
                        required
                    >

                </div>


                <div class="form-group">

                    <label>
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                    ><?php echo htmlspecialchars($package['description']); ?></textarea>

                </div>


                <div class="form-group">

                    <label>
                        Image File Name
                    </label>

                    <input
                        type="text"
                        name="image"
                        value="<?php echo htmlspecialchars($package['image']); ?>"
                        placeholder="Example: manali.jpg"
                    >

                    <small>
                        Image must be available inside the images folder.
                    </small>

                </div>


                <?php if (!empty($package['image'])) { ?>

                    <div class="current-image">

                        <p>
                            Current Image:
                        </p>

                        <img
                            src="../images/<?php echo htmlspecialchars($package['image']); ?>"
                            alt="Current Package Image"
                        >

                    </div>

                <?php } ?>


                <div class="form-buttons">

                    <button
                        type="submit"
                        name="update_package"
                        class="update-btn"
                    >
                        Update Package
                    </button>


                    <a
                        href="packages.php"
                        class="cancel-btn"
                    >
                        Cancel
                    </a>

                </div>


            </form>


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