<?php

class Model_Product_Media extends Model_Core_Table
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    public function __construct()
    {
        parent::__construct();
        $this->setResourceName('Model_Product_Media_Resource');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return self::STATUS_DEFAULT;
    }

    public function getStatuesOptions()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
        ];
    }

    public function getStatusText()
    {
        $statues = $this->getStatuesOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[self::STATUS_DEFAULT];
    }
}


?>