<?php

class Model_Vendor extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Vendor_Resource');
        $this->setCollectionClass('Model_Vendor_Collection');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Vendor_Resource::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Vendor_Resource::STATUS_DEFAULT];
    }
}


?>