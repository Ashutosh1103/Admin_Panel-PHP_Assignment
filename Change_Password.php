<?php

error_reporting(0);

// input fields
$email=$_SESSION['sid'];
$pass=$_SESSION['spass'];


$con_password = input_field($_POST["con_password"]);
$password = input_field($_POST["password"]);
$old_password = input_field($_POST["old_password"]);

$con_passwordErr = $old_passwordErr= $passwordErr = "";

// validation
if (isset($_POST["sub"])) {
    // confirm password validation 
    if (empty($con_password)) {
        $con_passwordErr = "Password is required.";
    } else if (!($con_password === $password)) {
        $con_passwordErr = "Password does not match";
    }

    // password validation 
    if (empty($password)) {
        $passwordErr = "Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $password)) {
        $passwordErr = "Length of password should be between 4, 16 characters.";
    }

     // old password validation 
     if (empty($old_password)) {
        $old_passwordErr = "Password is required.";
    } else if (!preg_match("/^[a-zA-Z0-9]{3,16}+$/", $old_password)) {
        $old_passwordErr = "Length of password should be between 4, 16 characters.";
    }

    if ($con_passwordErr === "" && $passwordErr  === "" && $old_passwordErr === "" ) 
    {
        if($old_password == $password){
            $passwordErr = "New Passworrd cannot be old password.";
        }
        elseif($old_password != $pass){
           $old_passwordErr = "Old Password does not match";
        }
        elseif($password != $con_password){
            $con_passwordErr = "Password does not match";
        }
        else{
              $fo=fopen("users/$email/details.txt","r");
              $fn=fopen("users/$email/details1.txt","a+");
             
              fwrite($fn,$password."\n");
              fgets($fo);
          
              while(!feof($fo)){
                fwrite($fn,fgets($fo)); 
              }
              fclose($fo);
              fclose($fn);
            
              unlink("users/$email/details.txt");
              rename("users/$email/details1.txt","users/$email/details.txt");
              $error="Password changed successfully";
              header("location:index.php");
        }
    }

}

// trim function 
function input_field($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <h1 class="text-dark">Change Password</h1>

    <!-- <?php
    error_reporting(0);
        
        $email=$sid;
         $fo=fopen("users/".$email,"r");
        $fo2=fopen("users/".$email."/details.txt","r");
        
       
       
        $old_password=fgets($fo2);
        echo  "<h3 class='text-dark'>Old Password: $old_password<h3>";  

    ?> -->
    <form method="POST">

                        <div class="form-outline mb-4">
                          <input type="password" id="old_password" class="form-control form-control-lg" name="old_password"/>
                          <label class="form-label text-dark" for="old_password">Old Password:</label>
                          <small id="err" class="form-text text-danger"><?php echo $old_passwordErr; ?></small>
                        </div>


                        <div class="form-outline mb-4">
                          <input type="password" id="password" class="form-control form-control-lg" name="password"/>
                          <label class="form-label text-dark" for="password">New Password:</label>
                          <small id="err" class="form-text text-danger"><?php echo $passwordErr; ?></small>
                        </div>

                        <div class="form-outline mb-4">
                          <input type="password" id="con_password" class="form-control form-control-lg" name="con_password"/>
                          <label class="form-label text-dark" for="con_password">Confirm Password:</label>
                          <small id="err" class="form-text text-danger"><?php echo $con_passwordErr; ?></small>
                        </div>

                        <div class="d-flex justify-content-center">
                          <input type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" value="SUBMIT" name="sub"></input>
                          
                        </div>
    </form>
   
</body>
</html>