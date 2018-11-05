 <?php require_once('inc\connection.php'); ?>
<?PHP 

$condition = $_GET['PN'];
$bbb = " ";
if (isset($_GET['a'])) {
$bbb = $_GET['a'];


if ($bbb == "ok" ) {

 $query = " UPDATE `patient` SET `dele`='1' WHERE `telNo` = '{$condition}' LIMIT 1 ";
 $result = mysqli_query($connection,$query) ;
 header('Location:t_selete_query.php?sort=name_sort');
}else{header('Location:t_selete_query.php?sort=name_sort');}

}



  $Query = "SELECT   `title`,`firstName`, `lastName`, `nic`, `telNo`, `dob`, `age`,`date`,`notes`,`img` FROM patient  WHERE `telNo` = '{$condition}' " ;
  $result_set =mysqli_query($connection,$Query);
  $all_patient=mysqli_fetch_assoc($result_set);
  $up = " " ;


  $Q = "SELECT   `note`,`note1`,`note2`,`note3`,`photo1`,`photo2`,`photo3`,`date`,`tel`,`datetime` FROM `photos` ORDER BY `photos`.`date` DESC" ;
  $re =mysqli_query($connection,$Q);
  $how_many = mysqli_num_rows($re);




$up = '<div style="overflow-y:auto;height:auto;max-height: 830px;">';

  while ($all=mysqli_fetch_assoc($re)) { 

    if ($all['tel']==$condition) {

  $pic1 = '<img src="data:image/jpeg;base64,'.base64_encode($all['photo1']).'" height="100" width="100"/>';
  $pic2 = '<img src="data:image/jpeg;base64,'.base64_encode($all['photo2']).'" height="100" width="100"/>';
  $pic3 = '<img src="data:image/jpeg;base64,'.base64_encode($all['photo3']).'" height="100" width="100"/>';

  $note = $all['note'];
  $note1 = $all['note1'];
  $note2 = $all['note2'];
  $note3 = $all['note3'];
  $date = $all['date'];
  $url="t_view_diagnose.php?PN= {$all_patient['telNo']}&&DT={$all['datetime']}";

  $up .= '<div style="width: 95%;height: 50px;background: #D9ECF5;margin-left: 2.5%;border-radius: 5px;margin-top:5px;" class="element">';
  $up.='<div style="float: left;padding:5px 100px;font-size:22px;color:black;margin-left:-8%;">';
  $up.=$all['date'];                        
  $up.='</div>';
  $up.='<div style="float: left;padding:5px 60px;font-size:22px;color:black;">';
  $up.="Tentative Diagnosis : good";              
  $up.='</div>';
  $up.='<div style="float: right;padding:5px 10px;font-size:22px;color:black;margin-left:60PX;;">';
  $up.='<a href="'.$url.'">'.'<img   src="image/plus.png" style="width: 30px;height: auto;">'.'</a>';                        
  $up.='</div>';
  $up .= '</div>';




    }
 } 

  $up .= '</div>';

  


  $how_many_patients = mysqli_num_rows($result_set);
 
  if (!($result_set)) {
    echo "Selete Query not successful" . "<br>";
  }

          if (!empty($all_patient['img'])) {   
            $pic0 = '<img src="data:image/jpeg;base64,'.base64_encode($all_patient['img']).'" class="pic" />';
          }else{
            $pic0 =  '<img src="IMG\Screenshot (67).png">';
          }
        $t ='<div class="f0">'. $all_patient['title'].'</div>'; 
        $name= '<div class="fl">'. $all_patient['title'].".".$all_patient['firstName']." " .$all_patient['lastName'].'</div>';

  $ta = '<div class="one_p">';

        $ta .= '<div class="one_photo">';     
        $ta .=$pic0;    
        $ta .= '</div>';

        $ta .= '<div class="datails">'; 

        $ta .= '<div class="name">';
        $ta .= $t.$name ;
        $ta .= '</div>'; 
        $ta .= '<div class="age">';

        $ta .=  "Age :".$all_patient['age']."" ;         

        $ta .= '</div>';
        $ta .= '<div class="dob">'; 
        $ta .= "Birth day :"." ".$all_patient['dob'];
        $ta .= '</div>';
        $ta .= '<div class="id">';
        $ta .= "NIC :"." ".$all_patient['nic'] ;
        $ta .= '</div>';
        $ta .= '<div class="phone-number">';
        $ta .= "Phone No :"." ".$all_patient['telNo'];
        $ta .= '</div>';
        $ta .= '<div class="coming_date">';
        
        $ta .= "First Cilinic Date :"." ".$all_patient['date'];

        $ta .= '</div>';
        $ta .= '<div class="more-datails">';
        $ta .= $all_patient['notes'];
        $ta .= '</div>';


        $ta .= '</div>'; 

  $ta .= '</div>'; 

  ?>


<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="utf-8">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $all_patient['firstName']." ".$all_patient['lastName']; ?></title>
 
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
    <link rel="stylesheet" type="text/css" href="CSS/one-by-one.css">
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
                  <!--   <li><div class="left-bg"></div></li> --><img src="IMG\ic.jpg" style="width: 230px; height: auto;">
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
            <div class="a col-md-8 ">
              
              <div class="b">
                <div style="float: left;" class="tableBlock">
                  <div style="overflow-y:auto;height:auto;max-height: 900px;"> 

                 <?php echo $up; ?> 

                  
                  </div>
                </div> 
                <div class="test">
                  <div style="position: absolute;" class="dropdown1">
                <button onclick="myFunction()" class="dropbtn">More</button>
                  <div id="myDropdown" class="dropdown-content">
                     <a href="t-edit-query.php?PN=<?php echo $condition ?>"> EDIT DETAILS  </a>
                     <a href="t-update.php?PN=<?php echo $condition ?>">     ADD DIAGNOSE RESULT</a>
                     <a class="delet-link" onclick="myFunction2()">DELETE PATIENT</a>
                  </div>
              </div>
                  <div style="letter-spacing: 1px;line-height: 15px;font-family: sans-serif;font-size: 20px;" class="pppp">
                  <?php echo $pic0; ?>

                  <h2 style="margin-left: 5%;font-family: sans-serif;"><?php echo $name ; ?></h2>
                  <p style="margin-left: 5%;font-family: sans-serif;">Age:<?php echo $all_patient['age'] ; ?></p>
                  <p style="margin-left: 5%;font-family: sans-serif;">Tel. No.:<?php echo $all_patient['telNo']; ?></p>
                  <p style="margin-left: 5%;font-family: sans-serif;">First Visit:<?php echo $all_patient['date']; ?></p><br><br>   
                  <p style="margin-left: 5%;font-family: sans-serif;">About Patient:<br></p>
                  <p style="margin-left: 5%;line-height: 25px;"><?php echo $all_patient['notes'] ?></p>
                  </div>
                </div> 
              </div>
            </div>                
          <!-- end: content -->
      </div>






<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

  function myFunction2(){
    var txt;
    var r = confirm("Are you sure?Do you want delete?");
    if (r == true) {
      txt = "ok";
    }else{
      txt ="not";
    }
    window.location.href = window.location.href+'&&a='+txt;
  //  document.getElementById("demo")

  }

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("<?php $t ?>");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>       
  </body>
</html>
<?php mysqli_close($connection);  ?>

