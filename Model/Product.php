<?php

class Model_Product extends Model_Core_Table
{
    
    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Product::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status, $statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Product::STATUS_DEFAULT];
    }

    public function __construct()
    {
        parent::__construct();

        $this->setResourceClass('Model_Product_Resource');
        $this->setCollectionClass('Model_Product_Collection');
    }
}



?>