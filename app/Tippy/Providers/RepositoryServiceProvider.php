<?php 

namespace Tippy\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
	/**
	 * Register the service pprovider
	 *
	 * @return void
	 **/
	public function register()
	{
		$this->app->bind(
			'Tippy\Repositories\CategoryRepositoryInterface',
			'Tippy\Repositories\Eloquent\CategoryRepository'
		);

		$this->app->bind(
			'Tippy\Repositories\TipRepositoryInterface',
			'Tippy\Repositories\Eloquent\TipRepository'
		);
	}
}