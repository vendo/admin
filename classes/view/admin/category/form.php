<?php

/**
 * Admin category form view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Category_Form extends View_Layout
{
	public $title = 'Add A Category';

	public $category;
	public $errors;

	protected $_partials = array(
		'product_category_form' => 'admin/category/product_category_form',
	);

	/**
	 * Gets a safe version of the category
	 *
	 * @return array
	 */
	public function category()
	{
		return $this->category->as_array();
	}

	/**
	 * Returns a nested array of product categories
	 *
	 * @return array
	 */
	public function product_categories()
	{
		return $this->category->full_tree(NULL, TRUE);
	}
}