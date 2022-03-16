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


    $sql = "select make_order.* ,user.u_id,user.u_name , book.b_id, book.b_name ,payment.delivery_date ,payment.payment_status from make_order
    inner join user  on user.u_id  = make_order.u_id inner join book on make_order.b_id = book.b_id 
    inner join payment  on make_order.o_id = payment.o_id where make_order.o_id = $id ";
    $op  = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($op);
    // echo mysqli_error($con);
    //exit;
}



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $book_id       = Clean($_POST['book_id']);
    $user_id    = Clean($_POST['user_id']);
    $numcopies     = Clean($_POST['numcopies']);
    $order_date     = Clean($_POST['order_date']);
    $order_status  = Clean($_POST['order_status']);
    $delivery_date   = Clean($_POST['delivery_date']);
    $pay_status   = Clean($_POST['pay_status']);

    $errors = [];

    # book_id Validation ...
    if (!validate($book_id, 1)) {
        $errors['book_id'] = "Field Required";
    } elseif (!validate($book_id, 5)) {

        $errors['book_id'] = "Invalid id";
    }
    # user_id Validation ...
    if (!validate($user_id, 1)) {
        $errors['user_id'] = "Field Required";
    } elseif (!validate($user_id, 5)) {

        $errors['user_id'] = "Invalid id";
    }

    # numcopies Validation ...
    if (!validate($numcopies, 1)) {
        $errors['numcopies'] = "Field Required";
    } elseif (!validate($numcopies, 5)) {

        $errors['numcopies'] = "Invalid id";
    }

    # order_date Validation ... 
    if (!validate($order_date, 1)) {
        $errors['order_date'] = "Field Required";
    } elseif (!validate($order_date, 9)) {
        $errors['order_date'] = "Invalid Date Format";
    }

    # order_status Validate 
    if ($order_status != 1) {
        if ($order_status != 0) {
            $errors['order_status'] = "Invalid order_status";
        }
    }
    # payment_status Validate 

    if ($pay_status != 1) {
        if ($pay_status != 0) {
            $errors['payment_status'] = "Invalid payment_status";
        }
    }


    # delivery_date Validation ... 
    if (!validate($delivery_date, 1)) {
        $errors['delivery_date'] = "Field Required";
    } elseif (!validate($delivery_date, 9)) {
        $errors['delivery_date'] = "Invalid Date Format";
    }



    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {


        $sql = "select price from book where b_id= $book_id";
        $op  = mysqli_query($con, $sql);
        $pri = mysqli_fetch_assoc($op);


        // cla price
        $price = $numcopies * $pri['price'];

        $order_date  = strtotime($order_date);
        $delivery_date  = strtotime($delivery_date);
        // DB Code .... 


        $sql = "update make_order set b_id = '$book_id' , u_id = '$user_id' , num_copies = $numcopies , order_date = $order_date ,
        order_status = $order_status,price = $price  where o_id = $id";

        $order_op  = mysqli_query($con, $sql);
        // echo mysqli_error($con);
        //exit;
        //  $order_id = mysqli_insert_id($con);



        if ($order_op) {

            $sql = "update payment set delivery_date = '$delivery_date', payment_status = $pay_status  where o_id = $id";



            $order_op  = mysqli_query($con, $sql);

            if ($order_op) {
                $message = ['Order Updated'];
            } else {
                $message = ['Error in payment Try Again'];
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

                <form action="edit.php?id=<?php echo $data['o_id']; ?>" method="post">

                    <div class="form-group">
                        <label for="exampleInputPassword">Book Name</label>
                        <select class="form-control" name="book_id">

                            <?php
                            # Select Roles ..... 
                            $sql = "select b_id,b_name from book order by b_id desc";
                            $op  = mysqli_query($con, $sql);

                            while ($role_data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $role_data['b_id']; ?>" <?php if ($role_data['b_id'] == $data['b_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                    <?php echo $role_data['b_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">User Name</label>
                        <select class="form-control" name="user_id">

                            <?php

                            # Select Roles ..... 
                            $sql = "select u_id,u_name from user order by u_id desc";
                            $op  = mysqli_query($con, $sql);

                            while ($role_data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $role_data['u_id']; ?>" <?php if ($role_data['u_id'] == $data['u_id']) {
                                                                                        echo 'selected';
                                                                                    } ?>>
                                    <?php echo $role_data['u_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Number of copies</label>
                        <input type="number" class="form-control" name="numcopies" value="<?php echo $data['num_copies']; ?>" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter num.copies">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Order Date</label>
                        <input type="date" class="form-control" name="order_date" value="<?php echo date('Y-m-d', $data['order_date']); ?>" id="exampleInputPassword1" placeholder="Enter Order Date">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Delivery Date</label>
                        <input type="date" class="form-control" name="delivery_date" value="<?php echo date('Y-m-d', $data['delivery_date']); ?>" id="exampleInputPassword1" placeholder="Enter Delivery Date">
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword">Order Status</label>
                        <select class="form-control" name="order_status">
                            <option value="1" <?php if ($data['order_status']) {
                                                    echo 'selected';
                                                } ?>>True</option>
                            <option value="0" <?php if (!$data['order_status']) {
                                                    echo 'selected';
                                                } ?>>false</option>


                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputPassword">Payment Status</label>
                        <select class="form-control" name="pay_status">
                            <option value="1" <?php if ($data['payment_status']) {
                                                    echo 'selected';
                                                } ?>>Done</option>
                            <option value="0" <?php if (!$data['payment_status']) {
                                                    echo 'selected';
                                                } ?>>not paid</option>
                        </select>
                    </div>



                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>



        </div>
    </main>


    <?php

    require '../layouts/footer.php';

    ?>