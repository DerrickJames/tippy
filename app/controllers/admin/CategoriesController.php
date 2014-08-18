<?php 

namespace admin;

use BaseController;
use Illuminate\Support\Facades\Input;
use Tippy\Repositories\CategoryRepositoryInterface;

class CategoriesController extends BaseController
{
	/**
	 * Category repository
	 *
	 * @var \Tippy\Repositories\CategoryRepositoryInterface
	 **/
	protected $categories;

	/**
	 * Create a new CategoriesController instance
	 *
	 * @param \Tippy\Repositories\CategoryRepositoryInterface $category
	 * @return void
	 **/
	public function __construct(CategoryRepositoryInterface $category)
	{	
		parent::__construct();

		$this->categories = $categories;
	}

	/**
	 * Show the admin categories index page.
	 *
	 * @return \Response
	 **/
	public function index()
	{
		$categories = $this->categories->findAll('order', 'asc');

		$this->view('admin.categories.index', compact('categories'));
	}
}