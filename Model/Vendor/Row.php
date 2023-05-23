<?php

class Model_Vendor_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Vendor');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Vendor::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statues = $this->gsetTable()->getStatusOptions();
        if(array_key_exists($this->data,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Vendor::STATUS_DEFAULT];
    }
}


?>