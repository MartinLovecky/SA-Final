<?php

namespace Repse\Sa\support;

use eftec\bladeone\BladeOne;

class Bladecsfr extends BladeOne{

    //ANCHOR step1: copy this function and replace it inside BladeOne line: 1541
    //ANCHOR if you use composer update you need do step1 again.
    public function getCsrfToken($fullToken = false, $tokenId = '_token'): string
    {
        if ($this->csrf_token == '') {
            $this->csrf_token = base64_encode(uniqid(rand(),true).'|'.$_SERVER['REMOTE_ADDR'].'|'.$_SERVER['SERVER_NAME'].'|'.bin2hex(uniqid(rand(),true)));
            @$_SESSION['_token'] = strrev($this->csrf_token);
            return $this->csrf_token;
        }
        return $this->csrf_token;
    }
}
