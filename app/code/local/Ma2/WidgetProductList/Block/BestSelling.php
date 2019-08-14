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
 * @copyright   Copyright (c) 2013 MagenMarket, NetQ Creative Software Co. (http://www.magenmarket.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
**/
/* $Id: BestSelling.php 4 2013-10-08 04:27:03Z linhnt $ */

class Ma2_WidgetProductList_Block_BestSelling extends Mage_Catalog_Block_Product_Abstract implements Mage_Widget_Block_Interface
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
    
    /**
     * Get products collection
     */
  protected function _getProductCollection()
  {
      if (is_null($this->_productCollection))
      {
          $visibility = array(
                  Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH,
                  Mage_Catalog_Model_Product_Visibility::VISIBILITY_IN_CATALOG);
          $storeId = Mage::app()->getStore()->getId();
          $collection = Mage::getResourceModel('reports/product_collection')
                            ->addAttributeToSelect('*')
                            ->addOrderedQty()
                            ->addAttributeToFilter('visibility', $visibility)
                            ->setStoreId($storeId)
                            ->addStoreFilter($storeId)
                            ->setPageSize($this->getData('products_count'))
                            ->setOrder('ordered_qty', 'DESC');
    $this->_productCollection = $collection;
      }
      return $this->_productCollection;
  }

  public function _toHtml()
  {
      $this->assign('WidgetProductProductCollection',$this->_getProductCollection());
      $_columnCount = $this->getData('column_count');
      if(!$_columnCount || $_columnCount == 0 || empty($_columnCount)) $_columnCount = 3;
      $this->assign('item_width',(int)(100/$_columnCount));
      $this->assign('_columnCount',(int)$_columnCount);
      foreach($this->getData() as $_para=>$value)
      {
        $this->assign($_para, $value);
      }
      return parent::_toHtml();
  }
}