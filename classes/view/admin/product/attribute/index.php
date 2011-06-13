<?php

/**
 * Admin product attribute index view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Product_Attribute_Index extends View_Admin_Layout
{
	public $title = 'All Product Attributes';

	/**
	 * Returns all the products to display in the template
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
	 * Returns routes for this view
	 *
	 * @return array
	 */
	public function routes()
	{
		return parent::routes()+array(
			'edit_product_attribute' => Route::get('actions')->uri(
				array(
					'controller' => 'product_attribute',
					'action' => 'edit',
				)
			),
			'delete_product_attribute' => Route::get('actions')->uri(
				array(
					'controller' => 'product_attribute',
					'action' => 'delete',
				)
			),
		);
	}
}