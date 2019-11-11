<?php
session_start();
include("../config/connect.php");
  $first=$_POST['firstNameTextField'];
  $last=$_POST['lastNameTextField'];
  $email=$_POST['emailUserNameTextField'];
  $mobile=$_POST['userPhoneNumberTextField'];
  $gender=$_POST['gender'];
  $year=$_POST['year'];
  $dept=$_POST['department'];
  $username = $first.' '.$last;
  $status=0; 
  $adminid=$_SESSION["pk_admin_id"];
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
     $query=mysqli_query($con,"INSERT INTO `usermaster`( `user_firstname`, `user_lastname`, `user_email`, `user_mobileno`, `user_gender`, 
     `user_year`, `user_dept`, `user_image`, `fk_admin_id`, `status`)
     VALUES ('$first','$last','$email','$mobile','$gender','$year','$dept','$filepath','$adminid','$status')");
                   $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                   <html xmlns="http://www.w3.org/1999/xhtml">
                   <head>
                       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                       <title>eDoc::Student Management</title>
                       <link rel="icon" href="http://localhost/studentmanagement/public/assets/image/fav.png" type="image\png" sizes="16x16">
                       <style type="text/css">
                           body
                           {
                              font-family: "Helvetica", sans-serif;
                               font-size:16px;
                               line-height: 25px;
                           }
                           * {
                               outline: none;
                               border:none;
                           }
                           img {
                               border: none;
                               display: block;
                           }
                           p {
                               margin: 0;
                               padding: 10px; 
                               font-size: 14px;
                               color:  #00215B;
                               font-family: "Helvetica", sans-serif;
                           }
                       </style>
                   </head>
                   <body style="background: #03a9f405;">
                       <center>
                           <table width="735" border="0" cellspacing="0" cellpadding="0" style="background:#ffffff;padding: 20px;margin-top:15px;margin-bottom: 10px">
                               <tr>
                                   <td width="735" align="center" valign="top"><img src="http://oreference.com/wp-content/uploads/2016/08/Student.png" width="150" style="padding:20px" alt="Logo" /></td>
                               </tr>
                               <tr>
                                   <td width="735" align="left" valign="top">
                                     <p>Hi <b>'.$username.'</b>,</p>
                                   </td>
                               </tr>
                               <tr>
                                   <td width="735" align="left" valign="top">
                                     <p><b>Congratulations</b>, You have been selected for next level of process.</p>
                                   </td>
                                 </tr>
                                   <tr>
                                   <td width="735" align="left" valign="top" style="padding-top: 10px">
                                 <p>If you have any questions related to portal access and user account, please contact us at <b><a href="#" target="_blank" style="color:  #00215B;">studentmanagement@yahoo.com</a></b></p>
                               </td>
                             </tr>
                                 <tr>
                                   <td width="735" align="left" valign="top">
                                     <p>Thank you,</p>
                                     <p>'.$_SESSION['admin_name'].',</p> 
                                     <p>Student Management</p>
                                   </td>
                                 </tr>
                           </table>
                           <table width="735" border="0" cellspacing="0" cellpadding="0" style="background:#efefef;padding: 20px">
                              <tr>
                                   <td width="735" align="center" valign="top">
                                     <p style="padding: 8px">No 26 Dooming street, Santhome - 600004</p>
                                   </td>
                                 </tr>
                                 <tr>
                                    <td width="735" align="center" valign="top">
                                      <p>Powered by <b><a href="http://http://localhost/studentmanagement/" target="_blank" style="color:  #00215B;">Student Management System.</a></b></p>
                                    </td>
                                 </tr>
                           </table>
                       </center>
                   </body>
                   </html>'; 
                   include '../vendor/swiftmailer/lib/swift_required.php';
                   // Create the SMTP configuration
                   $transporter = Swift_SmtpTransport::newInstance('secure.emailsrvr.com',587)
                   ->setUsername('test@gmail.com')
                   ->setPassword('test@123');
                   $mailer = Swift_Mailer::newInstance($transporter);
                   $message = Swift_Message::newInstance();
                   $message->setTo(array(
                   "$email" => "HI". $first,
                    ));
                   $message->setSubject("Welcome");
                   $message->setBody($html,"text/html");
                   $message->setFrom("norply@gmail.com",);
                   $mailer->send($message, $failedRecipients);
                   $array = array("ReturnCode"=>200,"Message"=>"Data Inserted");
                 }
        else
           {
              $array = array("ReturnCode"=>201,"Message"=>"Data not Inserted ");
           }
   echo json_encode($array);
?>