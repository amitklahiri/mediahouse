<?php 
class Media
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function index()
	{
		$this->db->query("SELECT * FROM medias");
		$this->db->execute();
		return $this->db->resultSet();
	}

	public function single($id)
	{
		$this->db->query("SELECT * FROM medias WHERE id = :id");
		$this->db->bind(':id', $id);
		return $this->db->single();
	}

	public function add($data)
	{
		$this->db->query("INSERT INTO medias (title, url, user_id) VALUES (:title, :url, :user)");
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':url', $data['url']);
		$this->db->bind(':user', $_SESSION['user_id']);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	public function delete($id)
	{
		$this->db->query('DELETE FROM medias WHERE id = :id AND user_id = :user_id');
		$this->db->bind(':id', $id);
		$this->db->bind(':user_id', $_SESSION['user_id']);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
}
