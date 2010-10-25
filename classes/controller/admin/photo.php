<?php
/**
 * Admin controller for administering photos
 *
 * @package    Vendo
 * @author     Jeremy Bush
 * @copyright  (c) 2010 Jeremy Bush
 * @license    http://github.com/zombor/Vendo/raw/master/LICENSE
 */
class Controller_Admin_Photo extends Controller_Admin
{
	/**
	 * Lists all photos in the system
	 *
	 * @return null
	 */
	public function action_index()
	{
		$this->request->response = new View_Admin_Photo_Index;
		$this->request->response->errors = Session::instance()->get('errors');
		Session::instance()->set('errors', NULL);
	}

	/**
	 * Processes an uploaded image
	 *
	 * @return null
	 */
	public function action_upload()
	{
		// Validate the upload first
		$validate = new Validate($_FILES);
		$validate->rules(
			'image',
			array(
				'Upload::not_empty' => null,
				'Upload::valid' => null,
				'Upload::size' => array('4M'),
				'Upload::type' => array(
					array('jpg', 'png', 'gif')
				),
			)
		);

		if ($validate->check(true))
		{
			// Shrink the image to the lowest max dimension
			$image = Image::factory($_FILES['image']['tmp_name']);
			$constraints = Kohana::config('image')->constraints;

			$image->resize(
				$constraints['max_width'],
				$constraints['max_height']
			);
			$image->save(APPPATH.'photos/'.$_FILES['image']['name']);

			$photo = new Model_Photo;
			$photo->file = APPPATH.'photos/'.$_FILES['image']['name'];
			$photo->save();

			unlink(APPPATH.'photos/'.$_FILES['image']['name']);

			$this->request->redirect('admin/photo');
		}
		else
		{
			Session::instance()->set('errors', $validate->errors('validate'));
			$this->request->redirect('admin/photo');
		}
	}
}