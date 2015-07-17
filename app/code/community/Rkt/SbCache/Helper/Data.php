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
 * Helper Class
 *
 * Default Helper class.
 *
 * @category    Rkt
 * @package     Rkt_Config
 * @author      Rajeev K Tomy <programmer.rkt@gmail.com>
 */
class Rkt_SbCache_Helper_Data extends Mage_Core_Helper_Abstract
{

	/**
	 * constants.
	 *
	 * @const NUM_LETTERS     Number + Letters.
	 */
	const NUM_LETTERS = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	/**
	 * Use to generate a random string
	 *
	 * @access public
	 * @param  integer $length
	 * @return string
	 */
	public function randomString($length = 5)
	{
		$characters = self::NUM_LETTERS;
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
		    $randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}
}