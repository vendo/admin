<?php
/**
 * Admin controller for categories
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_Category extends Controller_Admin
{
	/**
	 * Lists all categories
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->request->response = new View_Admin_Category_Index;
	}

	/**
	 * Add a category
	 *
	 * @return null
	 */
	public function action_add()
	{
		$this->request->response = new View_Admin_Category_Form;
		$this->request->response->bind('category', $category);
		$this->request->response->bind('errors', $errors);

		$category = new Model_Vendo_Product_Category;

		if ($_POST)
		{
			if ( ! arr::get($_POST, 'parent_id'))
				$_POST['parent_id'] = NULL;

			$category->set_fields($_POST);

			try
			{
				$category->save();
				$this->request->redirect('admin/category');
			}
			catch (AutoModeler_Exception $e)
			{
				$errors = (string) $e;
			}
		}
	}

	/**
	 * Edits a category
	 *
	 * @return null
	 */
	public function action_edit()
	{
		$id = arr::get($_GET, 'id');
		$this->request->response = new View_Admin_Category_Form;
		$this->request->response->bind('category', $category);
		$this->request->response->bind('errors', $errors);

		$category = new Model_Vendo_Product_Category($id);

		if ($_POST)
		{
			if ( ! arr::get($_POST, 'parent_id'))
				$_POST['parent_id'] = NULL;

			$category->set_fields($_POST);

			try
			{
				$category->save();
				$this->request->redirect('admin/category');
			}
			catch (AutoModeler_Exception $e)
			{
				$errors = (string) $e;
			}
		}
	}
}