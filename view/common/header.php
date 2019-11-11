<html>
<head>
  <title>Student Management</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/studentmanagement/public/assets/css/header.css">
  <!-- <link rel="stylesheet" href=" https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
</div>
    <ul class="nav navbar-nav">
     <li class="menuhighlight" id="register"><a href="http://localhost/studentmanagement/view/registerform.php">Register</a></li>
     <li class="menuhighlight" id="detailview" ><a href="http://localhost/studentmanagement/view/viewdetails.php">Detail View</a></li>
       <li class="menuhighlight" id="bulkupload"><a href="http://localhost/studentmanagement/view/bulkupload.php">Bulk Upload</a></li>
      </ul>
    <ul class="nav navbar-nav navbar-right">
    <li style="color:white;margin-top:16px;">
    <?php 
    $adminname=$_SESSION['admin_name'];
    echo "  Hello  ".$adminname;
    ?>
    </li>
   <li><a href="http://localhost/studentmanagement/controller/logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<script src ="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src ="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src ="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script> 
function action(classname, idname)
{
  $("."+classname).removeClass("active")
  $("#"+idname).addClass("active")
}
</script>
 </body>
</html>
