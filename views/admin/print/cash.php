<?php $this->load->view('_/header') ?>

<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title;
                                                        if (!empty($tgl_1)) {
                                                            echo " Periode $tgl_1 - $tgl_2";
                                                        }  ?></h6>
                </div>
                <div class="col-lg-4 col-5 text-right">
                    <a class="btn btn-sm btn-neutral"><i class="fa fa-upload"></i></a>
                    <a class="btn btn-sm btn-neutral"><i class="fa fa-download"></i></a>
                </div>
            </div>

            <?php echo $this->session->flashdata('report'); ?>

            <?php foreach ($kas as $k) {
                $total_kas      = ($k->income_lunas + $k->income_blunas) - ($k->spending_lunas + $k->spending_blunas);
                $total_utang    = $k->utang;
                $total_piutang  = $k->piutang;
                $fcf            = $total_kas - $k->utang;

                $tk             = $k->tk;
                $tkbl           = $k->tkbl;
                $tkl            = $k->tkl;

                $tj             = $k->tj;
                $tjl            = $k->tjl;
                $tjdp           = $k->tjdp;
                $tjp            = $k->tjp;
            } ?>
            <div class="row">

                <div class="col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" class="form-light" action="<?php echo base_url('admin/cash/total') ?>" method="POST">

                                <div class="row">
                                    <div class="col-xl-5 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input name="tgl_1" class="form-control" placeholder="Tanggal Awal" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input name="tgl_2" class="form-control" placeholder="Tanggal Akhir" type="date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-md-6">
                                        <button type="submit" class="form-control btn btn-block btn-info" title="Lihat Laporan Berdasarkan Periode"><i class="fa fa-eye"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Omset</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format($tj, 0, ",", ".") . ""; ?></span>
                                </div>
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Omset</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format($tj, 0, ",", ".") . ""; ?></span>
                                </div>
                            </div>
                        </div> -->
                    </div>

                </div>

                <div class="col-xl-12 col-md-6">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header border-0">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="mb-0">Kas dari Aktivitas Operasional</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="#" target="_blank" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Cetak PDF">
                                        <span class="btn-inner--icon"><i class="fas fa-print"></i></span>
                                        <span class="btn-inner--text">PDF</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Light table -->
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th><?php if (!empty($tgl_1)) {
                                                echo "$tgl_1 - $tgl_2";
                                            } else {echo "Arus Kas";} ?></th>
                                        <th class="text-right">Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td><span class="text-muted">Profit</span></td>
                                        <td class="text-right"><a class="font-weight-bold"><?php echo "" . number_format(($tj - $tk), 0, ",", ".") . ""; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Piutang</span></td>
                                        <td class="text-right"><a class="font-weight-bold"><?php echo "" . number_format($tjp, 0, ",", ".") . ""; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Utang</span></td>
                                        <td class="text-right"><a class="font-weight-bold"><?php echo "" . number_format($total_utang, 0, ",", ".") . ""; ?></a></td>
                                    </tr>
                                    <tr>
                                        <td><span class="text-muted">Kas On Hand</span></td>
                                        <td class="text-right"><a class="font-weight-bold"><?php echo "Rp " . number_format(((($tj - $tk) - $total_utang) - $tjp), 0, ",", ".") . ""; ?></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Profit Bersih</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format(($tj - $tk), 0, ",", ".") . ""; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">New order for Argon Dashboard</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">Your theme has been updated</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->

                <!-- <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Piutang</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format($total_piutang, 0, ",", ".") . ""; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">New order for Argon Dashboard</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">Your theme has been updated</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Total Utang</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format($total_utang, 0, ",", ".") . ""; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">New order for Argon Dashboard</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">Your theme has been updated</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                    <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="card-title text-uppercase text-muted mb-0">Kas On Hand</h5>
                                    <span class="h2 font-weight-bold mb-0"><?php echo "Rp " . number_format($fcf, 0, ",", ".") . ""; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">New order for Argon Dashboard</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                                <a class="list-group-item list-group-item-action flex-column align-items-start py-4 px-4">
                                    <h4 class="mt-3 mb-1"><span class="text-info">Your theme has been updated</span></h4>
                                    <p class="text-sm mb-0">Doasdnec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div>

        </div>
    </div>

</div>


<div class="container-fluid mt--6">
    <div class="row">
        <div class="col">
        </div>
    </div>


    <div class="modal fade" id="modal-new-income" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="header-body">
                        <h4 class="modal-title">Tambah Penjualan Baru</h4>
                    </div>
                </div>

                <form action="<?php echo base_url('admin/add/transaksi'); ?>" method="POST">
                    <input name="login" type="hidden" value="invoice">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="pembeli">Pembeli</label>
                                        <select name="username" id="pembeli" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id="1" tabindex="-1" aria-hidden="true" required>

                                            <?php
                                                $no = 0;
                                                foreach ($admin as $ad) {
                                                    $no++;
                                                    echo "<option data-select2-id='$no' value='$ad->username'>$ad->username</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                        <?php
                        } ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="produk">Produk</label>
                                    <select name="id_produk" id="produk" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id="2" tabindex="-2" aria-hidden="true" required>

                                        <?php
                                        $no = 0;
                                        foreach ($produk as $pr) {
                                            $no++;
                                            echo "<option data-select2-id2='$no' value='$pr->id_produk'>$pr->nama_produk</option>";
                                        }
                                        ?>

                                    </select>
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
                                        <option value="2">Utang</option>
                                        <option value="3">Piutang</option>
                                    </select>
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