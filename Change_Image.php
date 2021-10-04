<?php
  error_reporting(0);
  $fileError=$success="";
  $email=$_SESSION['sid'];
  if(isset($_POST["submit"])){
      $tmp=$_FILES['image']['tmp_name'];
      $fn=$_FILES['image']['name'];
      $ext=pathinfo($fn,PATHINFO_EXTENSION);
      if(empty($tmp))
      {
          $fileError="*Image required";
      }
      if($ext=="jpg" || $ext=="png" || $ext=="jpeg"){
        $fname= "attach-" . rand() . "-" . time() . "." .$ext;
        $fo=fopen("users/$email/details.txt","r");
        $fn2=fopen("users/$email/details1.txt","a+");
        
        $i=1;
        while($i!=5){
            fwrite($fn2,fgets($fo));
            $i++;
        }
        $old_img=input_field(fgets($fo));
        if(move_uploaded_file($tmp,"users/$email/$fname")){
            fwrite($fn2,$fname."\n");
        }
        else{
          $fileError="File upload error";
        }
        
        fclose($fo);
        fclose($fn2);
        unlink("users/$email/$old_img");
        unlink("users/$email/details.txt");
        rename("users/$email/details1.txt","users/$email/details.txt");
        $success="Image Changed Successfully!";
      }
      else{
          $fileError="*Only jpg, png and jpeg supported";
      }
     
  }//isset close

  function input_field($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Change Image </title>
  </head>
  <body>

<h1 class="  text-dark">Change Image</h1>


<div class="">
<?php
if(!empty($fileError)){
    ?>
    <div class="alert alert-danger"><?php echo $fileError; ?></div>

 <?php   
}
?>
</div>
<form method="post" enctype="multipart/form-data"> 

<!-- <div class="form-group">
    <label for="image" class="font-weight-bold"> Image</label>
    <input type="file" class="form-control-file" name="image">
  </div> -->

  <div class="form-outline mb-4">
    <input type="file" id="image" class="form-control form-control-lg" name="image"/>
    <label class="form-label" for="image">Image</label>
                         
  </div>

  <button type="submit" class="btn btn-primary" name="submit">Change Image</button>
  
  <div class="">
<?php
if(!empty($success)){
    ?>
    <div class="text-success"><?php echo $success; ?></div>
 <?php  
}
?>
  </div>
   
    
  </body>
</html>