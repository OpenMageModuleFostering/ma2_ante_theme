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
/* $Id: New.php 18 2013-11-05 07:30:33Z linhnt $ */

class Ma2_WidgetProductList_Block_New
extends Mage_Catalog_Block_Product_Abstract
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
    
    /**
     * Get products collection
     */
    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection))
        {
            $todayStartOfDayDate  = Mage::app()->getLocale()->date()
                ->setTime('00:00:00')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
              
            $todayEndOfDayDate  = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
              
            /** @var $collection Mage_Catalog_Model_Resource_Product_Collection */
            $collection = Mage::getResourceModel('catalog/product_collection');
            $collection->setVisibility(Mage::getSingleton('catalog/product_visibility')->getVisibleInCatalogIds());
            
            $collection = $this->_addProductAttributesAndPrices($collection)
                ->addStoreFilter()
                ->addAttributeToFilter('news_from_date', array('or'=> array(
                    0 => array('date' => true, 'to' => $todayEndOfDayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter('news_to_date', array('or'=> array(
                    0 => array('date' => true, 'from' => $todayStartOfDayDate),
                    1 => array('is' => new Zend_Db_Expr('null')))
                ), 'left')
                ->addAttributeToFilter(
                    array(
                        array('attribute' => 'news_from_date', 'is'=>new Zend_Db_Expr('not null')),
                        array('attribute' => 'news_to_date', 'is'=>new Zend_Db_Expr('not null'))
                        )
                  )
                ->addAttributeToSort('news_from_date', 'desc')
                ->setPageSize($this->getProductsCount())
                ->setCurPage(1);
            Mage::getModel('review/review')->appendSummary($collection);
            $collection->load();
            
            $this->_productCollection = $collection;
            
        }
        return $this->_productCollection;
    }
    
    /**
      *  To html
      *	Assign variable and getValues
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