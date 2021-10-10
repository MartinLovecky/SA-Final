<?php

namespace Repse\Sa\support;

use ArrayAccess;
use HTMLPurifier;
use Repse\Sa\http\Request;

class Sanitizer{

    public function __construct(protected HTMLPurifier $purifier) {}

    public function purify(Request $request) : array
    {
        foreach(get_object_vars($request) as $key => $value)
        {   
            $purifyed = $this->purifier->purify($value);
            $purify[$key] = $purifyed;
            $this->{$key} = $purifyed;   
        }
            return $purify; 
    }


}