<?php

/**
 * Admin order index view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Order_Index extends View_Admin_Layout
{
	public $title = 'All Orders';

	// Which page to show
	public $page = 1;

	/**
	 * Obtains all orders and formats them for display
	 *
	 * @return array
	 */
	public function orders()
	{
		$orders = array();

		foreach (Model_Order::get_orders(10, $this->page-1) as $order)
		{
			$foo = array(
				'id' => $order->id,
				'date_created' => date('m/d/Y', $order->date_created),
				'address_id' => $order->address_id,
				'amount' => number_format($order->amount(), 2),
			);

			if ($order->user_id)
			{
				$foo['user'] = array(
					'id' => $order->user_id,
					'name' => $order->user->last_name.', '.
						$order->user->first_name,
				);
			}
			elseif ($order->contact_id)
			{
				$foo['contact'] = array(
					'id' => $order->contact_id,
					'name' => $order->contact->last_name.', '.
						$order->contact->first_name,
				);
			}

			$orders[] = $foo;
		}

		return $orders;
	}

	/**
	 * Gets pages information for pagination
	 *
	 * @return array
	 */
	public function pages()
	{
		$pages = array();
		for ($i = 1; $i <= ceil(
			Model::factory('order')->load(NULL, NULL)->count()/10
		); $i++)
		{
			$pages[] = array(
				'text' => $i,
				'link' => Route::get('actions')->uri(
					array('controller' => 'order', 'action' => 'index')
				).'?p='.$i,
			);
		}

		return $pages;
	}

	/**
	 * Return routes for this view
	 *
	 * @return array
	 */
	public function routes()
	{
		return parent::routes()+array(
			'order_view' => Route::get('actions')->uri(
				array('controller' => 'order', 'action' => 'view')
			),
			'user' => Route::get('actions')->uri(
				array('controller' => 'user', 'action' => 'view')
			),
			'contact' => Route::get('actions')->uri(
				array('controller' => 'contact', 'action' => 'view')
			),
			'address' => Route::get('actions')->uri(
				array('controller' => 'address', 'action' => 'view')
			),
		);
	}
}