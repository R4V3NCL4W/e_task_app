<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spv extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -  
   *    http://example.com/index.php/welcome/index
   *  - or -
   * Since this controller is set as the default controller in 
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */

    function __construct() {
        parent::__construct();
        $this->load->model('m_spv');
     
  

    }


    public function index()
    {
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']        = 'Home';
        $data['content']      = 'main/home';
        $data['menu']         = 'spv';
        $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

        
        if(!empty($cek)) {
            if ($level == 'spv'){
                $this->load->view('v_template',$data);
            }
            else 
            {
                redirect('home');
            }            
        } 
        else
        {
            redirect('home');

        }
  }

  public function add_tugas()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']        = 'Tambah Customer';
      $data['content']      = 'spv/tambah_tugas';
      $data['menu']         = 'spv';
      $data['koordina']     =  $this->m_spv->select_koor($nik);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if(!empty($cek)) {
          if ($level == 'spv'){
              $this->load->view('v_template',$data);
          }
          else 
          {
              redirect('home');
          }
      } 
      else
      {
          redirect('home');
      }
  }

  public function insert_tugas()
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');

      if ($level == 'spv')
      {
          $config2['upload_path'] = './storage/file_tugas';
          $config2['allowed_types'] = '*';
          $config2['allowed_types'] = TRUE;
          $config2['max_size'] = '200000';
          $this->load->library('upload',$config2);
          $files_upload= $this->upload->do_upload('file_attachment');
        
          $ab = $this->upload->data();
          $file = $ab['file_name'];
               
                
          $data = array(
              'spv'         =>  $nik,
              'tugas'       =>  $this->input->post('nama_tugas'),
              'koor'        =>  $this->input->post('koordinator'),
              'rincian'     =>  $this->input->post('desc_tugas'),
              'file'        =>  $file,
              'deadline'    =>  $this->input->post('tgl_deadline')." ".$this->input->post('waktu_deadline'),
              'status_now'  =>  "SP: DISPATCHED",
              'tgl_status'  =>  $this->input->post('tgl_input'),
              'tgl_input'   =>  $this->input->post('tgl_input'),                              
            );

          $id = $this->m_spv->insert_tugas($data);

          $data2 = array(
              'id_tugas' => $id,
              'file' => $file,
              'tanggal' => $this->input->post('tgl_input'),
              'status' => "SP: DISPATCHED",
          );

          $this->m_spv->insert_history($data2);

          $this->session->set_flashdata('pesan', 'Sukses Menambahkan');
          redirect('spv/add_tugas');
      }
      redirect('home');
  }

  public function inbox_tugas()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']        = 'Inbox New';
      $data['content']      = 'spv/inbox_spv';
      $data['menu']         = 'spv';
      $data['inbox']        =  $this->m_spv->inbox_new($nik);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if(!empty($cek))
      {
          if ($level == 'spv')
          {
              $this->load->view('v_template',$data);
          }
      } 
      else
      {
          redirect('home');
      }       
  }

  public function view_inbox($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_spv->select_tugas($id);
      $data['content']    = 'spv/inbox_submit';
      $data['menu']       = 'spv';    
      $task               = $this->m_spv->select_tugas($id);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if ($level == 'spv')
      {
          foreach ($task as $row ) {
              $status = $row->status_now;
          }

          if ($status == 'SP DISPATCHED'){  
              $update = array(
              'status_now' => 'SP: INBOX',
              'tgl_status' => date("Y-n-d")
          );
          $this->m_koor->update_tugas(array('id' => $id), $update);
          }
          $this->load->view('v_template',$data);                          
      } 
      else 
      {
          redirect('home');
      }
  }

  public function update_spv()
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');

      if ($level == 'spv'){
          $nilai = $this->m_spv->get_nilai_tugas($this->input->post('id'));
          $revisi = $this->m_spv->get_revisi_tugas($this->input->post('id'));
          $n = $nilai;
          $r = $revisi;
          if (($this->input->post('kepuasan') == 'Tidak Puas') or ($this->input->post('status') == 'KO: REVISION'))
          {
              $n = $nilai - 1;
              $r = $revisi + 1;
          }
          $data2 = array(
                    'status'   =>  $this->input->post('status'),
                    'id_tugas' => $this->input->post('id'),
                    'comment'  => $this->input->post('comment'),
                    'tanggal'  =>date("Y-n-d")
                  );
          if ( $r > 3 ) {
              $data = array(
                    'id' => $this->input->post('id'),
                    'status_now' => 'SP: INCOMPLETE',
                    'nilai' => 0,
              );
          } 
          else if ($this->input->post('kepuasan') == 'Tidak Puas')
          {
              $data = array(
                    'id'          => $this->input->post('id'),
                    'status_now'  => $this->input->post('status'),
                    'comment_spv' => $this->input->post('comment'),
                    'nilai'       => $n,
                    'kepuasan'    => 'Tidak Puas',
                    'revisi'      => $r,
              );
          } 
          else
          {
                $data = array(
                    'id' => $this->input->post('id'),
                    'status_now'  => $this->input->post('status'),
                    'comment_spv' => $this->input->post('comment'),
                    'nilai'       => $n,
                    'kepuasan'    => 'Puas',
                    'revisi'      => $r,
                );
          }
          
          $id = $this->input->post('id');
          $this->m_spv->update_spv($id, $data, $data2);

          redirect('home');
      }
  }

  public function inbox_tugas_complete()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title'] = 'Inbox New';
      $data['content'] = 'spv/inbox_complete';
      $data['menu'] = 'spv';
      $data['inbox'] =  $this->m_spv->inbox_complete($nik);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if(!empty($cek)) {
          if ($level == 'spv'){
              $this->load->view('v_template',$data);
          }
          else 
          {
              redirect('home');
          }

      } 
      else
      {
          redirect('home');

      }
  }

  public function inbox_tugas_manage()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title'] = 'Inbox New';
      $data['content'] = 'spv/inbox_manage';
      $data['menu'] = 'spv';
      $data['inbox'] =  $this->m_spv->inbox_manage($nik);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if(!empty($cek)) {
          if ($level == 'spv'){
              $this->load->view('v_template',$data);
          }
          else 
          {
              redirect('home');
          }

      } 
      else
      {
          redirect('home');

      }
  }

  public function view_inbox_complete($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_spv->select_tugas($id);
      $data['content']    = 'spv/inbox_complete_det';
      $data['menu']       = 'spv';    
      $task               = $this->m_spv->select_tugas($id);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if ($level == 'spv'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }
          $this->load->view('v_template',$data);                          
      }
      else 
      {
          redirect('home');
      }
  }

  public function view_inbox_manage($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_spv->select_tugas($id);
      $data['content']    = 'spv/inbox_manage_det';
      $data['menu']       = 'spv';    
      $task               = $this->m_spv->select_tugas($id);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);

      if ($level == 'spv'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }
          $this->load->view('v_template',$data);                          
      }
      else 
      {
          redirect('home');
      }
  }

  public function inbox_tugas_ongo()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title'] = 'Inbox New';
      $data['content'] = 'spv/inbox_ongo';
      $data['menu'] = 'spv';
      $data['inbox'] =  $this->m_spv->inbox_ongo($nik);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);
      $data['deadline'] = $this->m_spv->select_1hour($nik);

      if(!empty($cek)) 
      {
          if ($level == 'spv'){
              $this->load->view('v_template',$data);
          }
          else 
          {
              redirect('home');
          }
      } 
      else
      {
          redirect('home');
      }
  }

  public function view_inbox_ongo($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_spv->select_tugas($id);
      $data['content']    = 'spv/inbox_ongo_det';
      $data['menu']       = 'spv';    
      $task               = $this->m_spv->select_tugas($id);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas_approved($nik);
      $data['deadline'] = $this->m_spv->select_1hour($nik);

      if ($level == 'spv'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }
          $this->load->view('v_template',$data);                            
      } 
      else 
      {
          redirect('home');
      }
  }
}