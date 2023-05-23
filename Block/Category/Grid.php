<?php

class Block_Category_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Category Grid');
        $this->getCollection();
        $this->_prepareActions();
        $this->_prepareColumns();
        $this->_prepareButtons();
    }

    public function getCollection()
    {
        $sql = "SELECT count(category_id) FROM `category`";
        $totalRecord = Ccc::getModel('Core_Adapter')->fetchOne($sql);
        $currentPage = Ccc::getModel('Core_Request')->getParam('p');

        $pager = Ccc::getModel('Core_Pagination');
        $pager->setCurrentPage($currentPage)->setTotalRecord($totalRecord);
        $pager->calculate();
        $pager->setPager($pager);

        $sql = "SELECT * FROM `categrory` LIMIT {$pager->setStartLimit()},{$pager->setRecordPerPage()} ";
        $categories = Ccc::getModel('Category')->fetchAll($sql);
        return $categories;
    }

    public function _prepareColumns()
    {
        $this->addColumn('category_id',['title' => 'Category_Id']);
        $this->addColumn('name',['title' => 'Name']);
        $this->addColumn('description',['title' => 'Description']);
        $this->addColumn('status',['title' => 'Status']);
        $this->addColumn('created_at',['title' => 'Created_At']);
        $this->addColumn('updated_at',['title' => 'Updated_At']);

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
        $this->addButton('categoiry_id',['title' => 'Add' , 'url' => $this->getUrl('add','category',[],true)]);
        return parent::_prepareButtons();
    }
}


?>