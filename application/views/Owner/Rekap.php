<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Rekapitulasi</title>
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
                <a href="<?= site_url('owner') ?>" class="btn btn-warning p-1 d-flex justify-content-center align-items-center"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></a>
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
                    <div class="card-body bg-dark text-white d-flex justify-content-center align-items-center" style="min-height: 200px;">
                        <div class="row">
                            <button type="button" data-toggle="modal" data-target="#date" class="btn btn-dark w-100 col-lg-12 font-weight-bold text-center" style="font-size:20px;white-space: break-spaces;">Harian</button>
                            <button type="button" data-toggle="modal" data-target="#bulanan" class="btn btn-dark w-100 col-lg-12 font-weight-bold text-center" style="font-size:20px;line-height: 55px;white-space: break-spaces;">Bulanan</button>
                            <button type="button" data-toggle="modal" data-target="#tahunan" class="btn btn-dark w-100 col-lg-12 font-weight-bold text-center" style="font-size:20px;line-height: 55px;white-space: break-spaces;">Tahunan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="tahunan" tabindex="-1" role="dialog" aria-labelledby="tahunan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-body bg-dark text-white">
                    <form action="<?= site_url('owner/detailrekap'); ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="tahun" id="datepicker" class="form-control mb-2" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary rounded mr-2" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning rounded">Rekap</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="bulanan" tabindex="-1" role="dialog" aria-labelledby="bulanan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-body bg-dark text-white">
                    <form action="<?= site_url('owner/detailrekap'); ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="bulan" id="datepickerb" class="form-control mb-2" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary rounded mr-2" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning rounded">Rekap</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="date" tabindex="-1" role="dialog" aria-labelledby="bulanan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-body bg-dark text-white">
                    <form action="<?= site_url('owner/detailrekap'); ?>" method="POST">
                        <div class="form-group">
                            <input type="text" name="date" id="datepickerd" class="form-control mb-2" />
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary rounded mr-2" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-warning rounded">Rekap</button>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script>
        $("#datepicker").datepicker( {
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years", 
            minViewMode: "years"
        });

        $("#datepickerb").datepicker( {
            format: "yyyy-mm",
            startView: "months", 
            minViewMode: "months"
        });

        $("#datepickerd").datepicker( {
            format: "yyyy-mm-dd",
        });
    </script>
    <div>
        <?php
        $this->load->view('particals/alert');
        ?>
    </div>
</body>

</html>