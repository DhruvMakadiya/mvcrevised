<?php

class Block_Core_Eav_Attribute_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('eav/edit.phtml');
    }

    public function getCollection()
    {
        return Ccc::getModel('Eav_Attribute')->getEntityTypes();
    }
}


?>