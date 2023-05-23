<?php
class Block_Core_Eav_Attribute_Inputtype extends Block_Core_Template
{
	protected $attribute = null;
	protected $row = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('core/eav/attribute/inputtype.phtml');
	}

	public function setAttributes($attribute)
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

	public function getInputtypeField()
	{
		$attribute = $this->getAttribute();
		if ($attribute->input_type == 'text') {
			return $this->getLayout()->createBlock('Core_Eav_Attribute_Inputtype_Text')->setAttribute($this->getAttribute())->setRow($this->getRow());
		}

		elseif ($attribute->input_type == 'textarea') {
			return $this->getLayout()->createBlock('Core_Eav_Attribute_Inputtype_Textarea')->setAttribute($this->getAttribute())->setRow($this->getRow());
		}

		elseif ($attribute->input_type == 'select') {
			return $this->getLayout()->createBlock('Core_Eav_Attribute_Inputtype_Select')->setAttribute($this->getAttribute())->setRow($this->getRow());
		}

		elseif ($attribute->input_type == 'multiselect') {
			return $this->getLayout()->createBlock('Core_Eav_Attribute_Inputtype_Multiselect')->setAttribute($this->getAttribute())->setRow($this->getRow());
		}

		else{
			echo "No String";
		}
	}
}