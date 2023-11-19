

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../img/nav-logo.png" />
    <!--  Font  -->
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=thuluth-decorated,hala,thuluth-decorated,sukar-black,mirza-bold,shahd-bold,sara,sheba" />
    <link rel="stylesheet" type="text/css" href="https://www.fontstatic.com/f=rsail,rabat,arabswell-1,kawkab-bold" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Register</title>
</head>
<body>

    <!-- Navbar -->
    <section class="header">
        <header class="navbar">
            <nav>
                <a href="" class="out">Register</a>
                <a href="./login.php" class="out">Log In</a>        
            </nav>
            <h3 class="nav-logo">
                <a href="../index.php">
                    <img src="../img/nav-logo.png">
                </a>
            </h3>

        </header>
    </section>



    <!--start register-->
    <form method="post">
        <div class="regist">
            <div class="container">
                <h1>Create Account</h1>
                <div class="register">
                    <input type="text" name="name" id="name" placeholder="Name" required>
                    <input type="email" name="email" id="email" placeholder="E-mail" required>
                    <input type="text" name="phone" id="phone" placeholder="phone number" required>
                    <input type="password" name="pass" id="pass" placeholder="password" required>
                    <input type="text" name="location" id="location" placeholder="Location" required>
                    <select name="type" id="type" onchange="showHideGuestField()">
                        <option value="User">User</option>
                        <option value="Factor">Factor</option>
                        <option value="Guest">Organization</option>
                    </select>
                    <select name="guestField" id="guestField" id="type" style="display: none;">
                        <option value="Material">Material Organization</option>
                        <option value="Food">Food Organization</option>
                    </select>
                    <button value="submit">register</button>
                    <p>If you have an account <a href="Register.html">Register</a></p>
                </div>
            </div>
        </div>
    </form>
    <!--end regist-->

</body>





<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "recycle";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = md5($_POST['pass']);
    $location = $_POST['location'];
    $userType = $_POST['type'];
    $guestField = $_POST['guestField'];


    if ($userType === 'User') {
        $insertQuery = "INSERT INTO users (name, email, phone, pass, location, type) 
                        VALUES ('$name', '$email', '$phone', '$pass', '$location', '$userType')";
    }

    else if ($userType === 'Factor') {
        $insertQuery = "INSERT INTO factor (name, email, phone, pass, location, type) 
                        VALUES ('$name', '$email', '$phone', '$pass', '$location', '$userType')";
    }
    else if ($guestField === 'Material') {
        $insertQuery = "INSERT INTO guest (name, email, phone, pass, location, type) 
                        VALUES ('$name', '$email', '$phone', '$pass', '$location', '$userType')";
    }else if ($guestField === 'Food') {
        $insertQuery = "INSERT INTO guest (name, email, phone, pass, location, type) 
                        VALUES ('$name', '$email', '$phone', '$pass', '$location', '$userType')";
    } else {
        echo "Error";
    }

    if ($conn->query($insertQuery) === TRUE) {
        session_start();
        $_SESSION['username'] = $name;

        if ($userType === 'User') {
            header('Location: user_page.php?username=' . $name);
        } else if ($userType === 'Factor') {
            header('Location: admin_page.php?username=' . $name);
        } else if ($guestField === 'Material') {
            header('Location: material_page.php?username=' . $name);
        } else if ($guestField === 'Food') {
            header('Location: food_page.php?username=' . $name);
        } else {
            exit();
        }
    } else {
        echo "Error: " . $conn->error; 
    }

    $conn->close();
}
?>


    <script src="../script/reg.js"></script>
</html>