<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];


require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mail.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'logos-vlg@mail.ru';                 // Наш логин
$mail->Password = '37logos11';                           // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
 
$mail->setFrom('logos-vlg@mail.ru', 'School A+');   // От кого письмо 
$mail->addAddress('ladoga-vlg@mail.ru');     // Add a recipient
//$mail->addAddress('rasar@inbox.ru');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Данные';
$mail->Body    = '
		Пользователь оставил данные <br> 
	Имя: ' . $name . ' <br>
	E-mail: ' . $email . '<br>
	Номер телефона: ' . $phone . '<br>
	Сообщение: ' . $message .'';

if(!$mail->send()) {
    $message = 'Что-то пошло не так...';
} else {
    $message = 'Данные успешно отправлены';
}
$res = ['message' => $message];

header('Content-type: application/json');
echo json_encode($res);
?>