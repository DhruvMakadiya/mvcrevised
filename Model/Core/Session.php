<?php

class Model_Core_Session
{
    public function start()
    {
        session_start();
        return $this;
    }

    public function destroy()
    {
        session_destroy();
    }

    public function set($key,$value)
    {
        $_SESSION[$key] = $value;
        return $this;
    }

    public function get($key)
    {
        if(array_key_exists($key, $_SESSION))
        {
            return $_SESSION[$key];
        }
        return null;
    }

    public function getId()
    {
        session_id();
        return $this;
    }

    public function unset($key)
    {
        if(array_key_exists($key,$_SESSION))
        {
            unset($_SESSION[$key]);
        }
        return $this;
    }

    public function has($key)
    {
        if(array_key_exists($key,$_SESSION))
        {
            return true;
        }
        return false;
    }
}

?>