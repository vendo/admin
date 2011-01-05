<?php
/**
 * Admin controller for users
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_User extends Controller_Admin
{
	/**
	 * Lists all users
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->request->response = new View_Admin_User_Index;
	}
	
	/**
	 * Adds a user
	 *
	 * @return null
	 */
	public function action_add()
	{
		$this->request->response = new View_Admin_User_Add;
	}
	
	/**
	 * Edits a user
	 *
	 * @return null
	 */
	public function action_edit()
	{
		$this->request->response = new View_Admin_User_Edit;
	}
	
	/**
	 * Deletes a user
	 *
	 * @return null
	 */
	public function action_delete()
	{
		$id = arr::get($_POST, 'id');

		// check for csrf

		// delete the user

		// redirect
	}
}