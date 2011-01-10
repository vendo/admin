<?php

/**
 * Admin photo index view class
 *
 * @package   Vendo
 * @author    Jeremy Bush <contractfrombelow@gmail.com>
 * @copyright (c) 2010-2011 Jeremy Bush
 * @license   ISC License http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Photo_Index extends View_Admin_Layout
{
	public $title = 'All Photos';
	public $errors;

	protected $action = 'admin/photo/upload';

	/**
	 * Variable method to fetch all the photos
	 *
	 * @return array
	 */
	public function photos()
	{
		$photos = array();
		foreach (
			Model::factory('vendo_photo')->load(NULL, NULL) as $photo
		)
		{
			$photos[] = array(
				'id' => $photo->id,
				'filename' => $photo->filename,
				'uri' => $photo->uri(),
			);
		}
		return $photos;
	}

	/**
	 * Formats the errors
	 *
	 * @return string
	 */
	public function errors()
	{
		return View::factory('form_errors')
			->set(array('errors' => $this->errors))->render();
	}
}