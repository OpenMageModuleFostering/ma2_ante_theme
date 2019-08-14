<?php 
class Ma2_Manufacturers_Model_System_Config_Source_Manuid
{
    public function toOptionArray()
    {
    
      $manu_code = Mage::getStoreConfig('manufacturers/general/attr_code');
      if (empty($manu_code)) return array();
      
      $productModel = Mage::getModel('catalog/product');
      $manufacturers = $productModel->getResource()
       ->getAttribute($manu_code)
       ->getSource()
       ->getAllOptions(false);
       
      return $manufacturers;
    }
}

?>