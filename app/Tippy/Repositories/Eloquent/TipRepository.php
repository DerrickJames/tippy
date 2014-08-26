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
					 ->orderBy($orderColumn, $orderDir)
					 ->get();

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

		$tip->title 		= $data['title'];
		$tip->slug 			= Str::slug($tip->name, '-');
		$tip->description 	= $data['description'];
		$tip->user_id 		= $data['user_id'];

		if ($data['filedata']  != '') {
			// File::move(public_path().'/assets/img/uploads/temp/'.$data['filedata'], 'assets/img/uploads/'.$data['filedata']);

			$tip->display_img = $data['filedata'];
		}

		return $tip->save();
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