<?php

class Model_Category_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Category');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Category::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getTable()->getStatusOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Category::STATUES_DEFAULT];
    }
}


?>