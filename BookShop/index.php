<?php
require './helpers/dbConnection.php';
require './helpers/functions.php';
require './helpers/checkLogin.php';



require './layouts/header.php';
require './layouts/nav.php';
require './layouts/sidNav.php';

?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Database</li>
            </ol>
            <div class="row">

                <?php

                # Modules .... 

                $modules = ["Roles", "Users", "Order", "catigory", "books"];


                foreach ($modules as $key => $val) {

                ?>


                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body"> <?php echo $val; ?> </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="<?php echo  url($val)  ?>">View Data</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>


                <?php } ?>


            </div>


        </div>
    </main>


    <?php

    require './layouts/footer.php';

    ?>