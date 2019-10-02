<?php 
class Users extends Controller
{
	private $userModel;

	public function __construct()
	{
		$this->userModel = $this->model('User');
		flash_message('', '');
	}

	public function index()
	{
		$this->view('users/login');
	}

	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'name' => trim($_POST['name']), 
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']), 
				'confirm_password' => trim($_POST['confirm_password']), 
				'picture' => $_FILES['picture'], 
				'name_err' => '', 
				'email_err' => '', 
				'password_err' => '', 
				'confirm_password_err' => '', 
				'picture_err' => '', 
			];

			if (empty($data['name'])) {
				$data['name_err'] = 'Name cannot be blank';
			}

			if (empty($data['email'])) {
				$data['email_err'] = 'Email cannot be blank';
			} elseif ($this->userModel->findUserByEmail($data['email'])) {
				$data['email_err'] = 'Email aleady occupied';
			}

			if (empty($data['password'])) {
				$data['password_err'] = 'Password cannot be blank';
			} elseif (strlen($data['password']) < 6) {
				$data['password_err'] = 'Password must be at least of 6 characters';
			}

			if (empty($data['confirm_password'])) {
				$data['confirm_password_err'] = 'Confirm Password cannot be blank';
			} elseif (strlen($data['confirm_password']) < 6) {
				$data['confirm_password_err'] = 'Confirm Password must be at least of 6 characters';
			} elseif ($data['password'] !== $data['confirm_password']) {
				$data['confirm_password_err'] = 'Password and Confirm Password mismatch';
			}

			if (empty($data['picture']['name'])) {
				$data['picture_err'] = 'Profile Picture cannot be blank';
			} else {
				// Profile Picture Upload. 
				$picture_upload = $this->userModel->uploadUserProfilePicture($data['picture']);
				if($picture_upload === false) {
					$data['picture_err'] = 'Profile Picture does not upload';
				} else {
					$data['picture'] = $picture_upload;
					$data['picture_err'] = '';
				}
			}

			if (empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['picture_err'])) {

				// Encrypt Password. 
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				// Register User Profile. 
				if ($this->userModel->register($data)) {
					flash_message('User register successfully', 'success');
					redirect('users/login');
				} else {
					flash_message('User does not register', 'danger');
					$this->view('users/register', $data);
				}
			} else {
				$this->view('users/register', $data);
			}
		} else {
			$data = [
				'name' => '', 
				'email' => '', 
				'password' => '', 
				'confirm_password' => '', 
				'image' => '', 
				'name_err' => '', 
				'email_err' => '', 
				'password_err' => '', 
				'confirm_password_err' => '', 
				'image_err' => '', 
			];

			$this->view('users/register');
		}
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			$data = [
				'email' => trim($_POST['email']), 
				'password' => trim($_POST['password']), 
				'email_err' => '', 
				'password_err' => '', 
			];

			if (empty($data['email'])) {
				$data['email_err'] = 'Email cannot be blank';
			} elseif (!$this->userModel->findUserByEmail($data['email'])) {
				$data['email_err'] = 'Email does not exists';
			}

			if (empty($data['password'])) {
				$data['password_err'] = 'Password cannot be blank';
			}

			if (empty($data['email_err']) && empty($data['password_err'])) {
				// Login User. 
				$userLoggedIn = $this->userModel->login($data);
				if ($userLoggedIn) {
					$this->createUserSession($userLoggedIn);
					redirect('medias');
				} else {
					$data['password_err'] = 'Password does not match';
					$this->view('users/login', $data);
				}
			} else {
				flash_message('Email and / or Password incorrect', 'danger');
				$this->view('users/login', $data);
			}
		} else {
			$data = [
				'email' => '', 
				'password' => '', 
				'email_err' => '', 
				'password_err' => '', 
			];

			$this->view('users/login');
		}
	}

	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_name'] = $user->name;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_picture'] = $user->picture;
	}

	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_name']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_picture']);
		session_destroy();
		redirect('pages');
	}
}