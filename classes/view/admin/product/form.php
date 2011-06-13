<?php

/**
 * Admin product form view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Product_Form extends View_Admin_Layout
{
	public $title = 'Add A Product';

	public $product;
	public $categories = array();
	public $errors;

	protected $_partials = array(
		'product_category_form' => 'admin/product/product_category_form',
	);

	/**
	 * Gets a safe version of the product
	 *
	 * @return array
	 */
	public function product()
	{
		return $this->product->as_array()+array(
			'product_categories' => AutoModeler::factory(
				'vendo_product_category'
			)->full_tree(NULL, FALSE, $this->product)
		);
	}

	/**
	 * Returns a nested array of product categories
	 *
	 * @return array
	 */
	public function product_categories()
	{
		return Model::factory('vendo_product_category')->full_tree(
			NULL, TRUE, $this->product
		);
	}

	/**
	 * Returns an array of all attributes available for adding
	 *
	 * @return array
	 */
	public function attributes()
	{
		$attributes = array();

		foreach (
			Model::factory('vendo_product_attribute')->load(NULL, NULL)
			as $attribute
		)
		{
			$attributes[] = $attribute->as_array();
		}
		return $attributes;
	}

	/**
	 * Gets all existing attributes and values for this product
	 *
	 * @return array
	 */
	public function existing_attributes()
	{
		echo Debug::vars($this->product->attributes());
		return $this->product->attributes();
	}

	/**
	 * Returns routes for this view
	 *
	 * @return array
	 */
	public function routes()
	{
		return parent::routes();
	}
}