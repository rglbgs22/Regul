<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Pemesanan</title>
    <!-- Bootstrap core CSS-->
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <style>
        body,html{
            height:100%;
        }
        body{
            background-image: url("<?php echo base_url('assets/img/regul-bg.jpg');?>");
            background-repeat: no-repeat, repeat;
            background-color: #cccccc;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
        }
        .nav-link{
            color: white;
        }
        .nav-tabs .nav-link.active{
            color: white;
            background-color: transparent;
            border-color: #fdf327;
            border-radius: 25px;
        }
        .nav-tabs{
            border-bottom   :none;
        }
        .table td, .table th{
            border : none;
            vertical-align: middle;
        }
        .table thead th{
            border: none !important;
        }
        .table-sm td{
            padding : 0px;
        }
        /* width */
        ::-webkit-scrollbar {
        width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
        background: black; 
        }
        
        /* Handle */
        ::-webkit-scrollbar-thumb {
        background: #3d3e42; 
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
        background: #555; 
        }

    </style>
</head>
<body>
    <div class="container h-100 text-white">
        <div class="w-100 d-flex justify-content-end mt-2">
            <a href="<?= site_url('login/logout') ?>" class="btn btn-warning p-1 d-flex justify-content-center align-items-center"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></a>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <img src="<?php echo base_url('assets/img/logo.png');?>" alt="">
        </div>
        <div class="row justify-content-center align-items-center" style="margin-top: 50px;">
            <div class="col-12 col-md-6" style="margin-bottom:20px;">
                <div class="card bg-dark text-white" style="border-radius: 35px;overflow: hidden;">
                    <form action="<?= site_url('kasir/approve/'.$this->uri->segment(3)) ?>" method="POST">
                        <div class="card-body" style="height: 350px;overflow-y: scroll;" id="menucontent">
                            <div class="row mx-0 h-100">
                                <div class="col-lg-7 col-md-12 h-100 mb-3">
                                    <?php
                                        $i=1;
                                        foreach($data->result() as $row){
                                            $name = $row->username;
                                            $status = $row->status;
                                            $metode = $row->metode;
                                        }
                                        if ($row->status == 0) {
                                            $status =  "Belum Lunas";
                                        }else{
                                            $status =  "LUNAS";
                                        }
                                    ?>
                                    <b class="d-block mt-2">Nama Pemesan</b>   
                                    <span class="d-block"><?php echo $name;?></span>
                                    <b class="d-block mt-2">Status Pesanan</b>
                                    <span class="d-block text-warning"><?php echo $status;?></span>
                                    <b class="d-block mt-2">Total Pemesanan</b>
                                    <table class="table table-sm text-white w-100" style="background-color:#343a40;">
                                        <thead>
                                            <tr>
                                                <th><small class="font-italic text-monospace">Nama</small></th>
                                                <th><small class="font-italic text-monospace">Qty</small></th>
                                                <th><small class="font-italic text-monospace">Total</small></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $i=1;
                                                foreach($data->result() as $row){
                                                    echo "<tr>";
                                                    echo "<td><small>".$row->nama."</small></td>";
                                                    echo "<td><small>".$row->qty." x ".$row->harga."</small></td>";
                                                    echo "<td><small>".$row->harga*$row->qty."</small></td>";
                                                    echo "</tr>";
                                                    $i++;
                                                    $total = $row->total;
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <b class="d-block mt-2">Total Pembayaran</b>   
                                    <span class="d-block text-warning">Rp.<?php echo $total;?></span>
                                    <a href="<?= site_url('kasir/tambah/'.$this->uri->segment(3)) ?>" class="btn btn-outline-warning btn-sm float-right">
                                        <svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                        Tambah
                                    </a>
                                </div>
                                <div class="col-lg-5 col-md-12 h-100 mb-3 border-left border-light">
                                    <small><b class="d-block mt-3 mb-2">Metode Pembayaran</b></small>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <?php
                                                if ($metode === '0') {
                                                    ?>
                                                        <a class="nav-link p-1 active" id="tf-tab" data-toggle="tab" href="#tf" role="tab" aria-controls="tf" aria-selected="true"><small>Transfer Bank</small></a>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <a class="nav-link p-1" id="tf-tab" data-toggle="tab" href="#tf" role="tab" aria-controls="tf" aria-selected="true"><small>Transfer Bank</small></a>
                                                    <?php
                                                }
                                            ?>
                                        </li>
                                        <li class="nav-item">
                                            <?php
                                                if ($metode === '1') {
                                                    ?>
                                                        <a class="nav-link p-1 active" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash" aria-selected="false"><small>Cash</small></a>
                                                    <?php
                                                }else{
                                                    ?>
                                                        <a class="nav-link p-1" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash" aria-selected="false"><small>Cash</small></a>
                                                    <?php
                                                }
                                            ?>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <?php
                                            if ($metode === '0') {
                                                ?>
                                                    <div class="tab-pane fade pt-2 show active" id="tf" role="tabpanel" aria-labelledby="tf-tab">
                                                <?php
                                            }else{
                                                ?>
                                                    <div class="tab-pane fade pt-2" id="tf" role="tabpanel" aria-labelledby="tf-tab">
                                                <?php
                                            }
                                        ?>
                                            <small>Transfer Pembayaran Ke Rekening Bank Mandiri <span class="text-warning">130118123456</span> a/n <span class="text-warning">REGUL</span></small>
                                        </div>
                                        <?php
                                            if ($metode === '1') {
                                                ?>
                                                    <div class="tab-pane fade pt-2 show active" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                                                <?php
                                            }else{
                                                ?>
                                                    <div class="tab-pane fade pt-2" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                                                <?php
                                            }
                                        ?>
                                            <small>Pembayaran Cash Dapat Dilakukan Langsung Kepada Kasir Yang Berjaga</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-end">
                                <div>
                                    <input type="hidden" name="metode" id="metode" value="0" class="form-control">
                                    <a href="<?= site_url('kasir'); ?>" class="btn btn-secondary btn-sm rounded">Kembali</a>
                                    <button type="submit" class="btn btn-warning btn-sm rounded">Setujui Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('js/bs/jquery-3.5.1.js')?>"></script>
    <script src="<?php echo base_url('js/bs/popper.min.js')?>"></script>
    <script src="<?php echo base_url('js/bs/bootstrap.min.js')?>"></script>
    <div>
        <?php
        $this->load->view('particals/alert');
        ?>
    </div>
    <script>
        $('#tf-tab').click(function(){
            $('#metode').val(0);
        });
        $('#cash-tab').click(function(){
            $('#metode').val(1);
        });
    </script>
</body>

</html>