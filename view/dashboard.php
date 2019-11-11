<?php
include("../config/connect.php");
session_start();
$email=$_SESSION['email'];
$adminname=$_SESSION['admin_name'];
if(!$email)
{
    //echo "<script>alert('please login again');document.location='../index.php';</script>";
}
?>
<!DOCTYPE HTML>
<html>
<link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
<title>Student Management</title>
<style>
 body
{
background-image: url("http://localhost/studentmanagement/public/assets/image/under-construction-dark.jpg");
background-size: cover;
background-repeat: no-repeat;
color:white ;
}
#foot
{
    margin-top:45%;
}
</style>
<head>
<body>
<?php 

include("../view/common/header.php");
?>
<!-- <h1 align="center">
<b>UNDER CONSTRUCTION</b>

</h1> -->
<p id="foot">
<?php 

include("../view/common/footer.php");?>
</p>
<script>
 action("menuhighlight", "dashboard")
 $("#copyright").css("color","white")
</script>
</body>
</html>