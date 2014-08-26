<?php

namespace Tippy\Services\Forms;

class TipForm extends AbstractForm
{
	/**
	 * Validation rules to validate input data.
	 *
	 * @var array
	 **/
	protected $rules = [
		'title' => 'required',
		'image_url'	=> 'required'
	];	
}