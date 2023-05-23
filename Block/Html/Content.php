<?php

class Block_html_Content extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('html/content/content.phtml');
    }
}


?>