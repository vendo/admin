<?php

/**
 * Admin product photos view class
 *
 * @package    Vendo
 * @author     Jeremy Bush
 * @copyright  (c) 2010 Jeremy Bush
 * @license    http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class View_Admin_Product_Photos extends View_Layout
{
	public $title = 'Product Photos';
	public $success;
	public $product;

	/**
	 * Returns all the images to display in the template
	 *
	 * @return array
	 */
	public function photos()
	{
		$photos = array();
		foreach (Model::factory('vendo_photo')->load(NULL, NULL) as $photo)
		{
			$photos[] = array(
				'id' => $photo->id,
				'filename' => $photo->filename,
				'uri' => $photo->uri(),
				'checked' => $this->product->has('vendo_photos', $photo->id),
				'checked_primary' => $this->product->primary_photo_id
					== $photo->id,
			);
		}
		return $photos;
	}
}