

<!-- display errors -->
<?php 
if (!empty($errors)) {
  display_errors($errors);
}
 ?>
<form accept-charset="utf-8"  method="post" action ="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  enctype="multipart/form-data" >

<div class="form">

      <div class="la">
<label class="labels ">Title : </label>      <br>
<label class="labels ">Frist Name : </label> <br>
<label class="labels ">Last Name :</label> <br>
<label class="labels ">Birth Day :</label>  <br>
<label class="labels ">NIC Number :</label> <br>
<label class="labels ">Phone Number :</label>      <br>
<label class="labels ">Add Photo :</label>      <br>
      </div>

      

<div class="d ">
     <div class="inputs  "> <select class="Title" name="title" ><option><?php  echo $title ?> </option><option>Rev</option><option>Mr</option><option>Miss</option><option>Mrs</option></select></div>
     <div class="inputs  "> <input  class="Frist"     type="text"  name="firstName"  <?php  echo 'value=" '.$Fname.'' ?> ">             </div>
     <div class="inputs  "> <input  class="Last"     type="text"   name="lastName"   <?php echo  'value=" '.$Lname.'' ?> ">                </div>
     <div class="inputs  "> <input  class="Birth"     type="date"  name="dob"    id="datepicker"   <?php  echo 'value=" '.$DoB.'"' ?>  >                     </div>
     <div class="inputs  "> <input  class="NIC"     type="text"    name="nic"        <?php  echo 'value=" '.$nic.'"' ?> >                        </div>
     <div class="inputs  "> <input  class="Phone"     type="tel"   name="telNo"      <?php  echo 'value=" '.$teNo.'' ?> ">                     </div>
     <div class="inputs  "> <input  class="Add"     type="file"    name="image"      id="image">              </div>
     <div class="inputs  "> <textarea class="note"                 name="notes"      cols="10" <?php  echo 'value=" '.$notes.'"' ?> ></textarea> </div>
     <div class="inputs  "> <input    class="submit" type="submit" name="submit"     <?php  echo 'value=" Submit' ?> ">             </div>
</div>
</div>    

 </form>  
