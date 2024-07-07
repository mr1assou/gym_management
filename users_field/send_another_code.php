<?php
    include '../vendor/connect.php'; 
    include '../functions/functions.php';
    require __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable('../vendor');
    $dotenv->load();
    use PHPMailer\PHPMailer\PHPMailer;
    $verificationCode=rand(100000, 999999);
    $query="{CALL sendAnotherCode (?,?)}";
    $result=sqlsrv_query($conn,$query,array($_GET['email'],$verificationCode));
    $mail = new PHPMailer(true);
    $mail->isSMTP();                                           
    $mail->Host = 'smtp-relay.brevo.com';                    
    $mail->SMTPAuth = true;                                 
    $mail->Username = $_ENV["LOGINSMTP"];                    
    $mail->Password =$_ENV["PASSWORDSMTP"];                             
    $mail->SMTPSecure = 'ssl';            
    $mail->Port = 465;                
    $mail->setFrom('marwane.assou@gmail.com', 'Gym Manager');
    $mail->addAddress($_GET['email'],"");
    $mail->addBCC($_GET['email']);
    $mail->isHTML(true);
    $mail->Subject = 'Verification Code';
    $mail->Encoding = 'base64';
    $mail->Body = 
    '
    <div style="display: flex;justify-content: center;">
        <div style="display:flex;flex-direction: column;align-items: center;background-color: #eee;width: 50%;border-radius: 2%;padding:10px;">
            <p style="font-weight:bold;">Code:<b style="color:#00FC3A;font-size:20px;font-weight:bold;">'.$verificationCode.'</b></p>
            </div>
        </div>
    ';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    try{
    $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    if(!isset($_GET['status']))
        header('Location:./verification.php?email='.$_GET['email'].'&language='.$_GET['language'].''); 
    else
        header('Location:./verification.php?email='.$_GET['email'].'&status=change_password&language='.$_GET['language'].'');