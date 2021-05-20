<?php 

namespace App\utility;

class Sanitizer{

    public static function sanitizeTest($data){

        $sanitized = $data;
        return $sanitized;
    }









    public static function sanitize($data){


        $userData = []; //stored $_POST

        $userData = $data;

        if(array_key_exists('name', $userData)){
            $guestName = $userData['name'];

            if(empty($guestName)){
                $_SESSION['nameError'] = "Name can't be empty";
                $_SESSION['errorMsgType'] = "danger";
            }
        }

        if(array_key_exists('comment', $userData)){
            $guestComment = $userData['comment'];

            if(empty($guestComment)){
                $_SESSION['commentError'] = "Comment can't be empty";
                $_SESSION['errorMsgType'] = "danger";
            }
        }

        
        if(empty($userData['name']) || empty($userData['comment'])){
            return false;
        }else{
            return $userData;
        }
        
    }
}