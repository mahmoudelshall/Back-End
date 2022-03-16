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


    $sql = "select user.* , roles.title , address.country ,address.gov , address.city ,address.extraData from user
inner join roles  on user.u_role  = roles.id inner join address on user.u_id = address.u_id where user.u_id = $id";
    $op  = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($op);
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name        = Clean($_POST['name']);
    $email       = Clean($_POST['email']);
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

        # Db Operation ..... 

        $sql = "update address set country = '$country' , gov = '$government', city = '$city' , extraData = '$extraData'  where u_id = $id ";
        $op  = mysqli_query($con, $sql);

        if ($op) {
            $sql = "update user set  u_name = '$name' , u_email = '$email' , u_role = $role_id , u_phone = '$phone'   where u_id = $id ";
            $op  = mysqli_query($con, $sql);
            if ($op) {
                $message = ['Raw Updated'];
            } else {
                $message = ['Error Try Again'];
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

                <li class="breadcrumb-item active">
                    <?php
                    $text = "Update ROLE";
                    printMessage($text);
                    ?>
                </li>




            </ol>




            <div class="container">

                <form action="edit.php?id=<?php echo $data['u_id']; ?>" method="post">


                    <div class="form-group">
                        <label for="exampleInputName">Name</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $data['u_name']; ?>" id="exampleInputName" aria-describedby="" placeholder="Enter Name">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail">Email address</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $data['u_email']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Phone</label>
                        <input type="tel" class="form-control" name="phone" value="<?php echo $data['u_phone']; ?>" id="exampleInputPassword1" placeholder="Phone">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Role</label>
                        <select class="form-control" name="role_id">

                            <?php
                            # Select Roles ..... 
                            $sql = "select * from roles order by id desc";
                            $op  = mysqli_query($con, $sql);
                            while ($role_data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $role_data['id']; ?>" <?php if ($role_data['id'] == $data['u_role']) {
                                                                                    echo 'selected';
                                                                                } ?>> <?php echo $role_data['title']; ?></option>
                            <?php } ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="exampleInputName">Address</label>
                        <br>
                        <label for="exampleInputName">Country</label>
                        <input type="text" class="form-control" name="country" value="<?php echo $data['country']; ?>" id="exampleInputName" aria-describedby="" placeholder="Enter Country">

                        <label for="exampleInputName">Government</label>
                        <input type="text" class="form-control" name="government" value="<?php echo $data['gov']; ?>" id="exampleInputName" aria-describedby="" placeholder="Enter Government">

                        <label for="exampleInputName">City</label>
                        <input type="text" class="form-control" name="city" value="<?php echo $data['city']; ?>" id="exampleInputName" aria-describedby="" placeholder="Enter City">

                        <label for="exampleInputName">Extra Data</label>
                        <input type="text" class="form-control" name="extraData" value="<?php echo $data['extraData']; ?>" id="exampleInputName" aria-describedby="" placeholder="Enter Extra Data">


                    </div>


                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>





        </div>
    </main>


    <?php

    require '../layouts/footer.php';

    ?>