<?php
class Messagemodel extends CI_model
{
	public function ownerDetails()
	{
		if (isset($_SESSION['uniqueid'])) {
			$this->db->select('*');
			$this->db->where('unique_id', $_SESSION['uniqueid']);
			$res = $this->db->get('user')->result_array();
			return $res;
		}
	}
	public function allUser()
	{
		if (isset($_SESSION['uniqueid'])) {
			$mysession = $_SESSION['uniqueid'];
			$this->db->select('*');
			$this->db->where('unique_id != ', $mysession);
			$data = $this->db->get('user');
			if ($data->num_rows() > 0) {
				return $data->result_array();
			} else {
				return false;
			}
		}
	}


	public function sentMessage($data)
	{
		$this->db->insert('user_messages', $data);
	}
	public function getmessage($data)
	{
		$this->db->select('*');
		$session_id = $_SESSION['uniqueid'];
		$where = "sender_message_id = '$session_id' AND receiver_message_id = '$data' OR 
		sender_message_id = '$data' AND receiver_message_id = '$session_id'";
		$this->db->where($where);
		// $this->db->order_by('time', 'ASC');
		$result = $this->db->get('user_messages')->result_array();
		return $result;
	}
	public function getLastMessage($data)
	{
		$this->db->select('*');
		$session_id = $_SESSION['uniqueid'];
		$where = "sender_message_id = '$session_id' AND receiver_message_id = '$data' OR 
		sender_message_id = '$data' AND receiver_message_id = '$session_id'";
		$this->db->where($where);
		$this->db->order_by('time', 'DESC');
		$result = $this->db->get('user_messages', 1)->result_array();
		return $result;
	}
	public function getIndividual($id)
	{
		$this->db->select('*');
		$this->db->where('unique_id', $id);
		$res = $this->db->get('user')->result_array();
		return $res;
	}
}
