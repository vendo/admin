<?php

/**
 * Admin controller for products
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_Product extends Controller_Admin
{
	/**
	 * Displays all the products to edit/delete them, and an add link
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->request->response = new View_Admin_Product_Index;
	}

	/**
	 * Add a product
	 *
	 * @return null
	 */
	public function action_add()
	{
		$this->request->response = new View_Admin_Product_Form;
		$this->request->response->bind('product', $product);
		$this->request->response->bind('categories', $categories);
		$this->request->response->bind('errors', $errors);

		$product = new Model_Vendo_Product;
		$categories = array();

		if ($_POST)
		{
			$categories = arr::get($_POST, 'category_id', array());
			$product->set_fields($_POST);

			try
			{
				$product->save();

				foreach ($categories as $cat_id)
				{
					$product_category = new Model_Vendo_Product_Category($cat_id);
					$product_category->vendo_products = $product->id;
				}

				$this->request->redirect('admin/product');
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
		$id = arr::get($_GET, 'id');
		$this->request->response = new View_Admin_Product_Form;
		$this->request->response->bind('product', $product);
		$this->request->response->bind('errors', $errors);

		$product = new Model_Vendo_Product($id);

		if ($_POST)
		{
			$categories = arr::get($_POST, 'category_id', array());
			$product->set_fields($_POST);

			try
			{
				$product->save();
				$product->remove_all('vendo_product_categories');

				foreach ($categories as $cat_id)
				{
					$product_category = new Model_Vendo_Product_Category($cat_id);
					$product_category->vendo_products = $product->id;
				}

				$this->request->redirect('admin/product');
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
		$id = arr::get($_POST, 'id', NULL);

		$product = new Model_Vendo_Product($id);
		$product->delete();
		$this->request->redirect('admin/product');
	}

	/**
	 * Relates photos to this product
	 *
	 * @return null
	 */
	public function action_photos()
	{
		$id = arr::get($_GET, 'id');
		$this->request->response = new View_Admin_Product_Photos;
		$this->request->response->bind('product', $product);
		$this->request->response->bind('errors', $errors);

		$product = new Model_Vendo_Product($id);

		if ($_POST)
		{
			$product->remove_all('vendo_photos');
			$product->relate('vendo_photos', arr::get($_POST, 'photos', array()));
			$product->primary_photo_id = arr::get(
				$_POST, 'primary_photo_id', NULL
			);
			$product->save();

			$this->request->response->success = 'You have assigned the photos';
		}
	}
}