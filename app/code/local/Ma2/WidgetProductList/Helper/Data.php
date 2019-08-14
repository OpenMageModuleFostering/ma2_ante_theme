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
/* $Id: Data.php 2 2013-10-07 08:18:48Z linhnt $ */

class Ma2_WidgetProductList_Helper_Data extends Mage_Core_Helper_Abstract 
{
	public function randomkeys($length) {
		$pattern = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$key = '';
		for($i = 0; $i < $length; $i++) {
			$key .= $pattern{rand(0,strlen($pattern)-1)};
		}
		return $key;
	}
}