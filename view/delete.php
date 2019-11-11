<?php
include ('../config/connect.php');

$id=$_GET['id'];
$query = "Update usermaster set status=1 where pk_user_id='$id'";
if(mysqli_query($con,$query)) {
header("location:../view/viewdetails.php");
}
 else
  {
echo "unable to delete!";
}
?>