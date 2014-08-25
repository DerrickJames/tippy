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
	public function __construct(CategoryRepositoryInterface $categories)
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

	/**
	 * Store a new category in the database.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @access public
	 **/
	public function store()
	{
		$form = $this->categories->getForm();

		if (! $form->isValid()) {
			return $this->redirectRoute('admin.categories.index')
						->withErrors($form->getErrors())
						->withInput();
		}

		$category = $this->categories->create($form->getInputData());

		return $this->redirectRoute('admin.categories.index');
	}

	/**
	 * Show the form to update the specified category.
	 *
	 * @return \Response
	 * @param mixed $id
	 **/
	public function edit($id)
	{	
		$category = $this->categories->findById($id);

		$this->view('admin.categories.edit', compact('category'));
	}

	/**
	 * Update the specified tip.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @param mixed $id
	 **/
	public function update($id)
	{
		$form = $this->categories->getForm();

		if (! $form->isValid()) {
			return $this->redirectRoute('admin.categories.edit', $id)
						->withErrors($form->getErrors())
						->withInput();
		}

		$category = $this->categories->update($id, $form->getInputData());

		return $this->redirectRoute('admin.categories.edit', $id);
	}

	/**
	 * Delete the specified category.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @param mixed $id
	 **/
	public function destroy($id)
	{	
		$this->categories->delete($id);

		return $this->redirectRoute('admin.categories.index');
	}
}