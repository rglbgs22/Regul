<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
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
                    <form action="<?= site_url('customer/pembayaran/'.$this->uri->segment(3)) ?>" method="POST">
                    <div class="card-body" style="height: 350px;overflow-y: scroll;" id="menucontent">
                        <div class="row mx-0">
                            <div class="col-lg-12 col-md-12 h-100 mb-3">
                                <b class="d-block mb-2">Total Pemesanan</b>   
                                <div class="w-100">
                                    <div class="d-flex justify-content-between">
                                        <span class="font-italic text-monospace">Nama Menu</span>
                                        <span class="font-italic text-monospace">Quantity Pembelian</span>
                                        <span class="font-italic text-monospace">Total @Item</span>
                                    </div>
                                <?php
                                    foreach($data->result() as $row){
                                        ?>
                                            <div class="d-flex justify-content-between">
                                                <span><?php echo $row->nama;?></span>
                                                <span><?php echo $row->qty." x ".$row->harga;?></span>
                                                <span><?php echo $row->harga*$row->qty;?></span>
                                            </div>
                                        <?php
                                        $total = $row->total;
                                    }
                                ?>
                                </div>
                                <b class="d-block mt-3 mb-2">Metode Pembayaran</b>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link p-1 active" id="tf-tab" data-toggle="tab" href="#tf" role="tab" aria-controls="tf" aria-selected="true">Transfer Bank</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link p-1" id="cash-tab" data-toggle="tab" href="#cash" role="tab" aria-controls="cash" aria-selected="false">Cash</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade pt-2 show active" id="tf" role="tabpanel" aria-labelledby="tf-tab">
                                        Transfer Pembayaran Ke Rekening Bank Mandiri <span class="text-warning">130118123456</span> a/n <span class="text-warning">REGUL</span>
                                    </div>
                                    <div class="tab-pane fade pt-2" id="cash" role="tabpanel" aria-labelledby="cash-tab">
                                        Pembayaran Cash Dapat Dilakukan Langsung Kepada Kasir Yang Berjaga
                                    </div>
                                </div>
                                <b class="d-block mt-3 mb-2">Total Pembayaran</b>   
                                <span class="text-warning">Rp.<?php echo $total;?></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            <div>
                                <input type="hidden" name="metode" id="metode" value="0" class="form-control">
                                <button type="submit" class="btn btn-warning rounded">Bayar</button>
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