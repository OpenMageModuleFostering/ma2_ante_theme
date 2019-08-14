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
/* $Id: Patern.php 12 2013-11-05 10:00:22Z minhnv $ */

class Ma2_ThemeOptions_Block_Adminhtml_System_Config_Form_Field_patern extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /**
     * Override method to output our custom image   omg
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return String
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        // Get the default HTML for this option
        $html = parent::_getElementHtml($element);

	    $html = '<div class="paterns-row">';
        $value = $element->getValue();
        if ($values = $element->getValues()) {
            foreach ($values as $option) {
                $html.= $this->_optionToHtml($element, $option, $value);
            }
        }
        $html.= $element->getAfterElementHtml();
	    $html.= '</div>';

        return $html;
    }

	/**
	 * Override method to output wrapper
	 *
	 * @param Varien_Data_Form_Element_Abstract $element
	 * @param Array $option
	 * @param String $selected
	 * @return String
	 */
    protected function _optionToHtml($element, $option, $selected)
    {
	    $float = ( $option['value'] == 'light' ? 'right' : 'left' );
        $html = '<div class="'.$float.' a-center ma2-radio">';
	    $html .= '<div class="ma2-thumb" style="background:url('.Mage::getDesign()->getSkinUrl('images/paterns/'.$option['value'].'.png').') 0 0 repeat;"></div>';
	    $html .= '<input type="radio"'.$element->serialize(array('name', 'class', 'style'));
        if (is_array($option)) {
            $html.= 'value="'.htmlspecialchars($option['value'], ENT_COMPAT).'"  id="'.$element->getHtmlId().$option['value'].'"';
            if ($option['value'] == $selected) {
                $html.= ' checked="checked"';
            }
            $html.= ' />';
        }
        elseif ($option instanceof Varien_Object) {
            $html.= 'id="'.$element->getHtmlId().$option->getValue().'"'.$option->serialize(array('label', 'title', 'value', 'class', 'style'));
            if (in_array($option->getValue(), $selected)) {
                $html.= ' checked="checked"';
            }
            $html.= ' />';
        }
        $html.= '</div>';
        $html.= $element->getSeparator() . "\n";
        return $html;
    }

}