<?php
/**
 * Abstract admin module controller
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin extends Controller
{
	/**
	 * Overload before method to restrict access to only admins
	 *
	 * @return null
	 */
	public function before()
	{
		parent::before();

		Auth::instance()->get_user()->assert('use_admin');
	}
}