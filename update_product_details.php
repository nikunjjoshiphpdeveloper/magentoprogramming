<?php
    // PUT THIS FILE IN ROOT FOLDER WHERE YOUR WEBSITE HOSTED
    $mageFilename = 'app/Mage.php';
    require_once $mageFilename;
    umask(0);

    Mage::app('admin');
    Mage::register('isSecureArea', 1);
    Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

    // GET PRODUCT BY ID
    $product_id = 1; // YOUR PRODUCT ID
    $product = Mage::getModel('catalog/product')->load($product_id);

    // GET PRODUCT BY ATTRIBUTE.
    //$product = Mage::getModel('catalog/product')->loadByAttribute('sku',$sku);

    if($product)
    {
        // UPDATE PRODUCT NAME.
        $name = 'Name of the product';
        $product->setName($name);

        // UPDATE PRODUCT SKU
        $sku = 'sku-of-product';
        $product->setSku($sku);

        // UPDATE PRODUCT SHORT DESCRIPTION.
        $short_description = 'Short Description of Product';
        $product->setShortDescription(addslashes($short_description));

        // UPDATE PRODUCT DESCRIPTION
        $description = 'Description of Product';
        $product->setDescription(addslashes($description));

        // UPDATE PRODUCT META DETAILS
        $meta_title = 'name or title';
        $product->setMetaTitle(addslashes($meta_title));

        $meta_keywords = 'Keywords of product';
        $product->setMetaKeyword(addslashes($meta_keywords));
        
        $meta_description = 'meta Description';
        $product->setMetaDescription(addslashes($meta_description));

        // UPDATE PRODUCT CATEGORIES
        // CATEGORY ID LIST AS ARRAY
        $categories = array(3);
        $product->setCategoryIds($categories);

        // UPDATE PRICE
        $price = 15.75;
        $product->setPrice($price);

        // UPDATE STOCK AND STATUS OF STOCK
        $qty = 10;
        if($qty > 0) { $is_in_stock = 1; } else { $is_in_stock = 0; }

        $stockItem = Mage::getModel('cataloginventory/stock_item')->loadByProduct($product_id);
        if ($stockItem->getId() > 0)
        {
            $stockItem->setQty($qty);
            //$stockItem->setIsInStock((int)($qty > 0));
            $stockItem->setIsInStock($is_in_stock);
            $stockItem->save();
        }

        // UPDATE PRODUCT STATUS ENABLE OR DISABLE.
        $status = 1;
        $product->setStatus($status);

        if($product->save()) {
            echo "Product Updated Successfully ID: ".$product_id; exit();
        }
        else {
            echo "Error in saving product ID: ".$product_id; exit();
        }
    }
    else {
        echo "Error in getting product ID: ".$product_id; exit();
    }
?>