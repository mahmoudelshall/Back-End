<?php

if (!isset($_SESSION['user'])) {
    header("Location: ." . url('CustomerSide/login.php'));
}
