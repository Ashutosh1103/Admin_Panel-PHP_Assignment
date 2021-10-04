<?php
session_start();
$sid=$_SESSION['sid'];
if(empty($sid)){
  header("location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
    
<?php include('Nav.php'); ?>

<!-- Sidebar & Contentarea-->
<div class="row container">
  <div class="col-4 ">
  <?php include('Sidebar.php'); ?>

  </div>


  <div class="col-8 bg-white text-white w-100  h-100">
    <?php
    switch(@$_GET['con']){
      case 'images' : include('Image.php');
      break;

      case 'change_image' : include('Change_Image.php');
      break;

      case 'name' : include('Name.php');
      break;

      case 'age' : include('Age.php');
      break;
      
      case 'gender' : include('Gender.php');
      break;
      
      case 'changepass' : include('Change_Password.php');
      break;
      
    }
    

    
    ?>

   

  </div>
</div>
<?php
include('Footer.php');
?>
</body>
</html>