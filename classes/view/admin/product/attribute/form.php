<?php

/**
 * Admin product attribute form view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Product_Attribute_Form extends View_Admin_Layout
{
	public $title = 'Add A Product Attribute';

	public $attribute;
	public $errors;

	/**
	 * Gets a safe version of the product attribute
	 *
	 * @return array
	 */
	public function attribute()
	{
		return $this->attribute->as_array();
	}
}