<?php

namespace Tippy\Repositories\Eloquent;

use Tippy\Tip;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Tippy\Services\Forms\TipForm;
use Tippy\Repositories\TipRepositoryInterface;

class TipRepository extends AbstractRepository implements TipRepositoryInterface
{
	/**
	 * Create a new DB TipRepository instance.
	 *
	 * @return void
	 * @param Tippy\Tip $tip
	 **/
	public function __construct(Tip $tip)
	{
		// parent::__construct();

		$this->model = $tip;
	}

	/**
	 * Find all tips.	
	 *
	 * @return \Illuminate\Database\Eloquent\Collection|\Tip[]
	 * @param string $orderColumn
	 * @param stirng $orderDir
	 **/
	public function findAll($orderColumn = 'created_at', $orderDir = 'desc')	
	{
		$tips = $this->model
					 ->leftJoin('users', 'users.id', '=', 'tips.user_id')
					 ->orderBy($orderColumn, $orderDir)
					 ->get([
					 	'tips.id',
					 	'title', 
					 	'slug', 
					 	'description', 
					 	'username', 
					 	'tips.created_at', 
					 	'display_img'
					 ]);

		return $tips;
	}



	/**
	 *Find the specified tip from the database.
	 *
	 * @return Tippy\Tip
	 * @param mixed $id
	 **/
	public function findById($id)
	{
		return $this->model->find($id);
	}

	/**
	 * Create a new tip in the database.
	 *
	 * @return \Tippy\Tip
	 * @param array $data
	 **/
	public function create(array $data)
	{
		$tip = $this->getNew();

		$tip->user_id 		= $data['user_id'];
		$tip->display_img 	= $data['display_img'];

		return $tip->save();
	}

	/**
	 * Retrieve the comments associated with the specified tip.
	 *
	 * @return bool|object
	 * @param mixed $id
	 **/
	public function findCommentsByTip($id, $orderColumn = 'created_at', $orderDir = 'desc')
	{
		$comments = $this->model
						 ->leftJoin('comments', 'comments.post_id', '=', 'tips.id')
						 ->leftJoin('users', 'users.id', '=', 'comments.user_id')
						 ->orderBy($orderColumn, $orderDir)
						 ->get([
						 	'content', 
						 	'comments.created_at', 
						 	'username'
						 ]);
		return $comments;
	}

	/**
	 * Update the specified tip in the database.
	 *
	 * @return \Tippy\Tip
	 * @param mixed $id
	 * @param array $data
	 **/
	public function update($id, array $data)
	{
		$tip = $this->findById($id);

		$tip->title 		= $data['title'];
		$tip->slug 			= Str::slug($tip->name, '-');
		$tip->description 	= $data['description'];
		$tip->image_url 	= $data['image_url'];
		$tip->user_id 		= $data['user_id'];

		$tip->save();

		return $tip;
	}

	/**
	 * Delete the specified tip from the database.
	 *
	 * @return void
	 * @param mmixed $id
	 **/
	public function destroy($id)
	{
		$tip = $this->findById($id);

		$tip->delete();
	}

	/**
	 * Get the tip crate/update form.
	 *
	 * @return \Tippy\Services\Forms\TipForm
	 **/
	public function getForm()
	{
		return new TipForm;
	}
}