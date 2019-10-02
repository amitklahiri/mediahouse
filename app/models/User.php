<?php 
class User
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function register($data)
	{
		$this->db->query('INSERT INTO users (name, email, password, picture) VALUES (:name, :email, :password, :picture)');
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':password', $data['password']);
		$this->db->bind(':picture', $data['picture']);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function login($data)
	{
		$this->db->query('SELECT * FROM users WHERE email = :email');
		$this->db->bind(':email', $data['email']);
		$row = $this->db->single();
		$hashed_password = $row->password;
		if (password_verify($data['password'], $hashed_password)) {
			return $row;
		} else {
			return false;
		}
	}

	public function findUserByEmail($email) 
	{
		$this->db->query("SELECT * FROM users WHERE email = :email");
		$this->db->bind(":email", $email);
		$row = $this->db->single();
		if ($this->db->rowCount() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function uploadUserProfilePicture($picture) 
	{
		$picture_src = $picture['tmp_name'];
		$picture_dst = time() . $picture['name'];

		if (move_uploaded_file($picture_src, 'asset/user/' . $picture_dst)) {
			return $picture_dst;
		} else {
			return false;
		}
	}
}