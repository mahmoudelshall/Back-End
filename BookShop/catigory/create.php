<?php
# logic..

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $book_title = Clean($_POST['t_book']);


    $errors = [];

    #validation....

    if (!validate($book_title, 1)) {
        $errors['book_title'] = "Field required";
    } elseif (!validate($book_title, 6)) {
        $errors['book_title'] = "invalid string";
    }

    if (count($errors) > 0) {
        $_SESSION["Message"] = $errors;
    } else {
        # Database .........
        $sql = "insert into book_type (t_name) values('$book_title') ";
        $op  = mysqli_query($con, $sql);

        if ($con) {
            $Message = ['Data inersted'];
        } else {
            $Message = ['Sorry try again'];
        }
        $_SESSION['Message'] = $Message;
        header("Location:index.php");
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
                    <li class="breadcrumb-item active""><i>Add new Type </i> </li>
           <?php } ?>
            
             </ol>





         <form action=" <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">

                        <h3 style="text-align: center;">Books' Information</h3>


                        <div class="form-group">
                            <label for="exampleInputName">Book Type</label>
                            <input type="text" class="form-control" name="t_book" id="exampleBook_Name" aria-describedby="" placeholder="Enter Book_Name">
                        </div>




                        <button type="submit" class="btn btn-primary">Save</button>
                        </form>






        </div>
    </main>






    <?php
    require "../layouts/footer.php";

    ?>