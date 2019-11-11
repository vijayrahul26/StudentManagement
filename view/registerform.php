<?php 
session_start();
$email=$_SESSION['email'];
// $adminname=$_SESSION['admin_name'];
if(!$email)
{
    echo "<script>document.location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
<link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/bootstrap.min.css."> 
<!-- <link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/registerform.css"> -->
<title>Student Management</title>
</head>
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
  <form class="form-horizontal" id="form1" name="form1" enctype="multipart/form-data" autocomplete="off">
    <div class="form-group">
     <p><label class="control-label col-sm-5 ">First Name:</label></p>
      <div class="col-sm-3">
       <input type="text" class="form-control" name="firstNameTextField" placeholder="First name" required>
      </div>
    </div>
    <div class="form-group">
    <p> <label class="control-label col-sm-5" >Last Name:</label></p>
      <div class="col-sm-3">  
      <input type="text" class="form-control" name="lastNameTextField" placeholder="Last Name" required>
     </div>
    </div>
      <div class="form-group">
      <p> <label class="control-label col-sm-5" >Email:</label></p>
      <div class="col-sm-3">  
      <input type="email" class="form-control" name="emailUserNameTextField" placeholder="Email" required>
     </div>
    </div>
     <div class="form-group">
     <p> <label class="control-label col-sm-5" >Mobile Number:</label></p>
      <div class="col-sm-3">  
      <input type="text" class="form-control" name="userPhoneNumberTextField" placeholder="Mobile No" pattern="[0-9]{10}" maxlength="10" required>
     </div>
    </div>
     <div class="form-group">
     <p> <label class="control-label col-sm-5" >Gender:</label></p>
      <div class="col-sm-2">  
     <label class="radio-inline">
      <input type="radio" name="gender"  value="male" required>Male
    </label>
    <label class="radio-inline">
      <input type="radio" name="gender" value="female">Female
    </label>
    </div>
    </div>
     <div class="form-group"> 
     <p><label class="control-label col-sm-5" >Year:</label></p>
     <div class="col-sm-3">
   <select class="form-control" name="year" required>
        <option value="FIRST">FIRST</option>
        <option value="SECOND">SECOND</option>
        <option value="THIRD">THIRD</option>
        <option value="FINAL">FINAL</option>
      </select>
      </div>
      </div>
      <div class="form-group"> 
      <p> <label class="control-label col-sm-5" >Department:</label></p>
     <div class="col-sm-3">
     <select class="form-control"  name="department" required>
       <option value="IT">IT</option>
        <option value="CS">CS</option>
        <option value="MECH">MECH</option>
        <option value="CIVIL">CIVIL</option>
        </select>
      </div>
      </div>
        <div class="form-group">
        <p><label class="control-label col-sm-5" >Select file to upload:</label></p>
   <div class="col-sm-1">
   <!-- <label class="btn-bs-file btn btn-sm btn-primary">
           Browse
                <input type="file" name="file" required>
            </label> -->
            <input type="file" name="file" id="BSbtnsuccess" accept="image/*">
                       <br>
  </div>
      </div>
      <br>
    <div class="form-group">        
    <div class="col-sm-offset-4 col-sm-4">
        <button type="submit" class="btn btn-success" name=button id="submitButton" data-loading-text="<i class='fa fa-circle-o-notch' aria-hidden='true'></i> Loading...">Submit</button>
<button type="reset" class="btn btn-danger" >Reset</button>
        <p id="errors"></p>
      </div>
    </div>
    </form>
  </center>
</div>
<?php include("../view/common/footer.php");?>
<script src = "http://localhost/studentmanagement/public/assets/js/jquery-3.4.1.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap-notify.js"></script>
<script>
action("menuhighlight", "register")
$("#form1").submit(function(k)  
{
// $('#form1').on('submit', function(){
k.preventDefault();
// alert("hai")
 $("#errors").empty()
var form = $('#form1')[0];
var formData = new FormData(form)
console.log(formData)
$.ajax(
{
url: "http://localhost/studentmanagement/controller/formback.php", 
type: 'POST',
data: formData,
contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+) submitButton
processData: false,
success: function (result) {
console.log('result',result)
result = JSON.parse(result)
console.log(result.ReturnCode)
if(result.ReturnCode == 200)
{
$('#form1')[0].reset();
reset();
 $.notify({
// icon: 'glyphicon glyphicon-star',
// message:result.Message,
},
{
type: "success",
});
$("#submitButton").button('reset');
 
}
else
{
$("#errors").empty()
$("#errors").append("Data fetching is not done, Please contact Admin") // Please remove the Admin from this message, because admin is fill this form to regiter
$("#submitButton").button('reset');
}
},
error: function (msg) {
$("#submitButton").button('reset');
 $("#errors").empty()
}
});
 });
 </script>
</body>
</html>





