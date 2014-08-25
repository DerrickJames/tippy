<?php

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller {

	/**
	 * The layout used by the controller.
	 *
	 * @var Illuminate\View\View
	 **/
	protected $layout = 'site.layouts.default';

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post', 'on' => 'put'));
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

	/**
	 * Set the specified view as content on the layout.
	 *
	 * @param string $path
	 * @param array  $data
	 * @return void
	 * @author 
	 **/
	protected function view($path, $data = [])
	{
		$this->layout->content = View::make($path, $data);
	}

	/**
	 * Redirect to the specified route.
	 *
	 * @param string $route
	 * @param array $params
	 * @param array $data
	 * @return \Illuminate\Http\RedirectResponse
	 **/
	protected function redirectRoute($route, $params = [], $data = [])
	{
		return Redirect::route($route, $params)->with($data);
	}

	/**
	 * Redirect back with old input.
	 *
	 * @param array $data
	 * @return \Illuminate\Http\Response
	 **/
	protected function redirectBack($data = [])
	{
		return Redirect::back()->withInput()->with($data);
	}

	/**
	 * Redirect logged in user to the previoously intended url.
	 *
	 * @param mixed $default
	 * @return \Illuminate\Http\RedirectResponse
	 **/
	protected function redirectIntended($default = null)
	{
		Redirect::intended($default);
	}

}