<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';




?>




<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="description" content="Book Shop " />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Book Shop</title>

    <!--== bootstrap -->
    <link href="css/test.css" rel="stylesheet" type="text/css" />


</head>

<body>
    <div class="part1">
        <nav class="nav">
            <h1 class="title">Book Shop</h1>
            <ul class="">
                <li class="">Home</li>
                <li class="">About</li>
                <li class="">Service</li>
                <li class="">Contact</li>
                <li class="">News</li>
            </ul>
            <form class="">
                <a class="but" href="login.php">login</a>
                <a class="but" href="logout.php">LogOut</a>
            </form>
        </nav>
    </div>



    <?php
    $sql = "select * from book_type";
    $op  = mysqli_query($con, $sql);

    while ($deparment = mysqli_fetch_assoc($op)) {
        $x = $deparment['t_id'];
    ?>






        <div class="part2">
            <h1> <?php echo $deparment['t_name']; ?> Department</h1>
            <div class="container">
                <?php
                $sql = "select book.* ,book_type.* from book inner join book_type 
            on book.type_id = book_type.t_id  where type_id = $x";
                $oop  = mysqli_query($con, $sql);

                while ($data = mysqli_fetch_assoc($oop)) {

                ?>



                    <div class="card">
                        <img class="" src="../books/photos/<?php echo $data['images'] ?>" alt="">
                        <h3>Book Name: <?php echo $data['b_name'] ?></h3>
                        <h3>Book Author: <?php echo $data['b_author'] ?> </h3>
                        <h3>Book Publisher: <?php echo $data['publisher'] ?> </h3>
                        <h3>Classification:<?php echo $data['t_name'] ?></h3>
                        <p> <?php echo substr($data['description'], 0, 200) ?> </p>
                        <div class="price">Price:<?php echo $data['price'] ?> $ </div>
                        <a class="buy" href='buy.php?id=<?php echo $data['b_id']; ?>'>Buy</a>
                    </div>
                <?php } ?>

            </div>
        </div>


    <?php } ?>


</body>

</html>