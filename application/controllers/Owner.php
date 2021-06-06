<?php

class Owner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("users_model");
        $this->load->model("menu_model");
        $this->load->model("pemesanan_model");

        if($this->users_model->isNotLogin()) redirect(site_url('/'));
        if($this->session->userdata('user_logged')->role !== 'owner'){
            if($this->session->userdata('user_logged')->role == 'owner'){
                redirect(site_url('owner'));
            }elseif($this->session->userdata('user_logged')->role == 'customer'){
                redirect(site_url('customer'));
            }elseif($this->session->userdata('user_logged')->role == 'kasir'){
                redirect(site_url('kasir'));
            }else{
                redirect(site_url('login/logout'));
            }
        }
    }

    public function index(){
        $this->load->view('Owner/index.php');
    }

    public function listmenu(){
        // get data
		$result['data']   =   $this->menu_model->index();

        $this->load->view('Owner/listmenu.php',$result);
    }

    public function tambah(){
        // jika form login disubmit
        if($this->input->post()){
            $data['nama']       =   $this->input->post('nama');
            $data['kategori']   =   $this->input->post('kategori');
            $data['harga']      =   $this->input->post('harga');
            $data['keterangan'] =   $this->input->post('keterangan');

			$response=$this->menu_model->create($data);
			if($response==true){
                $this->session->set_flashdata('success', 'Tambah Menu Berhasil');
			}else{
                $this->session->set_flashdata('error', 'Tambah Menu Gagal');
			}
            redirect(site_url('owner/tambah'));
        }

        // view
        $this->load->view('Owner/tambahmenu.php');
    }

    public function delete($id){
        $response=$this->menu_model->delete($id);
        if($response==true){
            $this->session->set_flashdata('success', 'Hapus Menu Berhasil');
        }else{
            $this->session->set_flashdata('error', 'Hapus Menu Gagal');
        }
        redirect(site_url('owner/listmenu'));
    }

    public function rekap(){      
        $this->load->view('Owner/rekap.php');
    }

    public function detailrekap(){
        // jika form login disubmit
        if($this->input->post()){
            if($this->input->post('tahun')){
                $key    =   $this->input->post('tahun')."-".date("m")."-".date("d")." 00:00:01";
                $key2   =   $this->input->post('tahun')."-".date("m")."-".date("d")." 23:59:59";
            }elseif($this->input->post('bulan')){
                $key    =   $this->input->post('bulan')."-".date("d")." 00:00:01";
                $key2   =   $this->input->post('bulan')."-".date("d")." 23:59:59";
            }elseif($this->input->post('date')){
                $key    =   $this->input->post('date')." 00:00:01";
                $key2   =   $this->input->post('date')." 23:59:59";
            }

            $cek   =   $this->pemesanan_model->listdataby($key, $key2);
            if($cek !== false){
            }else{
                $this->session->set_flashdata('error', 'Get Data Gagal');
                redirect(site_url('owner/rekap'));
            }
            
            $result['data'] = $cek;
            $this->load->view('Owner/detailrekap.php',$result);
        }else{
            redirect(site_url('owner/rekap'));
        }
    }
}