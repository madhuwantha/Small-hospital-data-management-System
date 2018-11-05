<?php session_start(); ?>
<?php require_once('inc\connection.php');?>
<?php require_once('inc\function.php');?>
<?php if (!isset($_SESSION['first_name'])) {
  header('Location:login.php');
} ?>

<?php
if (isset($_SESSION['userName'])) {
$username = ($_SESSION['userName']);
$name = ($_SESSION['first_name']);
$password = ($_SESSION['password']);
}



$errors = array();
$Fname = $Lname = $gender= $nic= $teNo= $DoB= $age= $title  =  $notes= $temp_image=" ";  

if(isset($_POST['submit'])){


  $title =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["title"])    ))  ;
  $Fname =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["firstName"])))  ;
  $Lname =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["lastName"]) ))  ;
  $nic   =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["nic"])      ))  ;
  $teNo  =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["telNo"])    ))  ;
  $DoB   =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["dob"])      ))  ;
  $notes =  /*test_input*/mysqli_real_escape_string($connection,($_POST["notes"])    ) ;
  $temp_image = $_FILES['image']['tmp_name']                                           ;



 if (!empty($temp_image)) {
  $img   = addslashes(file_get_contents($temp_image));
 }

  


  //check phone number already exists
  $query_check_phone_number = "SELECT * FROM `patient` WHERE  `telNo` = '{$teNo}' LIMIT 1 ";
  $result_check_phone_number = mysqli_query($connection,$query_check_phone_number);
  if ($result_check_phone_number) {
    if (mysqli_num_rows($result_check_phone_number)) {
      $errors[] = 'Phone number already exists';
    }
  }

  //check required field
  $req_fields = array('title','firstName','telNo');
  $errors= array_merge($errors,check_re_fi($req_fields));

  //check max length of inputs
  $max_length = array('firstName'=>30,'lastName'=>50,'telNo'=>12,'nic'=>13,);
  $errors= array_merge($errors,check_max_le($max_length)); 
  
  // age is calculated
  $today = date("y/m/d");
  $lastAge = ( (2000 + date('y')) - (date('Y',strtotime($DoB))) );  


//save data in mysql data base
if (empty($errors)) {
  if (!empty($img)) {
  $query = "INSERT INTO `patient` (`title`,`firstName`, `lastName`, `nic`, `telNo`, `dob`, `age`,`date`,`notes`,`img`,`dele`) 
  VALUES                          ('$title',' $Fname', ' $Lname', '$nic', '$teNo', '$DoB','$lastAge','$today','$notes','$img','0') ";
  $result = mysqli_query($connection,$query) ;
  }else{
    $query = "INSERT INTO `patient` (`title`,`firstName`, `lastName`, `nic`, `telNo`, `dob`, `age`,`date`,`notes`,`img`,`dele`)
     VALUES                         ('$title',' $Fname', ' $Lname', '$nic', '$teNo', '$DoB','$lastAge','$today','$notes','0','0') ";
    $result = mysqli_query($connection,$query) ;
  }
}
}

  $Query = "SELECT * FROM `patient` WHERE dele = 0 " ;
  $result_set =mysqli_query($connection,$Query);
$how_many_patient =  mysqli_num_rows($result_set);

?>


<!DOCTYPE html>
<html lang="en">
<head>


  <meta charset="utf-8">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Patient</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/font-awesome.min.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/simple-line-icons.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/animate.min.css"/>
      <link rel="stylesheet" type="text/css" href="asset/css/plugins/fullcalendar.min.css"/>

    <link href="asset/css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CSS/index-query.css">
    <link rel="stylesheet" type="text/css" href="CSS/common.css">
  <!-- end: Css -->

 



  </head>

 <body id="mimin" class="dashboard">


      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <?php require_once('inc\top.php'); ?>
            </div>
          </div>
        </nav>
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
          <!-- start:Left Menu -->
            <div id="left-menu">
              <div class="sub-left-menu ">
                <ul class="nav nav-list">
                    <!--  <li><div class="left-bg"></div></li> <br> -->
                    <img src="IMG\ic.jpg" style="width: 230px; height: auto;">
                    <li class="time">
                      <h2 class="animated fadeInLeft"><?php 
                       echo  date('h:i a') ; 
                      

                      ?></h2>
                      <p class="animated fadeInRight"><?php echo (date("20y.m.d")) ; ?></p>

                    </li>

                    <li >
                     <?php require_once('inc\links.php'); ?>
                    </li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->
          <!-- start: content -->
              <div id="content">
                <div class="panel">
                  <div class="panel-body">
                      <div class="col-md-6 col-sm-12" >
                        <div  style="height:5px;"></div>
                        <h3 class="animated fadeInLeft">Logged in as <?php echo $name; ?> </h3>
                        <div  style="height:5px;"></div>
                      </div>
                      <a href="change_p.php?user=<?php echo $username?>&&pass=<?php echo $password?>" style="float: right;margin-right: 10px;margin-top: 20px;">change my password</a>
                  </div> <!-- panel-body -->
                </div> <!-- panel -->

                <div class="col-md-12" style="padding:1px;">
                    <div class="col-md-12 padding-0" >
                        <div class="col-md-8 padding-0">
                             <div class="x col-md-12">
                                <div class="panel box-v4" >
                                   
                                    <div class="panel-body padding-0" >
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                            <?php require_once('inc\form.php'); ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col-md-12 padding-0">
                              <div class="panel box-v2">
                                  <div class="panel-body">
                                    <div class="col-md-12 padding-0 text-center">
                                      
                                     <h2 style="float: left;width: 80%;">Number of patient : </h2>
                                          <h1 style="float: left;width: 20%;"><?php echo $how_many_patient; ?></h1>
                                 <div id="calendar">
                                  
                                 </div>
                                      
                                    </div>
                                  </div>
                              </div>
                            </div>
                            <div id="right">
                            <div class="col-md-12 padding-0" >
                              <div class="panel box-v3 ">
                                <div class="panel-heading bg-white border-none">
                     <ul id="main-nav" class="nav navbar-nav navbar-right default">
                                </div>

                                <div class="panel-footer bg-white border-none"> <img src="IMG\images.png" style="width: auto;height: 300px;">
                                </div>
                              </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
        <!-- end: content -->

      </div>
  </body>
</html>
<?php mysqli_close($connection);  ?>