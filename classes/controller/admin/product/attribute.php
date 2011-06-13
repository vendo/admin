<?php

/**
 * Admin controller for product attribute categories
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_Product_Attribute extends Controller_Admin
{
	/**
	 * Displays all the product attributes to edit/delete them
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->view = new View_Admin_Product_Attribute_Index;
	}

	/**
	 * Add a product attribute
	 *
	 * @return null
	 */
	public function action_add()
	{
		$this->view = new View_Admin_Product_Attribute_Form;
		$this->view->title = 'Add A Product Attribute';
		$this->view->bind('attribute', $attribute);

		$attribute = new Model_Vendo_Product_Attribute;

		if (HTTP_Request::POST === $this->request->method())
		{
			$attribute->set_fields($this->request->post());

			try
			{
				$attribute->save();

				$this->request->redirect(
					Route::get('actions')->uri(
						array(
							'controller' => 'product_attribute',
							'method' => 'index',
						)
					)
				);
			}
			catch (AutoModeler_Exception $e)
			{
				$errors = (string) $e;
			}
		}
	}

	/**
	 * Edits a product
	 *
	 * @return null
	 */
	public function action_edit()
	{
		$id = $this->request->query('id');
		$this->view = new View_Admin_Product_Attribute_Form;
		$this->view->title = 'Edit Product Attribute';
		$this->view->bind('attribute', $attribute);

		$attribute = new Model_Vendo_Product_Attribute($id);

		if (HTTP_Request::POST === $this->request->method())
		{
			$attribute->set_fields($this->request->post());

			try
			{
				$attribute->save();

				$this->request->redirect(
					Route::get('actions')->uri(
						array(
							'controller' => 'product_attribute',
							'method' => 'index',
						)
					)
				);
			}
			catch (AutoModeler_Exception $e)
			{
				$errors = (string) $e;
			}
		}
	}

	/**
	 * Deletes a product
	 *
	 * @return null
	 */
	public function action_delete()
	{
		$id = $this->request->post('id');

		$attribute = new Model_Vendo_Product_Attribute($id);
		$attribute->delete();

		$this->request->redirect(
			Route::get('actions')->uri(
				array(
					'controller' => 'product_attribute',
					'method' => 'index',
				)
			)
		);
	}
}