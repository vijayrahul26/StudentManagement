<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
<link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/bootstrap.min.css.">
<link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/login.css">
<title>Student Management</title>
</head>
<style>
body
{
	font-size:20px;
	overflow: hidden;
}
.form-left
      {
        width: 50%;
        height:700px;
        border-right: 3px; 
       background-color: #00215b;
        /* margin-bottom: 10px */
        float:left;
        }
 p.a {
     font-family: "Comic Sans MS", Times, serif;
     font-size: 150%;
     color:#FFFFFF;
     }  

</style>
<body>
<div class="form-left">
      <center> 
      <img src="http://localhost/studentmanagement/public/assets/image/sm.png" style="margin-bottom:10px;margin-top:25%" width="65%" height="60%"> 
      <p class="a">Student Management System</p>
</center> 
   </div>
	<!-- <div class="form-right"> -->
<div class="container" >
<div style="margin-top:90px;">
<form  name=studentmanagement id="validate" autocomplete="off"><br><br>
<p id="errors"style="font-size:30px;color:red;margin-left:35px;"></p>
<br>
<div class="form-group">
<label for="email"><b>Email</b></label><br>
<input type="email"id="email" name="email" required>
</div>
<br>
<div class="form-group">
<label for="password"><b>Password</b></label><br>
<input type="password" id="password" name="password" required>
</div>
<br>
<button class="btn btn-success" id="loginsubmit"  data-loading-text="<i class='fa fa-circle-o-notch' aria-hidden='true'></i> Loading...">Login</button>
<input type="reset"  value="RESET" id="reset" class="btn btn-danger">
</form>
</div>
</div>
<script src =  "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap.min.js"></script>
<script src = "http://localhost/studentmanagement/public/assets/js/bootstrap-notify.js"></script>
<script>
$("#validate").submit(function (k) {
$("#errors").empty()
k.preventDefault();
$("#loginsubmit").button('loading');
const email = $("#email").val();
const password = $("#password").val();
$.ajax({
type: 'POST',
url: 'http://localhost/studentmanagement/controller/loginback.php', 
data: {
email: email,
password: password
},
dataType: "JSON",
success: function (result) {
	console.log(result.ReturnCode)
if (result.ReturnCode == 200)
{
$("#email").val("");
$("#password").val("");
$("#loginsubmit").button('reset');
$.notify({
icon: 'glyphicon glyphicon-star',
message:result.Message,
 }, {
type: "success",
});
setTimeout(() => {
	window.location='http://localhost/studentmanagement/view/viewdetails.php'
}, 1000);
}
else
{
$("#errors").empty()
$("#errors").append(result.Message)
$("#loginsubmit").button('reset');
}
},
error: function (msg) {
$("#errors").empty()
$("#errors").append("Data fetching is not done, Please contact Admin")
$("#loginsubmit").button('reset');
}
});
})
</script>
</body>
</html>
