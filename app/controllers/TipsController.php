<?php

// use Tippy\Facades\ImageUpload;
use Illuminate\Support\Facades\Auth;
use Tippy\Repositories\TipRepositoryInterface;
use Tippy\Services\Upload\ImageUploadService;

class TipsController extends BaseController 
{
	/**
	 * Tip repository
	 *
	 * @var \Tippy\Repositories\TipRepositoryInterface
	 **/
	protected $tips;

	protected $user;	

	protected $comment;

	/**
	 * Create a new TipsController instance.
	 *
	 * @return void
	 * @param \Tippy\Repositories\TipRepositoryInterface $tip
	 **/
	public function __construct(TipRepositoryInterface $tips, User $user, Comment $comment)
	{
		parent::__construct();

		$this->tips = $tips;
		$this->user = $user;
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
	public function getCreate()
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
		$file = Input::file('filedata');
		$destination = public_path().'/assets/uploads';
		$extension = Input::file('filedata')->getClientOriginalExtension();
		$filename = str_random(12).".{$extension}";
		$upload_success = Input::file('filedata')->move($destination, $filename);

		if ($upload_success) {
			$data = [
				'user_id'	=> Auth::user()->id,
				'display_img'	=> $filename
			];

			$tip = $this->tips->create($data);
			return Response::json('success', 200);
		} else {
			return Response::json('error', 400);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /tips/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function showTip($id)
	{
		$tip 	  = $this->tips->findById($id);
		
		$comments = $this->tips->findCommentsByTip($tip['id']);

		$this->view('tips.show', compact('tip', 'comments'));
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
	 * Create a new comment
	 *
	 * @return void
	 * @author 
	 **/
	public function storeComment()
	{
		$validator = Validator::make(
			$data = ['content' => Input::get('comment'), 'post_id' => Input::get('post_id')],
					['content' => 'required']
		);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
		$data['user_id'] = Auth::user()->id;
		// $data['post_id'] = $id;

		Comment::create($data);

		return Redirect::route('tips.index');
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