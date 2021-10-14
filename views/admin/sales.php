<?php $this->load->view('_/header') ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title ?></h6>
                </div>
                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" href="#modal-new-sales" class="btn btn-sm btn-neutral" title="Tambah Pembelian Baru"><i class="fa fa-plus"></i></a>
                    <!-- <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-upload"></i></a>
                    <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-download"></i></a> -->
                </div>
            </div>

            <!-- <?php echo $this->session->flashdata('report'); ?> -->

            <div class="row">

                <div class="col-xl-6 col-md-6">
                    <a href="<?php echo base_url('admin/sales/all') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua Penjualan</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($semua as $sm) {
                                                                                    echo "Rp " . number_format($sm->semua, 0, ",", ".") . "";
                                                                                } ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Utang</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php foreach ($utang as $u) {
                                                                                echo "Rp " . number_format($u->utang, 0, ",", ".") . "";
                                                                            } ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="col-xl-6 col-md-6">
                    <a href="<?php echo base_url('admin/sales/credit') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Piutang</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($piutang as $pi) {
                                                                                    echo "Rp " . number_format($pi->piutang, 0, ",", ".") . "";
                                                                                } ?> </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                            <i class="fa fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

</div>



<div class="container-fluid mt--6">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons" style="vertical-align: text-center;">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">Pelanggan</th>
                                <th width="20%">Produk</th>
                                <th width="15%">Keterangan</th>
                                <th width="10%">Status</th>
                                <th width="25%" class="text-center">Biaya</th>
                                <th width="9%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($income as $i) {
                                $no++;
                                echo "<tr>
                                <td>$no</td>
                                <td>$i->pelanggan</td>
                                <td>$i->produk</td>";

                                echo "<td>$i->komoditas ($i->jumlah Ha)</td>";

                                echo "<td>";
                                if ($i->status == 0) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Belum Lunas</span></span>";
                                } elseif ($i->status == 1) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Lunas</span></span>";
                                } elseif ($i->status == 4) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Pre Order</span></span>";
                                }

                                //TOTAL
                                echo "<td>";
                                ?>

                                <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <div class="media align-items-center">
                                                <div class="media-body ml-2 d-none d-lg-block">
                                                    <span class="mb-0 text-sm"><?php if ($i->status == 0) { //Belum Lunas
                                                                                        echo "<strong><font color='black'>Rp " . number_format($i->total, 0, ",", ".") . "</font></strong>";
                                                                                    } elseif ($i->status == 1) {
                                                                                        echo "<strong><font color='#2dce89'>Rp " . number_format($i->total, 0, ",", ".") . "</font></strong>";
                                                                                    } ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php
                                                echo "<table>";

                                                if ($i->status == 0) { //Belum Lunas
                                                    echo "  <tr><td width='30%' style='text-align:left;'>Total</td><td width='70%' style='text-align:right;'><strong><font color='black'>" . number_format($i->total, 0, ",", ".") . "</font></strong></td></tr>
                                                        <tr><td><font color='orange'>Dibayar</font></td><td style='text-align:right;'><strong><font color='orange'>" . number_format($i->total_dibayar, 0, ",", ".") . "</font></strong></td></tr>
                                                        <tr><td><font color='red'>Piutang</font></td><td style='text-align:right;'><strong><font color='red'>" . number_format(($i->total - $i->total_dibayar), 0, ",", ".") . "</font></strong></td></tr>";
                                                } elseif ($i->status == 1) {
                                                    echo "<tr><td width='30%' style='text-align:left;'><font color='#2dce89'>Total</font></td><td width='70%' style='text-align:right;'><font color='#2dce89'><strong>" . number_format($i->total, 0, ",", ".") . "</strong></font></td></tr>";
                                                }

                                                echo "</table>";
                                                ?>
                                        </div>
                                    </li>
                                </ul>

                            <?php
                                // echo "</td>";
                                // echo "<td><table>";
                                // if ($i->status == 0) { //Belum Lunas
                                //     echo "  <tr><td width='30%' style='text-align:left;'>Total</td><td width='70%' style='text-align:right;'><strong><font color='black'>" . number_format($i->total, 0, ",", ".") . "</font></strong></td></tr>
                                //             <tr><td><font color='orange'>Dibayar</font></td><td style='text-align:right;'><strong><font color='orange'>" . number_format($i->total_dibayar, 0, ",", ".") . "</font></strong></td></tr>
                                //             <tr><td><font color='red'>Piutang</font></td><td style='text-align:right;'><strong><font color='red'>" . number_format(($i->total - $i->total_dibayar), 0, ",", ".") . "</font></strong></td></tr>";
                                // } elseif ($i->status == 1) {
                                //     echo "<tr><td width='30%' style='text-align:left;'><font color='#2dce89'>Total</font></td><td width='70%' style='text-align:right;'><font color='#2dce89'><strong>" . number_format($i->total, 0, ",", ".") . "</strong></font></td></tr>";
                                // }
                                // echo "</table></td>";

                                echo "
                                <td class='table-actions'>
                                <a href='javascript:void(0)' onclick=\"edit_sales('$i->id_transaksi')\" class='table-action' data-toggle='tooltip' data-original-title='Edit Pengeluaran'>
                                    <i class='fas fa-edit text-green'></i>
                                </a>
                                <a href='" . base_url('admin/del/transaksi/') . "$i->id_transaksi/sales' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Pengeluaran'>
                                    <i class='fas fa-trash text-red'></i>
                                </a>
                            </td>
                            </tr>";
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-new-sales" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="header-body">
                        <h4 class="modal-title">Tambah Penjualan Baru</h4>
                    </div>
                </div>

                <form action="<?php echo base_url('admin/add/sales'); ?>" method="POST">
                    <input name="login" type="hidden" value="invoice">
                    <input name="username" type="hidden" value="<?php echo $this->session->userdata('log_id'); ?>">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>
                        <?php
                        } ?>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="pelanggan">Pelanggan</label>
                                    <select name="id_pelanggan" id="pelanggan" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_plg="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($pelanggan as $pl) {
                                            $no++;
                                            echo "<option data-select2-id_plg='$no' value='$pl->id_pelanggan'>$pl->nama_pelanggan</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="lokasi">Lokasi</label>
                                    <select name="kode" id="lokasi" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-kk="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($kota_kab as $kk) {
                                            $no++;
                                            echo "<option data-select2-kk='$no' value='$kk->kode'>$kk->nama</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="komoditas">Komoditas</label>
                                    <select name="id_komoditas" id="komoditas" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_kmd="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($komoditas as $km) {
                                            $no++;
                                            echo "<option data-select2-id_kmd='$no' value='$km->id_komoditas'>$km->nama_komoditas</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-control-label" for="pestisida">Pestisida</label>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="pestisida" class="custom-control-input" id="pestisida1" type="radio" value="1" required>
                                    <label class="custom-control-label" for="pestisida1">Ada</label>
                                </div>
                                <div class="custom-control custom-radio mb-3">
                                    <input name="pestisida" class="custom-control-input" id="pestisida2" type="radio" value="0" required>
                                    <label class="custom-control-label" for="pestisida2">Belum Ada</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="produk">Produk</label>
                                    <select name="id_produk" id="produk" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_prd="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($produk as $pr) {
                                            $no++;
                                            echo "<option data-select2-id_prd='$no' value='$pr->id_produk'>$pr->nama_produk</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="tp">Tanggal Pesan</label>
                                    <input type="date" name="tgl_pesan" class="form-control" id="tp" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="te">Tanggal Eksekusi</label>
                                    <!-- <input type="date" name="tgl_eksekusi" class="form-control" id="te" required> -->

                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <!-- 2018-11-23T10:30:00 -->
                                    <input class="form-control" type="datetime-local" name="tgl_eksekusi" value="<?php echo "" . date("Y-m-d") . "T" . date("H:i:s") . ""; ?>" id="example-datetime-local-input" id="te">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="lahan">Luas Lahan</label>
                                    <input type="number" name="jumlah" class="form-control" id="lahan" placeholder="Luas Lahan" required onchange="hitung()">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="total">Total Biaya (Rupiah)</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="Total Biaya" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="status">Status</label>

                                    <!--
                                    <select class="form-control" id="status" name="status">
                                        <option value="4">Pre Order</option>
                                        <option value="1">Lunas</option>
                                        <option value="0">Belum lunas</option>
                                        <option value="2">Utang</option>
                                        <option value="3">Piutang</option>
                                    </select>
                                    -->

                                    <!-- <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="status1" type="radio" value="4" required onclick="showPO();">
                                        <label class="custom-control-label" for="status1">Pre Order</label>
                                    </div> -->
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="status2" type="radio" value="0" required onclick="showU();">
                                        <label class="custom-control-label" for="status2">Belum Lunas</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="status3" type="radio" value="1" required onclick="showL();">
                                        <label class="custom-control-label" for="status3">Lunas</label>
                                    </div>

                                    <div class="form-group" id="inputPO"></div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="keterangan">Catatan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required placeholder="Catatan"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('_/footer') ?>

    <script type="text/javascript">
        function showPO() {
            document.getElementById('inputPO').innerHTML = "<label class='form-control-label' for='total_dibayar'>DP (Rupiah)</label><input type='number' name='total_dibayar' class='form-control' id='total_dibayar' placeholder='Total DP Dibayar' required>";
            // document.getElementById('inputPO').style.display = 'block';
            // document.getElementById('inputU').style.display = 'none';
        }

        function showU() {
            document.getElementById('inputPO').innerHTML = "<label class='form-control-label' for='total_dibayar'>Total Biaya Dibayar (Rupiah)</label><input type='number' name='total_dibayar' class='form-control' id='total_dibayar' placeholder='Total Biaya Dibayar' required>";
        }

        function showL() {
            document.getElementById('inputPO').innerHTML = "";
        }

        function showU_edt() {
            document.getElementById('input_edt').innerHTML = "<label class='form-control-label' for='total_dibayar'>Total Biaya Dibayar (Rupiah)</label><input type='number' name='total_dibayar' class='form-control' id='total_dibayar' placeholder='Total Biaya Dibayar' required>";
        }

        function showL_edt() {
            document.getElementById('input_edt').innerHTML = "";
        }
        
        function hitung() {
            var a = document.getElementById('lahan').value;
            document.getElementById("total").value = a * 200000;
        }

        function hitung_edt() {
            var a = document.getElementById('lahan_edt').value;
            document.getElementById("total_edt").value = a * 200000;
        }


        function edit_sales(id_transaksi) {
            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url('admin/get_transaksi') ?>/" + id_transaksi,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('[name="id_transaksi"]').val(data.id_transaksi);
                    $('[name="username"]').val(data.username);
                    $('[name="keterangan"]').val(data.keterangan);
                    $('[name="total"]').val(data.total);
                    $('[name="total_dibayar"]').val(data.total_dibayar);
                    $('[name="status"]').val(data.status);
                    $('[name="id_komoditas"]').val(data.id_komoditas);
                    $('[name="pestisida"]').val(data.pestisida);
                    $('[name="jumlah"]').val(data.jumlah);
                    $('[name="id_pelanggan"]').val(data.id_pelanggan);
                    $('[name="tgl_pesan"]').val(data.tgl_pesan);
                    $('[name="tgl_eksekusi"]').val(data.tgl_eksekusi);

                    $('#modal_edit_sales').modal('show');
                    $('.modal-title').text('Edit Penjualan');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax server');
                }
            });
        }
    </script>

    <div class="modal fade" id="modal_edit_sales" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="header-body">
                        <h4 class="modal-title"></h4>
                    </div>
                </div>

                <form action="<?php echo base_url('admin/update/sales'); ?>" method="POST">
                    <input name="login" type="hidden" value="invoice">
                    <input name="username" type="hidden" value="<?php echo $this->session->userdata('log_id'); ?>">
                    <input name="id_transaksi" type="hidden" value="<?php echo $this->session->userdata('log_id'); ?>">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>
                        <?php
                        } ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="pelanggan">Pelanggan</label>
                                    <select name="id_pelanggan" id="pelanggan" class="form-control" required disabled>
                                        <?php
                                        $no = 0;
                                        foreach ($pelanggan as $pl) {
                                            $no++;
                                            echo "<option value='$pl->id_pelanggan'>$pl->nama_pelanggan</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-control-label" for="komoditas">Komoditas</label>
                                    <select name="id_komoditas" id="komoditas" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_kmd="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($komoditas as $km) {
                                            $no++;
                                            echo "<option data-select2-id_kmd='$no' value='$km->id_komoditas'>$km->nama_komoditas</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="komoditas">Komoditas</label>
                                    <select class="form-control" id="komoditas" name="id_komoditas" required>
                                        <?php
                                        $no = 0;
                                        foreach ($komoditas as $km) {
                                            $no++;
                                            echo "<option value='$km->id_komoditas'>$km->nama_komoditas</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="pestisida">Pestisida</label>
                                    <select class="form-control" id="pestisida" name="pestisida" required>
                                        <option value="1">Ada</option>
                                        <option value="0">Belum Ada</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="produk">Produk</label>
                                    <select name="id_produk" id="produk" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_prd="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($produk as $pr) {
                                            $no++;
                                            echo "<option data-select2-id_prd='$no' value='$pr->id_produk'>$pr->nama_produk</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="tp">Tanggal Pesan</label>
                                    <input type="date" name="tgl_pesan" class="form-control" id="tp" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="te">Tanggal Eksekusi</label>
                                    <!-- <input type="date" name="tgl_eksekusi" class="form-control" id="te" required> -->

                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <!-- 2018-11-23T10:30:00 -->
                                    <input class="form-control" type="date" name="tgl_eksekusi" id="example-datetime-local-input" id="te">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="lahan_edt">Luas Lahan</label>
                                    <input type="number" name="jumlah" class="form-control" id="lahan_edt" placeholder="Luas Lahan" required onchange="hitung_edt()">
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="total">Total Biaya (Rupiah)</label>
                                    <input type="number" name="total" class="form-control" id="total_edt" placeholder="Total Biaya" readonly>
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="status_edt">Status</label>
                                    <select class="form-control" id="status_edt" name="status">
                                        <option value="1">Lunas</option>
                                        <option value="0">Belum lunas</option>
                                    </select>
                                </div>
                            </div> -->


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="status">Status</label>

                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="status-2" type="radio" value="0" required onclick="showU_edt();">
                                        <label class="custom-control-label" for="status-2">Belum Lunas</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="status-3" type="radio" value="1" required onclick="showL_edt();">
                                        <label class="custom-control-label" for="status-3">Lunas</label>
                                    </div>

                                    <div class="form-group" id="input_edt"></div>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="keterangan">Catatan</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required placeholder="Catatan"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit_spending" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                <form action="<?php echo base_url('admin/update/spending'); ?>" method="POST">
                    <input name="id_transaksi" type="hidden" value="<?php echo $this->session->userdata('log_id'); ?>">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>

                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label class="form-control-label" for="username_edit">Penanggung Jawab (PJ)</label>
                                        <input type="text" name="username" class="form-control" id="username_edit" placeholder="Total Biaya" required readonly>
                                    </div>
                                </div>


                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-control-label" for="tipe_pengeluaran">Jenis Pengeluaran</label>
                                        <select class="form-control" id="tipe_pengeluaran" name="tipe_pengeluaran">
                                            <option value="0">Langsung</option>
                                            <option value="1">Tak Langsung</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="username">PJ</label>
                                        <select name="username" id="username" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id="1" tabindex="-1" aria-hidden="true" required>
                                            <?php
                                                $no = 0;
                                                foreach ($pelanggan as $pl) {
                                                    $no++;
                                                    echo "<option data-select2-id='$no' value='$pl->id_pelanggan'>$pl->nama_pelanggan</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->

                        <?php
                        } else {
                            echo "<input type='hidden' name='username' value='" . $this->session->userdata('log_user') . "'>";
                        } ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="keterangan">Detail Pembelian</label>
                                    <textarea name="keterangan" class="form-control" id="keterangan" rows="3" required placeholder="Misal : Membeli 1 pak kertas HVS"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="total">Total Biaya (Rupiah)</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="Total Biaya" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="status">Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="1">Lunas</option>
                                        <option value="0">Belum lunas</option>
                                        <!-- <option value="2">Utang</option>
                                        <option value="3">Piutang</option> -->
                                    </select>
                                </div>
                            </div>


                            <div class="custom-control custom-radio mb-3">
                                <input name="status" class="custom-control-input" id="status2" type="radio" value="0" required onclick="showU();">
                                <label class="custom-control-label" for="status2">Belum Lunas</label>
                            </div>
                            <div class="custom-control custom-radio mb-3">
                                <input name="status" class="custom-control-input" id="status3" type="radio" value="1" required onclick="showL();">
                                <label class="custom-control-label" for="status3">Lunas</label>
                            </div>
                        </div>

                    </div>

            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
            </div>
            </form>
        </div>
    </div>
</div>