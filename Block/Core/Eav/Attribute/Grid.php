<?php

class Block_Eav_Attribute_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTtile('Attribute');
    }

    public function getCollection()
    {
        $sql = "SELECT count('attribute_id') FROM `eav_attribute`";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($sql);

        $currentPage = Ccc::getModel('Core_Request')->getParam('p');
        $pager = Ccc::getModel('Core_Pagination');
        $pager->setCurrentPage($currentPage)->setTotalRecord($totalRecord);
        $pager->calculate();
        $this->setPager($pager);

        $sql = "SELECT * FROM `eav_attribute` LIMIT {$pager->getStartLimit()},{$pager->setRecordPerPage()}";
        $eav_arrtibute = Ccc::getModel('Eav_Attribute')->fetchAll($sql);
        return $eav_arrtibute;
    }

    public function _prepareColumns()
    {
        $this->addColumn('attribute_id',['title' => 'attribute_id']);
        $this->addColumn('entity_type_id',['title' => 'entity_type_id']);
        $this->addColumn('code',['title' => 'code']);
        $this->addColumn('backend_type',['title' => 'backend_type']);
        $this->addColumn('name',['title' => 'name']);
        $this->addColumn('status',['title' => 'status']);
        $this->addCOlumn('input_type',['title' => 'input_type']);

        return parent::_prepareColumns();
    }

    public function _prepareActions()
    {
        $this->addAction('edit',['title' => 'Edit', 'method' => 'getEditUrl']);
        $this->addAction('delete',['title' => 'Delete', 'method' => 'getDeleteUrl']);

        return parent::_prepareActions();
    }

    public function _prepareButtons()
    {
        $this->addButton('add',['title' => 'Add', 'url' => $this->getUrl('add','eav',[],true)]);
        
        return parent::_prepareButtons();
    }
}


?>