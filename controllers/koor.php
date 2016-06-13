<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Koor extends CI_Controller {

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
      $this->load->model('m_koor');
  }
  public function index() {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Home';
      $data['content']    = 'main/home';
      $data['menu']       = 'koor';
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);
        
      if(!empty($cek)) {
          if ($level == 'koor'){
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
  
  public function inbox_tugas() {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';
      $data['content']    = 'koor/inbox_revisi';
      $data['menu']       = 'koor';
      $data['inbox']      = $this->m_koor->inbox_new($nik);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if(!empty($cek)) {
          if ($level == 'koor'){
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

  public function inbox_dispatched() 
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';
      $data['content']    = 'koor/inbox_disp';
      $data['menu']       = 'koor';
      $data['inbox']      = $this->m_koor->inbox_dispatched($nik);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if(!empty($cek)) {
          if ($level == 'koor'){
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

  public function inbox_dispatch() 
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level             = $this->session->userdata('level');
      $data['title'] = 'Inbox New';
      $data['content'] = 'koor/inbox';
      $data['menu'] = 'koor';
      $data['inbox'] =  $this->m_koor->inbox_dispatch($nik);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

     if(!empty($cek)) {
          if ($level == 'koor'){
              $this->load->view('v_template',$data);
          }
          else {
              redirect('home');
          }
      } 
      else
      {
          redirect('home');
      }
  }

  public function inbox_completed() 
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';
      $data['content']    = 'koor/inbox_complete';
      $data['menu']       = 'koor';
      $data['inbox']      = $this->m_koor->inbox_completed($nik);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if(!empty($cek)) {
          if ($level == 'koor'){
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

  public function view_inbox($id)
  {
      $nik              = $this->session->userdata('user');
      $cek              = $this->session->userdata('Logged');
      $level            = $this->session->userdata('level');
      $data['title']    = 'Inbox New';
      $data['tugas']    = $this->m_koor->select_tugas($id);
      $data['staff']    = $this->m_koor->select_staff($nik);
      $data['content']  = 'koor/det_inbox';
      $data['menu']     = 'koor';    
      $task             = $this->m_koor->select_tugas($id);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if ($level == 'koor')
      {
          foreach ($task as $row )
          {
              $status = $row->status_now;
          }
          if ($status == 'SP: DISPATCHED')
          {  
              $update = array(
                  'status_now' => 'KO: INBOX',
                  'tgl_status' => date("Y-n-d")
                );

              $this->m_koor->update_tugas(array('id' => $this->input->post('id')), $update);

              $history = array(
                    'id_tugas'  =>  $this->input->post('id'),
                    'status'    =>  'KO: INBOX',
                    'tanggal'   =>  date("Y-n-d")
                );
              $this->m_koor->insert_history($history);
          }
          $this->load->view('v_template', $data);
                
      } else
        {
            redirect('home');
        }
  }

  public function view_inbox_com($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_koor->select_tugas($id);
      $data['staff']      = $this->m_koor->select_staff($nik);
      $data['content']    = 'koor/det_inbox_complete';
      $data['menu']       = 'koor';    
      $task               = $this->m_koor->select_tugas($id);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if ($level == 'koor'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }
          if ($status == 'SP: DISPATCHED'){  
              $update = array(
                              'status_now' => 'KO: INBOX',
                              'tgl_status' => date("Y-n-d")
                        );
              $this->m_koor->update_tugas(array('id' => $this->input->post('id')), $update);

              $data = array(
                            'id_tugas'      =>  $this->input->post('id'),
                            'status'        =>  'KO: INBOX'
                      );

              $this->m_koor->insert_history('tb_history', $data);
          }
          $this->load->view('v_template', $data);                          
      } 
      else 
      {
          redirect('home');
      }
  }

  public function view_inbox_disp($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_koor->select_tugas($id);
      $data['staff']      = $this->m_koor->select_staff($nik);
      $data['content']    = 'koor/det_inbox_dispatch';
      $data['menu']       = 'koor';    
      $task               = $this->m_koor->select_tugas($id);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if ($level == 'koor'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }
          if ($status == 'SP: DISPATCHED'){  
              $update = array(
                              'status_now' => 'KO: INBOX',
                              'tgl_status' => date("Y-n-d")
                        );
              $this->m_koor->update_tugas(array('id' => $this->input->post('id')), $update);

              $data = array(
                            'id_tugas'      =>  $this->input->post('id'),
                            'status'        =>  'KO: INBOX'
                      );
              $this->m_koor->insert_history('tb_history', $data);
          }
          $this->load->view('v_template', $data);                          
      } 
      else 
      {
          redirect('home');
      }
  }      

  public function down_attach($filelink)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');

      if ($level == 'koor'){
          $string = $filelink;
          $change = array(
                          "&#40;" => "(",
                          "&#41;" => ")",
                          "%20" => " "
                    );
          $file=strtr($string,$change);              
          $this->load->helper('download');
          $data = file_get_contents("./storage/file_tugas/$file"); 
          force_download($file, $data);    
      } 
      else 
      {
          redirect('home');
      }
  }

  public function dispatch_tugas()
  {
      $data = array(
                    'staff'       =>  $this->input->post('staff'),
                    'status_now'  =>  'KO: DISPATCHED',
                    'tgl_status'  =>  date("Y-n-d")
              );

      $data2 = array(
                    'id_tugas' =>  $this->input->post('id'),
                    'tanggal'  =>  date("Y-n-d"),
                    'status'   =>  'KO: DISPATCHED',
              );
      $this->m_koor->insert_history($data2); 
      $this->m_koor->update_tugas(array('id' => $this->input->post('id')), $data);   
  }
          
  public function inbox_tugasr()
  {     
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';
      $data['content']    = 'koor/inbox_revisi';
      $data['menu']       = 'koor';
      $data['inbox']      =  $this->m_koor->inbox_newr($nik);
      $data['jumlah_notif'] = $this->m_koor->jumlah_tugas($nik);

      if(!empty($cek)) 
      {
          if ($level == 'koor')
          {
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
  
  public function view_inboxr($id)
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');
      $data['title']      = 'Inbox New';         
      $data['tugas']      = $this->m_koor->select_tugas($id);
      $data['staff']      = $this->m_koor->select_staff($nik);
      $data['content']    = 'koor/inbox_submit';
      $data['menu']       = 'koor';    
      $task               = $this->m_koor->select_tugas($id);
      $data['jumlah_notif'] = $this->m_spv->jumlah_tugas($nik);

      if ($level == 'koor'){
          foreach ($task as $row ) {
              $status = $row->status_now;
          }

          if ($status == 'ST: COMPLETE')
          {  
              $update = array(
                              'status_now' => 'KO: COMPLETE',
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

  public function update_koor()
  {
      $nik                = $this->session->userdata('user');
      $cek                = $this->session->userdata('Logged');
      $level              = $this->session->userdata('level');

      if ($level == 'koor'){
          $config2['upload_path']   = './storage/file_record';
          $config2['allowed_types'] = '*';
          $config2['allowed_types'] = TRUE;
          $config2['max_size']      = '200000';

          $this->load->library('upload',$config2);

          $files_upload = $this->upload->do_upload('file');
          $ab           = $this->upload->data();
          $file         = $ab['file_name'];
          $data2 = array(
                    'status' =>  $this->input->post('status'),
                    'id_tugas' => $this->input->post('id'),
                    'comment' => $this->input->post('comment'),
                    'file' =>$file,
                    'tanggal' =>date("Y-n-d")
                  );          
          if ( $this->input->post('status') == 'KO: APPROVED' )
          {
              $data = array(
                          'id' => $this->input->post('id'),
                          'status_now' => $this->input->post('status'),
                          'comment_koor' => $this->input->post('comment'),
                      );
          } 
          else 
          {
              $nilai = $this->m_koor->get_nilai_tugas($this->input->post('id'));
              $revisi = $this->m_koor->get_revisi_tugas($this->input->post('id'));
              $n = $nilai;
              $r = $revisi;
              if ($this->input->post('status') == 'ST: REVISION')
              {
                  $n = $nilai - 1;
                  $r = $revisi + 1;
              }
              if ( $r > 3 )
              {
                  $data = array(
                      'id' => $this->input->post('id'),
                      'status_now' => 'SP: INCOMPLETE',
                      'nilai' => 0,
                    );
              } 
              else
              {
                  $data = array(
                        'id' => $this->input->post('id'),
                        'status_now' => $this->input->post('status'),
                        'comment_koor' => $this->input->post('comment'),
                        'file' => $file,
                        'nilai' => $n,
                        'revisi' => $r,
                    );
              }
          }
          
          $id = $this->input->post('id');
          $this->m_koor->update_koor($id, $data, $data2);

          redirect('home');
        }
  }
}