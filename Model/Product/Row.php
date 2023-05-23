<?php

class Model_Product_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Product');
    }

    public function getStatus()
    {
        if($this->stauts)
        {
            return $this->status;
        }
        return Model_Product::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Product::STATUS_DEFAULT];
    }
}


?>