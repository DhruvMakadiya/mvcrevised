<?php

class Model_Vendor_Address_Resource extends Model_Core_Table_Resouce
{
    public function __construct()
    {
        parent::__construct();
        $this->setResourceName('vendor_address');
        $this->setPrimaryKey('vendor_id');
    }
}


?>