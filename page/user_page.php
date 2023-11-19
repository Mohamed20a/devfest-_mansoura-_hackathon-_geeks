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
    <link rel="stylesheet" href="../css/style.css">
    <title>User Page</title>
</head>
<body>

<?php 
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        header('Location: login.php');
        exit();
    }




    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }


    $dbHost = "localhost";
    $dbUser = "root";
    $dbPassword = "";
    $dbName = "recycle";

    $conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $username = $_SESSION['username'];
    $countMaterial = isset($_POST['count_material']) ? intval($_POST['count_material']) : 0;
    $countFood = isset($_POST['count_food']) ? intval($_POST['count_food']) : 0;


    
    $updateQuery = "UPDATE users SET count_material = $countMaterial, count_food = $countFood WHERE name = '$username'";

    if ($conn->query($updateQuery) === TRUE) {
        echo "Done";
    } else {
        echo "Error: " . $updateQuery . "<br>" . $conn->error;
    }

    $conn->close();


?>


<form method="post">
    <section class="header">
        <header class="navbar">
            <nav>
                <a href="./login.php" class="out">Logout</a>
                <a>food: <span id="count-food">0 Kg</span></a>
                <a>Material: <span id="count-material">0 Kg</span></a>
                <div class="flex">
                    <a><p> <?php echo $username; ?></p></a>
                    <p>: Point </p>
                </div>
            </nav>
            <h3 class="nav-logo">
                <a href="../index.php">
                    <img src="../img/nav-logo.png">
                </a>
            </h3>
        </header>
    </section>

    <section class="title">
        <h1>Welcome <?php echo $username; ?></h1>
        <p>Choose the amount of Food and Material</p>
    </section>

    <section class="page">
        <div class="card-user" id="material">
            <h2>Materials for recycling</h2>
            <p>These are recycled materials.</p>
            <button type="button" onclick="incrementCount('count-material')">+</button>
            <input type="hidden" name="count_material" id="hidden-count-material" value="0">
        </div>

        <div class="card-user" id="food">
            <h2>Food</h2>
            <p>It is the use of food from recycling.</p>
            <button type="button" onclick="incrementCount('count-food')">+</button>
            <input type="hidden" name="count_food" id="hidden-count-food" value="0">
        </div>
    </section>

    <section class="submit">
        <button type="submit">Submit Counts</button>
    </section>
</form>


    <script src="../script/user.js"></script>

</body>
</html>