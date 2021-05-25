<?php

include_once($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');

$guests = [];

if(array_key_exists('guestData', $_COOKIE)){

    $guests = unserialize($_COOKIE['guestData']);
}else{
    header('location: index.php');
}

if(empty($guests)){

    header('location: index.php');

}




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>pdf Review</title>
</head>
<body>

    <div class="container">

        <h1 class="text-center">Review PDF before downloading</h1>

        <table class="table table-content">

            <thead>
               <tr>
                    <th>ID:</td>
                    <td>NAME:</td>
                    <td>COMMENT:</td>
                </tr>
            </thead>
            <tbody>
                     <?php foreach($guests as $key => $data){ ?>

                        <tr>
                            <div class="td-item"><td><?= $key; ?> </td></div>
                            <div class="td-item"><td><?= $data["name"]; ?> </td></div>
                            <div class="td-item"><td><?= $data["comment"]; ?> </td></div>
                        </tr>


                    <?php } ?>

                    

            </tbody>

        </table>    

            <div class="row">
                <div class="col"> <a href="index.php" class="btn btn-warning">Update list</a> </div>
                <div class="float-right"> <a href="pdf.php" class="btn btn-success">Download PDF</a> </div>

            </div>

            




            
                        



    </div>

</body>
</html>