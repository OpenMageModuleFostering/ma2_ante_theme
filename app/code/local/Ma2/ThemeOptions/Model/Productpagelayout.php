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
 * @category    Themes
 * @package     Ma2_Default theme
 * @copyright   Copyright (coffee) 2013 MagenMarket, http://www.magenmarket.com
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
**/
/* $Id: Productpagelayout.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Model_Productpagelayout
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'productpage_small', 'label'=>Mage::helper('ThemeOptions')->__('Small')),
            array('value'=>'productpage_medium', 'label'=>Mage::helper('ThemeOptions')->__('Medium')),
            array('value'=>'productpage_large', 'label'=>Mage::helper('ThemeOptions')->__('Large')),
            array('value'=>'productpage_extralarge', 'label'=>Mage::helper('ThemeOptions')->__('Extra large'))
        );
    }

}