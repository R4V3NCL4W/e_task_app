<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff extends CI_Controller
{

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

  function __construct()
  {
        parent::__construct();
        $this->load->model('m_staff');
  }


  public function index()
  {
        $nik                = $this->session->userdata('user');
        $cek             = $this->session->userdata('Logged');
        $level           = $this->session->userdata('level');
        $data['title']   = 'Home';
        $data['content'] = 'main/home';
        $data['menu']    = 'staff';
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        
        if(!empty($cek)) {
             if ($level == 'staff'){
             $this->load->view('v_template',$data);
          }
        else {
            redirect('home');
          }

        } else{
          redirect('home');

        }
  }

  public function i_newTask()
  {     
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Inbox Tugas Baru';
        $data['content']    = 'staff/inbox_new';
        $data['menu']       = 'staff';
        $data['inbox']      = $this->m_staff->inbox_new($nik);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek))
        {
            if ($level == 'staff')
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

  public function inbox_completed()
  {     
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Inbox Tugas Baru';
        $data['content']    = 'staff/inbox_com';
        $data['menu']       = 'staff';
        $data['inbox']      = $this->m_staff->inbox_completed($nik);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek))
        {
            if ($level == 'staff')
            {
                $this->load->view('v_template',$data);
            } else
              {
                  redirect('home');
              }
        } else
          {
              redirect('home');
          }
  }

  public function inbox_ongo()
  {     
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Inbox Tugas Baru';
        $data['content']    = 'staff/inbox_ongo';
        $data['menu']       = 'staff';
        $data['inbox']      = $this->m_staff->inbox_on($nik);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek))
        {
            if ($level == 'staff')
            {
                $this->load->view('v_template',$data);
            } else
              {
                  redirect('home');
              }
        } else
          {
              redirect('home');
          }
  }

  public function inbox_revisi()
  {     
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Inbox Tugas Baru';
        $data['content']    = 'staff/inbox_rev';
        $data['menu']       = 'staff';
        $data['inbox']      = $this->m_staff->inbox_revision($nik);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek))
        {
            if ($level == 'staff'){
            $this->load->view('v_template',$data);
            } else
              {
                  redirect('home');
              }
        } else
          {
              redirect('home');
          }
  }

  public function view_inbox($id)
  {
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Detail Inbox';         
        $data['tugas']      = $this->m_staff->select_tugas($id);
        $data['content']    = 'staff/view_inbox';
        $data['menu']       = 'staff';    
        $task               = $this->m_staff->select_tugas($id);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek)) {     
            if ($level == 'staff')
            {
                foreach ($task as $row )
                {
                    $status = $row->status_now;
                }

                if ($status == 'KO: DISPATCHED')
                {
                    $update = array
                    (
                        'status_now' => 'ST: INBOX',
                        'tgl_status' => date("Y-n-d")

                    );
                    $this->m_staff->update_tugas(array('id' => $id), $update);
                }
                $this->load->view('v_template',$data); 
            } else
              {
                  redirect('home');
              }
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
        $data['title']      = 'Detail Inbox';         
        $data['tugas']      = $this->m_staff->select_tugas($id);
        $data['content']    = 'staff/view_inbox_com';
        $data['menu']       = 'staff';    
        $task               = $this->m_staff->select_tugas($id);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek)) {     
            if ($level == 'staff')
            {
                foreach ($task as $row )
                {
                    $status = $row->status_now;
                }

                if ($status == 'KO: DISPATCHED')
                {
                    $update = array
                    (
                        'status_now' => 'ST: INBOX',
                        'tgl_status' => date("Y-n-d")

                    );
                    $this->m_staff->update_tugas(array('id' => $id), $update);
                }
                $this->load->view('v_template',$data); 
            } else
              {
                  redirect('home');
              }
            } else
              {
                  redirect('home');            
              }
  }

  public function view_inbox_ongo($id)
  {
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Detail Inbox';         
        $data['tugas']      = $this->m_staff->select_tugas($id);
        $data['content']    = 'staff/view_inbox_ongo';
        $data['menu']       = 'staff';    
        $task               = $this->m_staff->select_tugas($id);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek)) {     
            if ($level == 'staff')
            {
                foreach ($task as $row )
                {
                    $status = $row->status_now;
                }

                if ($status == 'KO: DISPATCHED')
                {
                    $update = array
                    (
                        'status_now' => 'ST: INBOX',
                        'tgl_status' => date("Y-n-d")

                    );
                    $this->m_staff->update_tugas(array('id' => $id), $update);
                }
                $this->load->view('v_template',$data); 
            } else
              {
                  redirect('home');
              }
            } else
              {
                  redirect('home');            
              }
  }

  public function view_inbox_rev($id)
  {
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');
        $data['title']      = 'Detail Inbox';         
        $data['tugas']      = $this->m_staff->select_tugas($id);
        $data['content']    = 'staff/view_inbox_rev';
        $data['menu']       = 'staff';    
        $task               = $this->m_staff->select_tugas($id);
        $data['jumlah_not'] = $this->m_staff->jumlah_tugas_k($nik);

        if(!empty($cek)) {     
            if ($level == 'staff')
            {
                foreach ($task as $row )
                {
                    $status = $row->status_now;
                }

                if ($status == 'KO: DISPATCHED')
                {
                    $update = array
                    (
                        'status_now' => 'ST: INBOX',
                        'tgl_status' => date("Y-n-d")

                    );
                    $this->m_staff->update_tugas(array('id' => $id), $update);
                }
                $this->load->view('v_template',$data); 
            } else
              {
                  redirect('home');
              }
            } else
              {
                  redirect('home');            
              }
  }

  public function submit_tugas()
  {
        $nik                = $this->session->userdata('user');
        $cek                = $this->session->userdata('Logged');
        $level              = $this->session->userdata('level');

        if ($level == 'staff')
        {
            $config2['upload_path']   = './storage/file_tugas';
            $config2['allowed_types'] = '*';
            $config2['allowed_types'] = TRUE;
            $config2['max_size']      = '200000';
            $this->load->library('upload',$config2);
            $files_upload             = $this->upload->do_upload('file');
            $ab                       = $this->upload->data();
            $file                     = $ab['file_name'];               
                
            $data = array
            (
                'status_now'    => "ST: SUBMIT",
                'tgl_status'    => date("Y-n-d"),
                'comment_staff' => $this->input->post('comment'),
            );

            $this->m_staff->update_tugas(array('id' =>  $this->input->post('id')), $data);

            $data2 = array
            (
                'id_tugas'  => $this->input->post('id'),
                'file'      => $file,
                'tanggal'   => date("Y-n-d"),
                'status'    => "ST: SUBMIT",
                'comment'   => $this->input->post('comment'),
            );

            $this->m_staff->insert_history($data2);
            $this->session->set_flashdata('pesan', 'Sukses Menambahkan');
            redirect('staff/i_newTask');
                
        } else
          {
              redirect('home');
          }
  }
 
  public function deadline()
  {
      $this->m_staff->select_deadline();
  }

}