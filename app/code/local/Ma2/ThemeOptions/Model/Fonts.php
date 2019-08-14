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
/* $Id: Fonts.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Model_Fonts
{
	/**
	 * fonts list  omg
	 *
	 */
	
    public function toOptionArray()
    {
		defined('DS') || define('DS', DIRECTORY_SEPARATOR);
		
	    $sans_safe = array(
			"Arial, Helvetica, sans-serif",
			"'Arial Black', Gadget, sans-serif",
			"Impact, Charcoal, sans-serif",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif",
			"Tahoma, Geneva, sans-serif",
			"'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif"
		);
		$serif_safe = array(
			"'Book Antiqua', 'Palatino Linotype', Palatino, serif",
			"Bookman, serif",
			"Garamond, serif",
			"Georgia, serif",
			"'MS Serif', 'New York', serif",
			"'Times New Roman', Times, serif"
		);
		$monospace_safe = array(
			"Courier, monospace",
			"'Courier New', Courier, monospace",
			"'Lucida Console', Monaco, monospace"
		);
		
		$options = array();
		
		$font_default_Opt = array();
		$font_default_Opt[] = array(
			'label' => htmlentities("'Helvetica Neue', Helvetica, Arial, sans-serif"),
			'value' => htmlentities("s:'Helvetica Neue',Helvetica,Arial,sans-serif")
		);
		
		$sans_safe_Opt = array();
		foreach($sans_safe as $sansfont){
			$sans_safe_Opt[] = array(
				'label' => htmlentities($sansfont),
				'value' => 's:'.htmlentities($sansfont)
			);
		}
		$serif_safe_Opt = array();
		foreach($serif_safe as $seriffont){
			$serif_safe_Opt[] = array(
				'label' => htmlentities($seriffont),
				'value' => 's:'.htmlentities($seriffont)
			);
		}
		$monospace_safe_Opt = array();
		foreach($monospace_safe as $monospace_font){
			$monospace_safe_Opt[] = array(
				'label' => htmlentities($monospace_font),
				'value' => 's:'.htmlentities($monospace_font)
			);
		}
		
		$gwebfonts_Opt = array();
		
		if (!isset($_SESSION["gfontlist"]) || empty($_SESSION["gfontlist"])){
			$webfontJFile = realpath(Mage::getBaseDir('skin') . DS . 'adminhtml/default/default/ma2/js/webfonts/gwebfonts.json');
			$fontsJson = $this->file_include_contents($webfontJFile);
			$_SESSION["gfontlist"] = $fontsJson;
		}
		$webfonts = $_SESSION["gfontlist"] ? $_SESSION["gfontlist"] : $fontsJson;
			
		$webfonts = @json_decode($webfonts, true);
		$wfontArray = $webfonts["items"];
		if (is_array($wfontArray) && count($wfontArray) > 0){
			foreach($wfontArray as $idx => $wfont){
				$subsets = implode(',', (array)$wfont["subsets"]);
				$gwebfonts_Opt[] = array(
					'label' => htmlentities($wfont["family"] . ' (' .$subsets . ')'),
					'value' => htmlentities('w:' . str_replace(' ', '+', $wfont["family"]))
				);
				
			}
		}
		
		
		$options[] = array(
			'label' => 'Default',
			'value' => $font_default_Opt
		);
		$options[] = array(
			'label' => 'Safe Fonts: Sans-Serif',
			'value' => $sans_safe_Opt
		);
		$options[] = array(
			'label' => 'Safe Fonts: Serif',
			'value' => $serif_safe_Opt
		);
		$options[] = array(
			'label' => 'Safe Fonts: Monospace',
			'value' => $monospace_safe_Opt
		);
		$options[] = array(
			'label' => 'Google WebFonts',
			'value' => $gwebfonts_Opt
		);

        return $options;
    }
	
	public function file_include_contents($filename) {
		if (is_file($filename)) {
			ob_start();
			include $filename;
			$contents = ob_get_contents();
			ob_end_clean();
			return $contents;
		}
		return false;
	}

}