<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
	}

	public function index()
	{	
	
		if ($this->session->userdata('Logged') == TRUE)
        {
			$level = $this->session->userdata('level');
			

					redirect($level);
			
				
				
		} else {
			$this->load->view('main/login');
		
		}
	}	
	

	function dologin(){	
	
	

	
	     	$username = $this->security->xss_clean($this->input->post('username'));
	        $password = $this->security->xss_clean($this->input->post('password'));
		    $login = $this->m_login->getUser($username, $password);
		    if ($login->num_rows() > 0) {
			$hasil_login = $login->result();
			 foreach ($hasil_login as $row) {
			 	$this->session->set_userdata('Logged', TRUE);
			 	$this->session->set_userdata('level', $row->kategori);
			 	$this->session->set_userdata('id', $row->id_user);
			  }
				$detail = $this->m_login->getDetUser($username);
				$detail_hasil = $detail->result();
			    foreach ($detail_hasil as $baris) {	
					$this->session->set_userdata('user', $baris->nik);						
					$this->session->set_userdata('nama_user', $baris->nama);				
				    $this->session->set_userdata('foto_user', $baris->foto);

			
			}
				}else{

			}

			$level = $this->session->userdata('level');
			
			if ($level == 'spv') {
				redirect('spv');
			}else if ($level == 'koor') {
				redirect('koor');
			}
			else if ($level == 'staff') {
				redirect('staff');
			}

			else{

			$this->session->set_flashdata('pesan', 'Username Dan Password Tidak Ada!!.');
			
			redirect('home');

			}

		    
			
		
		
		
		
	}

	
	function logout(){
	
		$this->session->sess_destroy();
		redirect('home');
		
	}

}

