<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Customer</title>
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
        <div class="w-100 d-flex justify-content-end mt-2">
            <a href="<?= site_url('login/logout') ?>" class="btn btn-warning p-1 d-flex justify-content-center align-items-center"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></a>
        </div>
        <div class="w-100 d-flex justify-content-center">
            <img src="<?php echo base_url('assets/img/logo.png');?>" alt="">
        </div>
        <div class="row justify-content-center align-items-center" style="margin-top: 50px;">
            <div class="col-12 col-md-6" style="margin-bottom:20px;">
                <div class="card bg-dark text-white" style="border-radius: 35px;overflow: hidden;">
                    <div class="card-header bg-warning text-white">
                        <form action="#" id="pencarian">
                            <div class="input-group">
                                <input type="text" id="key" class="form-control bg-dark text-white" placeholder="Cari Menu Kesukaanmu...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-dark btn-sm input-group-text bg-dark text-white"><svg class="w-6 h-6" width="20px" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <form action="<?= site_url('customer/proses') ?>" method="POST">
                    <div class="card-body" style="height: 350px;overflow-y: scroll;" id="menucontent">
                        <div class="row mx-0">
                            <?php foreach($kategori as $item){
                                ?>
                                    <div class="col-md-12 px-0" id="<?php echo $item->kategori;?>">
                                        <b><?php echo $item->kategori;?></b>
                                        <hr class="w-100 text-white mt-0 mb-1 border-white">
                                    </div>
                                    <?php
                                        foreach($data as $row){
                                            if (strtolower($item->kategori) === strtolower($row->kategori)) {
                                            ?>
                                                <div class="col-md-12 px-0">
                                                    <div class="card flex-row flex-wrap bg-dark text-white w-100 border-0 d-flex align-items-center">
                                                        <div class="card-header p-0 border-0">
                                                            <img src="<?php echo base_url('assets/img/default.jpg'); ?>" class="rounded" width="100px" height="80px" alt="">
                                                        </div>
                                                        <div class="card-body p-1">
                                                            <h5><?php echo $row->nama; ?></h5>
                                                            <small><?php echo $row->keterangan; ?></small>
                                                            <div class="w-100 d-flex justify-content-between">
                                                                <div>
                                                                    <span class="text-warning" id="harga<?php echo $row->id; ?>"><?php echo $row->harga; ?></span>
                                                                </div>
                                                                <div id="add<?php echo $row->id; ?>">
                                                                    <button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 23px;" onclick="add(<?php echo $row->id; ?>);" id="addcontent<?php echo $row->id; ?>">add</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        }
                                    ?>
                                <?php
                            }?>
                        </div>
                        <button class="bg-white btn btn-sm" style="position: absolute;bottom: 65px;"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</button>
                        <div class="dropdown-menu">
                            <?php foreach($kategori as $item){?>
                                <a href="#<?php echo $item->kategori;?>" class="dropdown-item w-100">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <?php echo $item->kategori;?>
                                        </div>
                                        <div>
                                            <?php echo $item->count;?>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div id="resultform">
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div>
                                <span id="itemtotal">0</span> item | Rp.
                                <span id="hargatotal">0</span>
                            </div>
                            <div>
                                <input type="hidden" name="total" style="line-height: 23px;" id="totalpem" class="form-control">
                                <button type="submit" class="btn btn-dark text-warning">Proses</button>
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
        var hargatotal;
        var itemtotal = 0;
        const add = (id) => {
            var harga      = parseInt($(`#harga${id}`).text());
            hargatotal     = parseInt($(`#hargatotal`).text());
            $(`#add${id}`).empty();

            // rubah element
            var element = `
                    <button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 10px;width: 20px;" onclick="min(${id});" id="minuscontent${id}">-</button>
                        <span class="mx-1" id="qty${id}">1</span>
                    <button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 9px;" onclick="plus(${id});" id="addcontent${id}">+</button>
            `;
            $(`#add${id}`).append(element);

            //add form
            var input = `<input type="hidden" name="menu[${id}]" style="line-height: 23px;" value="1" class="form-control sample-pesanan" data-value="${id}">`;
            $(`#resultform`).append(input);

            // update harga total
            hargatotal    += harga;
            $(`#hargatotal`).text(hargatotal);
            $(`#totalpem`).val(hargatotal);
            itemtotal++;
            $(`#itemtotal`).text(itemtotal);
        }

        const min = (id) =>{
            var harga      = parseInt($(`#harga${id}`).text());
            hargatotal     = parseInt($(`#hargatotal`).text());

            var input = parseInt($(`input[name='menu[${id}]']`).val());
            input--;
            console.log(input);
            if (input <= 0) {
                $(`input[name='menu[${id}]']`).remove();
                $(`#add${id}`).empty();
                
                var element = `<button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 23px;" onclick="add(${id});" id="addcontent${id}">add</button>`;
                $(`#add${id}`).append(element);
            }else{
                $(`input[name='menu[${id}]']`).val(input);
                $(`#qty${id}`).text(input);
            }

            hargatotal    -= harga;
            $(`#hargatotal`).text(hargatotal);
            $(`#totalpem`).val(hargatotal);

            itemtotal--;
            $(`#itemtotal`).text(itemtotal);
        }

        const plus = (id) =>{
            var harga      = parseInt($(`#harga${id}`).text());
            hargatotal     = parseInt($(`#hargatotal`).text());

            var input = parseInt($(`input[name='menu[${id}]']`).val());
            input++;
            console.log(input);

            $(`input[name='menu[${id}]']`).val(input);
            $(`#qty${id}`).text(input);

            hargatotal    += harga;
            $(`#hargatotal`).text(hargatotal);
            $(`#totalpem`).val(hargatotal);

            itemtotal++;
            $(`#itemtotal`).text(itemtotal);
        }

        $('#pencarian').submit(function(e){
            let key = $('#key').val();
            var url = '<?= site_url('customer') ?>';
            $.ajax({
                url: url,
                type: "POST",
                data: {key:key},
                beforeSend: function()
                {
                    $('#menucontent').empty();
                    $('.senddataloader').show();
                },
                success: function(data){
                    $('#menucontent').append(data);
                    var numItems = $('.sample-pesanan');

                    if(typeof(numItems) !== 'undefined'){
                        if (numItems.length > 0) {
                            for (let index = 0; index < numItems.length; index++) {
                                var sample  = $('.sample-pesanan')[index];
                                console.log(sample.getAttribute("data-value"));
                                var id      = sample.getAttribute("data-value");
                                var input   = sample.value;

                                if (input > 0) {
                                    var element = `
                                            <button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 10px;width: 20px;" onclick="min(${id});" id="minuscontent${id}">-</button>
                                                <span class="mx-1" id="qty${id}">${input}</span>
                                            <button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 9px;" onclick="plus(${id});" id="addcontent${id}">+</button>
                                    `;
                                    $(`#add${id}`).empty();
                                    $(`#add${id}`).append(element);
                                }else{
                                    var element = `<button type='button' class="btn btn-sm btn-warning p-1 rounded-circle" style="line-height: 23px;" onclick="add(${id});" id="addcontent${id}">add</button>`;
                                    $(`#add${id}`).empty();
                                    $(`#add${id}`).append(element);
                                }
                            }
                        }
                    }else{
                        console.log('tidak ada');
                    }
                },
                error : function(e){
                    alert(e);
                }
            });
            return false;
        });
    </script>
</body>

</html>