<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
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
                <form action="<?= site_url('login/register') ?>" method="POST">
                    <div class="d-2 font-weight-bold d-flex justify-content-center">
                        <h4>Register</h4>
                    </div>
                    <div class="w-100 pr-2">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control bg-dark text-white" name="username" placeholder="username" required />
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" class="form-control bg-dark text-white" name="fullname" placeholder="Fullname" required />
                        </div>
                        <div class="form-group mb-2">
                            <input type="email" class="form-control bg-dark text-white" name="email" placeholder="Email" required />
                        </div>
                        <div class="form-group mb-2">
                            <input type="number" class="form-control bg-dark text-white" name="phone" placeholder="No Handphone" required />
                        </div>
                        <div class="form-group mb-2">
                            <input type="password" class="form-control bg-dark text-white" name="password" placeholder="Password" required />
                        </div>
                    </div>
                    <div class="w-100 mt-4 d-flex justify-content-between">
                        <a href="<?= site_url('login') ?>" class="btn btn-sm btn-primary d-flex align-items-center"><svg class="w-6 h-6 mr-1" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>Login</a>
                        <button type="submit" class="btn btn-sm btn-warning d-flex align-items-center"><svg class="w-6 h-6 mr-1" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>Daftar</button>
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