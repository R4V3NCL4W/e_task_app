<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_spv extends CI_Model {

        /*MODUL HAL. DEPAN */
        function  select_koor($nik)
        {
            $query = "select * from tb_karyawan where atasan ='$nik' and jobdesk='KOORDINATOR'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
         /*MODUL ADD TUGAS */
        function insert_tugas($data)
        {
            $this->db->insert('tb_tugas', $data);
            return $this->db->insert_id();
        }

        function  inbox_new($nik)
        {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where spv ='$nik' and status_now in('KO: APPROVED') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        
        function update_spv($id,$data,$data2)
        {
            $this->db->where('id',$id);
            $this->db->update('tb_tugas', $data);
            $this->db->insert('tb_history',$data2);
            return $this->db->affected_rows();
        }

        function  select_tugas($id)
        {
            $query = "select a.*,b.nama as nama_spv,c.nama as nama_koor from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) 
                      inner join tb_karyawan c on(a.koor = c.nik) where id ='$id' ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function  inbox_complete($nik)
        {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where spv ='$nik' and status_now in('SP: COMPLETE','SP: INCOMPLETE') ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function  inbox_revisi($nik)
        {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where spv ='$nik' and status_now in('ST: REVISION') ORDER BY prioritas, deadline ";
            $query2 =$this->db->query($query);
            return $query2->result();
        }
        function  inbox_manage($nik)
        {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where spv ='$nik' and status_now not in('SP: COMPLETE','SP: INCOMPLETE') and TIMEDIFF(deadline,now()) <= '01:00:00' ORDER BY prioritas, deadline ";
            $query2 =$this->db->query($query);
            return $query2->result();
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

        function jumlah_tugas_approved($nik){
            $query = "SELECT COUNT(CASE WHEN status_now = 'KO: APPROVED' or TIMEDIFF(deadline,now()) <= '01:00:00' then 1 ELSE NULL END) as jumlah,
                    COUNT(CASE WHEN status_now in('SP: COMPLETE','SP: INCOMPLETE') then 1 ELSE NULL END) as jumlah_c,
                    COUNT(CASE WHEN TIMEDIFF(deadline,now()) <= '01:00:00' then 1 ELSE NULL END) as jumlah_d,
                    COUNT(CASE WHEN status_now not in ('SP: COMPLETE','KO: APPROVED','SP: INCOMPLETE') and TIMEDIFF(deadline,now()) >= '01:00:00' then 1 ELSE NULL END) as jumlah_tot
             from tb_tugas  where spv = '$nik'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function select_1hour($nik){
            $query = "SELECT * from tb_tugas where TIMEDIFF(deadline,now()) <= '01:00:00' and spv = '$nik'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function  inbox_ongo($nik)
        {
            $query = "select a.*,b.nama as nama_spv from tb_tugas a inner join tb_karyawan b on(a.spv = b.nik) where spv ='$nik' and status_now not in ('KO: APPROVED','SP: COMPLETE', 'SP: INCOMPLETE' ) and TIMEDIFF(deadline,now()) >= '01:00:00'";
            $query2 =$this->db->query($query);
            return $query2->result();
        }

        function insert_history($data)
        {
            $this->db->insert('tb_history', $data);
        }
}
