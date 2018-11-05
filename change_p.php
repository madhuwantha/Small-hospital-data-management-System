 <?php require_once('inc\connection.php'); ?>


<?php 

if (isset($_GET['pass'])) {
$username = ($_GET['user']);
$password = ($_GET['pass']);

if (isset($_POST['submit'])) {

$p_pass       = trim(mysqli_real_escape_string($connection,($_POST["p_pass"])    ))  ;
$new_pass     = trim(mysqli_real_escape_string($connection,($_POST["new_pass"])    ))  ;
$conform_pa   = trim(mysqli_real_escape_string($connection,($_POST["conform_pass"])    )) ;

if ($p_pass == $password) {
  if ($new_pass==$conform_pa) {


  $query = "UPDATE `users` SET `password`='{$conform_pa}' WHERE `password` = '{$password}' LIMIT 1 ";
  $result = mysqli_query($connection,$query);
      if (!($result)) {
        header('Location:t_index_query.php?error');
      }else{
        header('Location:logout.php');
      }
  }
}
}
}

 ?>
  


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>change Pass Word</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="CSS/change_p.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="asset/css/plugins/icheck/skins/flat/aero.css"/>
  <link href="asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->

  <link rel="shortcut icon" href="asset/img/logomi.png">
    </head>

    <body id="mimin" style="background: white;">

      <div class="container" >
 <div class="form-signin">
       
          <div style="background: #9A9A9A;" ?>>
          <b style="font-size: 30px;">Change Password</b>
          <hr>
              <div class="panel-body text-center">
              <form accept-charset="utf-8"  method="post" action ="change_p.php?user=<?php echo $username?>&&pass=<?php echo $password?>"  enctype="multipart/form-data" >

              <div class="la">
                <label class="labels ">Current Password : </label>      <br>
                <label class="labels ">New Password: </label> <br>
                <label class="labels ">Confirm Password :</label> <br>
              </div>
              <div class="d">                 
                <div class="inputs"> <input type="password" name="p_pass"> </div>
                <div class="inputs"> <input type="password" name="new_pass"> </div>
                <div class="inputs"> <input type="password" name="conform_pass"> </div>
              </div>

              
                <input class="btn" type="submit" name="submit" value="Change">
              </form>
              <a class="aa"  href="t_index_query.php"><button style="position: absolute;margin-bottom: 20px;" class="Cancel btn ">Cancel</button></a>
          </div>
  </div>  

      </div>

      <!-- end: Content -->
      <!-- start: Javascript -->
      <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="asset/js/jquery.min.js"></script>
      <script src="asset/js/jquery.ui.min.js"></script>
      <script src="asset/js/bootstrap.min.js"></script>

      <script src="asset/js/plugins/moment.min.js"></script>
      <script src="asset/js/plugins/icheck.min.js"></script>

      <!-- custom -->
      <script src="asset/js/main.js"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>