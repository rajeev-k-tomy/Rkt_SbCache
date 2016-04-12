<?php
/**
 * Rkt_SbCache extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category       Rkt
 * @package        Rkt_SbCache
 * @author         Rajeev K Tomy <programmer.rkt@gmail.com>
 * @copyright      Copyright (c) 2015
 * @license        http://opensource.org/licenses/mit-license.php MIT License
 */

/**
 * Observer Class
 *
 * Listen To : core_block_abstract_to_html_before
 *
 * Use to apply cacheing for CMS Blocks, which lacks in core Magento.
 *
 * @category    Rkt
 * @package     Rkt_Config
 * @author      Rajeev K Tomy <programmer.rkt@gmail.com>
 */
class Rkt_SbCache_Model_Observer
{

	/**
	 * Use to apply cacheing for CMS Blocks in Magento.
	 *
	 * By default, Magento is not applying cacheing for CMS blocks. This function
	 * will apply cache for CMS Blocks and thus help us to overcome this difficulty.
	 *
	 * @access public
	 * @param  Varien_Event_Observer       $observer
	 * @return Rkt_SbCache_Model_Observer
	 */
	public function enableCmsBlockCaching(Varien_Event_Observer $observer)
	{
        if (!$this->_getHelper()->isEnabled()){
            return;
        }

		$block = $observer->getBlock();

		//make sure cache is going to apply for a cms block.
        if ($block instanceof Mage_Cms_Block_Widget_Block
            || $block instanceof Mage_Cms_Block_Block
        ) {

        	//making a unique cache key for each cms blocks so that cached HTML
        	//content will be unique per each static block
            $cacheKeyData = array(
                Mage_Cms_Model_Block::CACHE_TAG,
                $block->getBlockId(),
                Mage::app()->getStore()->getId(),
                intval(Mage::app()->getStore()->isCurrentlySecure()),
                Mage::getDesign()->getPackageName(),
                Mage::getDesign()->getTheme('template')
                //Mage::helper('rkt_sbcache')->randomString() // UNCOMMENT IF IT IS NECESSARY
            );
            $block->setCacheKey(implode('_', $cacheKeyData));

            //set cache tags. This will help us to clear the cache related to
            //a static block based on store, CMS cache, or by identifier.
            $block->setCacheTags(array(
		        Mage_Core_Model_Store::CACHE_TAG,
		        Mage_Cms_Model_Block::CACHE_TAG,
		        (string)$block->getBlockId()
		    ));

		    //setting cache life time to default. ie 7200 seconds(2 hrs).
		    //an integer value in seconds. eg : 86400 for one day cache
            $block->setCacheLifetime($this->_getHelper()->getCacheTimeout());
        }

	}

    /**
     * @return Rkt_SbCache_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('rkt_sbcache');
    }

}
