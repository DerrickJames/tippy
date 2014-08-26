<?php

namespace Tippy;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model {
	protected $fillable = ['title', 'slug', 'description', 'image_url', 'user_id'];

	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	protected $table = 'tips';
}