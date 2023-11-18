<?php
session_start();
// Config
// اتصل بالداتا بيس
include "./inc/config_db.php";


if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   // hash
   $pass = MD5($_POST['password']);   
   $select = " SELECT * FROM volunteer WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $_SESSION['loggedin'] = true;
      $_SESSION['email'] = $email;
      header('location:v_homepage.php');
      exit;
      
     
   }else{
      $error[] = 'incorrect email or password!';
   }

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login | Volunteer</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="#">register now</a></p>
   </form>
</div>

</body>
</html>
<?php include "./inc/close_db.php"; ?>