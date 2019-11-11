<?php
session_start();
include("../config/connect.php"); 
$email=$_POST['email'];
$password=$_POST['password'];
$_SESSION['email']=$email;
$_SESSION['password']=$password;
//$query=mysqli_query($con,"select * from usermaster where user_email='$email'");
$query=mysqli_query($con,"select * from adminmaster where admin_email='$email'and admin_password='$password'");

//$user=mysqli_fetch_array($query);
$row=mysqli_fetch_array($query);
$adminid=$row["pk_admin_id"];
$_SESSION['pk_admin_id']=$adminid;
$adminname=$row["admin_name"];
$_SESSION['admin_name']=$adminname;
if($adminid)
{
    $array = array("ReturnCode"=>200,"Message"=>"Welcome back!");
 
    // echo  "<script>alert('login admin');document.location='../view/viewdetails.php';</script>";
}

else
{
    $array = array("ReturnCode"=>201,"Message"=>"Not a valid user");

    // echo"<script>alert('login failed');document.location='../view/login.php';</script>";
}
echo json_encode($array);
?>