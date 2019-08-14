<?php 

class Ma2_Manufacturers_Block_List extends Mage_Catalog_Block_Product_Abstract {
  
  public function __construct()
  {
    parent::__construct();
    if (!$this->getTemplate()) {
      $this->setTemplate('ma2_manufacturers/default.phtml');
    }
  }
  
  public function getManufacturers()
  {
    if (is_null($this->_allManufacturers)){
      $manufacturers = Mage::getModel("manufacturers/system_config_source_manuid")->toOptionArray();
      if (!count($manufacturers)) return array();
      
      // included or excluded?
      if ($this->getIncluded() && trim($this->getIncluded()) != ''){
        $included = explode(',', str_replace(' ', '', $this->getIncluded()));
        $tmpManu = array();
        foreach($manufacturers as $manufacturer){
          if (in_array($manufacturer['value'], $included)) $tmpManu[] = $manufacturer;
        }
        
        unset($manufacturers);
        $manufacturers = $tmpManu;
        
      } else if ($this->getExcluded() && trim($this->getExcluded()) != ''){
        $excluded = explode(',', str_replace(' ', '', $this->getExcluded()));
        $tmpManu = array();
        foreach($manufacturers as $manufacturer){
          if (!in_array($manufacturer['value'], $included)) $tmpManu[] = $manufacturer;
        }
        
        unset($manufacturers);
        $manufacturers = $tmpManu;
      }
      
      
      $manu_code = Mage::getStoreConfig('manufacturers/general/attr_code');
      
      for($i = 0; $i < count($manufacturers); $i++){
        // logo
        $manufacturers[$i]['image'] = Mage::getStoreConfig('manufacturers/image/'.$manufacturers[$i]['value']);
        
        // product count
        $collection = Mage::getModel('catalog/product')->getCollection()
          ->addAttributeToFilter($manu_code, array('in' => array($manufacturers[$i]['value'])))
          ->load();
        $manufacturers[$i]['product_count'] = $collection->count();
        
      }
      
      
      $this->_allManufacturers = $manufacturers;
      
    }
    return $this->_allManufacturers;
  }  
  
  protected function _beforeToHtml()
  {
      /* var_dump($this->getShowLogo());
      var_dump($this->getShowProductCount());
      
      var_dump($this->getGridCol());
      var_dump($this->getIncluded()); */
      return parent::_beforeToHtml();
  }
}
?>