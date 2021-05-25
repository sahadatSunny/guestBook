<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/processor.php');






$guestEdit = null; // to keep edit text filed empty before clicking edit button

//

$update = false;  // if it is not true form data will go to processor.php if it is it will go to update.php

if(isset($_GET['position'])){  //to check edit button has been pressed or not and passing array key on $position

    $position = $_GET['position'];

    $guests = unserialize($_COOKIE['guestData']);

    if(array_key_exists($position, $guests)){

        $guestEdit = $guests[$position];
        $update = true;

    }else{
        header("location: index.php");
        $_SESSION['message'] = "Invalid Recuest !";
        $_SESSION['msg-type'] = "warning";
    }
}



//section to store data on cookie

$userData = [];


if(array_key_exists('guestData', $_COOKIE)){
        $userData = unserialize($_COOKIE['guestData']);

}

if(empty($userData)){
    $_SESSION['message'] = "List is empty now please add a guest from below"; // msg if there cooke has not been sat yet
    $_SESSION['msg-type'] = "info";
}





// foreach ($userData as $key => $data){

//     echo "ID: " . $key ." NAME: " . $data['name'] . " COMMENT: ". $data['comment'] ; 
// }



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
       
        <style>
          
            a {

                margin-left: 5px;
            }
        
        </style>

    <title>Guest Book</title>
</head>
<body>

    <?php if (isset($_SESSION['message'])): ?>


            <div class="alert alert-<?=$_SESSION['msg-type']?>" role="alert">

                <?php
                echo $_SESSION['message']."<strong><a style='float: right;text-decoration: none; color: #000;' href='index.php'>&times; close </a></strong>";
                unset($_SESSION['message']);
                ?>

            </div>

    <?php endif ?>

<div class="row">
 

        <div class="col">

            <?php if($update == false){ ?>
            <h1 class="text-center mb-6">Create New Guest</h1><hr>
            <?php }else{ ?>
            <h1 class="text-center mb-6">Editing guest no. <?=$position?>.</h1><hr>
            <?php } ?>
                <div class="row">
                    <div class="col-sm-5 offset-3">



                                <?php if($update == true){?> 

                                    <form method="post"  action="update.php?guestPosition=<?=$position; ?>">

                                <?php }else{ ?>

                                    <form method="post" action="processor.php">
                                    
                                <?php } ?>



                        
                            <div class="row mb-3">
                                <label for="name" class="col-sm-6 form-label">Full Name:</label>
                                <div class="col-sm-12">
                                    <input
                                            type="text"
                                            class="form-control"
                                            id="name"
                                            name="name"
                                            value="<?= $guestEdit['name']?>"
                                            placeholder="Please type your name">
                                </div>
                                
                                
                                  <?php if(isset($_SESSION['nameError'])) { ?>

                                        <div class="alert alert-<?= $_SESSION['errorMsgType']?>">
                                            <span >
                                            <?php 
                                            
                                            echo $_SESSION['nameError'];
                                            unset($_SESSION['nameError']);

                                            ?>
                                            </span>
                                            
                                        </div>

                                    <?php } ?>

                            </div>
                            <div class="row mb-3">
                                <label for="comment" class="col-sm-3 col-form-label">Comment</label>
                                <div class="col-sm-12">
                                  
                                    <textarea class="form-control" id="coment" name="comment" rows="3"><?=$guestEdit['comment']?></textarea>

                                    <?php if(isset($_SESSION['commentError'])) { ?>

                                        <div class="alert alert-<?= $_SESSION['errorMsgType']?>">
                                            <span >
                                            <?php 
                                            
                                            echo $_SESSION['commentError'];
                                            unset($_SESSION['commentError']);

                                            ?>
                                            </span>
                                            
                                        </div>

                                    <?php } ?>

                                </div>
                            </div>
                            <div class="mb-3">
                                
                                <?php if($update == true){?>

                                    <a class="btn btn-outline-primary" href="index.php">Create New</a>
                                    <button  style="float: right;" type="submit" name="submit" class="btn btn-primary mt-auto p-2">Update</button>

                                <?php }else{ ?>
                                    <button  style="float: right;" type="submit" name="submit" class="btn btn-primary mt-auto p-2">Create</button>

                                <?php } ?>

                            </div>

                        </form>

                        <?php 

                            if(!empty($userData)){
                                ?> <a class="btn btn-primary" href="pdfReview.php">Download PDF</a>
                            
                        
                       <?php } ?>

                    </div>
                </div>







            <!-- <h1>Creat new guest</h1>
            <form action="processor.php" method="POST">
            <input type="text" name="name" id="name" value="" placeholder="please type your name correctly">
            <input type="text" name="comment" id="comment" value="" placeholder="What do you thinking now please discribe to us ?">
            <button type="submit" name="submit">Submit</button>
            
            </form> -->



        </div>

    

    <div class="col">
   
       
            <h1 class="text-center mb-6">Guest list</h1>
            <hr>
                <table class="table" style="width: 600px; margin: auto">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th style="padding-left: 50px;">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($userData as $key => $data){ ?>

                        <tr>
                        <th scope="row"><?= $key ?></th>
                        <td><?= $data['name'] ?> </td>
                        <td><a title="See more" style="" class="btn btn-info" href="show.php?position=<?=$key?>">&#8594;</a> <a class="btn btn-outline-warning" href="index.php?position=<?=$key?>">Edit</a>  <a class="btn btn-outline-danger" href="delet.php?position=<?=$key?>">Delet</a></td>
                        </tr>

                <?php
                } ?>
                
                </tbody>
                </table>

        
        <!-- table section ends here -->

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>