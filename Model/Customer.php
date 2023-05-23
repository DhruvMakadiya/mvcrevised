<?php

class Model_Customer extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();

        $this->setResourceClass('Model_Customer_Resource');
        $this->setCollectionClass('Model_Customer_Collection');
    }

    public function getStatus()
    {
        if($this->status)
        {
            return $this->status;
        }
        return Model_Customer_Resource::STATUS_DEFAULT;
    }

    public function getStatusText($status)
    {
        $statues = $this->getResource()->getStatusOptions();
        if(array_key_exists($this->status,$statues))
        {
            return $statues[$this->status];
        }
        return $statues[Model_Customer_resource::STATUS_DEFAULT];
    }

    public function getMyBilling()
    {
        $billingAddress = Ccc::getModel('Customer_Address')->load($this->billing_address_id);
        return $billingAddress;
    }

    public function getMyShipping()
    {
        $shippingAddress = Ccc::getModel('Customer_Address')->load($this->shipping_address_id);
        return $shippingAddress;
    }
}



?>