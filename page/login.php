<?php
session_start();



$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "recycle";

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);

    // Check if the user exists in the database
    $checkQuery = "SELECT * FROM user WHERE email = '$email' AND phone = '$phone' AND pass = '$password'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        // User exists, set the username in the session
        $user = $result->fetch_assoc();
        $_SESSION['username'] = $user['name'];
        $_SESSION['userType'] = $user['type'];

        // Redirect the user based on their type
        $userType = $_SESSION['userType'];
        if ($userType === 'Admin') {
            header('Location: admin_page.php?username=' . $_SESSION['username']);
        } else if ($userType === 'User') {
            header('Location: user_page.php?username=' . $_SESSION['username']);
        } else if ($userType === 'Guest') {
            header('Location: guest_page.php?username=' . $_SESSION['username']);
        } else {
            exit();
        }
    } else {
        // User does not exist or credentials are incorrect, display an error message
        echo "Invalid credentials. Please try again.";
    }
}

$conn->close();
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../img/nav-logo.png" />
    <!--title of page-->
    <title>Login</title>
    <!---->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.min.js" integrity="sha512-WW8/jxkELe2CAiE4LvQfwm1rajOS8PHasCCx+knHG0gBHt8EXxS6T6tJRTGuDQVnluuAvMxWF4j8SNFDKceLFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!--main css file-->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/style.css">
    <!--font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>


    <section class="header">
        <header class="navbar">
            <nav>
                <a href="./register.php" class="out">Register</a>
                <a href="" class="out">Log In</a>        
            </nav>
            <h3 class="nav-logo">
                <a href="../index.php">
                    <img src="../img/nav-logo.png">
                </a>
            </h3>
        </header>
    </section>


    <!--start register-->
    <form  method="post">
        <div class="regist">
            <div class="container">
                <h1>log in</h1>
                <div class="register">
                    <input type="email" name="email" placeholder="E-mail" required>
                    <input type="text" name="phone" id="phone" placeholder="Phone number" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <button type="submit">log in</button>
                    <br>
                    <p>If you don't <a href="Register.html">Register</a></p>
                </div>
            </div>
        </div>
    </form>
    <!--end regist-->
</body>



