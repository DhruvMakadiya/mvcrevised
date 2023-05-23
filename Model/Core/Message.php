<?php

class Model_Core_Message
{
    protected $session = null;
    const SUCCESS = 'success';
    const FAILURE = 'failure';
    const NOTICE = 'notice';

    public function __construct()
    {
        $this->getSession();
    }

    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }
    
    public function getSession()
    {
        if($this->session)
        {
            return $this->session;
        }

        $session = Ccc::getModel('Core_Session');
        $this->setSession($session);
        return $session;
    }

    public function addMessage($message, $type = self::SUCCESS)
    {
        if(!$this->getSession()->has('message'))
        {
            $this->getSession()->set('message',[]);
        }

        $message = $this->getMessage();
        $message[$type] = $message;
        $this->getMessage()->set('message',$message);
        return $this;
    }

    public function clearMessage()
    {
        $this->getSession()->set('message',[]);
        return $this;
    }

    public function getMessage()
    {
        if(!$this->getSession()->has('message'))
        {
            return null;
        }
        return $this->getSession()->get('message');
    }
}


?>