<?php

class Model_Eav_Attribute extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Eav_Attribute_Resource');
        $this->setCollectionClass('Model_Eav_Attribute_Collection');
    }

    public function getEntityTypes()
    {
        $sql = "SELECT * FROM `entity_type`";
        return $this->fetchAll($sql);
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Eav_Attribute_Resource::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return Model_Eav_Attribute_Resource::STATUS_DEFAULT;
    }
}


?>