<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Posts_model extends CI_Model {
	
	public function get_all(){
		return $this->db->get('posts')->result_object();
	}
	public function insert($data){
		$this->db->insert('posts', $data);
		$insert_id = $this->db->insert_id();
		return  $insert_id;
	}
	public function delete($id){
		return $this->db->delete('posts',array('id' => $id));
	}

	// public function update($data){
	// 	$this->db->where('id', $data['id']);
	// 	$this->db->update('posts', $data);
	// }

	public function update ($data,$id)
    {
        $this->db->where('id', $id);
        $this->db->update('posts', $data);

        if ($this->db->affected_rows() > 0){return true;}
        else { return false;}
    }
	

}