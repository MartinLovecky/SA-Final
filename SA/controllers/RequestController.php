<?php

namespace Repse\Sa\controllers;

use Repse\Sa\tool\Mailer;
use Repse\Sa\http\Request;
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
        ) {}
    
    public function submitRegister(Request $request)
    {
        // Validator set messgaes if requets post is not valid
        $this->validator->validateRegister($request);
        $this->sanitizer->purify($request);
        if ($this->message->isNotEmpty()) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username,'old_email'=>$request->email,'message'=>$this->message->getMessages()];
            return false; 
        }
        //Progress with registration
        $hashPassword = password_hash($request->password,PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        $values = [
            'username'=>$this->sanitizer->username,
            'password'=>$hashPassword,
            'email'=>$this->sanitizer->email,
            'active'=>$activate,
            'permission'=>'user',
            'avatar'=>'empty_profile.png',
            'bookmarkCount'=>0,
            'visible'=>1
        ];
        $smtp = $this->db->con->insertInto('members')->values($values)->execute();
        $id = $this->db->getID($request->username);
        $this->db->con->close();
        $emailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views/emailTemplate/register.php');
        $body = str_replace(['YourUsername','MemberID','ActivisionHash','URL'],[$this->sanitizer->username,$id,$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
        $info = ['subject'=>'Potvrzení registrace','to'=>$this->sanitizer->email];
        if($this->email->sender($body,$info))
        {
            header("Location: /login?action=joined"); die;
        }
    
    }

    public function submitLogin(Request $request)
    {
        $this->validator->validateLogin($request);
        if ($this->message->isNotEmpty()) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username,'message'=>$this->message->getMessages()];
            return false; 
        }
        if ($request->remeber == 'yes') {
            setcookie('remeber',$request->username,time()+(86400 * 7),"/");
            $update = $this->db->con->update('members')->set(['remeber'=>'1'])->where('username',$request->username)->execute();
        }
        $memeberData = $this->db->getMemeberData($request->username);
        Member::setSession($memberData);
        header('Location: /member/'.$request->username.'?action=logged');
    }
}