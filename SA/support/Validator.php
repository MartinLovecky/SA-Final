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
      $decoded_session = explode('|',base64_decode($_SESSION['_token']));
      if ($decoded_token[0] === $decoded_session[0] && $decoded_token[1] === $decoded_session[1]) {
        return true;
      }
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

    private function emptyFields(array $fields) : bool
    {
        foreach ($fields as $filed => $value) {
            if (empty($value)) {
                return true;
            }
            return false;
        }
    }

    private function __empty($property)
    {
        return empty(($property));
    }

    public function validateRegister(Request $request)
    {
        if($this->propertiesExist($request) && $request->persistent_register === 'yes' && $this->validCSFR($request->_token))
        {
            if (!$this->__empty($request->username) &&
                !$this->__empty($request->email) &&
                !$this->__empty($request->password) && 
                !$this->__empty($request->password_again)
                ) {
                if (!$this->member->isUnique($request->username,$request->email)) {
                    $this->message->add(md5('Username'),'Jméno nebo email se již používá');
                }
            }
            $this->message->add(md5('Fail'),'Pole není vyplneno');
        }
        $this->message->add(md5('Persistent'),'Pro registraci musíte souhlasit Smluvními podmínkami a Ochranou soukromí');
        
    }
}