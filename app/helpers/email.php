<?php if (!defined('BASE_PATH')) exit('No direct script access allowed');

use Snipworks\SMTP\Email;

require_once "../vendor/snipworks/php-smtp/src/email.php";

class emailHelp 
{
    public function __construct() 
    {
        // Empty constructor to avoid "Constructor cannot be static" error.
    }
    
    /*
     * @param $subject
     * @param $email
     * @param $body
     * @return status
     *
     * Sends SMTP Email.
     */
    public static function smtpMail($email, $subject, $body)
    {
        $mail = new Email(SMTP_PRIMARY_HOST, SMTP_PRIMARY_PORT);
        $mail->setProtocol(Email::TLS);
        $mail->setLogin(SMTP_PRIMARY_EMAIL, SMTP_PRIMARY_PASSWORD);
        $mail->addTo($email);
        $mail->setFrom('no-reply@email.com', 'user');
        $mail->setSubject($subject);
        $mail->setHtmlMessage($body);

        if ($mail->send()) {
            return true;
        } elseif (!function_exists('mail')) {
            $headers   = array();
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=UTF-8';
            $headers[] = 'From: no-reply@email.com';
            $headers[] = 'Reply-To: no-reply@email.com';
            mail($email, $subject, $body, implode("\r\n", $headers));
            return true;
        } else {
            return false;
        }
    }
    
    /*
     * @param $token
     * @param $emailData
     * @return parameters
     *
     * Dynamic Template Email.
     */
    public static function mailTemplateData($token, $emailData)
    {
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }
        $emailContent = strtr($emailData[0]['template'],$varMap);
        return $emailContent;
    }
    
}