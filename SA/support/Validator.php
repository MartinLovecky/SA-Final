<?php

namespace Repse\Sa\support;

use Repse\Sa\http\Request;
use Repse\Sa\databese\user\Member;

class Validator
{
    public function __construct(protected Member $member)
    {
    }
  
    private function validCSFR(string $token)
    {
        $decoded_token = explode('|', base64_decode($token));
        $decoded_session = explode('|', base64_decode(strrev($_SESSION['_token'])));
        if (($decoded_token[1] === $decoded_session[1] && $decoded_token[1] === $_SERVER['REMOTE_ADDR']) &&
          ($decoded_token[2] === $decoded_session[2] && $decoded_token[2] === $_SERVER['SERVER_NAME'])) {
            return true;
        }
        return false;
    }

    private function propertiesExist(Request $request)
    {
        foreach(get_object_vars($request) as $key => $value) {
            if (property_exists($request, $key)) {
                return true;
            }
            return false;
        }
    }

    public function validateCaptcha(Request $request)
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
          'secret' => $_ENV['RECAPTCHA'],
          'response' => $request->grecaptcharesponse,
          'remoteip' => $_SERVER['REMOTE_ADDR']
        ];
        $options = array(
            'http' => array(
              'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              'method'  => 'POST',
              'content' => http_build_query($data))
            );
        # Creates and returns stream context with options supplied in options preset
        $context  = stream_context_create($options);
        # file_get_contents() is the preferred way to read the contents of a file into a string
        $response = file_get_contents($url, false, $context);
        # Takes a JSON encoded string and converts it into a PHP variable
        $res = json_decode($response, true);
        if (!$res['success']) {
            $err =  $res['error-codes'];
            foreach ($err as $msg) {
                return $msg;
            }
        }
        return null;
    }

    public function validateRegister(Request $request)
    {
        if ($this->propertiesExist($request) &&
            $this->validCSFR($request->_token)&&
            $request->persistent_register == 'yes') {
            if ($this->member->isUnique($request->username, $request->email != null)) {
                return '/register?action=Uexist';
            }
            if (strlen($request->username) < 4 && strlen($request->username) > 35) {
                return '/register?action=Ulen';
            }
            if (!ctype_alnum($request->username)) {
                return '/register?action=UNum';
            }
            if (strlen($request->password) < 6 || strlen($request->password_again) < 6) {
                return '/register?action=PWDLen';
            }
            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@$%^&]).*$/', $request->password)) {
                return '/register?action=PWDSpec';
            }
            if ($request->password !== $request->password_again) {
                return '/register?action=PWDAga';
            }
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                return '/register?action=FilterE';
            }
        }
        return '/register?action=FField';
    }

    public function validateLogin(Request $request)
    {
        if ($this->propertiesExist($request) && 
            $this->validCSFR($request->_token)) {
            if(!$this->member->exists($request->username)) {
                return '/register?action=UNexist';
            }
        }
    }
}
