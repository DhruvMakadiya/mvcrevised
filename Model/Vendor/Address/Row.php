<?php

class Model_Vendor_Address_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Vendor_Address');
    }
}


?>