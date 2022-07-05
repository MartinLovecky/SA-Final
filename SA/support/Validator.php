<?php

namespace Repse\Sa\support;

use Repse\Sa\http\Request;
use Repse\Sa\databese\user\Member;

class Validator
{
    public function __construct(protected Member $member){}
  
    private function validCSFR(string $token)
    {
      $decoded_token = explode('|',base64_decode($token));
      $decoded_session = explode('|',base64_decode(strrev($_SESSION['_token'])));
      if (($decoded_token[1] === $decoded_session[1] && $decoded_token[1] === $_SERVER['REMOTE_ADDR']) && 
          ($decoded_token[2] === $decoded_session[2] && $decoded_token[2] === $_SERVER['SERVER_NAME'])) {
            return true;
      }
        return false;
    }

    private function propertiesExist(Request $request)
    {
        foreach (get_object_vars($request) as $key => $value) {
            if (property_exists($request, $key)) {
                return true;
            }
            return false;
        }
    }

    public function validateRegister(Request $request)
    {
        if($this->propertiesExist($request) && $request->persistent_register == 'yes' && $this->validCSFR($request->_token)){   
            if( !empty($request->username) &&
                !empty($request->email) &&
                !empty($request->password) && 
                !empty($request->password_again)
            ){
                if ($this->member->isUnique($request->username,$request->email)){
                    return dd( $this->member->isUnique($request->username,$request->email)); //'/regiter?action=Uexist';
                }
                if(strlen($request->username) < 4 && strlen($request->username) > 35){
                    return '/regiter?action=Ulen';
                }
                if (!ctype_alnum($request->username)) {
                    return '/regiter?action=UNum';
                }
                if (strlen($request->password) < 6 || strlen($request->password_again) < 6){
                    return '/regiter?action=PWDLen';
                }
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@$%^&]).*$/',$request->password)){
                    return '/regiter?action=PWDSpec';
                }
                if ($request->password !== $request->password_again){
                    return '/regiter?action=PWDAga';
                }
                if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)){
                    return '/regiter?action=FilterE';
                }
            }else{
                return '/regiter?action=FField';
            }
        }else{
            return '/regiter?action=Persistent';
        }
    }

    public function validateLogin(Request $request)
    {
        if ($this->propertiesExist($request) && $this->validCSFR($request->_token)) {
            if(!empty($request->username) && !empty($request->password))
            {
                if (!$this->member->exists($request->username)) {
                    return '/regiter?action=UNexist';
                }
            }
        }
    }
}