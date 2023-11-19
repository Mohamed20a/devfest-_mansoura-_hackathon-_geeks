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
    <!-- <link rel="stylesheet" href="../css/login.css"> -->
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Page</title>
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
    if(! $conn){
        echo mysqli_connect_error();
        exit;
    }


    $query = "SELECT * FROM `users`";

    if (isset($_GET['search'])){
        $search = mysqli_escape_string($conn, $_GET['search']);
        $query .= " WHERE `users` . `name` LIKE '%" . $search . "%' OR `users` . `email` LIKE '%" . $search . "%'";
    }
    $result = mysqli_query($conn, $query);


?>

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


    <section class="title">
        <h1>Welcome <?php echo $username; ?></h1>
        <p>This is the number of people registered and has materials that are subject to change</p>
    </section>

    <section class="page">
        <table>
            <thead class="row header" id="header-admin">
                <tr> 
                    <th class="cell">Name</th>
                    <th class="cell">Phone</th>
                    <th class="cell">Address</th>
                    <th class="cell">Material</th>
                    <th class="cell">food</th>
                    <th class="cell">Actions</th>
                </tr>
            </thead>
            <?php 
                while($row = mysqli_fetch_assoc(($result))){
            ?>

                <tr class="row" id="row-col">
                    <td class="cell"><?= $row['name']?></td>
                    <td class="cell"><?= $row['phone']?></td>
                    <td class="cell"><?= $row['location']?></td>
                    <td class="cell"><?= $row['count_material']?></td>
                    <td class="cell"><?= $row['count_food']?></td>
                    
                    <td class="cell" id="btn">
                        <a href="#" onclick="moveToGuest('<?= $row['phone'] ?>', '<?= $row['name'] ?>', '<?= $row['location'] ?>', '<?= $row['count_material'] ?>', '<?= $row['count_food'] ?>')">✔</a>
                    </td>
                </tr>

            <?php
                }
            ?>
        </table>
    </section>




    <script>
    function moveToGuest(phone, name, location, countMaterial, countFood) {
        var confirmation = confirm("Are you sure you want to move this record?");
        
        if (confirmation) {
            var rowElement = document.getElementById('row-col');
            rowElement.style.display = 'none';

            var xhr = new XMLHttpRequest();
            var url = 'move_to_guest.php';
            var params = 'phone=' + phone + '&name=' + name + '&location=' + location + '&count_material=' + countMaterial + '&count_food=' + countFood;
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send(params);
        }
    }
</script>


</body>