<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
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
        <div class="w-100 d-flex justify-content-center">
            <img src="<?php echo base_url('assets/img/logo.png');?>" alt="">
        </div>
        <div class="row justify-content-center align-items-center" style="margin-top: 125px;">
            <div class="col-12 col-md-4">
                <form action="<?= site_url('login') ?>" method="POST">
                    <div class="d-2 font-weight-bold">
                        <h4>Login</h4>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="w-100 pr-2">
                            <div class="form-group">
                                <input type="text" class="form-control bg-dark text-white" name="username" placeholder="username" required />
                            </div>
                            <div class="form-group mb-0">
                                <input type="password" class="form-control bg-dark text-white" name="password" placeholder="Password" required />
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-warning text-dark w-100 h-100 font-weight-bolder p-0" style="font-size: 35px;">></button>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="form-group mb-0">
                            <small>Belum Punya Akun Restorant Gaul ? <a href="<?= site_url('Login/register') ?>">Daftar Yukk</a></small>
                        </div>
                    </div>
                </form>
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