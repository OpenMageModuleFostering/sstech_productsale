<?php
class SSTech_Productsale_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED = 'sstech_productsale/general/is_enabled';
    
    public function setIsModuleEnabled($value)
    {
        Mage::getModel('core/config')->saveConfig(self::XML_PATH_ENABLED, $value);
    }
    
    public function getCatalogSaleUrl()
    {
        return $this->_getUrl('productsale');
    }
}