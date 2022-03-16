<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';


$sql = "select * from roles order by id desc";
$op  = mysqli_query($con, $sql);




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
                    $text = "Display Roles";
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
                                    <th>Role Title</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Role Title</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>


                                <?php

                                while ($data = mysqli_fetch_assoc($op)) {

                                ?>
                                    <tr>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['title'] ?></td>
                                        <td>
                                            <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit.php?id=<?php echo $data['id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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