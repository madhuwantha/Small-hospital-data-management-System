<?php require_once('inc\connection.php');?>
<?php require_once('inc\function.php');?>
<?php
$errors = array();
$Fname = $Lname = $gender= $nic= $teNo= $DoB= $age= $title =   $notes= $temp_image=" ";  //new variables

  //display already fields
  if (isset($_GET['PN'])) {
    
    $teNo = mysqli_real_escape_string($connection,$_GET['PN']);

    $query1 = "SELECT * FROM  patient WHERE  `telNo` = {$teNo} LIMIT 1 ";
    $result_set1 = mysqli_query($connection , $query1);

    if ($result_set1){
      if(mysqli_num_rows($result_set1) == 1){
        $result = mysqli_fetch_assoc($result_set1);
        $title = $result['title'];
        $Fname = $result['firstName'];
        $Lname = $result['lastName'];
        $nic = $result['nic'];
        $DoB = $result['dob'];
        $notes = $result['notes'];

$pic2 = '<img src="data:image/jpeg;base64,'.base64_encode($result['img']).'" height="300" width="450"/>';
$name= '<div class="fl">'. $result['title']." ".$result['firstName'] .$result['lastName'].'</div>';


      }
    }else{ 
      echo "unsuccesful query1";
    }
  }




// if ($_SERVER["REQUEST_METHOD"] == "POST") { 
if(isset($_POST['submit'])){

  //get inputs
  $teNocheck =  /*test_i*/trim(mysqli_real_escape_string($connection,($_POST["teNo"])))   ;
  $title =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["title"])    ))  ;
  $Fname =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["firstName"])))  ;
  $Lname =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["lastName"]) ))  ;
  $nic   =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["nic"])      ))  ;
  $teNo  =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["telNo"])    ))  ;
  $DoB   =  /*test_input*/trim(mysqli_real_escape_string($connection,($_POST["dob"])      ))  ;
  $notes =  /*test_input*/mysqli_real_escape_string($connection,($_POST["notes"])    ) ;
  $temp_image = $_FILES['image']['tmp_name']                                          ;

 if (!empty($temp_image)) {
  $img   = addslashes(file_get_contents($temp_image))                                ;
 }  


  //check phone number already exists
  $query_check_phone_number = "SELECT * FROM `patient` WHERE  `telNo` = '{$teNo}' AND `telNo`!= '{$teNocheck}' LIMIT 1 ";
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
  $query = "UPDATE `patient` SET `title`='{$title}',`firstName`='{$Fname}', `lastName`='{$Lname}', `nic`='{$nic}', `telNo`='{$teNo}', `dob`='{$DoB}', `age`='{$lastAge}',`img`='{$img}',`notes`='{$notes}' WHERE `telNo` = '{$teNocheck}' LIMIT 1 ";
  $result = mysqli_query($connection,$query) ;
  }else{
  $query = "UPDATE `patient` SET `title`='{$title}',`firstName`='{$Fname}', `lastName`='{$Lname}', `nic`='{$nic}', `telNo`='{$teNo}', `dob`='{$DoB}', `age`='{$lastAge}',`notes`='{$notes}' WHERE `telNo` = '{$teNocheck}' LIMIT 1 ";
  $result = mysqli_query($connection,$query) ;   
  }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
 
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

 <body id="mimin" class="dashboard" style="background: #D4E8F1;">
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
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                   <!--  <li><div class="left-bg"></div></li> --><img src="IMG\ic.jpg" style="width: 230px; height: auto;">
                    <li class="time">
                      <h2 class="animated fadeInLeft"><?php  echo  date('h:i a') ; ?> </h2>
                      <p class="animated fadeInRight"><?php echo (date("20y.m.d")) ; ?></p>
                      
                    <li class="ripple">
                     <?php require_once('inc\links.php'); ?>
                    </li>
                  </ul>
                </div>
            </div>
          <!-- end: Left Menu -->
          <!-- start: content -->
              <div id="content">
                <div class="col-md-12" style="padding:20px;">
                    <div style="margin-top: 10px;" class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0" >
                             <div class="col-md-12" >
                                <div  class="panel box-v4">
                                    <div class="panel-heading bg-white border-none">
                                      
                                    </div>
                                    <div class="panel-body padding-0">
                                        <div class="col-md-12 col-xs-12 col-md-12 padding-0 box-v4-alert">
                                            <?php require_once('inc\form-edit.php'); ?>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div  class="col-md-4">
                            <div class="col-md-12 padding-0">

                            <div id="right" >
                            <div class="col-md-12 padding-0"  >
                              <div class="panel box-v3 ">
                                <div class="panel-heading bg-white border-none">
                                  <hr>
                                  <h3><?php echo $name; ?></h3>
                                  <hr>
                                </div>
                                <div class="">
                                  <hr>
                                  <?php echo $pic2; ?>
                                  <hr>
                                </div>
                              </div>
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

