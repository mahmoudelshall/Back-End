<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $book_id       = Clean($_POST['book_id']);
    $user_id    = Clean($_POST['user_id']);
    $numcopies     = Clean($_POST['numcopies']);
    $order_status  = Clean($_POST['order_status']);
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


    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {


        $sql = "select price from book where b_id= $book_id";
        $op  = mysqli_query($con, $sql);
        $pri = mysqli_fetch_assoc($op);


        // cla price
        $price = $numcopies * $pri['price'];

        $order_date  = strtotime(date("Y-m-d"));

        // DB Code .... 

        $sql = "insert into make_order (b_id,u_id,price,num_copies,order_date,order_status) values($book_id,$user_id,$price,$numcopies,'$order_date',$order_status)";
        $order_op  = mysqli_query($con, $sql);
        // echo mysqli_error($con);
        //exit;
        $order_id = mysqli_insert_id($con);



        if ($order_op) {

            $delivery_date  = strtotime(date("Y-m-d")) + (4 * 60 * 60 * 24);
            $sql = "insert into payment (delivery_date,o_id,payment_status) values('$delivery_date',$order_id,'$pay_status')";
            $order_op  = mysqli_query($con, $sql);

            if ($order_op) {
                $message = ['Order Inserted'];
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

                    <li class="breadcrumb-item active">Make New Order</li>

                <?php   }   ?>




            </ol>




            <div class="container">

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">




                    <div class="form-group">
                        <label for="exampleInputPassword">Book Name</label>
                        <select class="form-control" name="book_id">

                            <?php
                            # Select Roles ..... 
                            $sql = "select b_id,b_name from book order by b_id desc";
                            $op  = mysqli_query($con, $sql);

                            while ($data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $data['b_id']; ?>"> <?php echo $data['b_name']; ?></option>
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

                            while ($data = mysqli_fetch_assoc($op)) {
                            ?>
                                <option value="<?php echo $data['u_id']; ?>"> <?php echo $data['u_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail">Number of copies</label>
                        <input type="number" class="form-control" name="numcopies" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter num.copies">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Order Status</label>
                        <select class="form-control" name="order_status">
                            <option value="1">True</option>
                            <option value="0">false</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputPassword">Payment Status</label>
                        <select class="form-control" name="pay_status">
                            <option value="1">Done</option>
                            <option value="0">not paid</option>
                        </select>
                    </div>




            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>





</div>
</main>


<?php

require '../layouts/footer.php';

?>