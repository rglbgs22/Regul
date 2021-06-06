<?php

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("users_model");
        $this->load->model("menu_model");
        $this->load->model("pemesanan_model");

        if($this->users_model->isNotLogin()) redirect(site_url('/'));
        if($this->session->userdata('user_logged')->role !== 'customer'){
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
        $output ="";
        // PORT MODE
        if($this->input->post()){
            $data = $this->menu_model->search($this->input->post('key'));
            $data_kategori = $this->menu_model->searchkategori($this->input->post('key'));
            if ($data === false) {
                echo "";
            }else{
                $output .= '<div class="row mx-0">';
                if($data_kategori->num_rows() > 0){
                    foreach($data_kategori->result() as $item){
                        $output .= "<div class='col-md-12 px-0' id='$item->kategori'>
                                        <b>$item->kategori</b>
                                        <hr class='w-100 text-white mt-0 mb-1 border-white'>
                                    </div>";

                        if($data->num_rows() > 0){
                            foreach($data->result() as $row){
                                if (strtolower($item->kategori) === strtolower($row->kategori)) {
                                    $output .= "
                                        <div class='col-md-12 px-0'>
                                            <div class='card flex-row flex-wrap bg-dark text-white w-100 border-0 d-flex align-items-center'>
                                                <div class='card-header p-0 border-0'>
                                                    <img src='".base_url('assets/img/default.jpg')."' class='rounded' width='100px' height='80px' alt=''>
                                                </div>
                                                <div class='card-body p-1'>
                                                    <h5>$row->nama</h5>
                                                    <small>$row->keterangan</small>
                                                    <div class='w-100 d-flex justify-content-between'>
                                                        <div>
                                                            <span class='text-warning' id='harga$row->id'>$row->harga</span>
                                                        </div>
                                                        <div id='add$row->id'>
                                                            <button class='btn btn-sm btn-warning p-1 rounded-circle' style='line-height: 23px;' onclick='add($row->id);' id='addcontent$row->id'>add</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    ";
                                }
                            }
                        }else{
                            $output .=  "<div class='col-md-12 px-0 text-center'>Tidak Ada Produk</div>";
                        }
                    }
                }else{
                    $output .= '<div class="col-md-12 align-text">Data Tidak Ditemukan</div>';
                }
                $output .= '
                    </div>
                    <button class="bg-white btn btn-sm" style="position: absolute;bottom: 65px;"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
                    <div class="dropdown-menu">
                ';

                if($data_kategori->num_rows() > 0){
                    foreach($data_kategori->result() as $item){
                        $output .=  "
                            <a href='#$item->kategori' class='dropdown-item w-100'>
                                <div class='d-flex justify-content-between'>
                                    <div>
                                        $item->kategori
                                    </div>
                                    <div>
                                        $item->count
                                    </div>
                                </div>
                            </a>
                        ";
                    }
                }

                $output .=  "</div>";
            }
            echo $output;
        }else{
            // GET MODE
            // get data
            $result['data']         =   $this->menu_model->index();
            $result['kategori']     =   $this->menu_model->kategori();

            $this->load->view('Customer/index.php',$result);
        }
    }

    public function proses(){
        // jika form login disubmit
        if($this->input->post()){
            $cc = $this->db->count_all('pemesanan');
            $coun = str_pad($cc,4,STR_PAD_LEFT);
            $id = "REGUL"."-";
            $d = date('y') ;
            $mnth = date("m");
            $customid = $id.$d.$mnth.$coun;

            $temp = $this->input->post('menu');
            foreach ($temp as $key => $value) {
                $data['resi']           =   $customid;
                $data['user_id']        =   $this->session->userdata('user_logged')->user_id;
                $data['menu_id']        =   $key;
                $data['qty']            =   $value;
                $data['total']          =   $this->input->post('total');
                $data['metode']         =   NULL;
                $data['status']         =   0;
                $data['created_at']     =   date("Y-m-d h:i:s a");
                $tambah = $this->pemesanan_model->create($data);
            }

            if($tambah!==[]){
                $this->session->set_flashdata('success', 'Pemesanan Berhasil');
                redirect(site_url('customer/pembayaran/'.$customid));
			}else{
                $this->session->set_flashdata('error', 'Pemesanan Gagal');
                redirect(site_url('customer'));
			}
        }

        // tampilkan balik ke pemesanan
        redirect(site_url('customer'));
    }

    public function pembayaran(){
        $in = $this->uri->segment(3);   
        if($in === NULL){
            redirect(site_url('customer'));
        }

        if($this->input->post()){
            $data['metode']         =   $this->input->post('metode');
            $updatin                =   $this->pemesanan_model->update($data,$in);

            if($updatin){
                $this->session->set_flashdata('success', 'Pilih Metode Pembayaran Berhasil');
                redirect(site_url('customer/check/'.$in));
			}else{
                $this->session->set_flashdata('error', 'Pilih Metode Pembayaran Gagal');
                redirect(site_url('customer/pembayaran/'.$in));
			}

        }else{    
            $cek                    =   $this->pemesanan_model->detail($in);
            if($cek === []){
                redirect(site_url('customer'));
            }
    
            $result['data']         =   $cek;
            $this->load->view('Customer/pembayaran',$result);
        }
    }

    public function check(){
        $in = $this->uri->segment(3);   
        if($in === NULL){
            redirect(site_url('customer'));
        }

        $cek                    =   $this->pemesanan_model->detail($in);
        if($cek === []){
            redirect(site_url('customer'));
        }

        $result['data']         =   $cek;
        $this->load->view('Customer/check',$result);
    }
}