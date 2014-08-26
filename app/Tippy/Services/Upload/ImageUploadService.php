<?php 

namespace Tippy\Services\Upload;

use Intervention\Image\Image;
use	Illuminate\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploadService
{
	/**
	 * undocumented class variable
	 *
	 * @var string
	 **/
	protected $directory = 'assets/img/uploads/temp';

	/**
	 * The file type to use.
	 *
	 * @var string
	 **/
	protected $extension = 'jpg';

	/**
     * The dimensions to resize the image to.
     *
     * @var int
     */
    protected $size = 160;

    /**
     * The quality the image should be saved in.
     *
     * @var int
     */
    protected $quality = 65;

    /**
     * Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    /**
	 * Create a new ImageUploadService instance
	 *
	 * @return void
	 * @param \Illuminate\Filesystem\Filesystem $filesystem
	 **/
	public function __construct(Filesystem $filesystem)
	{
		$this->filesystem = $filesystem;
	}	

	/**
	 * Enable CORS
	 *
	 * @return void
	 * @param string $origin
	 **/
	public function enableCORS($origin)
	{
		$allowHeaders = [
			'Origin',
			'X-Requested-With',
			'Content-Range',
			'Content-Disposition',
			'Content-Type'
		];

		header('Access-Control-Allow-Origin: ' . $origin);
		header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
		header('Access-Control-Allow-Headers: ' . implode(', ', $allowHeaders));
	}

	/**
	 * Generate full ppath from the given partial path.
	 *
	 * @return string
	 * @param string $path
	 **/
	protected function getFullPath($path)
	{
		return 	public_path() . '/' . $path;
	}

	/**
	 * Make a new unique filename.
	 *
	 * @return string
	 **/
	protected function makeFileName()
	{
		return Sha1(time() . time()) . '.{$this->extension}';
	}

	/**
	 * Retrieve contents of file at specified path.
	 *
	 * @return mixed
	 * @param string $path
	 **/
	protected function getFile($path)
	{
		$this->filesytem->get($path);
	}

	/**
	 * Get the file size of file at specified path.
	 *
	 * @return mixed
	 * @param string $path
	 **/
	protected function getFileSize($path)
	{
		return $this->filesytem->size($path);
	}

	/**
	 * Construct data URL for json data.
	 *
	 * @return string
	 * @param string $mime
	 * @param string $path
	 **/
	protected function getDataUrl($mime, $path)
	{	
		$base = base64_encode($this->getFile($path));

		return 'data:' .  $mime . ';base64,'  $base;
	}

	/**
	 * Construct the body of the json response.	
	 *
	 * @return array
	 * @param string $filename
	 * @param string $mime
	 * @param string $path
	 **/
	protected function getJsonBody($filename, $mime, $path)
	{
		return [
			'images' => [
				'filename' 	=> $filename,
				'mime'		=> $mime,
				'size' 		=> $this->getFileSize($path),
				'dataURL'	=> $this->getDataUrl($mime, $path)
			]
		];
	}

	/**
	 * Handle the file upload.
	 *
	 * @return array|bool
	 * @param \Symfony\Component\HttpFoundation\UploadedFile $file
	 **/
	public function handle(UploadedFile $file)
	{
		$mime 		= $file->getMimeType();
		$filename 	= $this->makeFileName();
		$path 		= $this->getFullPath($this->directory . '/' . $filename);

		$success = Image::make($file->getRealPath())
						->resize($this->size, $this->size, true, false)
						->save($path, $this->quality);

		if (! $success) {
			return false;
		}

		return $this->getJsonBody($filename, $mime, $path);
	}
}