<?php

namespace Lynx\System\Mail;

use Lynx\System\Exception\ApplicationException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Lynx\System\View\View;
use Lynx\System\Set\Set;

class Mail {

    public static function sendTemplate($to, $subject, $template, $data, $from = null, $cc = null, $bcc = null, $replyTo = null, $attachments = null)
    {
        $message = View::render($template, $data);
        return self::send($to, $subject, $message, $from, $attachments, $cc, $bcc, $replyTo);

    }


    public static function send($to, $subject, $message, $from = null, $attachments  = null, $cc = null, $bcc = null, $replyTo = null)
    {
        // $mail = new PHPMailer(true);

        // try {

        //     $mail->SMTPDebug = 0;                                       
        //     $mail->isSMTP();                                            
        //     $mail->Host       = env('MAIL_HOST');                  
        //     $mail->SMTPAuth   = true;             
        //     $mail->Username   = env('MAIL_ADDRESS');              
        //     $mail->Password   = env('MAIL_PASSWORD');             
        //     $mail->SMTPSecure = env('MAIL_ENCRYPTION');           
        //     $mail->Port       = env('MAIL_PORT');                 

        //     $mail->setFrom($from ?? env('MAIL_ADDRESSS'));
        //     $mail->addAddress($to);                                     
        //     $mail->addReplyTo($replyTo ?? env('MAIL_ADDRESS'));

        //     if($cc){
        //         $mail->addCC($cc);
        //     }

        //     if($bcc){
        //         $mail->addBCC($bcc);
        //     }

        //     if($attachments){
        //         foreach($attachments as $attachment){
        //             $mail->addAttachment($attachment);
        //         }
        //     }

        //     $mail->isHTML(true);                                        // Set email format to HTML
        //     $mail->Subject = $subject;
        //     $mail->Body    = $message;
        //     $mail->AltBody = strip_tags($message);

        //     $mail->send();
        //     return true;
        // } catch (\Exception $e) {
        //     return new ApplicationException($mail->ErrorInfo,'Lynx/System/Exception/MailerException.php',400);
        // }
    }

}
