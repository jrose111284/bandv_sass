<?php
 session_start();
 require_once 'phpmailer/PHPMailerAutoload.php';

 $errors = [];

 if (isset($_POST['name'], $_POST['last'], $_POST['email'], $_POST['contact'], $_POST['message'])) {
   $fields = [
     'name' => $_POST['name'],
     'last' => $_POST['last'],
     'email' => $_POST['email'],
     'contact' => $_POST['contact'],
     'message' => $_POST['message']
 ];
 foreach ($fields as $field => $data) {
   if (empty($data)) {
     $errors[] = 'the ' . $field . ' field is required';
   }
 }
 if (empty($errors)) {
   $mail = new PHPMailer;

   $mail->isSMTP();
   $mail->SMTPAuth = true;

   $mail->Host = 'smtp.gmail.com';
   $mail->Username = 'bandvtest@gmail.com';
   $mail->Password = 'Davidessery';
   $mail->SMTPSecure = 'ssl';
   $mail->Port = 465;

   $mail->isHTML();

   $mail->Subject = 'Contact form submitted';
   $mail->Body = 'from: ' . $fields['name'] . $fields['last'] . $fields['contact'] . ' (' . $fields['email'] . ')<p>' . $fields['message'] . '</p>';

   $mail->FromName = 'contact';

   $mail->AddAddress('bandvtest@gmail.com', 'Jamie Rose');

   if ($mail->Send()) {
     header('Location: thanks.php');
     die();
   } else {
     $errors[] = "sorry somthing went wrong please try again";
   }
 }
 } else {
   $errors[] = "not working";
 }
 $_SESSION['errors'] = $errors;
 $_SESSION['fields'] = $fields;
header('Location: ./index.php');
 ?>
