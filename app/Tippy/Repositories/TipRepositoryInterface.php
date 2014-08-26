<?php 

namespace Tippy\Repositories;

interface TipRepositoryInterface 
{
	/**
	 * Find all tips.
	 *
	 * @return array
	 **/
	public function findAll($orderColumn = 'created_at', $orderDir = 'desc');

	/**
	 * Find a tip by id.
	 *
	 * @return \Tippy\Tip
	 * @param mixed $id
	 **/
	public function findById($id);

	/**
	 * Create a new tip in the database.
	 *
	 * @return \tippy\Tip
	 * @param array $data
	 **/
	public function create(array $data);

	/**
	 * Update the specified tip in the database.
	 *
	 * @return \Tippy\Tip
	 * @param mixed $id
	 * @param array $data
	 **/
	public function update($id, array $data);

	/**
	 * Delete the specified tip in the database.
	 *
	 * @return void
	 * @param mixed $id
	 **/
	public function destroy($id);
	
}