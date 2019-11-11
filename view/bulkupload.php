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
#foot
{
    margin-top:30%;
}
</style>
<body>
<?php 
// session_start();
$adminname=$_SESSION['admin_name'];
include("../view/common/header.php");
?>
<div class="container">
<center>
<form class="form-horizontal" id="form1" name="form1" enctype="multipart/form-data" >
<fieldset>
  <legend>Upload Student Detail File(.csv)</legend>
<div class="form-group">
<h4><p class="control-label col-sm-6">
  <a href="http://localhost/studentmanagement/public/assets/file/StudentDetail.csv" >
     Sample Format Download<span class="glyphicon glyphicon-download-alt" style="font-size:20px;color:black"></span> 
        </a>
        </p>
        </h4>
   <br>
   <br>   
   <h4><label class="control-label col-sm-6" >Select file to upload:</label></h4>
   <div class="col-sm-2 col-md-1">
   <!-- <label class="btn-bs-file btn btn-sm btn-primary">
           Browse -->
                <input type="file" name="file" accept=".csv"   required>
            <!-- </label> -->
            <br>
  </div>
       <div class="col-sm-2 col-md-3">
       <input type="submit" name=button class="btn btn-info btn-small" id="submitButton" data-loading-text="Loading..."  value="Upload">
      <br>
     <p id="errors"></p>
       </div>
      </div>
      <label id="totalcount" style="margin-right: 306px;display:none"></label>   
      <label  id="insertedcount" style="margin-right: 245px;display:none"></label> 
      <label id="duplicatecount" style="margin-right: 270px;display:none"></label> 
</fieldset>
      </form>
      </center>
      <p id="foot">
<?php include("../view/common/footer.php");?>
</p>
      </div>

    <script src = "http://localhost/studentmanagement/public/assets/js/jquery-3.4.1.min.js"></script>
      <script src = "http://localhost/studentmanagement/public/assets/js/bootstrap.min.js"></script>
      <script src = "http://localhost/studentmanagement/public/assets/js/bootstrap-notify.js"></script>
      <script>
  //  action("menuhighlight", "bulkupload")
   $("#form1").submit(function(k) 
   {
// $('#form1').on('submit', function(){
k.preventDefault();
// alert("hai")
$("#submitButton").button('loading');
$("#errors").empty()
var form = $('#form1')[0];
var formData = new FormData(form)
console.log(formData)
$.ajax(
{
url: "http://localhost/studentmanagement/controller/bulkuploadcontroller.php", 
type: 'POST',
data: formData,
contentType: false, 
processData: false,
success: function (result) {
console.log('result',result)
result = JSON.parse(result)
console.log(result.ReturnCode)
if(result.ReturnCode == 200)
{
// $('#form1')[0].reset();
// reset();
 $.notify({
icon: 'glyphicon glyphicon-star',
message:result.Message,
},
{
type: "success",
});
$("#submitButton").button('reset');
$("#totalcount").append(result.totalcount)
$("#insertedcount").append(result.insertedcount)
$("#duplicatecount").append(result.duplicatecount)
$("#totalcount").css('display','block')
$("#insertedcount").css('display','block')
$("#duplicatecount").css('display','block')
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