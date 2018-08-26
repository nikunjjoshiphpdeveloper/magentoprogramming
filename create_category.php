<?php
	/*
		* AUTHOR : NIKUNJ JOSHI (www.nikunjjoshiphpdeveloper.com)
	*/
	
	// CREATE OR ADD THIS FILE IN ROOT (MAGENTO INSTALLED) FOLDER.
	ini_set('display_errors', 1);
	$mageFilename = 'app/Mage.php';
	require_once $mageFilename;
	//Mage::setIsDeveloperMode(true);
	umask(0);

	Mage::app('admin');
	Mage::register('isSecureArea', 1);
	Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);

	$cat_name = "NAME OF CATEGORY"; // CHANGE THE NAME OF CATEGORY YOU WANT TO CREATE
	$cat_id = CheckAndSaveCategory($cat_name,2); // NO 2 IS THE ID OF MAIN PARENT (DEFAULT CATEGORY)
	if($cat_id > 0) {
		echo $cat_id.") ".$cat_name.' category created successfully. <br />';
	}
	else {
		echo "Error in create category ".$cat_name; exit();
	}


	function CheckAndSaveCategory($cat_name = '',$parent_cat_id = 2)
	{
		$cat_id = 0;
		if(trim($cat_name) != '')
		{
			$CategoryName = $cat_name;
			$parentCategoryId = $parent_cat_id;
			
			try
			{
				$category = Mage::getModel('catalog/category');
				$category->setName($CategoryName);
				$category->setUrlKey($CategoryName);
				$category->setIsActive(1);
				$category->setDisplayMode('PRODUCTS');
				$category->setIsAnchor(1); //for active anchor
				$category->setStoreId(Mage::app()->getStore()->getId());
				$parentCategory = Mage::getModel('catalog/category')->load($parentCategoryId);
				$category->setPath($parentCategory->getPath());
				$category->save();
				
				$cat_id = $category->getId();
				
				return $cat_id;
			}
			catch(Exception $e) {
				return $cat_id; // ERROR IN SAVING CATEOGRY.
			}
		}
		else {
			return $cat_id;
		}
	}
?>
