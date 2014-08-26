<?php

class TipsController extends \BaseController 
{
	/**
	 * Tip repository
	 *
	 * @var \Tippy\Repositories\TipRepositoryInterface
	 **/
	protected $tip;	

	/**
	 * Create a new TipsController instance.
	 *
	 * @return void
	 * @param \Tippy\Repositories\TipRepositoryInterface $tip
	 **/
	public function __construct(TipRepositoryInterface $tip)
	{
		parent::__construct();
		
		$this->tip = $tip;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tips
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tips/create
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->view('tips.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tips
	 *
	 * @return Response
	 */
	public function store()
	{
	}

	/**
	 * Display the specified resource.
	 * GET /tips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tips/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /tips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /tips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}