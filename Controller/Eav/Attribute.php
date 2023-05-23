<?php

class Controller_Eav_Attribute extends Controller_Core_Action
{	
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Core_Eav_Attribute_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		try {
			$layout = $this->getLayout();
			$attribute = Ccc::getModel('Core_Eav_Attribute');
        	$add = $layout->createBlock('Core_Eav_Attribute_Edit')->setData(['attribute'=>$attribute]);
			$layout->getChild('content')->addChild('edit',$add);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Eav_Attribute not showed.',Model_Core_Message::FAILURE);
		}
		
	}

	public function editAction()
	{
		try {
			$attributeId = (int) Ccc::getModel('Core_Request')->getParams('id');
        	$layout = $this->getLayout();
        	$attribute = Ccc::getModel('Core_Eav_Attribute')->load($attributeId);
        	$edit = $layout->createBlock('Core_Eav_Attribute_Edit')->setData(['attribute'=>$attribute]);
        	$layout->getChild('content')->addChild('edit',$edit);
        	$layout->render();
			
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Eav_Attribute not showed.',Model_Core_Message::FAILURE);
		}
	}

	public function saveAction()
	{
		try {
			
			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request", 1);
			}

			$postData = $this->getRequest()->getPost();
			// echo "<pre>";
			// print_r($postData);
			// die();
			if (!$postData) {
				throw new Exception("Data not available", 1);
			}

			if ($id = $this->getRequest()->getParams('id')) {
				$attribute = Ccc::getModel('Core_Eav_Attribute')->load($id);

				if (!$attribute) {
					throw new Exception("Invalid id.", 1);
				}
			}
			else{
				$attribute = Ccc::getModel('Core_Eav_Attribute');
			}
			$attribute->setData($postData['attribute']);

			if (!$attribute->save()) {
				throw new Exception("Attribute not saved.", 1);
			}
			$attributeId = $attribute->attribute_id;
			$query = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id` = '{$attributeId}'";
			$attributeOptionModel = Ccc::getModel('Core_Eav_Attribute_Option');
			$attributeOption = $attributeOptionModel->fetchAll($query);
			if ($attributeOption) {
				foreach ($attributeOption->getData() as $row) {
					if (!array_key_exists($row->option_id,$postData['option']['exits']['name'])) {
						$row->setData(['option_id',$row->option_id]);
						if (!$row->delete()) {
							throw new Exception("Attribute Option not deleted", 1);
						}
					}
				}
			}
			
			if ($postData) {
				if (array_key_exists('option',$postData)) {
					if (array_key_exists('exits',$postData['option'])) {
						foreach ($postData['option']['exits']['name'] as $optionId => $optionName) {
							$option['name'] = $optionName;
							$option['attribute_id'] = $attributeId;
							$option['option_id'] = $optionId;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attribute->save();
							unset($option);
						}

						foreach ($postData['option']['exits']['position'] as $optionId => $positionName) {
							$option['position'] = $positionName;
							$option['attribute_id'] = $attributeId;
							$option['option_id'] = $optionId;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attributeOption->save();
							unset($option);
						}
					}

					if (array_key_exists('new',$postData['option'])) {
						$newPosition = $postData['option']['new']['position'];

						foreach ($postData['option']['new']['name'] as $id => $optionName) {
							$option['name'] = $optionName;
							$option['position'] = $newPosition[$id];
							$option['attribute_id'] = $attribute->attribute_id;

							$attributeOption = Ccc::getModel('Core_Eav_Attribute_Option');
							$attributeOption->setData($option);
							$attributeOption->save();
						}
					}
				}
			}
			$this->getMessage()->addMessage('Attribute saved successfully.',Model_Core_Message::SUCCESS);
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Attribute not saved.',Model_Core_Message::FAILURE);
		}
		$this->redirect('grid','eav_attribute',null,true);
	}

	public function deleteAction()
	{
		try {	
			if (!($id = (int)$this->getRequest()->getParams('id'))) {
				throw new Exception("Id not found", 1);	
			}
			$attribute = Ccc::getModel('Core_Eav_Attribute')->load($id);
			$attribute->delete();
			$this->getMessage()->addMessage('Attribute deleted successfully',Model_Core_Message::SUCCESS);
		} catch (Exception $e) {
			$this->getMessage()->addMessage('Attribute not deleted',Model_Core_Message::FAILURE);
		}
			$this->redirect('grid','eav_attribute',null,true);
	}
}

?>