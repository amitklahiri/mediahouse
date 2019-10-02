<?php 
class Pages extends Controller
{
	private $pageModel;

	public function __construct()
	{
		$this->pageModel = $this->model('Page');
		flash_message('', '');
	}

	public function index($page = 'index')
	{
		$this->view('pages/' . $page);
	}

	public function contact()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['name']), 
				'email' => trim($_POST['email']), 
				'subject' => trim($_POST['subject']), 
				'message' => trim($_POST['message']),
				'name_err' => '', 
				'email_err' => '', 
				'subject_err' => '', 
				'message_err' => '',
			];

			if (empty($data['name'])) {
				$data['name_err'] = 'Please enter name';
			}

			if (empty($data['email'])) {
				$data['email_err'] = 'Please enter email';
			} elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				$data['email_err'] = 'Please enter correct email';
			}

			if (empty($data['subject'])) {
				$data['subject_err'] = 'Please enter subject';
			}

			if (empty($data['message'])) {
				$data['message_err'] = 'Please enter message';
			}

			if (empty($data['name_err']) && empty($data['email_err']) && empty($data['subject_err']) && empty($data['message_err'])) {
				if ($this->pageModel->contact($data)) {
					flash_message('Your request has been sent successfully', 'success');
				} else {
					flash_message('Contact request fails to sent', 'danger');
					$this->view('pages/contact', $data);
				}
			} else {
				$this->view('pages/contact', $data);
			}			
		} else {
			$data = [
				'name' => '', 
				'email' => '', 
				'subject' => '', 
				'message' => '',
			];

			$this->view('pages/contact', $data);
		}
	}
}