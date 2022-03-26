<?php

namespace Repse\Sa\controllers;

use Repse\Sa\databese\DB;
use Repse\Sa\tool\Mailer;
use Repse\Sa\http\Request;
use Repse\Sa\support\Validator;
use Repse\Sa\databese\user\Member;
use Repse\Sa\support\Messages;

class RequestController{

    public function __construct(
        protected DB $db,
        protected Mailer $email,
        protected Validator $validator,
        protected Messages $message) {}
    
    public function submitRegister(Request $request)
    {
        // Validator set messgaes if requets post is not valid
        $this->validator->validateRegister($request);
        if ($this->message->isNotEmpty()) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username,'old_email'=>$request->email];
            return false; 
        }
        //Progress with registration
        $hashPassword = password_hash($request->password,PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        $values = [
            'username'=>$this->request->username,
            'password'=>$hashPassword,
            'email'=>$this->request->email,
            'active'=>$activate,
            'permission'=>'user',
            'avatar'=>'empty_profile.png',
            'bookmarkCount'=>0,
            'visible'=>1
        ];
        
        $this->db->con->insertInto('members')->values($values)->execute();
        $id = $this->db->getID($request->username);
        //Parse data to email template and send email
        $emailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views/emailTemplate/register.php');
        $body = str_replace(['YourUsername','MemberID','ActivisionHash','URL'],[$this->request->username,$id,$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
        $info = ['subject'=>'Potvrzení registrace','to'=>$this->request->email];
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
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username];
            return false; 
        }
        if (isset($request->remeber) && $request->remeber == 'yes') {
            setcookie('remeber',$request->username,time()+(86400 * 7),"/");
            $this->db->con->update('members')->set(['remeber'=>'1'])->where('username',$request->username)->execute();
        }
        $memberData = $this->db->getMemeberData($request->username);
        Member::setSession($memberData);
            header('Location: /member/'.$request->username.'?action=logged');
    }
}