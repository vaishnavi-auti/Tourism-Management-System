<?php

session_start();

include "../config/database.php";

$message = "";

if (isset($_POST['login'])) {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM admins WHERE email = ?";

    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param(
        $stmt,
        "s",
        $email
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {

        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin['password'])) {

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "Invalid password!";

        }

    } else {

        $message = "Admin account not found!";

    }

    mysqli_stmt_close($stmt);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Tourism Management System</title>

    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/admin-login.css">

</head>

<body>


<!-- ================= ADMIN LOGIN ================= -->

<section class="admin-login-section">

    <div class="admin-login-box">

        <div class="admin-icon">
            🔐
        </div>

        <h1>Admin Login</h1>

        <p>
            Tourism Management System
        </p>


        <?php if ($message != "") { ?>

            <div class="admin-message">

                <?php echo htmlspecialchars($message); ?>

            </div>

        <?php } ?>


        <form method="POST">

            <label>
                Email Address
            </label>

            <input
                type="email"
                name="email"
                placeholder="Enter admin email"
                required
            >


            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Enter admin password"
                required
            >


            <button
                type="submit"
                name="login"
            >
                Login
            </button>

        </form>


        <a
            href="../index.php"
            class="back-home"
        >
            ← Back to Home
        </a>

    </div>

</section>


</body>

</html>