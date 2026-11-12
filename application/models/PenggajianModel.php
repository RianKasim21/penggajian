<?php

class PenggajianModel extends CI_model{
    public function get_data($table)
    {
    return $this->db->get($table);
    }

    public function insert_data($data,$table)
    {
        $this->db->insert($table,$data);
    }

    public function update_data($table,$data,$where)
    {
        $this->db->update($table,$data,$where);
    }

    public function delete_data($where,$table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function insert_batch($table = null, $data = array())
    {
        $jumlah = count($data);
        if($jumlah > 0)
        {
            $this->db->insert_batch($table, $data);
        }
    }

    public function cek_login()
    {
        $username = set_value('username');
        $password = set_value('password');

        $result = $this->db->where('username',$username)
                           ->where('password',md5($password))
                           ->limit(1)
                           ->get('data_pegawai');
        if($result->num_rows()>0){
            return $result->row();
        }else{
            return false;
        }
    }

    public function CreateCode(){
        $this->db->select('RIGHT(data_jabatan.kode_jabatan,3) as kode_jabatan', FALSE);
        $this->db->order_by('kode_jabatan','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('data_jabatan');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode_jabatan) + 1; 
            }
            else{      
                 $kode = 1;  
            }
        $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
        $kodetampil = "J".$batas;
        return $kodetampil;  
    }
    
    public function CreateCode1(){
        $this->db->select('RIGHT(data_kehadiran.kode_absensi,0) as kode_absensi', FALSE);
        $this->db->order_by('kode_absensi','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('data_kehadiran');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode_absensi); 
            }
            else{      
                 $kode = 0;  
            }
        $tgl = date('dmy');
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);    
        $kodetampil = "AB".$tgl.$batas;
        return $kodetampil;  
    }

    public function KodeGaji(){
        $this->db->select('RIGHT(data_kehadiran.kode_gaji,0) as kode_gaji', FALSE);
        $this->db->order_by('kode_gaji','DESC');    
        $this->db->limit(1);    
        $query = $this->db->get('data_kehadiran');
            if($query->num_rows() <> 0){      
                 $data = $query->row();
                 $kode = intval($data->kode_gaji); 
            }
            else{      
                 $kode = 0;  
            }
        $tgl = date('dmy');
        $batas = str_pad($kode, 2, "0", STR_PAD_LEFT);    
        $kodetampil = "GJ".$tgl.$batas;
        return $kodetampil;  
    }

    public function get_absensi_per_bulan() {
        $this->db->select('DATE_FORMAT(data_absensi.hari, "%Y-%m") as bulan, data_guru.nama_guru, COUNT(data_absensi.id_absensi) as total_hadir');
        $this->db->from('data_absensi');
        $this->db->join('data_guru', 'data_absensi.id_absensi = data_guru.id_guru', 'left');
        $this->db->group_by('bulan, data_guru.nama_guru');
        return $this->db->get()->result();
    }

    public function is_absen_done($id) {
        // Asumsi hari ini yang akan dicek
        $today = date('dmY'); // Hanya hari
        $this->db->where('id_absensi', $id);
        $this->db->where('hari', $today);
        $query = $this->db->get('data_absensi');
        
        // Debugging
        echo $this->db->last_query(); // Tampilkan query terakhir
        var_dump($query->result()); // Tampilkan hasil query
        
        return $query->num_rows() > 0;
    }     
    
    public function get_teaching_status($instructor_id) {
        $this->db->select('status2');
        $this->db->from('data_pegawai');
        $this->db->where('id_guru', $instructor_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->status2;
        } else {
            return null;
        }
    }
}

?>