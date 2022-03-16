<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';

$sql = "select make_order.* ,user.u_name , book.b_name ,payment.delivery_date from make_order inner join user  on
 user.u_id  = make_order.u_id inner join book on make_order.b_id = book.b_id 
 inner join payment  on make_order.o_id = payment.o_id";

$op  = mysqli_query($con, $sql);

// echo mysqli_error($con);
// exit;


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
                    $text = "Display Order";
                    printMessage($text);
                    ?>
                </li>


            </ol>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    List Roles
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Book Name </th>
                                    <th>Number copies</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Delivery Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>User Name</th>
                                    <th>Book Name </th>
                                    <th>Num.copies</th>
                                    <th>Price</th>
                                    <th>Order Date</th>
                                    <th>Order Status</th>
                                    <th>Delivery Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>


                                <?php

                                while ($data = mysqli_fetch_assoc($op)) {

                                ?>
                                    <tr>
                                        <td><?php echo $data['o_id']; ?></td>
                                        <td><?php echo $data['u_name'] ?></td>
                                        <td><?php echo $data['b_name'] ?></td>
                                        <td><?php echo $data['num_copies'] ?></td>
                                        <td><?php echo $data['price'] ?>$</td>
                                        <td><?php echo date('Y/M/d', $data['order_date']); ?></td>
                                        <td><?php
                                            if ($data['order_status']) {
                                                echo "True";
                                            } else {
                                                echo "false";
                                            }
                                            ?></td>
                                        <td><?php echo date('Y/M/d', $data['delivery_date']); ?></td>
                                        <td>
                                            <a href='delete.php?id=<?php echo $data['o_id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <br>
                                            <br>
                                            <a href='edit.php?id=<?php echo $data['o_id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <?php

    require '../layouts/footer.php';

    ?>