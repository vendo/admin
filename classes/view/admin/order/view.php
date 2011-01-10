<?php

/**
 * Admin order index view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Order_View extends View_Admin_Layout
{
	public $title = 'View Order';

	public $order;

	/**
	 * Returns details for this order
	 *
	 * @return array
	 */
	public function order()
	{
		return $this->order->as_array();
	}
}