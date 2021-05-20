<?php 
include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');

use App\guest\Guest;

// $userData = unserialize($_COOKIE['testCookie']);

// $gbt = new Guest($userData);

// echo $gbt->name;?> <br><?php
// echo $gbt->comment;



$userDataNew = unserialize($_COOKIE['guestData']);

$gbtNew = new Guest($userDataNew);

echo $gbtNew->name;?> <br><?php
echo $gbtNew->comment;?> <br><pre><?php

Print_r($userDataNew);

?>
</pre>
<?php 
