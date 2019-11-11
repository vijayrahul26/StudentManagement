<?php
include("../config/connect.php");
session_start();
$email=$_SESSION['email'];
if(!$email)
{
  echo "<script>document.location='../index.php';</script>";
}
$id= $_GET['id'];
$adminname=$_SESSION['admin_name'];
$result=mysqli_query($con,"select * from usermaster where pk_user_id='$id'");
$row=mysqli_fetch_array($result);
$url="http://localhost/studentmanagement";
?>
<!DOCTYPE html>
<html>
<head>
</head>
<link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
<style>
body
{
	font-size:20px;
}
#foot
{
    margin-top:21%;
}
.btn-bs-file{
    position:relative;
}
.btn-bs-file input[type="file"]{
    position: absolute;
    top: -9999999;
    filter: alpha(opacity=0);
    opacity: 0;
    width:0;
    height:0;
    outline: none;
    cursor: inherit;
}
.control-label
{
  font-size:18px;
  margin-top:9px;
}
.form-control
{
  width: 13em;
  height:0.5em;
 
}
</style>
<body>
<?php include("../view/common/header.php");?>
<div class="container">
<center>
<b><h3>Student Form</h3></b>
   <form class="form-horizontal" method="POST" enctype="multipart/form-data" >
    <div class="form-group">
     <p><label class="control-label col-sm-5 ">First Name:</label></p>
      <div class="col-sm-3">
      <input type="hidden" name="userid" id="id" value="<?php echo $id; ?>">
      <p><input type="text" class="form-control" name="firstNameTextField"  value="<?php echo $row['user_firstname'];?>" placeholder="First Name" required></p>
      </div>
    </div>
    <div class="form-group">
    <p> <label class="control-label col-sm-5" >Last Name:</label></p>
      <div class="col-sm-3">  
      <input type="text" class="form-control" name="lastNameTextField"  value="<?php echo $row['user_lastname'];?>" placeholder="Last Name" required>
     </div>
    </div>
      <div class="form-group">
      <p> <label class="control-label col-sm-5" >Email:</label></p>
      <div class="col-sm-3">  
      <input type="email" class="form-control" name="emailUserNameTextField" value="<?php echo $row['user_email'];?>" placeholder="Email"required>
     </div>
    </div>
     <div class="form-group">
     <p> <label class="control-label col-sm-5" >Mobile Number:</label></p>
      <div class="col-sm-3">  
      <input type="text" class="form-control" name="userPhoneNumberTextField" value="<?php echo $row['user_mobileno'];?>" placeholder="Mobile Number"pattern="[0-9]{10}" maxlength="10"required>
     </div>
    </div>
     <div class="form-group">
     <p> <label class="control-label col-sm-5" >Gender:</label></p>
      <?php
      if($row["user_gender"]=="male")
      {
        ?>
         <div class="col-sm-2">  
     <label class="radio-inline">
      <input type="radio" name="gender" checked value="male" required>Male
      </label>
      <label class="radio-inline">
      <input type="radio" name="gender"  value="female" >Female
      </label>
      </div>
      <?php
      }
      else
      {
      ?>
     <div class="col-sm-2">  
     <label class="radio-inline">
      <input type="radio" name="gender"  value="male" required>Male
      </label>
      <label class="radio-inline">
      <input type="radio" name="gender"  checked value="female" >Female
      </label>
      </div>
      <?php
      }
      ?>
    </div>
    <div class="form-group"> 
     <p><label class="control-label col-sm-5" >Year:</label></p>
     <?php
    $year=$row['user_year'];
    switch($year)
      {
      case "FIRST":
        ?><div class="col-sm-3"> <select class="form-control" name="year" required>
        <option value="FIRST" Selected>FIRST</option>
        <option value="SECOND">SECOND</option>
        <option value="THIRD">THIRD</option>
        <option value="FINAL">FINAL</option>
      </select>
      </div>
      <?php
      break;
     case "SECOND":
    ?>
    <div class="col-sm-3"><select class="form-control" name="year" required>
        <option value="FIRST">FIRST</option>
        <option value="SECOND" Selected>SECOND</option>
        <option value="THIRD">THIRD</option>
        <option value="FINAL">FINAL</option>
      </select>
      </div>
      <?php
      break;
      
  case "THIRD": 
      ?><div class="col-sm-3"><select class="form-control" name="year" required>
        <option value="FIRST">FIRST</option>
        <option value="SECOND" >SECOND</option>
        <option value="THIRD" Selected>THIRD</option>
        <option value="FINAL">FINAL</option>
      </select>
      </div>
      <?php
     break;
  default
?>
<div class="col-sm-3"><select class="form-control" name="year" required>
        <option value="FIRST">FIRST</option>
        <option value="SECOND" >SECOND</option>
        <option value="THIRD" >THIRD</option>
        <option value="FINAL"Selected>FINAL</option>
  </select>
  </div>
  <?php
  }
 ?>
