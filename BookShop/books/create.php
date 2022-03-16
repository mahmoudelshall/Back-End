<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';


$sql = "select * from book_type order by t_id desc";
$op  = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $book_name         = Clean($_POST['b_name']);
    $book_authur       = Clean($_POST['b_anthor']);
    $book_publisher    = Clean($_POST['b_publisher']);
    $book_edition      = Clean($_POST['b_edition']);
    $book_price        = Clean($_POST['b_price']);
    $book_copies       = Clean($_POST['b_copies']);
    $book_description  = Clean($_POST['b_description']);
    $type_id           = Clean($_POST['type_id']);
    //$book_image       
    $file_tmp  =  $_FILES['image']['tmp_name'];
    $file_name =  $_FILES['image']['name'];
    $file_size =  $_FILES['image']['size'];
    $file_type =  $_FILES['image']['type'];

    $file_ex   = explode('.', $file_name);
    $updated_ex = strtolower(end($file_ex));


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
    } /* elseif (!validate($book_publisher, 4, 50)) {
        $error['book_publisher'] = "Name of Authors should have less than 20 chars";
    } */


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


    # cataloge Validation .... 
    if (!validate($type_id, 1)) {
        $error['cataloge'] = "Field Required";
    } elseif (!validate($type_id, 5)) {
        $error['cataloge'] = "Invalid Role";
    }



    # Image Validate ..... 
    if (!validate($file_name, 1)) {
        $error['Image'] = "Field Required";
    } elseif (!validate($updated_ex, 8)) {
        $error['Image'] = "Invalid Extension";
    }



    if (count($error) > 0) {
        $_SESSION['Message'] = $error;
    } else {

        # Upload Image ..... 
        $finalName = rand() . time() . '.' . $updated_ex;

        $disPath = './photos/' . $finalName;

        if (move_uploaded_file($file_tmp, $disPath)) {
            // DB Code .... 
            $book_description = str_replace("'", "''", $book_description);

            $sql = "insert into book( b_name, b_author, publisher, edition, price, no_of_copies, description,images,type_id) 
                    values ('$book_name','$book_authur','$book_publisher ','$book_edition','$book_price','$book_copies','$book_description','$finalName','$type_id')";
            $insert_op  = mysqli_query($con, $sql);



            // echo mysqli_error($con);
            // exit();

            if ($insert_op) {
                $message = ['Raw Inserted'];
            } else {
                $message = ['Error Try Again'];
            }
        } else {

            $message = ["Error In Upload Image Try Again"];
        }

        $_SESSION['Message'] = $message;
        header("Location: index.php");
        exit();
    }
}


require "../layouts/header.php";
require "../layouts/nav.php";
require "../layouts/sidNav.php";






?>



<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid" style="background-color:#f2f2f2;">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <?php
                if (isset($_SESSION['Message'])) {
                    foreach ($_SESSION['Message'] as $key => $val) {

                        echo '* ' . $key . ' : ' . $val . '<br>';
                    }
                    unset($_SESSION['Message']);
                } else {


                ?>
                    <li class="breadcrumb-item active""><i>Add new book </i> </li>
           <?php } ?>
            
             </ol>





         <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                        <h3 style="text-align: center;">Books' Information</h3>



                        <div class="form-group">
                            <label for="exampleInputName">Book_Name</label>
                            <input type="text" class="form-control" name="b_name" id="exampleBook_Name" aria-describedby="" placeholder="Enter Book_Name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail"> Book_Author </label>
                            <input type="text" class="form-control" name="b_anthor" id="exampleInputBook_Author" aria-describedby="emailHelp" placeholder="Enter Book_Author">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">publisher</label>
                            <input type="text" class="form-control" name="b_publisher" id="exampleInputpublisher" placeholder="publisher">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputPassword">Book_Edition</label>
                            <input type="text" class="form-control" name="b_edition" id="exampleInputBook_Edition" placeholder=" Book_Edition">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName">Price</label>
                            <input type="text" class="form-control" name="b_price" id="exampleInputPrice" aria-describedby="" placeholder="Enter Price">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputName">Copies</label>
                            <input type="number" class="form-control" name="b_copies" id="exampleInputName" aria-describedby="" placeholder="Enter Copies">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputName">Description</label>
                            <input type="text" class="form-control" name="b_description" id="exampleInputDescription" aria-describedby="" placeholder="Enter Description">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputName">image</label>
                            <input type="file" class="form-control" name="image" id="exampleInputName" aria-describedby="" placeholder="Upload image">

                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword">catalog</label>
                            <select class="form-control" name="type_id">

                                <?php
                                while ($data = mysqli_fetch_assoc($op)) {
                                ?>
                                    <option value="<?php echo $data['t_id']; ?>"> <?php echo $data['t_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>




                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>






        </div>
    </main>






    <?php
    require "../layouts/footer.php";

    ?>