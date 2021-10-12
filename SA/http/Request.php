<?php

namespace Repse\Sa\http;

class Request{

    public function getRequest() : void
    {
        //REVIEW only for testing delete after 
        $args = func_get_args();
        if (isset($args)) {
            foreach ($args[0] as $key => $value)
            {
                $this->{$key} = $value;
            }
        }
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