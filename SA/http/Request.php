<?php

namespace Repse\Sa\http;

class Request{

    public function getRequest() 
    {
        foreach ($_POST as $key =>$value)
            $this->{$key} = $value;
    }

    public function getGET() : array
    {
        $p = strpos($_SERVER['REQUEST_URI'],'?');
        if ($p > 0)
        {
            $getStr = substr($_SERVER['REQUEST_URI'], $p+1);
            $getArr = explode('&', $getStr);
            foreach ($getArr as $getValue)
            {
                if($getValue != '')
                    $pos = strpos($getValue, "=");
                if($pos > 0)
                    $getarry[urldecode(substr($getValue, 0 , $pos))] = urldecode(substr($getValue, $pos + 1));
                else
                    $getarry[urldecode($getValue)] = true;    
            }
        }
        if (!isset($getarry)) {
           return [];
        }
        return $getarry;
    }
}