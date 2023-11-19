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
    <title>Food Page</title>
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

    $error_fileds = array();
    $conn = mysqli_connect("localhost", "root", "", "recycle");
    if (! $conn){
        echo mysqli_connect_error();
        exit;
    }

    $query = "SELECT * FROM `users`";

    if (isset($_GET['search'])){
        $search = mysqli_escape_string($conn, $_GET['search']);
        $query .= " WHERE `users`.`name` LIKE '%" . $search . "%' OR `users`.`email` LIKE '%" . $search . "%'";
    }

    $result = mysqli_query($conn, $query);
    $totalMaterialCount = 0;
    $totalFoodCount = 0;
?>

    <!-- Navbar -->
    <section class="header">
        <header class="navbar">
            <nav>
                <a href="./login.php" class="out">Logout</a>
                <p> <?php echo $username; ?></p>
            </nav>
            <h3 class="nav-logo">
                <a href="../index.php">
                    <img src="../img/nav-logo.png">
                </a>
            </h3>
        </header>
    </section>

    <!-- Title -->
    <section class="title">
        <h1>Welcome <?php echo $username; ?></h1>
        <p>Total Amount of Food</p>
    </section>

    <!-- Table -->
    <section class="page">
        <table>
            <thead class="row header" id="header-guest">
                <tr> 
                    <th class="cell" id="col-guest">Quantity of Food</th>
                    <th class="cell">Actions</th>
                </tr>
            </thead>
            <?php 
                while ($row = mysqli_fetch_assoc($result)){
                    $totalMaterialCount += $row['count_material'];
                    $totalFoodCount += $row['count_food'];
                }
            ?>

                <tr class="row" id="row-col">
                    <td class="cell" id="col-guest"><?= $totalFoodCount ?></td>
                    <td class="cell" id="btn">
                        <a href="#" onclick="moveToGuest('<?= $row['phone'] ?>', '<?= $row['name'] ?>', '<?= $row['location'] ?>', '<?= $row['count_material'] ?>', '<?= $row['count_food'] ?>')">✔</a>
                    </td>
                </tr>
        </table>
    </section>

</body>
</html>
