<?php
/**
 * MagenMarket.com
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * DISCLAIMER
 *
 * Edit or modify this file with yourown risk.
 *
 * @category    Extensions
 * @package     Ma2_WidgetProductList
 * @copyright   Copyright (c) 2013 MagenMarket. (http://www.magenmarket.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
**/
/* $Id: Custom.php 18 2013-11-05 07:30:33Z linhnt $ */

class Ma2_WidgetProductList_Block_Custom extends Mage_Catalog_Block_Product_Abstract
implements Mage_Widget_Block_Interface
{
  /**
   * Store product collection we got from widget option setting
   * @var Varien_Object
   */
  protected $_productCollection = null;
  /**
   * Initialization
   */
  protected function _construct()
  {
      parent::_construct();
  }
  
  protected function _getProductCollection()
  {
      if (is_null($this->_productCollection))
      {
          $ids = $this->getData('ids');
          if ($ids){
              $ids = explode('}{', $ids);
              $cleanIds = array();
              foreach ($ids as $id) {
                  $id = str_replace('{', '', $id);
                  $id = str_replace('}', '', $id);
                  $cleanIds[] = $id;
              }
              
              if (count($cleanIds)) {
                  $products = $this->_getProductsByIDs($cleanIds);
                  if ($products) {
                      $this->_productCollection = $products;
                  }
              }
          }
      }
      return $this->_productCollection;
  }

  protected function _getProductsByIDs($ids) {
      $storeId = Mage::app()->getStore()->getId();
      $collection = Mage::getModel('catalog/product')->getResourceCollection()
                      ->addAttributeToSelect('*')
                      ->addAttributeToFilter('status', 1)
                      ->addFieldToFilter('entity_id', array('in' => $ids))
                      ->addStoreFilter($storeId)
                      ->setOrder($this->getData('sort_by'), $this->getData('sort_dir'))
                      ;
      
      Mage::getSingleton('catalog/product_status')->addVisibleFilterToCollection($collection);
      Mage::getSingleton('catalog/product_visibility')->addVisibleInCatalogFilterToCollection($collection);
      Mage::getModel('review/review')->appendSummary($collection);
      $collection->load();
      
      return $collection;
  }

  public function _toHtml()
  {
      $this->assign('WidgetProductProductCollection',$this->_getProductCollection());
      $_columnCount = $this->getData('column_count');
      if(!$_columnCount || $_columnCount == 0 || empty($_columnCount)) $_columnCount = 3;
      $size_width = 100/$_columnCount;
      $this->assign('item_width',(int)$size_width);
      foreach($this->getData() as $_para=>$value)
      {
        $this->assign($_para, $value);
      }
      return parent::_toHtml();
  }
}