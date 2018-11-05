<?php  require_once('inc\connection.php'); ?>
<?php session_start(); ?>
<?php if (!isset($_SESSION['first_name'])) {
  header('Location:login.php');
} 


  
if (isset($_GET['keywords'])) {
    $keywords=mysqli_real_escape_string($connection,$_GET['keywords']);

    $query="SELECT*FROM patient WHERE firstName LIKE '%{$keywords}%' OR lastName LIKE '%{$keywords}%' OR nic LIKE '%{$keywords}%' OR telNo LIKE '%{$keywords}%'";
    $result_set=mysqli_query($connection,$query);

$how_many = mysqli_num_rows($result_set);
if ($how_many < 1) {
  $ta = " result not found";
}else{

   $ta = '<table>';


        while ($all_patient=mysqli_fetch_assoc($result_set)  ) {
if ($all_patient['dele']=="0") {
         // $ta .= '<tr>';
 
          if (!empty($all_patient['img'])) {   
            $pic2 = '<img src="data:image/jpeg;base64,'.base64_encode($all_patient['img']).'" class="pic" />';
          }else{
            $pic2 =  '<img src="IMG\Screenshot (67).png">';
          }
            $url = "t-one-by-one.php?PN= {$all_patient['telNo']}";  
            $t ='<div class="f0">'. $all_patient['title'].'</div>';


            // $ta .='<td>'; 

            // $ta .='<div class="n">';
            // $ta .= '<h2>';         
           
            // $ta .='<li>'.'<a href= "'.$url.'" >'.'<b>'.'<div class="tit">'.$all_patient['title'] .".".'</div>'.'<div class="name">'.$all_patient['firstName'] ." " .$all_patient['lastName'].'</div>'.'</b>'.'</a>'.'</li>';

            
            // $ta .=  '<li>'.$all_patient['age']." year's old " .'</li>';         
            
            // $ta .= '<li>'.$all_patient['date'].'</li>';
           
            // $ta .=  '<li>'.$all_patient['telNo'].'</li>';
            // $ta .= '</h2>';
            // $ta .='</div>';
             //$ta .='<div class="p">'.$pic2.'</div>';


            // $ta .='</td>';
            // $ta .= '</tr>'  ;
            // $ta .='<tr>';
            // $ta .='<td>';     
            // $ta .='</td>';
            // $ta .='</tr>';

for ($i=0; $i <10 ; $i++) { 
                                    $ta .= '<tr>';
                                      $ta.='<td width="35%">';
$ta .= '<div class="NAME">'.$all_patient['title']." ".$all_patient['firstName'] ." " .$all_patient['lastName'].'</a>'.'</div>';
                                      $ta.='</td>';

                                      $ta.='<td width="10%">';
                                      $ta .= '<div class="ID">'.$all_patient['age'].'</div>';
                                      $ta.='</td>';
                                
                                      $ta.='<td width="15%">';
                                      $ta .= '<div class="ID">'.$all_patient['nic'].'</div>';
                                      $ta.='</td>';
                                      $ta.='<td width="15%">';
                                      $ta .= '<div class="TP">'.$all_patient['telNo'].'</div>';
                                      $ta.='</td>';
                                      $ta.='<td width="15%">';
                                      $ta .= '<div class="DATE">'.$all_patient['date'].'</div>';
                                      $ta.='</td>';
                                      $ta.='<td width="10%">';
                                      $ta .= '<div class="TTT">'."good".'</div>';
                                      $ta.='</td>';
                                      $ta.='<td width="10%">';
                                      $ta .= '<div class="LINK">'.'<a href= "'.$url.'" >'.">".'</a>'.'</div>';
                                      $ta.='</td>';
                                    $ta .= '</tr>';
}
          }

        }
  $ta .= '</table>'; 

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
    <link rel="stylesheet" type="text/css" href="CSS/selete-quary.css">
    <link rel="stylesheet" type="text/css" href="CSS/common.css">
  <!-- end: Css -->
  </head>
 <body id="mimin" class="dashboard">
      <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
  
  <header>
    <nav>
      <div class="top clearfix">
        <h1><BASEFONT>PATIENTS' DETAIL MANAGEMENT SYSTEM</BASEFONT></h1>   
      </div> <!-- top -->
            <div class="search_people" style="padding:20px 0;">
              <form method="get" action="sch.php"> 
                <input type="search" name="keywords" class="sr" <?php  echo 'value=" '.$keywords.'"' ?> >
                <button type="submit">Go</button>
              </form>
            </div>  <!-- search-bar -->
           
    </nav>
  </header>
  
            </div>
          </div>
        </nav>
      <!-- end: Header -->
      <div class="container-fluid mimin-wrapper">
          <!-- start:Left Menu -->
            <div id="left-menu">
              <div class="sub-left-menu scroll">
                <ul class="nav nav-list">
                    <!-- <li><div class="left-bg"></div></li> --><img src="IMG\ic.jpg" style="width: 230px; height: auto;">
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
                                <div class="dropdown1">
                                <button onclick="myFunction()" class="dropbtn">Sort By</button>
                                  <div id="myDropdown" class="dropdown-content">
                                    <a href="t_selete_query.php?sort=name_sort ">Name</a>
                                    <a href="t_selete_query.php?sort=age_sort  ">Age</a>
                                    <a href="t_selete_query.php?sort=date_sort ">Date</a>
                                  </div>
                                </div>
                            
                              <div class="b col-md-12 ">
                                <div style="width: auto;height: 40px;background: white;opacity: 0.8;border-radius: 5px;margin-bottom: 2px;">
                              <ul class="ulll">
                                <li>NAME</li>
                                <li style="margin-left: 8%;">AGE</li>
                                <li style="margin-left: -8%;">ID</li>
                                <li>TEL</li>
                                <li style="margin-left: -8%;">DATE</li>
                                <li style="margin-left: -7%;">TTTTTT</li>
                              </ul>
                                </div>

                                <div class="tableBlock">
                                  <div style="overflow-y:auto;height:auto;max-height: 800px;">                                   
                                 <?php echo $ta; ?>   
                                  </div>
                      </div>
                              </div>
                        </div>                     
          <!-- end: content -->
      </div>    
  </body>
</html>
<?php mysqli_close($connection);  ?>

