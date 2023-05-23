<?php

class Block_Core_Eav_Attribute_Inputtype_Multiselect extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/inputtype/multiselect.phtml');
	}
	public function setAttribute($attribute)
	{
		$this->attribute = $attribute;
		return $this;
	}	

	public function getAttribute()
	{
		return $this->attribute;
	}

	public function setRow($row)
	{
		$this->row = $row;
		return $this;
	}	

	public function getRow()
	{
		return $this->row;
	}
}

?>