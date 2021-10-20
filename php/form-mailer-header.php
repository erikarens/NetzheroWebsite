<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.strato.de';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'anfrage@netzhero.de';                     //SMTP username
    $mail->Password   = 'yeL5wxW.5jijWhy';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('anfrage@netzhero.de', 'Anfrage auf Netzhero');
    $mail->addAddress('info@netzhero.de');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject  = 'Webdesign / Website ='.$_POST['services1-0'];
    $mail->Subject .= 'Webbasierte Softwarelösungen ='.$_POST['services2-0'];
    $mail->Subject .= 'SEO ='.$_POST['services3-0'];

    $mail->Body    = 'Name= ';
    $mail->Body   .= $_POST['name1'];
    $mail->Body   .= ' Email= ';
    $mail->Body   .= $_POST['mail1'];
    $mail->Body   .= ' Nachricht= ';
    $mail->Body   .= $_POST['text1'];

    $mail->send();
    //echo 'Anfrage wurde gesendet!';
    header('Location: ../index.html');
    exit();
} catch (Exception $e) {
    echo "Anfrage konnte nicht gesendet werden. Mailer Error: {$mail->ErrorInfo}";
}