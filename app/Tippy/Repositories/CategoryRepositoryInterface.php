<?php 

namespace Tippy\Repositories;

interface CategoryRepositoryInterface
{
	/**
	 * Find all categories
	 *
	 * @param string $orderColumn
	 * @param string $orderDir
	 * @return \Illuminate\Database\Eloquent\Collection|\Tippy\Category[]
	 **/
	public function findAll($orderColumn = 'created_at', $orderDir = 'desc');	

	/**
	 * Find category by id.
	 *
	 * @param mixed $id
	 * @return \Tippy\Category
	 **/
	public function findById($id);

	/**
	 * Create a new category in the database.
	 *
	 * @param array $data
	 * @return \Tippy\Category
	 **/
	public function create(array $data);

	/**
	 * Update the specified category in the database.
	 *
	 * @param mixed $id
	 * @param array $data
	 * @return \Tippy\Category
	 **/
	public function update($id, array $data);

	/**
	 * Delete the specified category.
	 *
	 * @param mixed $id
	 * @return void
	 **/
	public function destroy($id);

}