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
/* $Id: Data.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Helper_Data extends Mage_Core_Helper_Abstract
{
	//public $section = 'theme_options';
	
	public function getAllConfig($section)
	{
		return Mage::getStoreConfig($section);
	}
	
	/**
	 *
	 *get theme options
	 *
	 */
	public function getGroupConfig($section, $group)
	{
		return Mage::getStoreConfig($section.'/'.$group);
	}
	
	/**
	 *
	 *get theme options
	 *
	 */
	public function getFieldConfig($section, $group, $field)
	{
		return Mage::getStoreConfig($section.'/'.$group.'/'.$field);
	}
}