<?php 

namespace App\utility;


class Validator{

        public static function validateTest($data){

                $validated = $data;
                return $validated;
        }


        
        public static function validate($data){

                $regex = "/^[a-zA-Z\s]+$/";

                $userData = [];

                $userData = $data;

                // if(ctype_alpha($userData['name']) && ctype_alpha($userData['comment']))

                if(preg_match($regex,$userData['name']) && preg_match($regex,$userData['comment'])){
                       
                        $userReturn = $userData;

                }else{
                        $_SESSION['nameError'] = "<span style='color: red;'>Warning:</span> Use only alphabet";
                        $_SESSION['commentError'] = "Use only alphabet on comment filed can't even use space only for now";
                        $_SESSION['errorMsgType'] = "warning";
                        return false;
                }

                if(strlen($userReturn['name'])>30){
                        $_SESSION['nameError'] = "Name can't be longer then 30 characters";
                        $_SESSION['errorMsgType'] = "warning";
                        return false;
                }else{
                        return $userReturn;
                }
        }

}
