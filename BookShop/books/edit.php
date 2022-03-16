<?php


# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';


# GET RAW Data .... 
$id = $_GET['id'];
$errors = [];
# Start Validation .... 

if (!validate($id, 1)) {
    $errors['id'] = "Field Required";
} elseif (!validate($id, 5)) {

    $errors['id'] = "Invalid id";
}


if (count($errors) > 0) {

    $Message = $errors;

    $_SESSION['Message'] = $Message;

    header("Location: index.php");
    exit();
} else {

    $sql = "select * from book where b_id = $id";
    $op  = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($op);
}




# Select Roles ..... 
$sql = "select * from book_type ";
$op  = mysqli_query($con, $sql);






if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $book_name         = Clean($_POST['b_name']);
    $book_authur       = Clean($_POST['b_anthor']);
    $book_publisher    = Clean($_POST['b_publisher']);
    $book_edition      = Clean($_POST['b_edition']);
    $book_price        = Clean($_POST['b_price']);
    $book_copies       = Clean($_POST['b_copies']);
    $book_description  = Clean($_POST['b_name']);
    $type_id           = Clean($_POST['type_id']);


    $error = [];

    # Validate book_name

    if (!validate($book_name, 1)) {

        $error['book_name'] = "Field Required ...";
    } elseif (!validate($book_name, 6)) {
        $error['book_name'] = "Invalid String ";
    }



    # Validate Authors

    if (!validate($book_authur, 1)) { //------------------------------

        $error['book_authur'] = "Field Required ...";
    } elseif (!validate($book_authur, 6)) {
        $error['book_authur'] = "Invalid String ";
    }


    # Validate publisher

    if (!validate($book_publisher, 1)) {

        $error['book_publisher'] = "Field Required ...";
    } elseif (!validate($book_publisher, 6)) {
        $error['book_publisher'] = "Invalid String ";
    }


    # Validate  edition

    if (!validate($book_edition, 1)) {

        $error['book_edition'] = "Field Required ...";
    }



    # Price.........

    if (!validate($book_price, 1)) {
        $error['book_price'] = "Field Required ...";
    } elseif (!validate($book_price, 5)) {
        $error['book_price'] = "should have number....!";
    }




    # Copies.........

    if (!validate($book_copies, 1)) {
        $error['book_copies'] = "Field Required ...";
    } elseif (!validate($book_copies, 5)) {
        $error['book_copies'] = "should have number....!";
    }




    # Description.........

    if (validate($book_description, 1) == false) {

        $error['book_description'] = "Field Required ...";
    } elseif (!validate($book_description, 4, 300)) {
        $errors['Content'] = "Length Must >= 300 CH";
    }
    $book_description = str_replace("'", "''", $book_description);


    # cataloge Validation .... 
    if (!validate($type_id, 1)) {
        $error['cataloge'] = "Field Required";
    } elseif (!validate($type_id, 5)) {
        $error['cataloge'] = "Invalid book type";
    }

    //********************************************************************************************** */

    if (validate($_FILES['image']['tmp_name'], 1)) {
        # code...

        $file_tmp  =  $_FILES['image']['tmp_name'];
        $file_name =  $_FILES['image']['name'];
        $file_size =  $_FILES['image']['size'];
        $file_type =  $_FILES['image']['type'];

        $file_ex   = explode('.', $file_name);
        $updated_ex = strtolower(end($file_ex));



        # Image Validate ..... 
        if (!validate($updated_ex, 8)) {
            $error['Image'] = "Invalid Extension";
        }
    }

    if (count($error) > 0) {
        $_SESSION['Message'] = $error;
    } else {


        //if image  true

        if (validate($_FILES['image']['tmp_name'], 1)) {



            //   # Upload Image ..... 
            $finalName = rand() . time() . '.' . $updated_ex;

            $disPath = './photos/' . $finalName;

            if (move_uploaded_file($file_tmp, $disPath)) {
                // DB Code .... 
                $sql = "update book set  b_name=' $book_name', b_author= '$book_authur', publisher=' $book_publisher', edition ='$book_edition', price=$book_price, no_of_copies=$book_copies,  description='$book_description',images='$finalName', type_id=$type_id where b_id=$id";
                $update_op  = mysqli_query($con, $sql);

                if ($update_op) {

                    unlink('./photos/' . $data['images']);
                    $message = ['Raw updated'];
                } else {
                    $message = ['Error Try Again'];
                }
            }
        } else {
            $sql = "update book set  b_name=' $book_name', b_author= '$book_authur', publisher=' $book_publisher', edition ='$book_edition', price=$book_price, no_of_copies=$book_copies,  description='$book_description', type_id=$type_id where b_id=$id";

            $op  = mysqli_query($con, $sql);
            if ($op) {
                $message = ['Raw Updated'];
            } else {
                $message = ['Error Try Again'];
            }
        }

        $_SESSION['Message'] = $message;
        header("Location: index.php");
        exit();
    }
}  // end form Logic ..... 

require "../layouts/header.php";
require "../layouts/nav.php";
require "../layouts/sidNav.php";

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">

                <li class="breadcrumb-item active">
                    <?php
                    $text = "upload book";
                    printMessage($text);
                    ?>
                </li>




            </ol>




            <div class="container">

                <form action="edit.php?id=<?php echo $data['b_id']; ?>" method="post" enctype="multipart/form-data">

                    <h3 style="text-align: center;">Uplode book</h3>



                    <div class="form-group">
                        <label for="exampleInputName">Book_Name</label>
                        <input type="text" class="form-control" name="b_name" value="<?php echo $data['b_name']; ?> " id="exampleBook_Name" aria-describedby="" placeholder="Enter Book_Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail"> Book_Author </label>
                        <input type="text" class="form-control" name="b_anthor" value="<?php echo $data['b_author']; ?> " id="exampleInputBook_Author" aria-describedby="emailHelp" placeholder="Enter Book_Author">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">publisher</label>
                        <input type="text" class="form-control" name="b_publisher" value="<?php echo $data['publisher']; ?> " id="exampleInputpublisher" placeholder="publisher">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputPassword">Book_Edition</label>
                        <input type="text" class="form-control" name="b_edition" value="<?php echo $data['edition']; ?>" id="exampleInputBook_Edition" placeholder="LinkedIn Book_Edition">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputName">Price</label>
                        <input type="text" class="form-control" name="b_price" value="<?php echo $data['price']; ?> " id="exampleInputPrice" aria-describedby="" placeholder="Enter Price">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputName">Copies</label>
                        <input type="text" class="form-control" name="b_copies" value="<?php echo $data['no_of_copies']; ?> " id="exampleInputName" aria-describedby="" placeholder="Enter Copies">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputName">Description</label>
                        <input type="text" class="form-control" name="b_description" value="<?php echo $data['description']; ?> " placeholder="Enter Description">
                    </div>





                    <div class="form-group">
                        <label for="exampleInputPassword"> cataloge</label>
                        <select class="form-control" name="type_id">

                            <?php
                            while ($type_data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $type_data['t_id']; ?>" <?php if ($type_data['t_id'] == $data['type_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                    <?php echo $type_data['t_name']; ?> </option>
                            <?php } ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputName">Image</label> <br>
                        <input type="file" name="image">

                        <img src="./photos/<?php echo $data['images'] ?>" width="50px">
                    </div>




                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>





        </div>
    </main>




    <?php

    require "../layouts/footer.php";

    ?>