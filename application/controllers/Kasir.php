<?php

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("users_model");
        $this->load->model("pemesanan_model");
        $this->load->model("menu_model");

        if($this->users_model->isNotLogin()) redirect(site_url('/'));
        if($this->session->userdata('user_logged')->role !== 'kasir'){
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
        $cek                    =   $this->pemesanan_model->listdata();
        $result['data']         =   $cek;
        $this->load->view('Kasir/index.php',$result);
    }

    public function detail($resi){
        $cek                    =   $this->pemesanan_model->detail($resi);
        if($cek === []){
            redirect(site_url('Kasir'));
        }

        $result['data']         =   $cek;
        // var_dump($cek->result());
        $this->load->view('Kasir/detail.php',$result);
    }

    public function tambah($resi){
        $cek                    =   $this->pemesanan_model->detail($resi);
        if($cek->result() === []){
            redirect(site_url('Kasir'));
        }

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
            $result['info']         =   $cek;
            $this->load->view('Kasir/tambah.php',$result);
        }
    }

    public function tambah_proses($id){
        
        // jika form login disubmit
        if($this->input->post()){
            // cek
            $cek    =   $this->pemesanan_model->cek($id);
            $cek    =   $cek->result();
            var_dump($cek[0]->total);

            $temp = $this->input->post('menu');
            foreach ($temp as $key => $value) {
                $fix_total = 0 ;
                $fix_total = (int)$this->input->post('total') +   (int)$cek[0]->total;
                $data['resi']           =   $cek[0]->resi;
                $data['user_id']        =   $this->session->userdata('user_logged')->user_id;
                $data['menu_id']        =   $key;
                $data['qty']            =   $value;
                $data['total']          =   $fix_total;
                $data['metode']         =   $cek[0]->metode;
                $data['status']         =   $cek[0]->status;
                $data['created_at']     =   date("Y-m-d h:i:s a");
                $tambah = $this->pemesanan_model->create($data);
            }

            if($tambah!==[]){
                if ($fix_total !== NULL || $fix_total !== 0) {
                    $update['total']        =   $fix_total;
                    $perbarui = $this->pemesanan_model->update($update,$id);
                }
                $this->session->set_flashdata('success', 'Pemesanan Berhasil');
            }else{
                $this->session->set_flashdata('error', 'Pemesanan Gagal');
            }
        }

        // tampilkan balik ke pemesanan
        redirect(site_url('kasir/tambah/'.$id));
    }


    public function approve($id){
        
        // jika form login disubmit
        if($this->input->post()){
            // cek
            $cek    =   $this->pemesanan_model->cek($id);
            $cek    =   $cek->result();

            if ($this->input->post('metode')) {
                $update['metode']        =   $this->input->post('metode');
            }

            $update['status']        =   1;
            $perbarui = $this->pemesanan_model->update($update,$id);
            // echo "masuk";
            if($perbarui){
                $this->session->set_flashdata('success', 'Pembayaran Disetujui');
                redirect(site_url('kasir'));
            }else{
                $this->session->set_flashdata('error', 'Pembayaran Gagal');
                redirect(site_url('kasir/gagal'));
            }
        }else{
            // echo "keluar";
            // tampilkan balik ke pemesanan
            redirect(site_url('kasir/detail/'.$id));
        }
    }
}