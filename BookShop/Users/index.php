<?php

# Logic 
require '../helpers/dbConnection.php';
require '../helpers/functions.php';
require '../helpers/checkLogin.php';
require '../helpers/checkadmin.php';



$sql = "select user.* , roles.title , address.country ,address.gov , address.city ,address.extraData from user
  inner join roles  on user.u_role  = roles.id inner join address on user.u_id = address.u_id";

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
                    $text = "Display Users";
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Role</th>

                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>


                                <?php

                                while ($data = mysqli_fetch_assoc($op)) {

                                ?>
                                    <tr>
                                        <td><?php echo $data['u_id']; ?></td>
                                        <td><?php echo $data['u_name'] ?></td>
                                        <td><?php echo $data['u_email'] ?></td>
                                        <td><?php echo $data['u_phone'] ?></td>
                                        <td>
                                            <?php echo $data['country'] . " - " . $data['gov'] . " - " . $data['city'] . " - " . $data['extraData'] ?>
                                        </td>
                                        <td><?php echo $data['title'] ?></td>


                                        <td>
                                            <a href='delete.php?id=<?php echo $data['u_id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                                            <a href='edit.php?id=<?php echo $data['u_id']; ?>' class='btn btn-primary m-r-1em'>Edit</a>
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