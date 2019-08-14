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
/* $Id: Backgroundrepeat.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Model_Backgroundrepeat
{
    public function toOptionArray()
    {
        return array(
            array('value'=>'no-repeat', 'label'=>Mage::helper('ThemeOptions')->__('No Repeat')),
            array('value'=>'repeat-x', 'label'=>Mage::helper('ThemeOptions')->__('Repeat X')),
            array('value'=>'repeat-y', 'label'=>Mage::helper('ThemeOptions')->__('Repeat Y')),
			array('value'=>'repeat', 'label'=>Mage::helper('ThemeOptions')->__('Repeat All'))
        );
    }

}