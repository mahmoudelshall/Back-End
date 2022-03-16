<?php


function  Clean($input)
{

    $value = trim($input);
    $value = htmlspecialchars($value);
    $value = stripcslashes($value);
    return $value;
}



function validate($input, $flag, $length = 6)
{

    $status = true;

    switch ($flag) {
        case 1:
            # code...
            if (empty($input)) {
                $status = false;
            }
            break;

        case 2:
            if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
                $status = false;
            }
            break;

        case 3:
            if (!filter_var($input, FILTER_VALIDATE_URL)) {
                $status = false;
            }
            break;

        case 4:
            if (strlen($input) < $length) {
                $status = false;
            }
            break;

        case 5:
            if (!filter_var($input, FILTER_VALIDATE_INT)) {
                $status = false;
            }
            break;

        case 6:

            if (!preg_match('/^[a-zA-Z\s]*$/', $input)) {
                $status = false;
            }
            break;



        case 7:
            if (!preg_match('/^01[0-2,5][0-9]{8}$/', $input)) {
                $status = false;
            }
            break;


        case 8:
            $allowed_ex = ["png", "jpg"];
            if (!in_array($input, $allowed_ex)) {
                $status = false;
            }
            break;

        case 9:
            if (!preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/', $input)) {
                $status = false;
            }

            break;
    }

    return $status;
}




function printMessage($txt)
{

    if (isset($_SESSION['Message'])) {
        foreach ($_SESSION['Message'] as $key => $val) {

            if ($key !== 0) {
                echo '* ' . $key . ' : ' . $val . '<br>';
            } else {
                echo '* ' . $val . '<br>';
            }
        }
        unset($_SESSION['Message']);
    } else {
        echo $txt;
    }
}



function url($url)
{

    return "http://" . $_SERVER['HTTP_HOST'] . "/BookShop/" . $url;
}
