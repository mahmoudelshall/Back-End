<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = Clean($_POST['title']);

    $errors = [];

    if (!validate($title, 1)) {
        $errors['Title'] = "Field Required";
    } elseif (!validate($title, 6)) {
        $errors['Title'] = "Invalid String";
    }


    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {

        # Db Operation ..... 

        $sql = "insert into roles (title) values ('$title')";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $message = ['Data Inserted'];
        } else {
            $message = ['Error Try Again'];
        }
        $_SESSION['Message'] = $message;

        header("Location: index.php");
        exit();
    }
}  // end form Logic ..... 

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">


                <li class="breadcrumb-item active">
                    <?php
                    $text = "ADD NEW ROLE";
                    printMessage($text);
                    ?>
                </li>











            </ol>




            <div class="container">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">


                    <div class="form-group">
                        <label for="exampleInputName">Title</label>
                        <input type="text" class="form-control" name="title" id="exampleInputName" aria-describedby="" placeholder="Enter Role Title">
                    </div>



                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>





        </div>
    </main>


    <?php

    require '../layouts/footer.php';

    ?>