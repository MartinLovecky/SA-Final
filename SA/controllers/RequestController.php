<?php

namespace Repse\Sa\controllers;

use Repse\Sa\databese\DB;
use Repse\Sa\tool\Mailer;
use Repse\Sa\http\Request;
use Repse\Sa\support\Validator;
use Repse\Sa\databese\user\Member;


class RequestController{

    public function __construct(
        protected DB $db,
        protected Mailer $email,
        protected Validator $validator) {}
    
    public function submitRegister(Request $request)
    {
        // Best solution for now
        $header = $this->validator->validateRegister($request);
        if (isset($header)) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username,'old_email'=>$request->email];
            header("Locaction: $header"); die;
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
        $header = $this->validator->validateLogin($request);
        if (isset($header)) {
            //Variables that we want display after redirect store to SESSION ... !!! never store password
            @$_SESSION = ['style'=>'danger','old_username'=>$request->username];
            header("Locaction: $header"); die;
        }
        if (isset($request->remeber) && $request->remeber == 'yes') {
            setcookie('remeber',$request->username,time()+(86400 * 7),"/");
            $this->db->con->update('members')->set(['remeber'=>'1'])->where('username',$request->username)->execute();
        }
        $memberData = $this->db->getMemeberData($request->username);
        Member::setSession($memberData);
            header('Location: /member/'.$request->username.'?action=logged');
    }

    public function reset_send(Request $request)
    {
        //TODO: VALIDATION of email,Suplytoken
        $stmt = $this->db->con->from('members')->select(['memberID','username'])->where('email',$request->email)->execute();
        $data = $stmt->fetchAll();
        $token = md5(uniqid(rand(), true));
        $activate  = hash('SHA256', ($token));
        // /resetPassword?action=Suplytoken&x=MemberID
        $emailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views/emailTemplate/pwd_reset.php.php');
        $body = str_replace(['YourUsername','MemberID','Suplytoken','URL'],[$data['username'],$data['memberID'],$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
        $info = ['subject'=>'Reset hesla','to'=>$request->email];
        // SEND EMAIL WITH link 
        if($this->email->sender($body,$info)){
            $set = ['resetToken'=>$activate,'resetComplete'=>'no'];
            $stmt = $this->db->con->update('members')->set($set)->where('email',$request->email)->execute();
            if($stmt){
                header("Location: /reset?action=Esend"); die;
            }
        }else{ 
            header("Location: /reset?action=Enotsend"); die;
        }
    }

    public function reset_pwd(Request $request)
    {
        $set = [];
        $stmt = $this->db->con->update('members')->set($set)->where('memberID',$request->memberID)->execute();
        // check if emil exist and send link to reset account
        // /resetPassword?action=Suplytoken&x=MemberID
        //$emailTemplate = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/views/emailTemplate/register.php');
        //$body = str_replace(['YourUsername','MemberID','Suplytoken','URL'],[$this->request->username,$id,$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
    }
}