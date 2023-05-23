<?php

class Block_Customer_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->getCollection();
        $this->_prepareActions();
        $this->_prepareColumns();
        $this->_prepareButtons();
        $this->setTitle('Customer Grid');
    }

    public function getCollection()
    {
        $sql = "SELECT count('customer_id') FROM `customer` ";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($sql);

        $currentPage = Ccc::getModel('Core_Request')->getParam('p');
        $pager = Ccc::getModel('Core_Pagination');
        $pager->setCurrentPage($currentPage)->setTaotalRecords($totalRecord);
        $pager->calculate();
        $pager->setPager($pager);

        $sql = "SELECT * FROM `customer` LIMIT{$pager->setStartLimit()},{$pager->setRecordPerPage()}";
        $customers = Ccc::getModel('Customer')->fetchAll($sql);
        return $customers;
    }

    public function _prepareColumns()
    {
        $this->addColumn('customer_id',['title' => 'Customer_Id']);
        $this->addColumn('first_name',['title' => 'First_Name']);
        $this->addColumn('last_name',['title' => 'Last_Name']);
        $this->addColumn('email',['title' => 'Email']);
        $this->addColumn('gender',['title' => 'Gender']);
        $this->addColumn('mobile',['title' => 'Mobile']);
        $this->addColumn('status',['title' => 'Status']);
        $this->addColumn('created_at',['title' => 'Created_At']);
        $this->addColumn('updated_at',['title' => 'Updated_At']);

        return parent::_prepareColumns();
    }

    public function _prepareButtons()
    {
        $this->addButton('customer_id',['title' => 'Add', 'url' => $this->getUrl('add','customer',[],true)]);
        return parent::_prepareButtons();
    }

    public function _prepareActions()
    {
        $this->addAction('edit',['title' => 'Edit', 'method' => 'getEditUrl']);
        $this->addAction('delete',['title' => 'Delete', 'method' => 'getDeleteUrl']);
        return parent::_prepareActions();
    }
}


?>