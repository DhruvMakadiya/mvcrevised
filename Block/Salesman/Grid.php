<?php

class Block_Salesman_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->getCollection();
        $this->_prepareColumns();
        $this->_prepareActions();
        $this->_prepareButtons();
    }

    public function getCollection()
    {
        $sql = "SELECT count(salesman_id) FROM `salesman`";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($sql);
        $currentPage = Ccc::getModel('Core_Request')->getParam('p');
        
        $pager = Ccc::getModel('Core_Pagination');
        $pager->setTotalRecord($totalRecord)->setCurrentPage($currentPage);
        $pager->calculate();
        $pager->setPager($pager);

        $sql = "SELECT * FROM `salesman` LIMIT {$pager->setStartLimit()},{$pager->setRecordPerPage()}";
        $salesman = Ccc::getModel('Salesman')->fetchAll($sql);
        return $salesman;
    }

    public function _prepareColumns()
    {
        $this->addColumn('salesman_id',['title' => 'Salesman Id']);
        $this->addColumn('first_name',['title' => 'First Name']);
        $this->addColumn('last_name',['title' => 'Last Name']);
        $this->addColumn('email',['title' => 'Email']);
        $this->addColumn('gender',['title' => 'Gender']);
        $this->addColumn('mobile',['title' => 'Mobile']);
        $this->addColumn('status',['title' => 'Status']);
        $this->addColumn('company',['title' => 'Company']);
        $this->addColumn('created_at',['title' => 'Created At']);
        $this->addColumn('updated_at',['title' => 'Updated At']);

        return parent::_prepareColumns();
    }

    public function _prepareActions()
    {
        $this->addAction('edit',['title' => 'Edit','method' => 'getEditUrl']);
        $this->addAction('delete',['title' => 'Delete','method' => 'getDeleteUrl']);
        return parent::_prepareActions();
    }

    public function _prepareButtons()
    {
        $this->addButtons('add',['title' => 'Add', 'url' => $this->getUrl('add','salesman',[],true)]);
        return parent::_prepareButtons();
    }
}


?>