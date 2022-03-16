<?php 
   
      session_start();
      session_destroy();


      require './helpers/functions.php';

      header("Location: ".url('login.php'));




?>