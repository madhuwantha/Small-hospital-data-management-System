<?php session_start(); ?>
<?php if (!isset($_SESSION['first_name'])) {
  header('Location:login.php');
} ?>

<?php require_once('inc\connection.php'); ?>
<?php 

// name_sort
// age_sort
// date_sort
$condition = " ";
$condition  = $_GET['sort'];

  if ($condition == "name_sort") {
      $Q= "firstName";

  }  if ($condition == "age_sort") {
      $Q= "age";
  }  if ($condition == "date_sort") {
      $Q= "date";
  }
  


  $Query = "SELECT * FROM `patient` WHERE dele = 0 ORDER BY `patient`.`{$Q}` ASC  " ;
  $result_set =mysqli_query($connection,$Query);


  $output = '';
if (isset($_POST["export"])) {  
    $deliminator = " ";
    $file_name = "significunt_" . date(Ymd) . ".xlsx";
    $f = fopen('php://memory', 'w');
    $field  = array('TITLE','FIRST','LAST','NIC','TEL','BIRTHDAY','AGE','DATE','ABOUT');
    fputcsv($f, $field , $deliminator);

    while ($row = $result_set->fetch_assoc() ) {
      $linedata  = array($row['title'],$row['firstName'],$row['lastName'],$row['nic'],$row['telNo'],$row['dob'],$row['age'],$row['date'],$row['notes']);
      fputcsv($f, $linedata , $deliminator);
    }

    fseek($f, 0);

    header('Content-type: text/csv');
    header('Content-Disposition:attachment;filename="'.$file_name.'";');
    fpassthru($f);

    // $output .= '
    //   <table class]="table" bordered="1">
    //     <tr>
    //       <th>TITLE</th>
    //       <th>FIRST NAME</th>
    //       <th>LAST NAME</th>
    //       <th>NIC NO</th>
    //       <th>TEL NO</th>
    //       <th>BIRTHDAY/th>
    //       <th>AGE</th>
    //       <th>DATE</th>
    //       <th>ABOUT</th>
    //     </tr>
    // ';
    // while ($excel = mysqli_fetch_array($result_set)) {
    //   $output .= '
    //     <tr>
    //     <td>'.$excel["title"].'</td>
    //     <td>'.$excel["firstName"].'</td>
    //     <td>'.$excel["lastName"].'</td>
    //     <td>'.$excel["nic"].'</td>
    //     <td>'.$excel["telNo"].'</td>
    //     <td>'.$excel["dob"].'</td>
    //     <td>'.$excel["age"].'</td>
    //     <td>'.$excel["date"].'</td>
    //     <td>'.$excel["notes"].'</td>
    //     </tr>
    //   ';
    // }
    // $output .= '</table>';
    // header("Content-type: application/vnd.ms-excel");
    // header("Content-Disposition: attachment; filename='download.xls' ");
    // echo  $output;


}
 

  if (!($result_set)) {
    echo "Selete Query not successful" . "<br>";
  }

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



?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Patients</title>
 
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
                    <!-- <li><div class="left-bg"></div></li> -->
                    <img src="IMG\ic.jpg" style="width: 230px; height: auto;">
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
                              <div class="b col-md-12 ">
                                <div style="width: auto;height: 40px;background: white;opacity: 0.8;border-radius: 5px;margin-bottom: 2px;">
                              <ul class="ulll">
                                <li>NAME</li>
                                <li style="margin-left: 8%;">AGE</li>
                                <li style="margin-left: -8%;">ID</li>
                                <li>TEL</li>
                                <li style="margin-left: -8%;">DATE</li>
                                <li style="margin-left: -7%;">TTTTTT</li>
                               <div class="dropdown1">
                                <button onclick="myFunction()" class="dropbtn"><img src="image/menu.png"></button>
                                  <div id="myDropdown" class="dropdown-content">
                                    <a href="t_selete_query.php?sort=name_sort ">Name</a>
                                    <a href="t_selete_query.php?sort=age_sort  ">Age</a>
                                    <a href="t_selete_query.php?sort=date_sort ">Date</a>
                                  </div>
                                </div>
                              </ul>
                                </div>


<form action="t_selete_query.php?sort=<?php echo $condition ?>" method="post">
  <input type="submit" name="export">
</form>


                                <div class="tableBlock">
                                  <div style="overflow-y:auto;height:auto;max-height: 800px;">                                   
                                 <?php echo $ta; ?>   
                                  </div>
                                </div>
                              </div>
                        </div>                       
          <!-- end: content -->
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

</script>      
  </body>
</html>
<?php mysqli_close($connection);  ?>

