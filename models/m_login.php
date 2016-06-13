<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_login extends CI_Model {

	function getUser($username, $password) {
		$this->db->select('*');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$this->db->where('app', "e_task");
		$query = $this->db->get('tb_user');
		return $query;
	}

	function getDetUser($username){
	    $this->db->select('tb_karyawan.*,tb_user.*');   
        $this->db->from('tb_user');
        $this->db->join('tb_karyawan', 'tb_user.username = tb_karyawan.nik', 'inner');
        $this->db->where('username',$username);
        $query = $this->db->get();

		return $query;
	}

    


        

}

/* End of file m_login.php */
/* Location: ./application/controllers/m_login.php */