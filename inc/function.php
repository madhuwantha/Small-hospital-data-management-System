  <?php 

//check required field
function check_re_fi($req_fields){
	$errors = array();
   foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {     
        $errors[] = $field.' is required';
        }
    } 
    return $errors;
}
//check max length of inputs
function check_max_le($max_length){
	$errors = array();
	foreach ($max_length as $field =>$max) {
        if (strlen(trim($_POST[$field])) > $max) {     
    	$errors[] = $field.' must be less than '.$max . ' charactors';
   		}
  }
  return $errors ;
}

//display errors
function display_errors($errors){
	echo '<div class="errormsg">';
    	foreach ($errors as $error) {
    	$error = ucfirst($error);
      	echo $error.'<br>';}
  	echo '</div>';
}

function photo_uplod_to_folder($pic){
//photo upload to folder
  $file_name = $_FILES['image']['name'];
  $file_type = $_FILES['image']['type'];
  $file_size = $_FILES['image']['size'];
  $temp_name = $_FILES['image']['tmp_name'];
//change the file name as firstname
  $temp =explode(".", $_FILES['image']['name']);
  $newfilename = ($Fname). '.jpg';   //.end($temp)
  $Upload_to = 'IMG/';
  $lp=  move_uploaded_file($temp_name, $Upload_to . $newfilename);

}

   ?>

