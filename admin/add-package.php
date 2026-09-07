<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include "../config/database.php";

$message = "";

if (isset($_POST['submit'])) {

    $package_name = trim($_POST['package_name']);
    $destination = trim($_POST['destination']);
    $duration = trim($_POST['duration']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $image = trim($_POST['image']);

    if (
        empty($package_name) ||
        empty($destination) ||
        empty($duration) ||
        empty($price)
    ) {

        $message = "Please fill all required fields.";

    } else {

        $sql = "INSERT INTO packages
                (package_name, destination, duration, price, description, image)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sssdss",
            $package_name,
            $destination,
            $duration,
            $price,
            $description,
            $image
        );

        if (mysqli_stmt_execute($stmt)) {
            $message = "Package added successfully!";
        } else {
            $message = "Something went wrong. Please try again.";
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

    <title>Add Package - Admin</title>

    <link rel="stylesheet" href="../css/style.css">

    <style>

        /* =========================
           ADD PACKAGE PAGE
        ========================= */

        body {
            margin: 0;
            background: #f4f7fb;
            font-family: Arial, sans-serif;
        }

        .package-container {
            width: 90%;
            max-width: 850px;
            margin: 50px auto;
            padding: 40px 50px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        }

        /* Heading */

        .package-container h1 {
            text-align: center;
            color: #222;
            font-size: 32px;
            margin: 0;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-top: 10px;
            margin-bottom: 35px;
            font-size: 15px;
        }

        /* Success Message */

        .success-message {
            background: #e8f7ee;
            color: #198754;
            padding: 13px;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 600;
        }

        /* Form */

        .package-form {
            display: flex;
            flex-direction: column;
        }

        .package-form label {
            font-size: 16px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            margin-top: 18px;
        }

        .package-form input,
        .package-form textarea {
            width: 100%;
            padding: 14px 15px;
            box-sizing: border-box;
            border: 1px solid #d5dbe3;
            border-radius: 8px;
            background: #fafbfc;
            font-size: 15px;
            transition: 0.3s;
        }

        /* Input Focus */

        .package-form input:focus,
        .package-form textarea:focus {
            outline: none;
            background: white;
            border-color: #1683ff;
            box-shadow: 0 0 0 3px rgba(22, 131, 255, 0.12);
        }

        /* Description */

        .package-form textarea {
            min-height: 130px;
            resize: vertical;
        }

        /* Button */

        .add-package-btn {
            margin-top: 30px;
            padding: 15px;
            border: none;
            border-radius: 8px;
            background: #1683ff;
            color: white;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .add-package-btn:hover {
            background: #006fe6;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(22, 131, 255, 0.25);
        }

        /* Back Button */

        .back-dashboard {
            display: block;
            width: fit-content;
            margin: 20px auto 0;
            color: #1683ff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-dashboard:hover {
            text-decoration: underline;
        }

        /* Responsive */

        @media (max-width: 768px) {

            .package-container {
                width: 88%;
                padding: 30px 25px;
                margin: 30px auto;
            }

            .package-container h1 {
                font-size: 27px;
            }

            .package-form input,
            .package-form textarea {
                font-size: 14px;
            }

        }

    </style>

</head>

<body>

    <!-- Admin Navbar -->

    <nav class="navbar">

        <div class="logo">
            Tourism Management
        </div>

        <ul class="nav-links">

            <li>
                <a href="dashboard.php">Dashboard</a>
            </li>

            <li>
                <a href="users.php">Users</a>
            </li>

            <li>
                <a href="bookings.php">Bookings</a>
            </li>

            <li>
                <a href="contact-messages.php">Messages</a>
            </li>

            <li>
                <a href="logout.php">Logout</a>
            </li>

        </ul>

    </nav>


    <!-- Add Package Container -->

    <div class="package-container">

        <h1>Add New Package</h1>

        <p class="subtitle">
            Add a new tour package to the tourism system
        </p>


        <?php if (!empty($message)) { ?>

            <div class="success-message">
                <?php echo htmlspecialchars($message); ?>
            </div>

        <?php } ?>


        <form method="POST" action="" class="package-form">

            <label>Package Name</label>

            <input
                type="text"
                name="package_name"
                placeholder="Enter package name"
                required
            >


            <label>Destination</label>

            <input
                type="text"
                name="destination"
                placeholder="Enter destination"
                required
            >


            <label>Duration</label>

            <input
                type="text"
                name="duration"
                placeholder="Example: 5 Days / 4 Nights"
                required
            >


            <label>Price</label>

            <input
                type="number"
                name="price"
                placeholder="Enter package price"
                min="0"
                step="0.01"
                required
            >


            <label>Description</label>

            <textarea
                name="description"
                placeholder="Enter package description"
            ></textarea>


            <label>Image Path</label>

            <input
                type="text"
                name="image"
                placeholder="Example: images/goa.jpg"
            >


            <button
                type="submit"
                name="submit"
                class="add-package-btn"
            >
                Add Package
            </button>

        </form>


        <a href="dashboard.php" class="back-dashboard">
            ← Back to Dashboard
        </a>

    </div>

</body>

</html>