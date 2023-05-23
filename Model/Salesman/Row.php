<?php

class Model_Salesman_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Salesman');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Salesman_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statues = $this->getTable()->getStatusOptions();
        if(array_key_exists($this->status, $statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Salesman_Resource::STATUS_DEFAULT];
    }
}


?>