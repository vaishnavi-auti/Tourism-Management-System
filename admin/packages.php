<?php

session_start();

include "../config/database.php";

// Check admin login
if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


// Fetch all packages
$query = mysqli_query(
    $conn,
    "SELECT * FROM packages ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manage Packages - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-packages.css">

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



<section class="packages-section">

    <div class="packages-container">


        <!-- Page Header -->

        <div class="packages-header">

            <div>

                <h1>
                    Manage Packages
                </h1>

                <p class="packages-subtitle">
                    View and manage all tour packages
                </p>

            </div>


            <a
                href="add-package.php"
                class="add-package-btn"
            >
                + Add Package
            </a>

        </div>



        <!-- Package List -->

        <?php if (mysqli_num_rows($query) > 0) { ?>


            <div class="table-container">

                <table class="packages-table">


                    <thead>

                        <tr>

                            <th>
                                ID
                            </th>

                            <th>
                                Image
                            </th>

                            <th>
                                Package Name
                            </th>

                            <th>
                                Destination
                            </th>

                            <th>
                                Duration
                            </th>

                            <th>
                                Price
                            </th>

                            <th>
                                Description
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        <?php while ($package = mysqli_fetch_assoc($query)) { ?>


                            <tr>


                                <!-- ID -->

                                <td>
                                    <?php
                                    echo $package['id'];
                                    ?>
                                </td>



                                <!-- Image -->

                                <td>

                                    <?php if (!empty($package['image'])) { ?>


                                        <img
                                            src="../images/<?php echo htmlspecialchars($package['image']); ?>"
                                            class="package-image"
                                            alt="Package Image"
                                        >


                                    <?php } else { ?>


                                        <span class="no-image">
                                            No Image
                                        </span>


                                    <?php } ?>

                                </td>



                                <!-- Package Name -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $package['package_name']
                                    );
                                    ?>

                                </td>



                                <!-- Destination -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $package['destination']
                                    );
                                    ?>

                                </td>



                                <!-- Duration -->

                                <td>

                                    <?php
                                    echo htmlspecialchars(
                                        $package['duration']
                                    );
                                    ?>

                                </td>



                                <!-- Price -->

                                <td class="price">

                                    ₹<?php
                                    echo htmlspecialchars(
                                        $package['price']
                                    );
                                    ?>

                                </td>



                                <!-- Description -->

                                <td class="description">

                                    <?php
                                    echo htmlspecialchars(
                                        $package['description']
                                    );
                                    ?>

                                </td>



                                <!-- Action -->

                                <td>

                                    <div class="action-buttons">


                                        <!-- Edit Button -->

                                        <a
                                            href="edit-package.php?id=<?php echo $package['id']; ?>"
                                            class="edit-btn"
                                        >
                                            Edit
                                        </a>



                                        <!-- Delete Button -->

                                        <a
                                            href="delete-package.php?id=<?php echo $package['id']; ?>"
                                            class="delete-btn"
                                            onclick="return confirm('Are you sure you want to delete this package?');"
                                        >
                                            Delete
                                        </a>


                                    </div>

                                </td>


                            </tr>


                        <?php } ?>


                    </tbody>


                </table>

            </div>


        <?php } else { ?>


            <!-- No Packages -->

            <div class="no-packages">


                <div class="no-package-icon">
                    📦
                </div>


                <h2>
                    No Packages Found
                </h2>


                <p>
                    No tour packages have been added yet.
                </p>


                <a
                    href="add-package.php"
                    class="add-package-btn"
                >
                    + Add Your First Package
                </a>


            </div>


        <?php } ?>


    </div>

</section>



<footer>

    <p>
        © 2026 Tourism Management System. All Rights Reserved.
    </p>

</footer>


</body>

</html>