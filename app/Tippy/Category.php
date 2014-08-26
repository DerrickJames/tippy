<?php

namespace Tippy;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name', 'slug', 'description', 'order'];

	/**
	 * The table associated with the model.
	 *
	 * @var string
	 **/
	protected $table = 'categories';

	/**
	 * Class used to present the model
	 *
	 * @var string
	 **/
	public $presenter = 'Tippy\Presenter\CategoryPresenter';

	/**
	 * Query the tips that belong to a category.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 **/
	public function tips()
	{
		return $this->belongsToMany('Tippy\Tip');
	}
}