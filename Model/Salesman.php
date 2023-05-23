<?php

class Model_Salesman extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->getResouceClass('Model_Salesman_Resource');
        $this->getCollectionClass('Model_Salesman_Collection');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Salesman_Resource::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status, $statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Salesman_resource::STATUS_DEFAULT];
    }
}


?>