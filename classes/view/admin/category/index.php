<?php

/**
 * Admin category index view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Category_Index extends View_Admin_Layout
{
	public $title = 'All Categories';

	protected $_partials = array(
		'product_category' => 'admin/category/product_category',
	);

	/**
	 * Returns all the categories to display in the template
	 *
	 * @return array
	 */
	public function categories()
	{
		return AutoModeler::factory('vendo_product_category')->full_tree();
	}
}