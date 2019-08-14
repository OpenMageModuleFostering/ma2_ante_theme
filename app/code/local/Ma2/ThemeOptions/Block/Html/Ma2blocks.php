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
/* $Id: Ma2blocks.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Block_Html_Ma2blocks extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
		
		if ($this->hasData('template')) {
            $this->setTemplate($this->getData('template'));
        } else {
			$this->setTemplate('page/html/ma2blocks.phtml');
		}
    }
	
	protected $_layouts = array(
		'1' => array('100'),
		'2' => array('50','50'),
		'3' => array('33','33','33'),
		'4' => array('25','25','25','25'),
		'5' => array('20','20','20','20','20')
	);
	
	public function getLayouts($block_name, $num_blocks = 1)
	{
		$create_column = trim(Mage::getStoreConfig('theme_options/blocks_layout/create_column_'.$block_name));
		if(intval($create_column) == 0){
			return array();
		}

		$default_column = trim(Mage::getStoreConfig('theme_options/blocks_layout/default_column_'.$block_name));
		if(intval($default_column) == 1){
			return $this->_layouts[(int)$num_blocks];
		}

		$store_config_layouts = trim(Mage::getStoreConfig('theme_options/blocks_layout/'.$block_name));
		$layout_boxes = array();
		
		if($store_config_layouts != '') {
			
			$store_config_layouts = explode(";", $store_config_layouts);
			
			if(count($store_config_layouts) > 0) {
				
				foreach ($store_config_layouts as $idx=>$store_config_layout) 
				{
					if (trim($store_config_layout) !=""){
						$layout_boxes[$idx+1] = explode(",", trim($store_config_layout));
					}
				}
			}
		}

		if(!count($layout_boxes)) 
		{
			$layout_boxes = $this->_layouts;
		}
		
		return $layout_boxes[(int)$num_blocks];
	}
}
?>