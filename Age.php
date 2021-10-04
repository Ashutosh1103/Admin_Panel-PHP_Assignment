<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <h1 class="text-dark">Age:</h1>

    <?php
    error_reporting(0);
        
        $email=$sid;
        $fo=fopen("users/".$email,"r");
        $fo2=fopen("users/".$email."/details.txt","r");
        fgets($fo2);
        fgets($fo2);
       
        $image=fgets($fo2);
        echo  "<h1 class='text-dark'>$image<h1>";  

    ?>
   
</body>
</html>