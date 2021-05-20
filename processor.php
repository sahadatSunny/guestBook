<?php 

session_start();

include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');

use App\guest\Guest;
use App\utility\Sanitizer;
use App\utility\Validator;
use App\utility\Utility;



$guests = [];

    if(array_key_exists('guestData', $_COOKIE)){
        $guests = unserialize($_COOKIE['guestData']);
    }


    if(isset($_POST['submit']) && Utility::postCheck()){

        $sanitizedData = Sanitizer::sanitize($_POST);
        if($sanitizedData){
            $validatedData = Validator::validate($sanitizedData);
        }else{
            header('location: index.php');
            die();
        }

        if($validatedData){
            $userGivenData = $validatedData;
        }else{
            header('location: index.php');
            die();
        }

        // $validatedData = Validator::validate($sanitizedData);
        // $userGivenData = $validatedData;
        $guests[] = $userGivenData;
        setcookie("guestData", serialize($guests), time() + 86000);
        header("location: index.php");

        $_SESSION['message'] = "New Guest Added successfully";
        $_SESSION['msg-type'] = "success";



    }

                


?>
