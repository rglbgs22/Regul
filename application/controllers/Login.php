<?php

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("users_model");
    }

    public function index()
    {
        // cek session
        if($this->session->userdata('user_logged') !== null){
            if($this->session->userdata('user_logged')->role == 'owner'){
                redirect(site_url('owner'));
            }elseif($this->session->userdata('user_logged')->role == 'customer'){
                redirect(site_url('customer'));
            }elseif($this->session->userdata('user_logged')->role == 'kasir'){
                redirect(site_url('kasir'));
            }
        }

        // jika form login disubmit
        if($this->input->post()){
            $cek = $this->users_model->doLogin();
            if($cek == 'owner'){
                redirect(site_url('owner'));
            }elseif($cek == 'customer'){
                redirect(site_url('customer'));
            }elseif($cek == 'kasir'){
                redirect(site_url('kasir'));
            }else{
                $this->session->set_flashdata('error', 'Credential Tidak Valid, Mohon Cek Lagi');
            }
        }

        // tampilkan halaman login
        $this->load->view("Auth/Login.php");
    }

    public function register()
    {
        // jika form login disubmit
        if($this->input->post()){
            $data['username']       =   $this->input->post('username');
            $data['full_name']       =   $this->input->post('fullname');
            $data['email']          =   $this->input->post('email');
            $data['password']       =   password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            $data['phone']          =   $this->input->post('phone');
            $data['role']           =   'customer';
            $data['is_active']      =   1;

            $tambah = $this->users_model->create($data);

            if($tambah==true){
                $this->session->set_flashdata('success', 'Daftar Berhasil, Silahkan Login');
                redirect(site_url('login'));
			}else{
                $this->session->set_flashdata('error', 'Daftar Gagal');
                redirect(site_url('login/register'));
			}
        }

        // tampilkan halaman register
        $this->load->view("Auth/Register.php");
    }

    public function logout()
    {
        // hancurkan semua sesi
        $this->session->sess_destroy();
        redirect(site_url('/'));
    }
}
?>