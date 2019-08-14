<?php

class SSTech_Productsale_Block_List extends Mage_Catalog_Block_Product_List
{
  protected $_productsCount = null;
  protected $_productCollection;
  const DEFAULT_PRODUCTS_COUNT = 5;

  protected function _construct()
  {
    parent::_construct();
    $this->addData(array(
      'cache_lifetime' => 300,
      'cache_tags' => array(Mage_Catalog_Model_Product::CACHE_TAG),
    ));
  }
   public function getLoadedProductCollection()
    {
        return $this->_getProductCollection();
    }

  protected function _getProductCollection()
  {
    if (is_null($this->_productCollection)) {
      $this->_productCollection = Mage::getModel('sstech_productsale/layer')->getProductCollection();
    }
    return $this->_productCollection;
  }

    public function setProductsCount($count)
  {
    $this->_productsCount = $count;
    return $this;
  }

  public function getProductsCount()
  {
    if (null === $this->_productsCount) {
      $this->_productsCount = self::DEFAULT_PRODUCTS_COUNT;
    }
    return $this->_productsCount;
  }

  public function getCacheKeyInfo()
  {
    return array(
      'CATALOGSALE_PRODUCT_SALE',
    Mage::app()->getStore()->getId(),
    Mage::getDesign()->getPackageName(),
    Mage::getDesign()->getTheme('template'),
    Mage::getSingleton('customer/session')->getCustomerGroupId(),
      'template' => $this->getTemplate(),
    $this->getProductsCount()
    );
  }

  protected function _beforeToHtml()
  {
    $collection = Mage::getSingleton('sstech_productsale/layer')->getProductCollection();
    $collection->setPageSize($this->getProductsCount())->setCurPage(1);
    $collection->getSelect()->order('rand()');
    $this->setProductCollection($collection);
    return parent::_beforeToHtml();
  }
}