<?php

class Model_Salesman_Address_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Salesman_Address');
    }
}


?>