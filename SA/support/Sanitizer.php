<?php

namespace Repse\Sa\support;

use ArrayAccess;
use Repse\Sa\http\Request;

class Sanitizer{

    public $username;
    public $email;

    public function purify(Request $request) 
    {
        $this->username = !empty($request->username) ? htmlspecialchars($request->username) : null;
        $this->email = !empty($request->email) ? filter_var($request->email, FILTER_SANITIZE_EMAIL) : null;
    }
}