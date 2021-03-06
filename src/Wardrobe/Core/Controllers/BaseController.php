<?php namespace Wardrobe\Core\Controllers;

use Controller, Config, View;

class BaseController extends Controller {

	/**
	 * The default theme used by the blog.
	 *
	 * @var string
	 */
	protected $theme = 'default';

	/**
	 * Create the base controller instance.
	 *
	 * @return BaseController
	 */
	public function __construct()
	{
		$this->theme = Config::get('core::wardrobe.theme');

		View::addLocation(public_path().'/packages/wardrobe/core');

		// Redirect to /install if in framework and not installed
		if (Config::get('core::wardrobe.in_framework') === true) {

			if (Config::get("wardrobe.installed") !== true)
			{
				header('Location: install');
				exit;
			}
		}
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
