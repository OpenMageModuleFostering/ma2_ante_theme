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
/* $Id: Backgroundposition.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Model_Backgroundposition
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'left top', 'label'=>Mage::helper('ThemeOptions')->__('Left Top')),
            array('value'=>'center top', 'label'=>Mage::helper('ThemeOptions')->__('Center Top')),
            array('value'=>'right top', 'label'=>Mage::helper('ThemeOptions')->__('Right Top')),
			array('value'=>'left center', 'label'=>Mage::helper('ThemeOptions')->__('Left Center')),
            array('value'=>'center center', 'label'=>Mage::helper('ThemeOptions')->__('Center Center')),
            array('value'=>'right center', 'label'=>Mage::helper('ThemeOptions')->__('Right Center')),
            array('value'=>'left bottom', 'label'=>Mage::helper('ThemeOptions')->__('Left Bottom')),
            array('value'=>'center bottom', 'label'=>Mage::helper('ThemeOptions')->__('Center Bottom')),
            array('value'=>'right bottom', 'label'=>Mage::helper('ThemeOptions')->__('Right Bottom'))
        );
    }

}