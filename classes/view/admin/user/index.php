<?php

/**
 * Admin user index view class
 *
 * @package    Vendo
 * @author     Jeremy Bush
 * @copyright  (c) 2010 Jeremy Bush
 * @license    http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_User_Index extends View_Layout
{
	public $title = 'All Users';

	/**
	 * Returns all the users to display in the template
	 *
	 * @return array
	 */
	public function users()
	{
		$users = array();
		foreach (Model::factory('vendo_user')->load(NULL, NULL) as $user)
		{
			$roles = array();
			foreach ($user->find_related('vendo_roles') as $role)
			{
				$roles[] = $role->name;
			}

			$users[] = array(
				'id' => $user->id,
				'email' => $user->email,
				'roles' => implode(', ', $roles),
			);
		}

		return $users;
	}

	/**
	 * Returns routes for this view
	 *
	 * @return array
	 */
	public function routes()
	{
		return parent::routes()+array(
			'add_user' => Route::get('user actions')->uri(array('action' => 'add')),
			'edit_user' => Route::get('user actions')->uri(array('action' => 'edit')),
			'delete_user' => Route::get('user actions')->uri(array('action' => 'delete')),
		);
	}
}