<?php

namespace App\utility;

class Utility{

  public static  function postCheck(){
      if(strtolower($_SERVER['REQUEST_METHOD']) == 'post'){
          return true;
      }
      return false;
  }
  
}

