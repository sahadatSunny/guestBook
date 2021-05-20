<?php 

namespace App\guest;

class Guest{

    public $name = null;
    public $comment= null;

    public function __construct($userData)
    
    {
        if(array_key_exists('name', $userData)){
           $this->name = $userData['name'];
        }
        
        if(array_key_exists('comment',$userData)){
           $this->comment = $userData['comment']; 
        }

    }

    public function getName(){
        echo "the name is ". $this->name;
    }


}

