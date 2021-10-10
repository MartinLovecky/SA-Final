<?php

namespace Repse\Sa\tool;

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer{

    private string $email;
    private string $password;

    public function __construct(){
        $this->email = $_ENV['EMAIL_NAME'];
        $this->password = $_ENV['EMAIL_PWD'];
    }

    public function subject($subject)
    {
        $this->Subject = $subject;
    }

    public function body($body)
    {
        $this->Body = $body;
    }

    public function sender($body,$email)
    {
        $this->IsSMTP();
        $this->body($body);
        $this->Host = 'smtp.seznam.cz';
        $this->SMTPDebug = false;
        $this->CharSet = 'utf-8';
        $this->SMTPAuth = true;
        $this->Username = $this->email;
        $this->Password = $this->password;
        $this->SMTPSecure = 'ssl';
        $this->Port = 465;
        $this->subject($email['subject']);
        $this->isHTML(true);
        $this->setFrom($this->email,'sadventure.com');
        $this->addAddress($email['to']);
        //$this->addAttachment
            return parent::send();
    }

}
