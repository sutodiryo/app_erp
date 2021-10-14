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
                    <a data-toggle="modal" href="#modal_new_bid" class="btn btn-sm btn-neutral" title="Penawaran Baru"><i class="fa fa-plus"></i></a>
                    <!-- <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-upload"></i></a> -->
                    <!-- <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-download"></i></a> -->
                </div>
            </div>

            <div class="row">
                <a href="<?php echo base_url('admin/bid/all') ?>">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua Penawaran</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php echo $bid_all;
                                                                                // foreach ($utang as $u) {
                                                                                //     echo "Rp " . number_format($u->utang, 0, ",", ".") . "";
                                                                                // }
                                                                                ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="fa fa-paper-plane"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6">
                <a href="<?php echo base_url('admin/bid/p') ?>">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Dalam Proses</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $bid_process; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                        <i class="fa fa-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-xl-4 col-md-6">
                <a href="<?php echo base_url('admin/bid/so') ?>">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Sales Order</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo $bid_so; ?></span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fa fa-calendar-check"></i>
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
    <div class="row">
        <div class="col">
            <div class="card">

                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%" class="text-center">Pengirim</th>
                                <th width="29%" class="text-center">Tujuan</th>
                                <!-- <th width="9%" class="text-center">Dokumen</th> -->
                                <!-- <th width="15%">Waktu</th> -->
                                <th width="40%" class="text-center">Total</th>
                                <th width="10%" class="text-center">Status</th>
                                <!-- <th width="5%"></th> -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($bid as $b) {
                                $no++;
                                echo "<tr>
                                <td>
                                <table>
                                    <tr><td>$no</td></tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                    <tr><td>$b->admin</td></tr>
                                </table>
                                </td>
                                <td>
                                <table>
                                    <tr><td>$b->pelanggan</td></tr>
                                    <tr><td><button title='Cetak Surat' onclick=\"window.open('" . base_url('admin/surat') . "/$b->id_bid', '_blank')\" class='btn btn-outline-default btn-icon btn-sm' type='button'><span class='btn-inner--icon'><i class='ni ni-email-83'></i></span><span class='btn-inner--text'>Surat</span></button></td></tr>
                                </table>
                                </td>";
                                // <button title='Cetak Surat' onclick=\"window.open('" . base_url('admin/surat') . "/$b->id_bid', '_blank')\" type='button' class='btn btn-success btn-sm'>Surat</button>
                                // echo "
                                // <br>
                                // <br>
                                // <button onclick=\"window.open('https://google.com/', '_blank')\" type='button' class='btn btn-info btn-sm'>Lampiran</button></td>";

                                //Total

                                date_default_timezone_set('UTC');
                                $tgl_penawaran  = new DateTime($b->tgl_penawaran);
                                $tgl_deal       = new DateTime($b->tgl_deal);
                                // " . $tgl_penawaran->format('d M Y (H:m:s)') . "
                                echo "<td>";
                                if ($b->status != 2) {
                                    echo "<table>
                                    <tr><td width='30%' style='text-align:left;'>Penawaran (" . $tgl_penawaran->format('d-M-Y') . ")</td><td width='70%' style='text-align:right;'><strong><font color='black'>Rp " . number_format($b->nilai_penawaran, 0, ",", ".") . "</font></strong></td></tr>
                                    </table>";
                                } elseif ($b->status == 2) {

                                    //     echo "<p class='mt-3 mb-0 text-sm'>
                                    //     <span class='text-success mr-2'><i class='fa fa-arrow-up'></i> 3.48%</span>
                                    //     <span class='text-nowrap'>Since last month</span>
                                    //   </p>
                                    //   <p class='mt-3 mb-0 text-sm'>
                                    //     <span class='text-success mr-2'><i class='fa fa-arrow-up'></i> 3.48%</span>
                                    //     <span class='text-nowrap'>Since last month</span>
                                    //   </p>";
                                    echo "<table>
                                    <tr><td width='30%' style='text-align:left;'>Penawaran (" . $tgl_penawaran->format('d-M-Y') . ")</td><td width='70%' style='text-align:right;'><strong><font color='black'>Rp " . number_format($b->nilai_penawaran, 0, ",", ".") . "</font></strong></td></tr>
                                    <tr><td><font color='orange'>Deal (" . $tgl_deal->format('d-M-Y') . ")</font></td><td style='text-align:right;'><strong><font color='orange'>Rp " . number_format($b->nilai_deal, 0, ",", ".") . "</font></strong></td></tr>         
                                    </table>";
                                }
                                echo "</td>";

                                // echo "</td>";
                                // echo "<td><table>";
                                // if ($i->status == 0) { //Belum Lunas
                                //     echo "  <tr><td width='30%' style='text-align:left;'>Total</td><td width='70%' style='text-align:right;'><strong><font color='black'>" . number_format($i->total, 0, ",", ".") . "</font></strong></td></tr>
                                //             <tr><td><font color='orange'>Dibayar</font></td><td style='text-align:right;'><strong><font color='orange'>" . number_format($i->nilai_penawaran, 0, ",", ".") . "</font></strong></td></tr>
                                //             <tr><td><font color='red'>Piutang</font></td><td style='text-align:right;'><strong><font color='red'>" . number_format(($i->total - $i->nilai_penawaran), 0, ",", ".") . "</font></strong></td></tr>";
                                // } elseif ($i->status == 1) {
                                //     echo "<tr><td width='30%' style='text-align:left;'><font color='#2dce89'>Total</font></td><td width='70%' style='text-align:right;'><font color='#2dce89'><strong>" . number_format($i->total, 0, ",", ".") . "</strong></font></td></tr>";
                                // }
                                // echo "</table></td>";

                                //Status
                                echo "<td class='text-center'>";
                                if ($b->status == 0) {
                                    echo "
                                    <table>
                                        <tr><td><a class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>Pending</span></a></td></tr>
                                        <tr>
                                            <td>
                                                <ul class='navbar-nav align-items-center ml-auto ml-md-0'>
                                                    <li class='nav-item dropdown'>
                                                        <button title='Update Status' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
                
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-info-circle'></i><span>Set Process</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-check-circle'></i><span>Set Sales Order</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-times-circle'></i><span>Set Cancel</span></a>
                                                            <div class='dropdown-divider'></div>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-edit'></i><span>Edit</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>";
                                } elseif ($b->status == 1) {
                                    echo "
                                    <table>
                                        <tr><td><a class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Process</span></a></td></tr>
                                        <tr>
                                            <td>
                                                <ul class='navbar-nav align-items-center ml-auto ml-md-0'>
                                                    <li class='nav-item dropdown'>
                                                        <button title='Update Status' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
                
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-pause-circle'></i><span>Set Pending</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-check-circle'></i><span>Set Sales Order</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-times-circle'></i><span>Set Cancel</span></a>
                                                            <div class='dropdown-divider'></div>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-edit'></i><span>Edit</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>";

                                } elseif ($b->status == 2) {
                                    echo "
                                    <table>
                                        <tr><td><a class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Sales Order</span></a></td></tr>
                                        <tr>
                                            <td>
                                                <ul class='navbar-nav align-items-center ml-auto ml-md-0'>
                                                    <li class='nav-item dropdown'>
                                                        <button title='Update Status' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
                
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-info-circle'></i><span>Set Process</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-times-circle'></i><span>Set Cancel</span></a>
                                                            <div class='dropdown-divider'></div>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-edit'></i><span>Edit</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>";
                                } elseif ($b->status == 3) {
                                    echo "
                                    <table>
                                        <tr><td><a class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Cancel</span></a></td></tr>
                                        <tr>
                                            <td>
                                                <ul class='navbar-nav align-items-center ml-auto ml-md-0'>
                                                    <li class='nav-item dropdown'>
                                                        <button title='Update Status' data-toggle='dropdown' class='btn btn-icon btn-sm btn-default'><span class='btn-inner--icon'><i class='ni ni-settings-gear-65'></i></span></button>
                
                                                        <div class='dropdown-menu dropdown-menu-right'>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-check-circle'></i><span>Set Sales Order</span></a>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-times-circle'></i><span>Set Cancel</span></a>
                                                            <div class='dropdown-divider'></div>
                                                            <a href='#!' class='dropdown-item'><i class='fa fa-edit'></i><span>Edit</span></a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </table>";
                                }

                                echo "</td>";

                                // echo "<td class='text-center'>
                                // <button title='Cetak Surat' onclick=\"window.open('" . base_url('admin/surat') . "/$b->id_bid', '_blank')\" type='button' class='btn btn-success btn-sm'>Surat</button>
                                // </td>";

                                echo "</tr>";
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_new_bid" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="header-body">
                        <h4 class="modal-title">Penawaran Baru</h4>
                    </div>
                </div>

                <form action="<?php echo base_url('admin/add/bid'); ?>" method="POST">
                    <!-- <input name="login" type="hidden" value="invoice"> -->
                    <input name="username" type="hidden" value="<?php echo $this->session->userdata('log_id'); ?>">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>
                        <?php
                        } ?>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="form-control-label" for="pelanggan">Pelanggan</label>
                                    <select name="id_pelanggan" id="pelanggan" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_pel="1" tabindex="-1" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($pelanggan as $pl) {
                                            $no++;
                                            echo "<option data-select2-id_pel='$no' value='$pl->id_pelanggan'>$pl->nama_pelanggan</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label" for="pelanggan_baru">Add</label>
                                    <button id="pelanggan_baru" class="form-control btn btn-icon btn-primary" type="button">
                                        <span class="btn-inner--icon"><i class="fa fa-user-plus"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <?php date_default_timezone_set('Asia/Jakarta'); ?>

                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="form-control-label" for="komoditas">Komoditas</label>
                                    <select name="id_komoditas" id="komoditas" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_kom="2" tabindex="-2" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($komoditas as $km) {
                                            $no++;
                                            echo "<option data-select2-id_kom='$no' value='$km->id_komoditas'>$km->nama_komoditas</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="produk">Produk</label>
                                    <select name="id_produk" id="produk" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_produk="3" tabindex="-3" aria-hidden="true" required>
                                        <?php
                                        $no = 0;
                                        foreach ($produk as $pr) {
                                            $no++;
                                            echo "<option data-select2-id_produk='$no' value='$pr->id_produk'>$pr->nama_produk</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
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

                                <div class="form-group">
                                    <label class="form-control-label" for="luas">Luas Lahan</label>
                                    <input type="number" name="luas" class="form-control" id="luas" placeholder="Luas Lahan" required>
                                </div>
                                <!-- <div class="form-group">
                                    <label class="form-control-label" for="total">Total Biaya (Rupiah)</label>
                                    <input type="number" name="total" class="form-control" id="total" placeholder="Total Biaya" readonly>
                                </div> -->
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

                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="tawar" type="radio" value="1" required onclick="showTW();">
                                        <label class="custom-control-label" for="tawar">Ditawarkan</label>
                                    </div>
                                    <div class="custom-control custom-radio mb-3">
                                        <input name="status" class="custom-control-input" id="deal" type="radio" value="0" required onclick="showDL();">
                                        <label class="custom-control-label" for="deal">Deal</label>
                                    </div>

                                    <div class="form-group" id="inputValue"></div>

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

    <script type="text/javascript">
        function showTW() {
            document.getElementById('inputValue').innerHTML = "<label class='form-control-label' for='tgl_penawaran'>Tanggal Penawaran</label><input type='date' name='tgl_penawaran' class='form-control' id='tgl_penawaran' required><br><label class='form-control-label' for='nilai_penawaran'>Nilai Penawaran (Rupiah)</label><input type='number' name='nilai_penawaran' class='form-control' id='nilai_penawaran' placeholder='Nilai Penawaran (Per Ha)' required>";
        }

        function showDL() {
            document.getElementById('inputValue').innerHTML = "<label class='form-control-label' for='tgl_penawaran'>Tanggal Penawaran</label><input type='date' name='tgl_penawaran' class='form-control' id='tgl_penawaran' required><br><label class='form-control-label' for='nilai_penawaran'>Nilai Penawaran (Rupiah)</label><input type='number' name='nilai_penawaran' class='form-control' id='nilai_penawaran' placeholder='Nilai Penawaran (Per Ha)' required><br><label class='form-control-label' for='tgl_deal'>Tanggal Deal</label><input type='date' name='tgl_deal' class='form-control' id='tgl_deal' required><br><label class='form-control-label' for='nilai_deal'>Nilai Deal (Rupiah)</label><input type='number' name='nilai_deal' class='form-control' id='nilai_deal' placeholder='Nilai Deal (Per Ha)' required>";
        }

        function hitung() {
            var a = document.getElementById('lahan').value;
            document.getElementById("total").value = a * 200000;
        }
    </script>

    <!-- Footer -->
    <?php $this->load->view('_/footer') ?>