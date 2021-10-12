<?php

namespace Repse\Sa\support;

use Repse\Sa\http\Request;
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
                return $this->register($request);
                break;
        }
    }

    private function register(Request $request)
    {
        if(property_exists($request,'persisted_register'))
        {
            if(/*$this->validCSFR() &&*/
               !$this->__empty($request->email) &&
               !$this->__empty($request->password) &&
               !$this->__empty($request->password_again) &&
               !$this->__empty($request->username) &&
               $request->persisted_register === 'yes')
               {
                if (!$this->member->isUnique($request->username, $request->email)) {
                    $this->message->style('danger')->add('UniqueMember', 'Uživatelské jméno nebo email se již používá');
                    return false;
                }
                if (strlen($request->username) < 4 || strlen($request->username) > 35) {
                    $this->message->style('danger')->add('ShortUsername', 'Uživatelské jméno musí obsahovat nejméne 4 znaky (ne více jak 35)');
                    return false;
                }
                if (!ctype_alnum($request->username)) {
                    $this->message->style('danger')->add('NumerInUsername', 'Uživatelské jméno musí obsahovat číslici');
                    return false;
                }
                if (strlen($request->password) < 6) {
                    $this->message->style('danger')->add('Password','Heslo je příliž krátké min délka je 6 znaků');
                    return false;
                }
                if($request->password !== $request->password_again){
                    $this->message->style('danger')->add('PasswordAgain', 'Hesla se neschodují');
                    return false;
                }
                if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$%^&]).*$/',$request->password))
                {
                    $this->message->style('danger')->add('PasswordSpecChars', 'Heslo musí obsahovat minimálně jeden malý,velký a speciální znak');
                    return false;
                }
                if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                    $this->message->style('danger')->add('Email', 'Nesprávný email');
                    return false;
                }
                return true;   
            }
            $this->message->style('danger')->add('field','Všecha pole musí být vyplněna');
            return false; 
        }
            $this->message->style('danger')->add('presisted','Bez souhlasu s VOP & Terms nelze dále pokračovat');
            return false;  
    }



}