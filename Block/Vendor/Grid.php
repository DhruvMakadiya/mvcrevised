<?php

class Block_Vendor_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->getCollection();
        $this->_prepareColumns();
        $this->_prepareActions();
        $this->_prepareButtons();
        $this->setTitle('vendor grid');
    }

    public function getCollection()
    {
        $sql = "SELECT count(vendor_id) FROM `vendor`";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($sql);
        $currentPage = Ccc::getModel('Core_Request')->getParam('p');

        $pager = Ccc::getModel('Core_Pagination');
        $pager->setCurrentPage($currentPage)->setTotalRcored($totalRecord);
        $pager->calculate();
        $pager->setPager($pager);

        $sql = "SELECT * FROM `vendor` LIMIT {$pager->setStartLimit()},{$pager->setRecordPerPage()}";
        $vendors = Ccc::getModel('Vendor')->fetchAll($sql);
        return $vendors;
    }

    public function _prepareColumns()
    {
        $this->addColumn('vendor_id',['title' => 'Vendor Id']);
        $this->addColumn('first_name',['title' => 'First Name']);
        $this->addColumn('last_name',['title' => 'Last Name']);
        $this->addColumn('email',['title' => 'Email']);
        $this->addColumn('gender',['title' => 'Gender']);
        $this->addColumn('mobile',['title' => 'Mobile']);
        $this->addColumn('status',['title' => 'Status']);
        $this->addColumn('company',['title' => 'Company']);
        $this->addColumn('created_at',['title' => 'Created_At']);
        $this->addColumn('updated_at',['title' => 'Updated_at']);

        parent::_prepareColumns();
    }

    public function _prepareActions()
    {
        $this->addAction('edit',['title' => 'Edit', 'method' => 'getEditUrl']);
        $this->addAction('delete',['title' => 'Delete', 'method' => 'getDeleteUrl']);
        return parent::_prepareActions();
    }

    public function _prepareButtons()
    {
        $this->addButton('add',['title' => 'Add','url' => $this->getUrl('add','vendor',[],true)]);
        return parent::_prepareButtons();
    }
}


?>