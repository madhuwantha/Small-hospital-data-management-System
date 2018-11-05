<?php session_start(); ?>
<?php require_once('inc\connection.php'); ?>
<?php if (!isset($_SESSION['first_name'])) {
  header('Location:login.php');
} ?>


<?php
if (isset($_GET['PN'])) {


$teNo     = mysqli_real_escape_string($connection,$_GET['PN']);
$date     =date("y.m.d");
$datetime = date("y.m.d").".".time();


  $Q = "SELECT   title,firstName, lastName ,img ,telNo FROM patient" ;
  $res =mysqli_query($connection,$Q);

    $how_many_patients = mysqli_num_rows($res);  
 
      for($i=0;$i<$how_many_patients;$i++) {           

        $patient=mysqli_fetch_assoc($res);

        if ($patient['telNo']==$teNo) {
$pic2 = '<img src="data:image/jpeg;base64,'.base64_encode($patient['img']).'" height="300" width="450"/>';
$name= '<div class="fl">'. $patient['title']." ".$patient['firstName'] .$patient['lastName'].'</div>';

        }
      }      
    



 //new variables

// if ($_SERVER["REQUEST_METHOD"] == "POST") { 
if(isset($_POST['submit'])){

  //get inputs
  $notes = mysqli_real_escape_string($connection,($_POST["notes"]));
  $notes1 = mysqli_real_escape_string($connection,($_POST["notes1"]));
  $notes2 = mysqli_real_escape_string($connection,($_POST["notes2"]));
  $notes3 = mysqli_real_escape_string($connection,($_POST["notes3"]));


  $temp_image1 = $_FILES['photo1']['tmp_name'];
  $temp_image2 = $_FILES['photo2']['tmp_name'];
  $temp_image3 = $_FILES['photo3']['tmp_name'];

  $i   = '<img src="IMG\Screenshot (67).png">';
 if (!empty($temp_image1) ) {
  $img1   = addslashes(file_get_contents($temp_image1));
 }else{
  $img1   = '<img src="IMG\Screenshot (67).png">';
 }
 if (!empty($temp_image2) ) {
  $img2   = addslashes(file_get_contents($temp_image2));
 }else{
  $img2   = '<img src="IMG\Screenshot (67).png">';
 }
 if (!empty($temp_image3) ) {
  $img3   = addslashes(file_get_contents($temp_image3));
 }else{
  $img3   = '<img src="IMG\Screenshot (67).png">';
 }

  

//save data in mysql data base
if (empty($errors)) {
  $query = "INSERT INTO `photos` (`datetime`,`tel`,`note`,`note1`,`note2`,`note3`,`photo1`,`photo2`,`photo3`,`date`) VALUES ('$datetime','$teNo','$notes','$notes1','$notes2','$notes3','$img1','$img2','$img3','$date') ";
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
    <link rel="stylesheet" type="text/css" href="CSS/t-update.css">
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
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                <!--     <li><div class="left-bg"></div></li> --><img src="IMG\ic.jpg" style="width: 230px; height: auto;">
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
              <div id="content"  >
                <div class="col-md-12" style="padding:20px;margin-top: 10px;">
                    <div class="col-md-12 padding-0">
                        <div class="col-md-8 padding-0">
             
                                    
                                        

 <div class="formUpdate" style="overflow-y:auto;height:auto;max-height: 1900px; background: white;border-radius: 5px; color: black;">
<form class="form" method="post" action ="t-update.php?PN=<?php echo $teNo ?>"  enctype="multipart/form-data">

                            <div class="col-md-12 padding-0">
                                <div class="text" style="padding: 10px;">
                                  <div class="panel box-v1">
                                    <p>About the patient</p>
                                      <textarea name="notes1" cols="80" rows="10" placeholder="Enter a comment about the picture"  ></textarea>
                                  </div>                                                         
                                  
                                </div>
                                <div class="col-md-6" style="padding: 10px;">
                                    <div class="panel" >                                   
                                        <input type="file" name="photo1" id="photo1" >      
                                    </div>
                                </div>                               
                            </div>
                            <div class="col-md-12 padding-0">
                                <div class="text" style="padding: 10px;">
                                  <div class="panel box-v1">
                                    <p>About the patient</p>
                                      <textarea name="notes2" cols="80" rows="10" placeholder="Enter a comment about the picture"  ></textarea>
                                  </div>                                                         
                                  
                                </div>
                                <div class="col-md-6" style="padding: 10px;">
                                    <div class="panel box-v1">                            
                                        <input type="file" name="photo2" id="photo2" >                       
                                    </div>
                                </div>                           
                            </div>
                            <div class="col-md-12 padding-0">
                                <div class="text" style="padding: 10px;">
                                  <div class="panel box-v1">
                                    <p>About the patient</p>
                                      <textarea name="notes3" cols="80" rows="10" placeholder="Enter a comment about the picture"  ></textarea>
                                  </div>                        
                                  
                                </div>
                                <div class="col-md-6" style="padding: 10px;">
                                    <div class="panel box-v1">                                 
                                        <input type="file" name="photo3" id="photo3" >                           
                                    </div>
                                </div>                    
                            </div>
                            <div class="col-md-12 padding-0">
                                    <div class="panel box-v1">
                                      <br><br><p>Overall report</p>
                                        <textarea class="last_comment" name="notes" cols="80" rows="10"  ></textarea>
                                    </div>                          
                            </div>
                            <div class="col-md-12 padding-0">
                                    <div class="panel box-v1">
                                      <br><br>

                            <ul>
                              <li><input type="text" name="label"><br>
                                <input type="file" name="report1" id="report1" style=" float: left; height: 35%;  "></li>
                              <li><input type="text" name="label"><br>
                                <input type="file" name="report1" id="report1" style=" float: left; height: 35%;  "></li>
                              <li><input type="text" name="label"><br>
                                <input type="file" name="report1" id="report1" style=" float: left; height: 35%;  "></li>
                              <li><input type="text" name="label"><br>
                                <input type="file" name="report1" id="report1" style=" float: left; height: 35%;  "></li>
                            </ul>
                                    </div>                          
                            </div>
                                        <input type="submit" name="submit" value="UPDATE"  >



                          
 </form>  

                            

   
 </div>


                        </div>
                        <div class="col-md-4">
                            <div id="right">
                            <div class="col-md-12 padding-0" >
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
          <!-- end: content -->
      </div>

                                    
                          
  </body>
</html>
<?php mysqli_close($connection);  ?>


