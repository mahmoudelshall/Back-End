<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';

# Select Roles ..... 
$sql = "select * from roles order by id desc";
$op  = mysqli_query($con, $sql);


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name        = Clean($_POST['name']);
    $email       = Clean($_POST['email']);
    $password    = Clean($_POST['password']);
    $phone       = Clean($_POST['phone']);
    $role_id     = Clean($_POST['role_id']);
    $country     = Clean($_POST['country']);
    $government  = Clean($_POST['government']);
    $city        = Clean($_POST['city']);
    $extraData   = Clean($_POST['extraData']);




    $errors = [];

    # Name Validation ... 
    if (!validate($name, 1)) {
        $errors['Name'] = "Field Required";
    } elseif (!validate($name, 6)) {
        $errors['Name'] = "Invalid String";
    }

    # Email Validate 
    if (!validate($email, 1)) {
        $errors['Email'] = "Field Required";
    } elseif (!validate($email, 2)) {
        $errors['Email'] = "Invalid Email Format";
    }

    # Password Validate 
    if (!validate($password, 1)) {
        $errors['Password'] = "Field Required";
    } elseif (!validate($password, 4)) {
        $errors['Password'] = "Invalid Length , Length Must Be >= 6 ch";
    }


    # Phone Validation 
    if (!validate($phone, 1)) {
        $errors['phone'] = "Field Required";
    } elseif (!validate($phone, 7)) {
        $errors['phone'] = "Invalid Phone Number";
    }


    # Role Validation .... 
    if (!validate($role_id, 1)) {
        $errors['Role'] = "Field Required";
    } elseif (!validate($role_id, 5)) {
        $errors['Role'] = "Invalid Role";
    }

    # country Validation ... 
    if (!validate($country, 1)) {
        $errors['country'] = "Field Required";
    } elseif (!validate($country, 6)) {
        $errors['country'] = "Invalid String";
    }

    # government Validation ... 
    if (!validate($government, 1)) {
        $errors['government'] = "Field Required";
    } elseif (!validate($government, 6)) {
        $errors['government'] = "Invalid String";
    }

    # city Validation ... 
    if (!validate($city, 1)) {
        $errors['city'] = "Field Required";
    } elseif (!validate($city, 6)) {
        $errors['city'] = "Invalid String";
    }

    # extraData Validation ... 
    if (!validate($extraData, 1)) {
        $errors['extraData'] = "Field Required";
    } elseif (!validate($extraData, 6)) {
        $errors['extraData'] = "Invalid String";
    }




    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {

        // DB Code .... 
        $password = md5($password);
        $sql = "insert into user (u_name,u_email,u_pass,u_phone,u_role) values ('$name','$email','$password','$phone',$role_id)";
        $user_op  = mysqli_query($con, $sql);

        // echo mysqli_error($con);
        // exit;
        $user_id = mysqli_insert_id($con);



        if ($user_op) {

            $sql = "insert into address (country,gov,city,extraData,u_id) values ('$country','$government','$city','$extraData',$user_id)";
            $Address_op  = mysqli_query($con, $sql);

            if ($Address_op) {
                $message = ['User Inserted'];
            } else {
                $message = ['Error in address Try Again'];
            }
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

                <?php

                if (isset($_SESSION['Message'])) {
                    foreach ($_SESSION['Message'] as $key => $val) {

                        echo '* ' . $key . ' : ' . $val . '<br>';
                    }
                    unset($_SESSION['Message']);
                } else {  ?>

                    <li class="breadcrumb-item active">ADD NEW User</li>

                <?php   }   ?>




            </ol>




            <div class="container">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">



                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" name="name" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">New Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputPassword">Phone</label>
                        <input type="tel" class="form-control" name="phone" id="exampleInputPassword1" placeholder="Phone">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        <select class="form-control" name="role_id">

                            <?php
                            while ($data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $data['id']; ?>"> <?php echo $data['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName">Address</label>
                        <br>
                        <label for="exampleInputName">Country</label>
                        <input type="text" class="form-control" name="country" id="exampleInputName" aria-describedby="" placeholder="Enter Country">

                        <label for="exampleInputName">Government</label>
                        <input type="text" class="form-control" name="government" id="exampleInputName" aria-describedby="" placeholder="Enter Government">

                        <label for="exampleInputName">City</label>
                        <input type="text" class="form-control" name="city" id="exampleInputName" aria-describedby="" placeholder="Enter City">

                        <label for="exampleInputName">Extra Data</label>
                        <input type="text" class="form-control" name="extraData" id="exampleInputName" aria-describedby="" placeholder="Enter Extra Data">


                    </div>


                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>





        </div>
    </main>


    <?php

    require '../layouts/footer.php';

    ?>