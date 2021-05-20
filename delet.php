<?php 
session_start();
include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');

use App\utility\Utility;

$guestPosition = $_GET['position'];

$guests = unserialize($_COOKIE['guestData']);


if(array_key_exists($guestPosition, $guests)){
     
        unset($guests[$guestPosition]);
        setcookie("guestData", serialize($guests), time() + 86000);

        header("location: index.php");
        
        $_SESSION['message'] = "Guest has been deleted successfully";
        $_SESSION['msg-type'] = "danger";
        
}else{

        header("location: index.php");
        
        $_SESSION['message'] = "Invalid request (errror)";
        $_SESSION['msg-type'] = "warning";    
}


// unset($indGuest);

//     setcookie("guestData", serialize($guests), time() + 86000);

// header("location: index.php");

// $_SESSION['message'] = "Guest has been deleted successfully";
// $_SESSION['msg-type'] = "danger";


?>

