<?php

class Controller_Core_Action
{
    protected $message = null;
    protected $request = null;
    protected $layout = 'view/core/layout/3columns.phtml';
    protected $adapter = null;
    protected $url = null;
    protected $view = null;
    protected $session = null;

    public function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if($this->adapter)
        {
            return $this->adapter;
        }
        $adapter = Ccc::getModel('Core_Adapter');
        $this->setAdapter($adapter);
        return $adapter;
    }

    public function setRequest(Model_Core_Request $request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        if($this->request)
        {
            return $this->request;
        }

        $request = Ccc::getModel('Core_Request');
        $this->setRequest($request);
        return $request;
    }

    public function setSession(Model_Core_Session $session)
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

        $session = new Model_Core_Session();
        $this->setSession($session);
        return $seesion;
    }

    public function setMessage(Model_Core_Message $message)
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        if($this->message)
        {
            return $this->message;
        }

        $message = Ccc::getModel('Core_Message');
        $this->setMessage($message);
        return $message;
    }

    public function setLayout(Block_Core_Layout $layout)
    {
        $this->layout = $layout;
        return $this;
    }

    public function getLayout()
    {
        if($this->layout)
        {
            return $this->layout;
        }

        $layout = new BLock_Core_Layout();
        $this->setLayout($layout);
        // $this->setLayout('view/core/layout/3columns.phtml');
        return $layout;
    }

    public function setUrl(Model_Core_Url $url)
    {
        $this->url = $url;
        return $this;
    }

    public function getUrl()
    {
        if($this->url)
        {
            return $this->url;
        }

        $url = new Model_Core_Url();
        $this->setUrl($url);
        return $url;
    }

    public function setView(Model_Core_View $view)
    {
        $this->view = $view;
        return $this;
    }

    public function getView()
    {
        if($this->view)
        {
            return $this->view;
        }
        $view = new Model_Core_View();
        $this->setView($view);
        return $view;
    }

    public function getTemplate($templatePath)
    {
        return "View" . DS . $templatePath;
    }

    public function redirect($action = null, $controller = null, $params = [], $resetParam = false)
    {
        $url = Ccc::getModel('Core_Url')->getUrl($action, $controller, $param, $resetParam);
        header("Location: {$url}");
        exit();
    }

    public function render()
    {
        return $this->getLayout()->render();
    }

    public function errorAction($action)
    {
        throw new Exception("method {$action} not exist", 1);
        
    }
}

?>