<?php

class SSTech_Productsale_Block_View extends Mage_Core_Block_Template
{
	protected function _prepareLayout()
	{
		parent::_prepareLayout();
	 	$breadcrumbs = $this->getLayout()->getBlock('breadcrumbs');
        if ($breadcrumbs) {
            $title = $this->__('Sale');
 
            $breadcrumbs->addCrumb('home', array(
                    'label' => $this->__('Home'),
                    'title' => $this->__('Go to Home Page'),
                    'link' => Mage::getBaseUrl()
            ))->addCrumb('item', array(
                    'label' => $title,
                    'title' => $title,
            ));
        }
		
		return $this;
	}
	
	protected function _getProductCollection()
	{
		if (is_null($this->_productCollection)) {
			$this->_productCollection = Mage::getSingleton('productsale/layer')->getProductCollection();
		}
		
		return $this->_productCollection;
	}
	
	public function IsRssCatalogEnable()
	{
		$path = Mage_Rss_Block_List::XML_PATH_RSS_METHODS.'/catalog/special';
		
		return (bool)Mage::getStoreConfig($path);
	}

    public function setListCollection()
    {
        $productList = $this->getChild('sale_product_list');
        $productList->setCollection($this->_getProductCollection());
    }
	
	
	
	public function getProductListHtml()
	{
		return $this->getChildHtml('sale_product_list');
	}

    public function getRssLink()
    {
    $param = array('sid' => $this->getCurrentStoreId());
    
    return Mage::getUrl(Mage_Rss_Block_List::XML_PATH_RSS_METHODS.'/catalog/special', $param);
    }
}
