<?php

namespace Repse\Sa\http;

class Request{

    /**
     * Convert $_POST array to public properties 
     * where array key is property name
     * @return void
     */
    public function getRequest() 
    {
        foreach ($_POST as $key =>$value)
            $this->{$key} = $value;
    }
}