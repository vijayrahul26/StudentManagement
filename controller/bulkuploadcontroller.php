<?php
session_start();
include("../config/connect.php");
function csvToJson($filepath)
{     // open csv file  
if (!($fp = fopen($filepath, 'r')))
{  
die("Can't open file...");   
}     
//read csv headers     
$key = fgetcsv($fp,"1024",",");  
// parse csv rows into array  
$json = array();      
while ($row = fgetcsv($fp,"1024",","))
{   
$json[] = array_combine($key, $row); 
}      
// release file handle  
fclose($fp);       
// encode array to json   
return json_encode($json);
}
date_default_timezone_set("Asia/Calcutta");
$date=date('d-m-Y');
$adminname=$_SESSION['admin_name'];
$adminid=$_SESSION['pk_admin_id'];
$adminemail=$_SESSION['email'];
if(isset($_FILES['file']))  
   {
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];
      $tmp = explode('.', $file_name);
      $file_ext = strtolower(end($tmp));
      $expensions= array("csv");
      $file_destination="../public/upload/".$file_name;
      $filepath="/public/upload/".$file_name;
     if(move_uploaded_file($file_tmp,$file_destination)) 
         {
           $csvToJson=csvToJson("http://localhost/studentmanagement/".$filepath);
            $csvToJson= json_decode($csvToJson,true);
             $datainsertedcount=0;
             $dataduplicatecount=0;
            $totaldatacount=count($csvToJson);
           $cou=mysqli_query($con,"INSERT INTO `countmaster`(`uploadedby`, `uploadedat`, `totaldatacount`, `datainsertedcount`, 
           `dataduplicatecount`,`status`)VALUES ('$adminid','$date','$totaldatacount','$datainsertedcount','$dataduplicatecount','$status')");
           $loadid=mysqli_insert_id($con);
          for($i = 0;$i<count($csvToJson);$i++)
            {
               $first= $csvToJson[$i]['FirstName'];
               $last=$csvToJson[$i]['LastName'];
               $email=$csvToJson[$i]['Email'];
               $mobile=$csvToJson[$i]['MobileNumber'];
               $gender=$csvToJson[$i]['Gender'];
               $year=$csvToJson[$i]['Year'];
               $dept=$csvToJson[$i]['Department'];
               $adminid=$_SESSION["pk_admin_id"];
               $status=0;
               $username = $first.' '.$last;
               $value="SELECT * FROM usermaster WHERE user_firstname='$first' and
               user_lastname='$last'and
               user_email='$email' and
               user_mobileno='$mobile' and
               user_gender='$gender' and 
               user_year='$year' and 
               user_dept='$dept' ";
               $result=mysqli_query($con,$value);
               $data=mysqli_fetch_array($result,MYSQLI_NUM);
               if($data[0] >= 1) 
               {
               $querys=mysqli_query($con,"INSERT INTO `errormaster`( `user_firstname`, `user_lastname`, `user_email`, `user_mobileno`, `user_gender`, 
               `user_year`, `user_dept`, `fk_admin_id`,`fk_loadid`, `status`)
               VALUES ('$first','$last','$email','$mobile','$gender','$year','$dept','$adminid','$loadid','$status')");
               $dataduplicatecount++;
               }
              else
               {
               $query=mysqli_query($con,"INSERT INTO `usermaster`( `user_firstname`, `user_lastname`, `user_email`, `user_mobileno`, `user_gender`, 
               `user_year`, `user_dept`, `fk_admin_id`, `status`)
               VALUES ('$first','$last','$email','$mobile','$gender','$year','$dept','$adminid','$status')");
              $datainsertedcount++;
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
              //$array = array("ReturnCode"=>200,"Message"=>"Data Inserted");pay
            }
         }
        }
      //  else
      // {
      //    $array = array("ReturnCode"=>201,"Message"=>"Data not Inserted ");
      // }
      if($dataduplicatecount==0) 
                    {
                        $array = array("ReturnCode"=>200,"Message"=>"Data Inserted sucessfully please check your mail","totalcount"=>"Total Data: ".$totaldatacount,"insertedcount"=>"Total Data Inserted: ".$datainsertedcount,"duplicatecount"=>"Duplicate Data: ".$dataduplicatecount);   
                        $update=mysqli_query($con,"UPDATE `countmaster` SET  `uploadedby`='$adminid',`uploadedat`='$date', 
                        `totaldatacount`='$totaldatacount',`datainsertedcount`='$datainsertedcount',`dataduplicatecount`='$dataduplicatecount', `status`='$status' where `pk_loadid`=`$loadid`");
                      $adminmail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                                                    <p>Hi <b>'.$adminname.'</b>,</p>
                                                  </td>
                                              </tr>
                                   <tr>
                                              <td width="735" align="left" valign="top">
                                              <p><b>Congratulations</b>, You have uploaded a file in student Management.</p>
                                              <p width="735"  valign="top">
                                                  Total Data Uploaded: '.$totaldatacount.'
                                              </p>
                                              <p width="735"  valign="top">
                                                  Total Data Inserted: '.$datainsertedcount.'
                                              </p>
                                              <p width="735"  valign="top">
                                                  Total Duplicate Count: '.$dataduplicatecount.'
                                              </p>
                                              <p>
                                                  Date: '.$date.'
                                              </p>
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
                                                     <p>Powered by <b><a href="http://http://localhost/studentmanagement/" target="_blank" style="color:  #00215B;">Student Management                                      System.</a></b></p>
                                                   </td>
                                                </tr>
                                          </table>
                                      </center>
                                  </body>
                                  </html>'; 
                                  include '../vendor/swiftmailer/lib/swift_required.php';
                                  $transporter = Swift_SmtpTransport::newInstance('secure.emailsrvr.com',587)
                                  ->setUsername('test@gmail.com')
                                  ->setPassword('test@123');
                                  $mailer = Swift_Mailer::newInstance($transporter);
                                  $message = Swift_Message::newInstance();
                                  $message->setTo(array(
                                  "$adminemail" => "Hi ". $adminname,
                                  ));
                                  $message->setSubject("Welcome");
                                  $message->setBody($adminmail,"text/html");
                                  $message->setFrom("norply@gmail.com",);
                                  $mailer->send($message, $failedRecipients);
                      }
                    else
                    {
                       $array = array("ReturnCode"=>200,"Message"=>"Data Inserted sucessfully, duplicate data found. please check your mail","totalcount"=>"Total Data: ".$totaldatacount,"insertedcount"=>"Total Data Inserted: ".$datainsertedcount,"duplicatecount"=>"Duplicate Data: ".$dataduplicatecount); 
                       $update=mysqli_query($con,"UPDATE `countmaster` SET  `uploadedby`='$adminid',`uploadedat`='$date', 
                       `totaldatacount`='$totaldatacount',`datainsertedcount`='$datainsertedcount',`dataduplicatecount`='$dataduplicatecount', `status`='$status' where `pk_loadid`=`$loadid`");
                     $adminmail = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
                                                   <p>Hi <b>'.$adminname.'</b>,</p>
                                                 </td>
                                             </tr>
                                  <tr>
                                             <td width="735" align="left" valign="top">
                                             <p><b>Congratulations</b>, You have uploaded a file in student Management.</p>
                                             <p width="735"  valign="top">
                                                 Total Data Uploaded: '.$totaldatacount.'
                                             </p>
                                             <p width="735"  valign="top">
                                                 Total Data Inserted: '.$datainsertedcount.'
                                             </p>
                                             <p width="735"  valign="top">
                                                 Total Duplicate Count: '.$dataduplicatecount.'
                                             </p>
                                             <p>
                                                 Date: '.$date.'
                                             </p>
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
                                                    <p>Powered by <b><a href="http://http://localhost/studentmanagement/" target="_blank" style="color:  #00215B;">Student Management                                      System.</a></b></p>
                                                  </td>
                                               </tr>
                                         </table>
                                     </center>
                                 </body>
                                 </html>'; 
                                 include '../vendor/swiftmailer/lib/swift_required.php';
                                 $transporter = Swift_SmtpTransport::newInstance('secure.emailsrvr.com',587)
                                 ->setUsername('test@gmail.com')
                                 ->setPassword('test@123');
                                 $mailer = Swift_Mailer::newInstance($transporter);
                                 $message = Swift_Message::newInstance();
                                 $message->setTo(array(
                                 "$adminemail" => "Hi ". $adminname,
                                 ));
                                 $message->setSubject("Welcome");
                                 $message->setBody($adminmail,"text/html");
                                 $message->setFrom("norply@gmail.com",);
                                 $mailer->send($message, $failedRecipients);
                      }
                  //$array = array("ReturnCode"=>200,"Message"=>"Data Inserted");  
   }
      echo json_encode ($array); 
     ?>