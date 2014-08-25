<?php 

namespace Tippy\Repositories\Eloquent;

use Tippy\Category;
use Illuminate\Support\Str;
use Tippy\Services\Forms\CategoryForm;
use Tippy\Repositories\CategoryRepositoryInterface;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
	/**
	 * Create a new DbCategoryRepository instance.
	 *
	 * @param \Tippy\Category $category
	 * @return void
	 **/
	public function __construct(Category $category)
	{
		$this->model = $category;
	}

	/**
	 * Find all categories.
	 *
	 * @param string $orderColumn
	 * @param string $orderDir
	 * @return \Illuminate\Database\Eloquent\Collection|\Category[]
	 **/
	public function findAll($orderColumn = 'created_at', $orderDir = 'desc')
	{
		$categories = $this->model
						   ->orderBy($orderColumn, $orderDir)
						   ->get();

		return $categories;
	}

	/**
	 * Find the specified category.
	 *
	 * @param midex $id
	 * @return \Tippy\Category
	 **/
	public function findById($id)
	{
		return $this->model->find($id);
	}

	/**
	 * Create a new category in the database.
	 * 
	 * @param array $data
	 * @return \Tippy\Category
	 **/
	public function create(array $data)
	{
		$category = $this->getNew();

		$category->name 		= e($data['name']);
		$category->slug 		= Str::slug($category->name, '-');
		$category->description 	= e($data['description']);
		$category->order 		= $this->getMaxOrder() + 1;

		$category->save();

		return $category;
	}

	/**
	 * update the specified category in the database.
	 *
	 * @param mixed $id
	 * @param array $data
	 * @return \Tippy\Category
	 **/
	public function update($id, array $data)
	{
		$category = $this->getNew();

		$category->name 		= e($data['name']);
		$category->slug 		= Str::slug($category->name, '-');
		$category->description 	= e($data['description']);

		$category->save();

		return $category;
	}

	/**
	 * The highest order number from the database.
	 *
	 * @return int
	 **/
	public function getMaxOrder()
	{
		return $this->model->max('order');
	}

	/**
	 * Delete the specified category from the database.
	 *
	 * @param mixed $id
	 * @return void
	 **/
	public function destroy($id)
	{
		$category = $this->findById($id);

		$category->tips->detach();
		$category->delete();
	}

	/**
	 * Get the category create/update form service.
	 *
	 * @return \Tippy\Services\Forms\CategoryForm
	 **/
	public function getForm()
	{
		return new CategoryForm;
	}
}