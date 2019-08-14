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
/* $Id: Bestselling.php 18 2013-11-05 07:30:33Z linhnt $ */

class Ma2_WidgetProductList_Block_Bestselling extends Mage_Catalog_Block_Product_Abstract implements Mage_Widget_Block_Interface
{
     /**
     * A model to serialize attributes
     * @var Varien_Object
     */
    protected $_serializer = null;
    protected $_final = null;
    /**
     * Initialization
     */
    protected function _construct()
    {
        $this->_serializer = new Varien_Object();
        parent::_construct();
    }
    /**
     * Get products collection
     */
    
    protected function _getProductCollection()
    {
      if (is_null($this->_productCollection))
      {
          $storeId = Mage::app()->getStore()->getId();
          $websiteId = Mage::getModel('core/store')->load($storeId)->getWebsiteId();
          $collection = Mage::getResourceModel('reports/product_collection')
                            ->addAttributeToSelect('*')
                            ->addStoreRestrictions($storeId, $websiteId)
                            ->addOrderedQty()
                            ->setOrder('ordered_qty', 'DESC') // must use addOrderedQty first
                            ->setPageSize($this->getData('products_count'))
                            ;
                            Mage::getModel('review/review')->appendSummary($collection);
                            $collection->load();
          $this->_productCollection = $collection;
      }
        return $this->_productCollection;
    }
      
    /**
     *  To html
     */
    public function _toHtml()
    {
        $this->assign('WidgetProductProductCollection',$this->_getProductCollection());
        $_columnCount = $this->getData('column_count');
        if(!$_columnCount || $_columnCount == 0 || empty($_columnCount)) $_columnCount = 3;
        $size_width = 100/$_columnCount;
        $this->assign('item_width',(int)$size_width);
        $this->assign('_columnCount',(int)$_columnCount);
        foreach($this->getData() as $_para=>$value)
        {
          $this->assign($_para, $value);
        }
        return parent::_toHtml();
    }
}