<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_koor extends CI_Model {

        /*MODUL INBOX BARU */
        function  inbox_new($nik){
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where koor ='$nik' and status_now in('ST: SUBMIT') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        function  inbox_dispatch($nik){
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where koor ='$nik' and status_now in('SP: DISPATCHED','KO: INBOX') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        //INBOX TUGAS DENGAN STATUS KO: DISPATCHED ATAU ST: INBOX
        function inbox_dispatched($nik){
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where koor ='$nik' and status_now in('KO: DISPATHCED','ST: INBOX') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        //INBOX TUGAS DENGAN STATUS SP: COMPLETE
        function inbox_completed($nik) {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where koor ='$nik' and status_now in('SP: COMPLETE') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        //UPDATE TUGAS DARI KOOR JADI KO: DISPATCHED 
        public function update_tugas($id, $data)
    	{
            $this->db->update('tb_tugas', $data, $id);
            return $this->db->affected_rows();
    	}

        function insert_history($data) {
            $this->db->insert('tb_history', $data);
        }
        
        public function get_nilai_tugas($id)
        {
            $query = "select a.nilai from tb_tugas a where id ='$id' ";
            $query2 =$this->db->query($query);
            foreach($query2->result() as $row)
            {
                $nilai = $row->nilai;
            }
            return $nilai;
        }

        public function get_revisi_tugas($id)
        {
            $query = "select a.revisi from tb_tugas a where id ='$id' ";
            $query2 =$this->db->query($query);
            foreach($query2->result() as $row)
            {
                $revisi = $row->revisi;
            }
            return $revisi;
        }

        public function update_nilai_tugas($nilai, $id)
        {
            $this->db->update('tb_tugas', $nilai, $id);
        }

		function  select_tugas($id) {
            $query = "select a.*,b.nama as nama_spv,c.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) 
            		  inner join tb_karyawan c on(a.koor = c.nik) where id ='$id' ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

		function  select_staff($nik) {
            $query = "select * from tb_karyawan where atasan ='$nik' and jobdesk='STAFF'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function  inbox_newr($nik){
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where koor ='$nik' and status_now in('ST: COMPLETE','ST: NOT COMPLETE','ST: SUBMIT') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }    

        function update_koor($id,$data,$data2){
            $this->db->where('id',$id);
            $this->db->update('tb_tugas', $data);
            $this->db->insert('tb_history',$data2);
            return $this->db->affected_rows();
        }

        function jumlah_tugas($nik){
            $query = "SELECT COUNT(CASE WHEN status_now = 'ST: SUBMIT' then 1 ELSE NULL END) as jumlah,
                    COUNT(CASE WHEN status_now = 'SP: COMPLETE' then 1 ELSE NULL END) as jumlah_c,
                    COUNT(CASE WHEN status_now in('KO: DISPATCH','ST: INBOX','ST: REVISION') then 1 ELSE NULL END) as jumlah_dis,
                    COUNT(CASE WHEN status_now = 'KO: REVISION' then 1 ELSE NULL END) as jumlah_rev,
                    COUNT(CASE WHEN status_now in('KO: INBOX','SP: DISPATCHED','KO: REVISION') then 1 ELSE NULL END) as jumlah_tot,
                    COUNT(CASE WHEN status_now in('SP: DISPATCHED','KO: INBOX') then 1 ELSE NULL END) as jumlah_d
            from tb_tugas  where koor = '$nik'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
}