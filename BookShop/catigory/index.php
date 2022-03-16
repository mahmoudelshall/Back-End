<?php
# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';

$sql = "select * from book_type ";
$op  = mysqli_query($con, $sql);


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
                    $text = "Display Roles";
                    printMessage($text);
                    ?>



                </li>



            </ol>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table mr-1"></i>
                    List Categories
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>book_type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>book_type</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>


                                <?php

                                while ($data = mysqli_fetch_assoc($op)) {

                                ?>
                                    <tr>
                                        <td><?php echo $data['t_id']; ?></td>
                                        <td><?php echo $data['t_name'] ?></td>
                                        <td>
                                            <a href='delete.php?id=<?php echo $data['t_id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit.php?id=<?php echo $data['t_id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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