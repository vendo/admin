<?php
/**
 * Admin controller for orders
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_ORder extends Controller_Admin
{
	/**
	 * Lists all orders, paginated
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->request->response = new View_Admin_Order_Index;
		$this->request->response->page = arr::get($_GET, 'p', 1);
	}

	/**
	 * Views a placed order
	 *
	 * @return null
	 */
	public function action_view()
	{
		$order = new Model_Order(arr::get($_GET, 'id', NULL));

		if (Model_Order::STATE_LOADED != $order->state())
		{
			throw new Vendo_404('Order not found!');
		}

		$this->request->response = new View_Admin_Order_View;
		$this->request->response->order = $order;
	}
}