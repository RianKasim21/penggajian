<?php

class gantiPassword extends CI_Controller{

    public function index()
    {
        $data['title'] = "Ganti Password";
        $this->load->view('desain_kepsek/header',$data);
        $this->load->view('desain_kepsek/sidebar');
        $this->load->view('kepsek/formGantiPassword',$data);
        $this->load->view('desain_kepsek/footer');
    }

    public function gantiPasswordAksi()
    {
        $passBaru  = $this->input->post('passBaru');
        $ulangPass = $this->input->post('ulangPass');

        $this->form_validation->set_rules('passBaru','Password Baru','required|matches[ulangPass]');
        $this->form_validation->set_rules('ulangPass','Ulangi Password','required');

        if($this->form_validation->run() != false){
            $data = array('password' => md5($passBaru));
            $id = array('id_pegawai' => $this->session->userdata('id_pegawai'));
            
            $this->penggajianModel->update_data('data_pegawai',$data,$id);
            $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password berhasil diganti</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
          redirect('welcome');
        }else{
            $data['title'] = "Ganti Password";
            $this->load->view('desain_kepsek/header',$data);
            $this->load->view('desain_kepsek/sidebar');
            $this->load->view('kepsek/formGantiPassword',$data);
            $this->load->view('desain_kepsek/footer');
        }
    }
}

?>