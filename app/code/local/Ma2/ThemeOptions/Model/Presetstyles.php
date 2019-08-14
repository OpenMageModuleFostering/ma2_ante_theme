<?php
class Ma2_ThemeOptions_Model_Presetstyles
{
    public function toOptionArray()
    {
        return array(		
			array('value' => 'blue',	'label' => Mage::helper('ThemeOptions')->__('Blue')),
			array('value' => 'green',	'label' => Mage::helper('ThemeOptions')->__('Green')),
			array('value' => 'yellow',		'label' => Mage::helper('ThemeOptions')->__('Yellow'))
        );
    }
}

