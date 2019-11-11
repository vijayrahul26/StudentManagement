<?php
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 
{
    echo "<script>document.location='http://localhost/studentmanagement/index.php';</script>";
}

?>

</body>
</html>