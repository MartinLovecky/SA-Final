<?php

namespace Repse\Sa\support;

use eftec\bladeone\BladeOne;
use Repse\Sa\support\MessageBag;
use Repse\Sa\databese\user\Member;

class Validator {

    public function __construct(protected MessageBag $message, protected BladeOne $blade, protected Member $member){}

    private function validCSFR()
    {
        $valid = $this->blade->csrfIsValid();
        if (!$valid)
        {
            return false;
        }
            return true;
    }

    private function emptyFields(array $fields) : bool
    {
        foreach ($fields as $filed => $value)
        {
            if(empty($value))
            {
                return true;
            }
                return false;
        }
    }

    private function __empty($property)
    {
        return empty(($property));
    }

    public function validate(Request $request)
    {
        //default value for validate is false
        $validate = false;
        switch ($request->type) {
            case 'register':
                //$username = trim(htmlspecialchars($request->username,'ENT_QUOTES','UTF-8'));        
                $validate = $this->register($request);
                break;
            
            default:
                return $validate;
                break;
        }
    }

    private function register(Request $request)
    {
        if($request->persisted_register == 'yes')
        {
            if($this->validCSFR()&&
               !$this->__empty($request->email) &&
               !$this->__empty($request->password) &&
               !$this->__empty($request->password_again) &&
               !$this->__empty($request->username))
            {
                //Check for unique username and email
                if(!$this->member->isUnique($request->username,$request->email))
                    $this->message->style('danger')->add('UniqueMember','');
                    return false;
                if(strlen($request->username < 4) || strlen($request->username > 35))
                    $this->message->style('danger')->add('ShortUsername','');
                    return false;
                if(!ctype_alnum($request->username))
                    $this->message->style('danger')->add('NumerInUsername',''); 
                    return false;
                if(mb_strlen($request->password) < 6)
                    $this->message->style('danger')->add('ShortPassword',''); 
                    return false;
                if($request->password === $request->password_again)
                    $this->message->style('danger')->add('ShortPassword',''); 
                    return false;
                if(!filter_var($request->email,FILTER_VALIDATE_EMAIL))
                    $this->message->style('danger')->add('ShortPassword',''); 
                    return false;
                //if everythink is okey return true
                return true;    
            }
            $this->message->style('danger')->add('fields','');
            return false; 
        }
            $this->message->style('danger')->add('presisted','');
            return false;  
    }



}