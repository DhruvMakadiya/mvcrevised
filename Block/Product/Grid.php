<?php

class Block_Product_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->geCollection();
        $this->_prepareActions();
        $this->_prepareColumns();
        $this->_prepareButtons();
    }

    public function getCollection()
    {
        $sql = "SELECT count('product_id) FROM `product` ";
        $totalRecord = Ccc::getModel('Core_Adapter')->fectOne($sql);
        $currentPage = Ccc::getModel('Core_Request')->getParam('p');

        $pager = Ccc::getModel('Core_Pagination');
        $pager->setCurrentPage($currentPage)->setTotalRecord($totalRecord);
        $pager->calculate();
        $pager->setPager($pager);

        $sql = "SELECT * FROM `product` LIMIT{$pager->setStatLimit()}, {$pager->setRecordPerPage()}";
        $products = Ccc::getModel('Product')->fetchAll($sql);
        return $prooducts;
    }

    public function _prepareColumns()
    {
        $this->addColumn('product_id',['title' => 'Product_Id']);
        $this->addColumn('name',['title' => 'Name']);
        $this->addColumn('cost',['title' => 'Cost']);
        $this->addColumn('sku',['title' => 'Sku']);
        $this->addColumn('price',['title' => 'Price']);
        $this->addColumn('quantity',['title' => 'Quantity']);
        $this->addColumn('description',['title' => 'Description']);
        $this->addColumn('status',['title' => 'Status']);
        $this->addColumn('color',['title' => 'Color']);
        $this->addColumn('material',['title' => 'Material']);
        $this->addColumn('created_at',['title' => 'Created_At']);
        $this->addColumn('updated_at',['title' => 'Updated_At']);

        parent::_prepareColumns();
    }

    public function _prepareActions()
    {
        $this->addAction('edit',['title' => 'Edit','url' => $this->getUrl('edit','product',['id' => $this->getId()],true)]);
        $this->addAction('delete',['title' => 'Delete', 'url' => $this->getUrl('delete','product',['id' => $this->getId()],true)]);
        return parent::_prepareActions();
    }

    public function _prepareButtons()
    {
        $this->addButton('product_id',['title' => 'Add', 'url' => $this->getUrl('add','product',[],true)]);
        return parent::_prepareButtons();
    }
}


?>