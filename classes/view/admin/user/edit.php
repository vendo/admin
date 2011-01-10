<?php

/**
 * User edit view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_User_Edit extends View_Admin_Layout
{
	public $title = 'Edit a user';

	protected $_template = 'admin/user/form';

	public $user;
	public $address;
	public $errors;

	/**
	 * Gets a list of roles for the user to select.
	 * 
	 * @return array
	 */
	public function roles()
	{
		$roles = array();
		foreach (Model::factory('role')->load(NULL, NULL) as $role)
		{
			$roles[] = array(
				'id' => $role->id,
				'name' => $role->name,
			);
		}
		return $roles;
	}

	/**
	 * Returns routes for this view
	 *
	 * @return array
	 */
	public function routes()
	{
		return parent::routes()+array(
			'post' => Route::get('user actions')->uri(
				array('action' => 'edit')
			).'?id='.$this->user->id,
		);
	}
}