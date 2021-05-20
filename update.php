<?php 

session_start();

include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');

use App\guest\Guest;
use App\utility\Sanitizer;
use App\utility\Validator;
use App\utility\Utility;

$position = $_GET['guestPosition'];

$guests = [];

    if(array_key_exists('guestData', $_COOKIE)){
        $guests = unserialize($_COOKIE['guestData']);
    }

    if(!array_key_exists($position, $guests)){

        header("location: index.php");
        $_SESSION['message'] = "Invalid Recuest !";
        $_SESSION['msg-type'] = "warning";
    
    }
       

    if(Utility::postCheck()){

        $sanitizedData = Sanitizer::sanitize($_POST);
        if($sanitizedData){
            $validatedData = Validator::validate($sanitizedData);
        }else{
            header('location: index.php?position='.$position);
            die;
        }

        if($validatedData){
            $userGivenData = $validatedData;
        }else{
            header('location: index.php?position='.$position);
            die;
        }
        
        $guests[$position] = $userGivenData;

        setcookie("guestData", serialize($guests), time() + 86000);
        header("location: index.php");

        $_SESSION['message'] = "Guest updated successfully";
        $_SESSION['msg-type'] = "secondary";

    }else{

        $_SESSION['message'] = "Error guest could not update";
        $_SESSION['msg-type'] = "warning";

    }

          

?>
