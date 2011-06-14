<?php
/**
 * Layout view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Layout extends View_Layout
{
	/**
	 * Var method to build the links sidebar that this user can see. Overloaded
	 * to show admin links for admin app
	 * 
	 * @return string
	 */
	public function account_links()
	{
		$links = array(
			array(
				'location' => Route::get('default')->uri(),
				'text' => 'Return Home',
			)
		);

		$links[] = array(
			'location' => Route::get('admin panel')->uri(
				array('action' => 'index')
			),
			'text'     => 'Admin Home',
		);
		$links[] = array(
			'location' => 'admin/category',
			'text'     => 'Manage Product Categories',
		);
		$links[] = array(
			'location' => 'admin/product',
			'text'     => 'Manage Products',
		);
		$links[] = array(
			'location' => Route::get('actions')->uri(
				array(
					'controller' => 'user',
					'action' => 'index',
				)
			),
			'text'     => 'Manage Users',
		);
		$links[] = array(
			'location' => Route::get('actions')->uri(
				array(
					'controller' => 'order',
					'action' => 'index',
				)
			),
			'text'     => 'Manage Orders',
		);

		return $links;
	}
}
