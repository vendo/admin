<?php

/**
 * Admin product index view class
 *
 * @package    Vendo
 * @author     Jeremy Bush
 * @copyright  (c) 2010 Jeremy Bush
 * @license    http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Product_Index extends View_Layout
{
	public $title = 'All Products';

	/**
	 * Returns all the products to display in the template
	 *
	 * @return array
	 */
	public function products()
	{
		$products = array();
		foreach (AutoModeler_ORM::factory('vendo_product')->fetch_all() as $product)
		{
			$products[] = $product->as_array();
		}
		return $products;
	}
}