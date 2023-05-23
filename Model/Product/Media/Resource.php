<?php

class Model_Product_Media_Resource extends Model_Core_Table_Resouce
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableName('product_media');
        $this->setPrimaryKey('media_id');
    }
}


?>