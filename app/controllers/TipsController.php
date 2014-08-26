<?php

// use ImageUpload;
use Illuminate\Support\Facades\Auth;
use Tippy\Repositories\TipRepositoryInterface;

class TipsController extends BaseController 
{
	/**
	 * Tip repository
	 *
	 * @var \Tippy\Repositories\TipRepositoryInterface
	 **/
	protected $tips;	

	/**
	 * Create a new TipsController instance.
	 *
	 * @return void
	 * @param \Tippy\Repositories\TipRepositoryInterface $tip
	 **/
	public function __construct(TipRepositoryInterface $tips)
	{
		parent::__construct();

		$this->tips = $tips;
	}

	/**
	 * Display a listing of the resource.
	 * GET /tips
	 *
	 * @return Response
	 */
	public function index()
	{
		$tips = $this->tips->findAll('created_at', 'desc');

		$this->view('tips.index', compact('tips'));
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
		$form = $this->tips->getForm();

		if (! $form->isValid()) {
			return $this->redirectRoute('tips.create')
						->withErrors($form->getErrors())
						->withInput();
		}

		$data = $form->getInputData();
		$data['user_id']	= Auth::user()->id;

		// echo "<pre/>";
		// var_dump($data);

		$tip = $this->tips->create($data);

		echo Response::json(url('assets/js/vendor/uploader'), 200);

		// return $this->redirectRoute('tips.index');
	}

	/**
	 * Display the specified resource.
	 * GET /tips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug = null)
	{
		// $tip = $this->tips->findById($id);

		$this->view('tips.show');
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
		$tip = $this->tips->findById($id);

		$this->view('tips.edit', compact('tip'));
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
		$form = $this->tips->getForm();

		if (! $form->isValid()) {
			return $this->redirectRoute('tips.edit')
						->withErrors($form->getErrors())
						->withInput();
		}

		$tip = $this->tips->update($id, $form->getInputData());

		return $this->redirectRoute('tips.edit', $id);
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
		$this->tips->delete($id);

		return $this->redirectRoute('tips.index');
	}

	/**
	 * Upload a new tip
	 *
	 * @return void
	 * @author 
	 **/
	public function uploadTip()
	{
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			ImageUpload::enableCORS($_SERVER['HTTP_ORIGIN']);
		}

		if (Request::server('REQUEST_METHOD') == 'OPTIONS') {
			exit;
		}

		$json = ImageUpload::handle(Input::file('filedata'));

		if ($json !== false) {
			return Response::json($json, 200);
		}

		return Response::json('error', 400);
	}

}