<?php
class SSTech_Productsale_IndexController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_ENABLED = 'sstech_productsale/general/is_enabled';
    public function preDispatch()
    {
        parent::preDispatch();

        if( !Mage::getStoreConfigFlag(self::XML_PATH_ENABLED) ) {
            $this->norouteAction();
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return;
        }
    }
	
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle('Sale');
        $this->getLayout()->getBlock('head')->setDescription('On Sale');
        $this->_initLayoutMessages('catalog/session');
        $this->renderLayout();
    }
}
