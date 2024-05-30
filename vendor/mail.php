<?php
require_once(__DIR__.'/autoload.php');
$dotenv=Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


use PHPMailer\PHPMailer\PHPMailer;
$mail = new PHPMailer(true);
//Server settings
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
$mail->isSMTP();                                            //Send using SMTP
$mail->Host = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
$mail->SMTPAuth = true;                                   //Enable SMTP authentication
$mail->Username = $_ENV["LOGINSMTP"];                     //SMTP username
$mail->Password =$_ENV["PASSWORDSMTP"];                               //SMTP password
$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//Recipients
$mail->setFrom('marwane.assou@gmail.com', 'Assou');
$mail->addAddress('marwane.assou@e-polytechnique.ma', 'Marwane');     //Add a recipient
$mail->addBCC('marwane.assou@e-polytechnique.ma');

$mail->isHTML(true);                                  //Set email format to HTML
$mail->Subject = 'Here is the subject';
$mail->Encoding = 'base64';

$mail->Body = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
try{
$mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



// $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// $apiInstance = new SendinBlue\Client\Api\ContactsApi(
//     new GuzzleHttp\Client(),
//     $config
// );
// $createContact = new \SendinBlue\Client\Model\CreateContact(); // \SendinBlue\Client\Model\CreateContact | Values to create a contact
// $createContact['email'] = 'marwane.assou@e-polytechnique.com'; // Email address of the user
// $createContact['listIds'] = array(2,3,4); // Ids of the lists to add the contact to
// try {
//     $result = $apiInstance->createContact($createContact);
//     print_r($result);
// } catch (Exception $e) {
//     echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage(), PHP_EOL;
// }










   
?>