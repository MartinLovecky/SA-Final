<?php

namespace Repse\Sa\controllers;

use Repse\Sa\tool\Mailer;
use Repse\Sa\http\Request;
use Repse\Sa\support\Validator;
use Repse\Sa\databese\user\Member;

class RequestController{

    public function __construct(protected $db,protected Mailer $email,protected Validator $validator,protected Sanitizer $sanitizer) {}

    public function submitRegister(Request $request)
    {
        // Validation doesnt clear data
        $validtRegister = $this->validator->validate($request);
        $sanitazedRequest = $this->sanitizer->purify($request);
        if(!$validtRegister || in_array('',$sanitazedRequest,true))
        {
            @$_SESSION = ['old_username'=>$request->username,'old_email'=>$request->email];
            header("Location: /register");
            die;
        }
        $hashPassword = password_hash($request->password,PASSWORD_BCRYPT);
        $activate = md5(uniqid(rand(),true));
        $values = [
            'username'=>$sanitazedRequest->username,
            'password'=>$hashPassword,
            'email'=>$sanitazedRequest->email,
            'activate'=>$activate,
            'permission'=>'user',
            'avatar'=>'empty_profile.png',
            'bookmarkCount'=>0,
            'visible'=>1
        ];
        $smtp = $this->db->insertInto('members')->values($values)->execute();
        $id = $this->db->lastInsertId();
        $this->db->close();
        $emailTemplate = file_get_contents(__DIR__ . '/views/emailTemplate/register.php');
        $body = str_replace(['YourUsername','MemberID','ActivisionHash','URL'],[$sanitazedRequest->username,$id,$activate,$_SERVER['DOCUMENT_ROOT']],$emailTemplate);
        $info = ['subject'=>'Potvrzení registrace','to'=>$sanitazedRequest->email];
        if($this->email->sender($body,$info))
        {
            header("Location: /login?action=joined");
        }
    }

    public function submitLogin(Request $request)
    {
        $login = $this->validator->validate($request);
        if(!$login)
        {
            // 
            @$_SESSION = [''];
        }
        $memeberData = $this->db->getMemeberData($request->username);
        Member::setSession($memberData);
        header('Location: /member/'.$request->username.'?action=logged');
    }
}