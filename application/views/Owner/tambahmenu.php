<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Menu</title>
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
        <div class="w-100 d-flex justify-content-between mt-2">
            <div>
                <a href="<?= site_url('owner/listmenu') ?>" class="btn btn-warning p-1 d-flex justify-content-center align-items-center"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
            </div>
            <div>
                <a href="<?= site_url('login/logout') ?>" class="btn btn-warning p-1 d-flex justify-content-center align-items-center"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></a>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <img src="<?php echo base_url('assets/img/logo.png');?>" alt="">
        </div>
        <div class="row justify-content-center align-items-center" style="margin-top: 35px;">
            <div class="col-12 col-md-4">
                <div class="card border-0 rounded">
                    <div class="card-body bg-dark text-white">
                        <h5 class="w-100 text-center">Tambah Menu</h5>
                        <form action="<?= site_url('owner/tambah') ?>" method="POST">
                            <div class="mb-2">
                                <input type="text" name="nama" placeholder="Nama" class="form-control bg-dark text-white">
                            </div>
                            <div class="mb-2">
                                <input type="text" name="kategori" placeholder="Kategori" class="form-control bg-dark text-white">
                            </div>
                            <div class="mb-2">
                                <input type="number" name="harga" placeholder="Harga Nominal" class="form-control bg-dark text-white">
                            </div>
                            <div class="mb-2">
                                <textarea name="keterangan" placeholder="Deskripsi" class="form-control bg-dark text-white" cols="5" rows="5"></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-warning">Submit</button>
                            </div>
                        </form>

                    </div>
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
</body>
</html>