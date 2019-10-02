<?php 
class Medias extends Controller
{
	private $postModel;

	public function __construct()
	{
		$this->postModel = $this->model("Media");
		flash_message('', '');
	}

	public function index($id = '')
	{
		$medias = $this->postModel->index();
		$data = [
			'medias' => $medias
		];
		
		if (!empty($id)) {
			$media_single = $this->postModel->single($id);
			$data += array('media_single' => $media_single);
			$this->view('medias/index', $data, $media_single);
		} else {			
			$this->view('medias/index', $data);
		}
	}

	public function add()
	{		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'title' => trim($_POST['title']),
				'url' => trim($_POST['url']), 
				'title_err' => '', 
				'url_err' => '',
			];
			
			if (empty($data['title'])) {
				$data['title_err'] = 'Please enter media title';
			}

			if (empty($data['url'])) {
				$data['url_err'] = 'Please enter media URL';
			}

			if (empty($data['title_err']) && empty($data['url_err'])) {
				if ($this->postModel->add($data)) {
					flash_message('Media added successfully', 'success');
					redirect('medias');
				} else {
					flash_message('Media does not add', 'danger');
					$this->view('medias/index');
				}
			} else {
				$medias = $this->postModel->index();
				$data += array('medias' => $medias);
				$this->view('medias/index', $data);
			}
		} else {
			$data = [
				'title' => '', 
				'url' => '', 
			];

			$this->view('medias/index');
		}
	}

	public function delete($id)
	{
		if ($this->postModel->delete($id)) {
			redirect('medias');
		} else {
			flash_message('User permission required to remove this media', 'danger');
			redirect('medias/index/' . $id);
		}
	}
}