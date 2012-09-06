<?php
include ABS_PATH . 'libs/Swift/swift_required.php';

class Mailer {
    private $mailer;
    
    function __construct() {
        $this->mailer = Swift_Mailer::newInstance(Swift_MailTransport::newInstance());
    }
    
    public function send($to, $from, $subject, $plain_body, $html_body = '') {
        $message = Swift_Message::newInstance($subject)
            ->setTo($to)
            ->setFrom($from)
            ->setBody($plain_body);
        
        if ( $html_body !== '' ) {
            $message->addPart($html_body, 'text/html');
        }
        
        return $this->mailer->send($message);
    }
}
?>