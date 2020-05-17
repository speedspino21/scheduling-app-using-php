<?php require_once('models/initialization.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">
    <title>Office Hours Sign Up</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php 
                $dateComponents = getdate();

                if(isset($_GET['month']) && isset($_GET['year'])){
                    $month = htmlentities($_GET['month']);
                    $year = htmlentities($_GET['year']);
                }else{
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];   
                }
                echo find_calendar($month, $year);
                ?>
            </div>
        </div>
    </div>
</body>
</html>