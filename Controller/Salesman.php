<?php

class Controller_Salesman extends Controller_Core_Action
{
    public function gridAction()
    {
        $layout = $this->getLayout();
        $grid = $layout->createBlock('Salesman_Grid');
        $layout->getChild('content')->addChild('grid',$grid);
        $layout->render();
    }

    public function addAction()
    {
        $layout = $this->getLayout();
        $salesman = Ccc::getModel('Salesman');
        $address = Ccc::getModel('Salesman_Address');
        $add = $layout->createBlock('Salesman_Edit')->setData(['salesman'=>$salesman,'salesmanAddress'=>$address]);
        $layout->getChild('content')->addChild('add',$add);
        $layout->render();
    }

    public function editAction()
    {
        try {
            $id = Ccc::getModel('Core_Request')->getParam('id');
            $salesman = Ccc::getModel('Salesman')->load($id);

            if(!$salesman)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $salesmanAddress = Ccc::getModel('Salesman_Address')->load($id);

            if(!$salesmanAddress)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $this->setTemplate('salesman/edit.phtml')->setData(['salesman' => $salesman, 'salesmanAddress' => $salesmanAddress]);
            $this->render();
        } catch (Exception $e) {
            //throw $th;
        }
    }

    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost())
            {
                throw new Exception("Invalid Request", 1);
            }
            $postData = $this->getRequest()->getPost('salesman');
            if(!$postData)
            {
                throw new Exception("Error Processing Request", 1);
            }
            if($id = $this->getRequest()->getParam('id'))
            {
                $salesman = Ccc::getModel('Salesman')->load($id);
                $salesman->updated_at = date("Y-m-d h-i-s");
            }
            else{
                $salesman = Ccc::getModel('Salesman');
                $salesman->created_at = date('Y-m-d h-i-s');
            }

            $salesman->setData($postData);

            if(!$salesman->save())
            {
                throw new Exception("Error Processing Request", 1);
            }

            $postAddressData = $this->getRequest()->getParam('address');
            if(!$postAddressData)
            {
                throw new Exception("Error Processing Request", 1);
            }

            if($id = $this->getRequest()->getParam('id'))
            {
                $salesmanAddress = Ccc::getModel('Salesman_Address')->load($id);
            }
            else{
                $salesmanAddress = Ccc::getModel('Salesman_Address');
                $salesmanAddress->salesman_id = $salesman->salesman_id;
            }
            $salesmanAddress->setData($postAddressData);
            if(!$salesmanAddress->save())
            {
                throw new Exception("Error Processing Request", 1);
            }

        } catch (Exception $e) {
            throw new Exception("Error Processing Request", 1);
        }
        $this->redirect('grid','salesman',[],true);
    }

    public function deleteAction()
    {
        try {
            $id = Ccc::getModel('Core_Request')->getParam('id');
            if(!$id)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $salesman = Ccc::getModel('Salesman')->load($id);
            if(!$salesman)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $salesman->delete();

            $salesmanAddress = Ccc::getModel('Salesman_Address');
            if(!$salesmanAddress)
            {
                throw new Exception("Error Processing Request", 1);
            }
            $salesmanAddress->delete();
        } catch (Exception $e) {
            //throw $th;
        }
        $this->redirect('grid','salesman',[],true);
    }

}
?>