</div>
<div class="form-group"> 
 <p> <label class="control-label col-sm-5" >Department:</label></p>
 <?php
    $dept=$row['user_dept'];
    switch($dept)
      {
      case "IT":
        ?><div class="col-sm-3"><select class="form-control" name="department" required>
        <option value="IT" Selected>IT</option>
        <option value="CS">CS</option>
        <option value="MECH">MECH</option>
        <option value="CIVIL">CIVIL</option>
        </select>
      </div>
      <?php
      break;

    case "CS":
    ?><div class="col-sm-3"><select class="form-control" name="department" required>
       <option value="IT" >IT</option>
        <option value="CS"Selected>CS</option>
        <option value="MECH">MECH</option>
        <option value="CIVIL">CIVIL</option>
      </select>
      </div>
      <?php
      break;
      
  case "MECH": 
      ?><div class="col-sm-3"><select class="form-control" name="department" required>
    <option value="IT" >IT</option>
        <option value="CS">CS</option>
        <option value="MECH"Selected>MECH</option>
        <option value="CIVIL">CIVIL</option>
         </select>
      </div>
      <?php
     break;
  default
?><div class="col-sm-3"><select class="form-control" name="department" required>
 <option value="IT">IT</option>
        <option value="CS">CS</option>
        <option value="MECH">MECH</option>
        <option value="CIVIL"Selected>CIVIL</option>
  </select>
  </div>
  <?php
  }
 ?>
</div>
<div class="form-group">
        <p><label class="control-label col-sm-5" >Select file to upload:</label></p>
      <div class="col-sm-3">
      <img width="100px" height="100px" src="<?php echo $url.$row['user_image']; ?>" onError="this.onerror=null;this.src='http://localhost/studentmanagement/public/assets/image/noimage.png';" alt="image"><input type="file" name="file" value="" accept="image/*">
       </div>
      </div>
      <br> 
<br> 
 <div class="form-group">        
 <div class="col-sm-offset-4 col-sm-4">
        <input type="submit" class="btn btn-success"  value="Update" name=bin >
        <!-- <input type="cancel" class="btn btn-danger" value="Cancel" onclick="location.href='../view/viewdetails.php';"> -->
        <button type="reset" class="btn btn-danger" value="Cancel" onclick="location.href='../view/viewdetails.php';" >Cancel</button>
      </div>
    </div>
   </form>
    
  </center>
</div>

<?php
require_once ("../config/connect.php");
// $id =$_GET['id'];
if(isset($_POST['bin']))
{
$id=$_POST['userid'];
$first=$_POST['firstNameTextField'];
$last=$_POST['lastNameTextField'];
$email=$_POST['emailUserNameTextField'];
$mobile=$_POST['userPhoneNumberTextField'];
$gender=$_POST['gender'];
$year=$_POST['year'];
$dept=$_POST['department'];
//  echo json_encode($_FILES['file']);
// exit();
if($_FILES['file']['name']!="")
{
  $file_name = $_FILES['file']['name'];
  $file_size = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];
  $file_type = $_FILES['file']['type'];
  $tmp = explode('.', $file_name);
  $file_ext = strtolower(end($tmp));
  // $file_ext=strtolower(end(explode('.',$file_name)));
  $file_name_new=$first.'_'.$last.'.'.$file_ext;
  $file_destination="../public/upload/".$file_name_new;
  $filepath="/public/upload/".$file_name_new;
  if(move_uploaded_file($file_tmp,$file_destination)) 
  {
   $update = mysqli_query($con,"UPDATE `usermaster` SET `user_firstname`='$first',`user_lastname`='$last',
  `user_email`='$email',`user_mobileno`='$mobile',`user_gender`='$gender',`user_year`='$year',
  `user_dept`='$dept',`user_image`='$filepath' WHERE `pk_user_id`=$id");
  if($update)
  {
    echo"<script>document.location='http://localhost/studentmanagement/view/viewdetails.php';</script>";  
  }
  // else
  // {
  
  // }
   }
   
}
else
{
  $update = mysqli_query($con,"UPDATE `usermaster` SET `user_firstname`='$first',`user_lastname`='$last',
  `user_email`='$email',`user_mobileno`='$mobile',`user_gender`='$gender',`user_year`='$year',
  `user_dept`='$dept' WHERE `pk_user_id`=$id");
  if($update)
  {
    echo"<script>document.location='http://localhost/studentmanagement/view/viewdetails.php';</script>";  
  }
}

 }
?>
<p id=foot>
 <?php include("../view/common/footer.php");?>
 </p>
<script src = "http://localhost/studentmanagement/public/assets/js/jquery-3.4.1.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap-notify.js"></script>
 <script>
action("menuhighlight", "register")
</script> 
</body>
</html>

