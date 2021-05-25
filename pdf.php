<?php 

include_once ($_SERVER['DOCUMENT_ROOT'].'/guestBook/config.php');



$guests = [];



if(array_key_exists('guestData', $_COOKIE)){
    $guests = unserialize($_COOKIE['guestData']);
} 

if(empty($guests)){
   
    header('location: index.php');

}


ob_start();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Review</title>

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
</head>
<body>

    <div class="container">

    <h1 class="text-center text-center">Guest List</h1>
        <table class="table-content">
        
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Comment</th>
                    <!-- <th>TIME OF POSTING</th> -->
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

                   
     </div>  



</body>
</html>



<?php 

$body = ob_get_clean();

$pdfMaker = new \Mpdf\Mpdf();

// $stylesheet = file_get_contents('style.css');
// $pdfMaker->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

$pdfMaker->writeHTML($body);

$pdfMaker->Output();
