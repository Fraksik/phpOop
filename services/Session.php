<?php


namespace app\services;


class Session
{

    public function __construct()
    {
        session_start();
    }

    public function get($key)
    {
    	if (array_key_exists($key, $_SESSION)) {
		    return $_SESSION[$key];
	    }
        return null;
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
}