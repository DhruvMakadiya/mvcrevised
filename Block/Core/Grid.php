<?php

class Model_Core_Grid extends Block_Core_Template
{
    protected $_columns = [];
    protected $_actions = [];
    protected $_buttons = [];
    protected $_title = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate(['core/grid.phtml'])->getCollection();
        $this->_prepareActions();
        $this->_prepareColumns();
        $this->_prepareButtons();
        $this->setTitle('Grid');
    }

    public function setColumns($columns)
    {
        $this->_columns = $columns;
        return $this;
    }

    public function getColumns()
    {
        return $this->_columns;
    }

    public function addColumn($key,$value)
    {
        $this->_columns[$key] = $value;
        return $this;
    }

    public function removeColumn()
    {
        if(array_key_exists($key, $this->_columns))
        {
            unset($this->_columns[$key]);
            return $this;
        }
    }

    public function getColumn($key)
    {
        if(array_key_exists($key,$this->_columns))
        {
            return $this->_columns[$key];
        }
        return null;
    }

    protected function _prepareColumns()
    {
        return $this;
    }

    public function setActions($actions)
    {
        $this->_actions = $actions;
        return $this->_actions;
    }

    public function getActions()
    {
        return $this->_actions;
    }

    public function addAction($key,$value)
    {
        $this->_actions[$key] = $value;
        return $this;
    }

    public function removeActions()
    {
        unset($this->_actions[$key]);
        return $this;
    }

    public function getAction()
    {
        if(array_key_exists($key,$this->_actions))
        {
            return $this->_actions[$key];
        }
        return null;
    }

    protected function _prepareActions()
    {
        return $this;
    }

    public function setButtons($buttons)
    {
        $this->_buttons = $buttons;
        return $this;
    }

    public function getButtons()
    {
        return $this->_actions;
    }

    public function addButton($key,$value)
    {
        $this->_actions[$key] = $value;
        return $this;
    }

    public function removeButtons()
    {
        unset($this->_buttons[$key]);
        return $this;
    }

    public function getButton($key)
    {
        if(array_key_exists($key,$this->_actions))
        {
            return $this->_actions[$key];
        }
        return null;
    }

    protected function _prepareButtons()
    {
        return $this;
    }

    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

    public function getTitle()
    {
        return $this->_title;
    }

    public function getEditUrl($row,$key)
    {
        $this->getUrl($key,null,['id' => $row->getId()],true);
        return $this;
    }

    public function getDeleteUrl($row,$key)
    {
        $this->getUrl($key,null,['id' => $row->getId()],true);
        return $this;
    }

}


?>