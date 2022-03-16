<?php

if ($_SESSION['user']['u_role'] != 1) {

    header("Location: " . url('login.php'));
}
