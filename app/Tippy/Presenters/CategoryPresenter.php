<?php

namespace Tippy\Presenters;

use Tippy\Category;
use Illuminate\Support\Facades\URL;
use McCool\LaravelAutoPresenter\BasePresenter;

class CategoryPresenter extends BasePresenter
{
	/**
	 * Create a new CategoryPresenter instance.
	 *
	 * @param \Tippy\Category $category
	 * @return void
	 **/
	public function __construct(Category $category) 
	{
		$this->resource = $category;	
	}

	/**
	 * Get the delete link for this category.
	 *
	 * @return string
	 **/
	public function deleteLink()
	{
		return URL::route('admin.categories.delete', [ $this->resource->id ]);
	}
}