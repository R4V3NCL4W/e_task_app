<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_staff extends CI_Model
{
    function  select_tugas($id)
        {
            $query = "select a.*,b.nama as nama_spv,c.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) 
                      inner join tb_karyawan c on(a.koor = c.nik) where id ='$id' ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
    /*MODUL INBOX BARU */
    function  inbox_new($nik)
    {
        $query = "select a.*,b.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.koor = b.nik) where staff ='$nik' and status_now    in('KO: DISPATCHED','ST: INBOX') ";
            $query2 =$this->db->query($query);
            return $query2->result();
    }
    function  inbox_completed($nik)
    {
        $query = "select a.*,b.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.koor = b.nik) where staff ='$nik' and status_now in('SP: COMPLETE') ";
        $query2 =$this->db->query($query);
        return $query2->result();
    }
    function  inbox_revision($nik)
    {
        $query = "select a.*,b.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.koor = b.nik) where staff ='$nik' and status_now    in('ST: REVISION') ";
        $query2 =$this->db->query($query);
        return $query2->result();
    }
    function  inbox_on($nik)
    {
        $query = "select a.*,b.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.koor = b.nik) where staff ='$nik' and status_now in('ST: SUBMIT','KO: APPROVED') ";
        $query2 =$this->db->query($query);
        return $query2->result();
    }
    public function update_tugas($id, $data)
    {
        $this->db->update('tb_tugas', $data, $id);
        return $this->db->affected_rows();
    }
    public function insert_history($data)
    {
        $this->db->insert('tb_history', $data);
    }
    public function select_deadline()
    {
        $query = "select * from tb_tugas where deadline < NOW() and status_now in('ST: INBOX','ST: DISPATCH','ST: REVISION')";
        $query2 = $this->db->query($query);
        $query3 =$query2->result();
        if ($query2->num_rows() > 0)
        {
            $data = array
            (
                'status_now' => 'ST: NOT COMPLETE',
            );
            foreach ($query3 as $row) {
                $data2 = array
                (
                    'id_tugas' => $row->id,
                    'status' => 'ST: NOT COMPLETE',
                    'tanggal' => date("Y-n-d"),
                    'comment' => 'DEADLINE HABIS',
                );
                $this->db->where('id',$row->id);
                $this->db->update('tb_tugas', $data);
                $this->db->insert('tb_history', $data2);
            }
        }
            return $query2->result();
    }
    function jumlah_tugas_k($nik){
            $query = "SELECT COUNT(CASE WHEN status_now in('KO: APPROVED','ST: SUBMIT','KO: REVISION')  then 1 ELSE NULL END) as jumlah,
                    COUNT(CASE WHEN status_now = 'SP: COMPLETE' then 1 ELSE NULL END) as jumlah_c,
                    COUNT(CASE WHEN status_now in('KO: DISPATCH','ST: INBOX') then 1 ELSE NULL END) as jumlah_dis,
                    COUNT(CASE WHEN status_now in('ST: REVISION') then 1 ELSE NULL END) as jumlah_rev,
                    COUNT(CASE WHEN status_now in('ST: REVISION','KO: DISPATCH','ST: INBOX') then 1 ELSE NULL END) as jumlah_tot
             from tb_tugas  where koor = '$nik'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
}
