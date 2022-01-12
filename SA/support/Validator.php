<?php

namespace Repse\Sa\support;

use Repse\Sa\http\Request;
use eftec\bladeone\BladeOne;
use Repse\Sa\support\MessageBag;
use Repse\Sa\databese\user\Member;

class Validator
{
    public function __construct(protected MessageBag $message, protected Member $member)
    {
    }
  
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
        if($this->propertiesExist($request) && $request->persistent_register == 'yes' && $this->validCSFR($request->_token))
        {
             if(!empty($request->username) &&
                !empty($request->email) &&
                !empty($request->password) && 
                !empty($request->password_again))
                {
                if (!$this->member->isUnique($request->username,$request->email)) {
                    $this->message->add(md5('Username'),'Jméno nebo email se již používá');
                }
                if(strlen($request->username) < 4 && strlen($request->username) > 35){
                    $this->message->add(md5('UsernameLen'),'Uživatelské jméno musí obsahovat nejméně 4 znaky a ne více jak 35');
                }
                if (!ctype_alnum($request->username)) {
                    $this->message->add(md5('UsernameNum'),'Uživatelské jméno musí obsahovat nejméně 1 číslo');
                }
                if (strlen($request->password) < 6 || strlen($request->password_again) < 6) {
                    $this->message->add(md5('PWDLen'),'Příliž krátké heslo. Musí obsahovat nejméně 6 znaků');
                }
                if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@$%^&]).*$/',$request->password)) {
                    $this->message->add(md5('PWDSpec'),'Heslo musí obasahovat nejméně jedno malé a velké písmeno a jeden specialní znak(!@$%^&)');
                }
                if ($request->password !== $request->password_again) {
                    $this->message->add(md5('PWDSpec'),'Heslo se neschoduje se neschoduje s heslem znovu');
                }
                if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    $this->message->add(md5('PWDSpec'),'Neplatný formát e-mailu');
                }
                return null;
            }
            $this->message->add(md5('Fail'),'Všechna pole musí být vyplneněna');
        }else
        {
            $this->message->add(md5('Persistent'),'Pro úspěšnou registraci musíte souhlasit se smluvními podmínkami a ochranou soukromí');
        }
    }

    public function validateLogin(Request $request)
    {
        if ($this->propertiesExist($request)  && $this->validCSFR($request->_token)) {
        # code   
        }
    }
}