<?php
class SSTech_Productsale_Block_Layer extends Mage_Catalog_Block_Layer_View
{
  public function getLayer()
  {
    return Mage::getSingleton('sstech_productsale/layer');
  }
}