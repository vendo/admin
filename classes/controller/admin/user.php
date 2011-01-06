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

		$user = new Model_Vendo_User;
		$address = new Model_Vendo_Address;

		if ($_POST)
		{
			$user_post = arr::get($_POST, 'user', array());
			unset($user_post['id']);
			$address_post = arr::get($_POST, 'address', array());
			unset($address_post['id']);
			$validate = Model_Vendo_User::get_password_validation($user_post);

			$roles = arr::get($user_post, 'role_id', array());
			unset($_POST['user']['role_id']);
			unset($_POST['user']['repeat_password']);

			$user->set_fields($user_post);
			$address->set_fields($address_post);

			try
			{
				// See if the user entered any address information
				$entered_address = FALSE;
				foreach ($address_post as $address_info)
				{
					if ($address_info)
					{
						$entered_address = TRUE;
						break;
					}
				}

				if ($entered_address)
				{
					$address->save();
					$user->address_id = $address->id;
				}
				else
				{
					$user->address_id = NULL;
				}

				$user->save($validate);

				foreach ($roles as $role)
				{
					$user->vendo_roles = $role;
				}

				Request::instance()->redirect('home');
			}
			catch (AutoModeler_Exception $e)
			{
				$this->request->response->errors = (string) $e;

				// If we've saved an address, get rid of it because it's junk
				// This can happen if the address is valid on the page, but the
				// user is not
				if ($address->id)
				{
					$address->delete();
				}
			}
		}

		$this->request->response->user = $user;
		$this->request->response->address = $address;
	}
	
	/**
	 * Edits a user
	 *
	 * @return null
	 */
	public function action_edit()
	{
		$this->request->response = new View_Admin_User_Edit;
		$user = new Model_Vendo_User(arr::get($_GET, 'id'));
		$address = $user->address ? $user->address : new Model_Vendo_Address;

		if ($_POST)
		{
			$user_post = arr::get($_POST, 'user', array());
			$address_post = arr::get($_POST, 'address', array());

			$validate = NULL;
			if (arr::get($_POST, 'password'))
			{
				$validate = Model_Vendo_User::get_password_validation(
					$user_post
				);
			}
			else
			{
				unset($user_post['password'], $user_post['repeat_password']);
			}

			$user->set_fields($user_post);
			$address->set_fields($address_post);
			$address->id = NULL;

			try
			{
				// See if the user entered any address information
				$entered_address = FALSE;
				foreach ($address_post as $address_info)
				{
					if ($address_info)
					{
						$entered_address = TRUE;
						break;
					}
				}

				// Only save the address if they've entered data and it's
				// different than their old one
				$user_address = $user->address
					? $user->address
					: new Model_Vendo_Address;

				if (
					$entered_address
					AND $address->as_array() != $user_address
				)
				{
					$address->save();
					$user->address_id = $address->id;
				}

				$user->save($validate);

				$this->request->response->success =
					'You have successfully updated the user';
			}
			catch (AutoModeler_Exception $e)
			{
				$this->request->response->errors = (string) $e;
			}
		}

		$this->request->response->user = $user;
		$this->request->response->address = $address;
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
		if ( ! security::check('user', 'delete'))
		{
			$this->request->redirect(Route::get('user actions')->uri());
		}

		// delete the user
		$user = new Model_User($id);
		$user->delete();

		// redirect
		$this->request->redirect(Route::get('user actions')->uri());
	}
}