<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Kasir</title>
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
                    <div class="card-body" id="menucontent">
                        <div class="table-responsive" style="height:350px;overflow-y: scroll;">
                            <table class="table table-sm text-white w-100 h-100" style="background-color:#343a40;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Status Pembayaran</th>
                                        <th>Atas Nama</th>
                                        <th>Metode Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $i=1;
                                        foreach($data->result() as $row){
                                            echo "<tr>";
                                            echo "<td>".$i."</td>";
                                            if ($row->status == 0) {
                                                echo "<td><a href='".site_url('kasir/detail/'.$row->resi)."' class='text-warning'>BELUM LUNAS</a></td>";
                                            }else{
                                                echo "<td class='text-warning'>LUNAS</td>";
                                            }
                                            echo "<td>".$row->username."</td>";
                                            if ($row->metode !== NULL) {
                                                if ($row->metode == 0) {
                                                    echo "<td class='text-warning'>TRANSFER BANK</td>";
                                                }else{
                                                    echo "<td class='text-warning'>CASH</td>";
                                                }
                                            }else{
                                                echo "<td class='text-warning'>-</td>";
                                            }
                                            echo "</tr>";
                                            $i++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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