<?php
    // PUT THIS FILE IN ROOT FOLDER WHERE YOUR WEBSITE HOSTED
    $mageFilename = 'app/Mage.php';
    require_once $mageFilename;
    umask(0);

    Mage::app('admin');
    Mage::register('isSecureArea', 1);
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

    // FIRST CREATE FOLDER "images" IN "media" folder and add image of product
    $mediaPath = Mage::getBaseDir('media').DS.'images'.DS;

    $name = addslashes('Name of the product');
    
    $description = addslashes('Description of Product');
    
    $short_description = addslashes('Short Description of Product');
    
    $sku = 'sku-of-product';
    $url = 'url-of-product';
    
    $price = 15.75;
    
    $meta_title = addslashes('name or title');
    $meta_keywords = addslashes('Keywords of product');
    $meta_description = addslashes('meta Description');
    
    $mediaImage =  $mediaPath."noimageavailable.png"; // CHANGE WITH YOUR IMAGE NAME

    $qty = 5;
    if($qty > 0) { $is_in_stock = 1; } else { $is_in_stock = 0; }
    
    // CATEGORY ID LIST AS ARRAY
    $categories = array(3);

    $product = Mage::getModel("catalog/product");
    $product->setStoreId(0)
    ->setWebsiteIds(array(1))
    ->setAttributeSetId(4)
    ->setTypeId('simple')
    ->setCreatedAt(strtotime('now'))
    ->setIsMassupdate(true)
    ->setExcludeUrlRewrite(true)
    ->setWeight(1)
    ->setStatus(1)
    ->setTaxClassId(2)
    ->setCountryOfManufacture('US')
    ->setVisibility(Mage_Catalog_Model_Product_Visibility::VISIBILITY_BOTH)
    ->setName($name)
    ->setDescription($description)
    ->setShortDescription($short_description)
    ->setSku($sku)
    ->setUrlkey($url)
    ->setPrice($price)
    ->setMetaTitle($meta_title)
    ->setMetaKeyword($meta_keywords)
    ->setMetaDescription($meta_description)
    ->addImageToMediaGallery($mediaImage,array('image','small_image','thumbnail'), false, false)
    ->setStockData(array(
        'use_config_manage_stock' => 1,
        'manage_stock' => 1,
        'min_sale_qty' => 1,
        'max_sale_qty' => '',
        'is_in_stock' => $is_in_stock,
        'qty' => $qty
    ))
    ->setCategoryIds($categories);

    if($product->save())
    {
        $prod_id = $product->getId();
        if($prod_id > 0) {
            echo "Product Added Successfully ID: ".$prod_id; exit();
        }
        else {
            echo "Error in getting product ID"; exit();
        }
    }
    else {
        echo "Error in saving product"; exit();
    }
?>