<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
       input[type=text],[type="tel"],[type="email"],[type="textarea"]
            {
    width:50%;
    padding:12px 20px;
    margin:8px 0;
    display:inline-block;
    border:1px solid black;
    border-radius:4px;
    box-sizing:border-box;
    }
    
    button[type=submit] {
    background-color:#4b40e7;
    color: white;
    padding:14px 20px;
    margin:8px 0;
    border:none;
    border-radius:4px;
    }
    .error{
      color:red;
    }
    </style>
</head>
<body>
<?php

$name_err=$phone_err=$email_err=$message_err=$subject_err="";


if(isset($_POST['btn']))
{
$name=$_REQUEST['name'];
$phone=$_REQUEST['phone'];
$email=$_REQUEST['email'];
$subject1=$_REQUEST['subject'];
$message1=$_REQUEST['message'];

if(strlen($name)==0)
 {
  $name_err = "Please enter your name";
 }
else{
if(!preg_match("/^[a-zA-Z-' ]*$/",$name))
 {
    $name_err = "Only letters allowed";
  }
}
if(!preg_match('/^[0-9]{10}+$/', $phone))
{
    $phone_err = "Enter valid number";
}

if(strlen($email)==0)
{
 $email_err = "Please enter your email";
}
else{
if (!filter_var($email, FILTER_VALIDATE_EMAIL))
 {
    $email_err = "Invalid email format";
  }
}
if(strlen($subject1)==0)
{
    $subject_err = "Enter subject detail";
}

if(strlen($message1)==0)
{
    $message_err = "Enter message";
}
if(!empty($_SERVER['HTTP_CLIENT_IP']))   //check for ip address shared by internet
{
  $ip = $_SERVER['HTTP_CLIENT_IP'];
}
else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //check for ip address proxy server
{
  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
  $ip = $_SERVER['REMOTE_ADDR'];
}

 if(strlen($name_err)==0 && strlen($phone_err)==0 && strlen($email_err)==0 && strlen($message_err)==0 && strlen($subject_err)==0)
{
$connect=mysqli_connect("localhost","root","","assignment");
$q=mysqli_query($connect,"insert into contact_form (name,phone,email,subject,message,ip_address) values('$name','$phone','$email','$subject1','$message1','$ip')");

if($q)
{
    echo "<h2 style='color:green;'>Succefully Submitted</h2><br>";
}

//smtp email code

$headers = "From: rajawatjyoti121@gmail.com";
$content = 'Enquiry details';
require_once('mailer/class.phpmailer.php');
$mail = new PHPMailer(); 
$mail->IsSMTP(); 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'ssl'; 
$mail->Host = "smtp.googlemail.com";
$mail->Port = 465; 
$mail->IsHTML(true);
$mail->Username = "rajawatjyoti121@gmail.com";
$mail->Password = "yizkatswpuivllsh";
$mail->SetFrom('rajawatjyoti121@gmail.com', "Contact Form");
$mail->AddReplyTo("rajawatjyoti121@gmail.com", "Contact Form"); 
$mail->AddAddress('test@techsolvitservice.com',"Virtual Softwares");

$mail->Subject    = "Contact form enquiry details";
$mail->AltBody    = "Message here..."; 
$message ="<div><center><br><br><b>-------------------Contact Form Enquiry -----------------------</b><br><br></center>
<left>Enquiry details listed below :<br><br>Name : $name<br>Email : $email<br>Phone : $phone<br>Subject : $subject1<br> Message: $message1<br><br>-------------------------------------------------------------------------------------------------------------<br></div>";

$mail->MsgHTML($message);
if($mail->send() == true){
  echo '';
}else{
  echo '<span style="color:red;">Error in sending details</span>';
}
}


}
 ?>


    <form method="post" action="">
      <h2>Contact Form</h2>
      <label>Full Name :</label>
      <br>
      <input type="text" name="name" placeholder="Enter your full name...">
      <span class="error"><?php echo $name_err; ?></span>
      <br>
      <label>Phone Number :</label>
      <br>
      <input type="tel" name="phone" placeholder="Enter your phone no...">
      <span class="error"><?php echo $phone_err; ?></span>
      <br>
      <label>E-mail :</label>
      <br>
      <input type="email" name="email" placeholder="Enter your email...">
      <span class="error"><?php echo $email_err; ?></span>
      <br>
      <label>Subject :</label>
      <br>
      <input type="text" name="subject" placeholder="Write subject...">
      <span class="error"><?php echo $subject_err; ?></span>
      <br>
      <label>Message :</label>
      <br>
      <textarea name="message" cols="83" rows="8" ></textarea>
      <span class="error"><?php echo $message_err; ?></span>
      <br>
      <button type="submit" name="btn">SUBMIT</button>
    </form>

   
</body>
</html>