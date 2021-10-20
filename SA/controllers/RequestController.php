<?php

namespace Repse\Sa\controllers;

use Repse\Sa\tool\Mailer;
use Repse\Sa\http\Request;
use eftec\bladeone\BladeOne;
use Repse\Sa\support\Sanitizer;
use Repse\Sa\support\Validator;
use Repse\Sa\support\MessageBag;
use Repse\Sa\databese\user\Member;

class RequestController{

    public function __construct(
        protected $db,
        protected Mailer $email,
        protected Validator $validator,
        protected Sanitizer $sanitizer,
        protected MessageBag $message,
        //protected BladeOne $blade,
        ) {}

    
    public function submitRegister(Request $request)
    {
        $this->validator->validateRegister($request);
        if ($this->message->isNotEmpty() || in_array('',$this->sanitizer->purify($request))) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username,'old_email'=>$request->email,'message'=>$this->message->getMessages()];
            
        }
    
            
        /*
        $hashPassword = password_hash($request->password,PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        $values = [
            'username'=>$this->sanitizer->username,
            'password'=>$hashPassword,
            'email'=>$this->sanitizer->email,
            'activate'=>$activate,
            'permission'=>'user',
            'avatar'=>'empty_profile.png',
            'bookmarkCount'=>0,
            'visible'=>1
        ];
        $smtp = $this->db->insertInto('members')->values($values)->execute();
        $id = $this->db->lastInsertId();
        $this->db->close();
        $emailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views/emailTemplate/register.php');
        $body = str_replace(['YourUsername','MemberID','ActivisionHash','URL'],[$this->sanitizer->username,$id,$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
        $info = ['subject'=>'Potvrzení registrace','to'=>$this->sanitizer->email];
        if($this->email->sender($body,$info))
        {
            header("Location: /login?action=joined");
        }*/
    }

    public function submitLogin(Request $request)
    {
        $login = $this->validator->validate($request);
        if(!$login)
        {
            @$_SESSION = [''];
            header("Location: /login");
            die;
        }
        $memeberData = $this->db->getMemeberData($request->username);
        Member::setSession($memberData);
        header('Location: /member/'.$request->username.'?action=logged');
    }
}