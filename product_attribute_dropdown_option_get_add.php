<?php
	// PUT THIS FILE IN ROOT FOLDER WHERE YOUR WEBSITE HOSTED
    $mageFilename = 'app/Mage.php';
    require_once $mageFilename;
    umask(0);

    Mage::app('admin');
    Mage::register('isSecureArea', 1);
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

    $attributeValue = 'CEAT'; // Brand (Manufacturer) Option Check
    $attributeCode = 'manufacturer';
    $attribute = Mage::getModel('eav/entity_attribute')->loadByCode('catalog_product', $attributeCode);

    $optionId = Mage::getModel('eav/entity_attribute_source_table')->setAttribute($attribute)->getOptionId($attributeValue);

    // IF OPTION NOT FOUND THEN CREATE NEW OPTION IN MANUFATURER ATTRIBUTE
    if($optionId == '' || $optionId <= 0)
    {
        $value['option'] = array($attributeValue,$attributeValue);
        $result = array('value' => $value);
        $attribute->setData('option', $result);
        $attribute->save();
        $optionId = Mage::getModel('eav/entity_attribute_source_table')->setAttribute($attribute)->getOptionId($attributeValue);
    }

    echo $optionId; // GET ATTRIBUTE OPTION ID
?>