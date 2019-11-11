<?php 
session_start();
include("../config/connect.php");
$email=$_SESSION['email'];
// $adminname=$_SESSION['admin_name'];
if(!$email)
{
    echo "<script>document.location='../index.php';</script>";
}
$adminid=$_SESSION['pk_admin_id'];
$querys=mysqli_query($con,"select * from usermaster  where fk_admin_id='$adminid' and status='0' ORDER BY pk_user_id DESC");
//$email=$_POST['email'];
//$password=$_POST['password'];
$email=$_SESSION['email'];
$password=$_SESSION['password'];
$adminname=$_SESSION['admin_name'];
//echo $adminname;
$query=mysqli_query($con,"select * from adminmaster where admin_email='$email'and admin_password='$password'");
//$row=mysqli_fetch_array($query);
?>
<html>
<head>
<link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
 <link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/bootstrap.min.css.">
<!-- <link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/viewdetails.css"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
<title>Student Management</title>
<style>
#foot
{
    margin-top:21%;
}
tbody{
    font-size:13px;
}
thead{
    font-size:13px;
}
</style>
</head>
<body>
<?php include("../view/common/header.php");?>
<table id="tableview" class="table table-striped table-bordered" style="width:100%">
<center>
<h3>Student Detail</h3><br>
</center>
<thead>
<tr><th>Si</th><th>FirstName</th><th>LastName</th><th>Email</th><th>MobileNumber</th><th>Gender</th><th>Year</th><th>Department</th><th>Image</th><th>CreatedAt</th><th>ACTION</th></tr></thead>
<tbody>
<?php
$url="http://localhost/studentmanagement";
$i=1;
while($row=mysqli_fetch_array($querys))
{?>
<tr><td><?php echo $i; ?></td>
<td><?php echo $row['user_firstname']; ?></td>
<td><?php echo $row['user_lastname']; ?></td>
<td><?php echo $row['user_email']; ?></td>
<td><?php echo $row['user_mobileno']; ?></td>
<td><?php echo $row['user_gender']; ?></td>
<td><?php echo $row['user_year']; ?></td>
<td><?php echo $row['user_dept']; ?></td>
<td><img width="100px" height="100px" src="<?php echo $url.$row['user_image']; ?>"
onError="this.onerror=null;this.src='http://localhost/studentmanagement/public/assets/image/noimage.png';" alt="image">
</td>
<td><?php echo $row['created_at']; ?></td>
<td><a href="../view/edit.php?id=<?php echo $row['pk_user_id'];?>"class="glyphicon glyphicon-pencil"  style="font-size:25px;color:green"></a>
<a href="../view/delete.php?id=<?php echo $row['pk_user_id'];?>"class="glyphicon glyphicon-trash"  style="font-size:25px;color:red" onclick="return confirm('Are you sure you wish delete your details?');"></a></td></tr>
<a href="../view/export.php?id=<?php echo $row['pk_user_id'];?>"class="glyphicon glyphicon-download-alt"  style="font-size:25px;color:blue"></a></td></tr>
<!-- <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" id="edit_<?php echo $row['pk_user_id'];?>" onclick="edit(this.id)">Edit</button>
<button type="button" class="btn btn-danger" id="delete_<?php echo $row['pk_user_id'];?>" onclick="delete(this.id)">Delete</button></td></tr> -->
<?php
$i++;}?>
</tbody>
</table>
<?php include("../view/common/footer.php");?>
<script>
$("#tableview").DataTable();
action("menuhighlight", "detailview")
</script>
</body>
</html>