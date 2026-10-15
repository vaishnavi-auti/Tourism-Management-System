<?php

session_start();

include "../config/database.php";

// ================= ADMIN LOGIN CHECK =================

if (!isset($_SESSION['admin_id'])) {

    header("Location: login.php");
    exit();

}


// ================= SEARCH =================

$search = "";

if (isset($_GET['search'])) {

    $search = trim($_GET['search']);

}


// ================= GET PACKAGES =================

if ($search != "") {

    /*
    Search text into separate words.

    Example:
    3 Day / 2 Nights

    becomes:

    3
    Day
    2
    Nights

    Every word will be searched in:
    Package Name
    Destination
    Duration
    Price
    Description
    */

    $words = preg_split(
        '/[\s\/,\-]+/',
        $search,
        -1,
        PREG_SPLIT_NO_EMPTY
    );


    $conditions = [];
    $parameters = [];
    $types = "";


    foreach ($words as $word) {

        $conditions[] = "
            (
                package_name LIKE ?
                OR destination LIKE ?
                OR duration LIKE ?
                OR CAST(price AS CHAR) LIKE ?
                OR description LIKE ?
            )
        ";


        $search_value = "%" . $word . "%";


        $parameters[] = $search_value;
        $parameters[] = $search_value;
        $parameters[] = $search_value;
        $parameters[] = $search_value;
        $parameters[] = $search_value;


        $types .= "sssss";

    }


    $sql = "
        SELECT *
        FROM packages
        WHERE " . implode(" AND ", $conditions) . "
        ORDER BY id DESC
    ";


    $stmt = mysqli_prepare($conn, $sql);


    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            $types,
            ...$parameters
        );


        mysqli_stmt_execute($stmt);


        $query = mysqli_stmt_get_result($stmt);

    } else {

        $query = false;

    }


} else {

    // Show all packages when search is empty

    $query = mysqli_query(
        $conn,
        "SELECT * FROM packages ORDER BY id DESC"
    );

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Manage Packages - Tourism Management System
    </title>


    <link
        rel="stylesheet"
        href="../css/style.css"
    >


    <link
        rel="stylesheet"
        href="../css/admin-packages.css"
    >

</head>


<body>


<!-- ================= NAVBAR ================= -->

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


            <a
                href="logout.php"
                class="admin-logout"
            >
                Logout
            </a>


        </div>

    </nav>

</header>



<!-- ================= PACKAGES SECTION ================= -->

<section class="packages-section">


    <div class="packages-container">


        <!-- ================= PAGE HEADER ================= -->

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



        <!-- ================= SEARCH ================= -->

        <div class="package-search">


            <form method="GET">


                <input
                    type="text"
                    name="search"
                    placeholder="Search package, destination, duration, price..."
                    value="<?php echo htmlspecialchars($search); ?>"
                >


                <button type="submit">
                    Search
                </button>


                <?php if ($search != "") { ?>

                    <a
                        href="packages.php"
                        class="clear-search"
                    >
                        Clear
                    </a>

                <?php } ?>


            </form>


        </div>



        <!-- ================= PACKAGE LIST ================= -->

        <?php

        if ($query && mysqli_num_rows($query) > 0) {

        ?>


            <div class="table-container">


                <table class="packages-table">


                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Image</th>

                            <th>Package Name</th>

                            <th>Destination</th>

                            <th>Duration</th>

                            <th>Price</th>

                            <th>Description</th>

                            <th>Action</th>

                        </tr>

                    </thead>


                    <tbody>


                    <?php

                    while (
                        $package =
                        mysqli_fetch_assoc($query)
                    ) {

                    ?>


                        <tr>


                            <!-- ID -->

                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $package['id']
                                );
                                ?>

                            </td>



                            <!-- IMAGE -->

                            <td>


                                <?php

                                if (
                                    !empty(
                                        $package['image']
                                    )
                                ) {

                                ?>

                                    <img
                                        src="../images/<?php
                                        echo htmlspecialchars(
                                            $package['image']
                                        );
                                        ?>"
                                        class="package-image"
                                        alt="Package Image"
                                    >

                                <?php

                                } else {

                                ?>

                                    <span class="no-image">
                                        No Image
                                    </span>

                                <?php

                                }

                                ?>


                            </td>



                            <!-- PACKAGE NAME -->

                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $package['package_name']
                                );
                                ?>

                            </td>



                            <!-- DESTINATION -->

                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $package['destination']
                                );
                                ?>

                            </td>



                            <!-- DURATION -->

                            <td>

                                <?php
                                echo htmlspecialchars(
                                    $package['duration']
                                );
                                ?>

                            </td>



                            <!-- PRICE -->

                            <td class="price">

                                ₹<?php

                                echo number_format(
                                    (float)$package['price'],
                                    2
                                );

                                ?>

                            </td>



                            <!-- DESCRIPTION -->

                            <td class="description">

                                <?php
                                echo htmlspecialchars(
                                    $package['description']
                                );
                                ?>

                            </td>



                            <!-- ACTION -->

                            <td>


                                <div class="action-buttons">


                                    <!-- EDIT -->

                                    <a
                                        href="edit-package.php?id=<?php
                                        echo $package['id'];
                                        ?>"
                                        class="edit-btn"
                                    >
                                        Edit
                                    </a>



                                    <!-- DELETE -->

                                    <a
                                        href="delete-package.php?id=<?php
                                        echo $package['id'];
                                        ?>"
                                        class="delete-btn"
                                        onclick="return confirm('Are you sure you want to delete this package?');"
                                    >
                                        Delete
                                    </a>


                                </div>


                            </td>


                        </tr>


                    <?php

                    }

                    ?>


                    </tbody>


                </table>


            </div>


        <?php

        } else {

        ?>


            <!-- ================= NO PACKAGES ================= -->

            <div class="no-packages">


                <div class="no-package-icon">
                    📦
                </div>


                <h2>
                    No Packages Found
                </h2>


                <?php if ($search != "") { ?>

                    <p>
                        No packages matched your search.
                    </p>


                    <a
                        href="packages.php"
                        class="clear-search"
                    >
                        Clear Search
                    </a>


                <?php } else { ?>

                    <p>
                        No tour packages have been added yet.
                    </p>


                    <a
                        href="add-package.php"
                        class="add-package-btn"
                    >
                        + Add Your First Package
                    </a>

                <?php } ?>


            </div>


        <?php

        }

        ?>


    </div>


</section>



<!-- ================= FOOTER ================= -->

<footer>

    <p>
        © 2026 Tourism Management System.
        All Rights Reserved.
    </p>

</footer>


</body>

</html>