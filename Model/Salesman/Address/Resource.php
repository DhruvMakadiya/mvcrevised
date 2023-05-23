<?php

class Model_Salesman_Address_Resouce extends Model_Core_Table_Resouce
{
    public function __construct()
    {
        parent::__construct();
        $this->setResourceName('salesman_address');
        $this->setPrimaryKey('salesman_id');
    }
}


?>