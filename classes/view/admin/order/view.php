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

	protected $_partials = array(
		'cart' => 'admin/order/cart',
	);

	/**
	 * Returns details for this order
	 *
	 * @return array
	 */
	public function order()
	{
		return $this->order->as_array();
	}

	/**
	 * Returns the user data for this order
	 *
	 * @return array
	 */
	public function user()
	{
		return $this->order->user;
	}

	/**
	 * Returns shipping information about this order
	 *
	 * @return array
	 */
	public function shipping()
	{
		return $this->order->address;
	}

	/**
	 * Determines if this order comes from a registered user or not
	 *
	 * @return book
	 */
	public function registered_user()
	{
		return NULL !== $this->order->user_id;
	}

	/**
	 * Var method to get the order's products
	 *
	 * @return array
	 */
	public function cart()
	{
		$cart_items = array();

		foreach ($this->order->get_products() as $product_id => $product)
		{
			$cart_items[] = array(
				'product'  => array(
					'total_price' => number_format($product['product']->price*$product['quantity'], 2)
				)+$product['product']->as_array(),
				'quantity' => $product['quantity'],
			);
		}

		return $cart_items;
	}

	/**
	 * Returns the total price for the order
	 *
	 * @return float
	 */
	public function total_price()
	{
		return number_format($this->order->amount(), 2);
	}
}