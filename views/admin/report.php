<?php $this->load->view('_/header') ?>

<?php
$t1 = new DateTime($tgl_1);
$t2 = new DateTime($tgl_2);

$tg1 = $t1->format('d M Y');
$tg2 = $t2->format('d M Y');
?>
<!-- Header -->
<div class="header pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-8 col-7">
                    <h6 class="h2 d-inline-block mb-0"><?php echo $title;
                                                        if (!empty($tgl_1)) {
                                                            echo " Periode ($tg1 - $tg2)";
                                                        }  ?></h6>
                </div>
                <div class="col-lg-4 col-5 text-right">
                    <a class="btn btn-sm btn-neutral" title="Reset Periode" href="<?php echo base_url('admin/report/') ?>"><i class="fa fa-retweet"></i></a>
                    <a class="btn btn-sm btn-neutral" title="Download PDF"><i class="fa fa-download"></i></a>
                </div>
            </div>

            <?php echo $this->session->flashdata('report'); ?>

            <!-- <?php foreach ($kas as $k) {
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
                    } ?> -->
            <div class="row">

                <div class="col-xl-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" class="form-light" action="<?php echo base_url('admin/report/') ?>" method="POST">

                                <div class="row">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input name="tgl_1" class="form-control" placeholder="Tanggal Awal" type="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                                </div>
                                                <input name="tgl_2" class="form-control" placeholder="Tanggal Akhir" type="date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6">
                                        <button type="submit" class="form-control btn btn-block btn-info" title="Set Periode Laporan">Set Periode <i class="fa fa-wrench"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="col-xl-6 col-md-6">

                    <div class="card bg-gradient-warning">
                        <!-- Card body -->
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">

                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <h5 class="h3 mb-0 text-white text-uppercase text-muted">Laporan Pengeluaran</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                                <form target="_blank" action="<?php echo base_url('admin/report') ?>" method="POST" role="form" class="form-primary">
                                    <input type="hidden" class="form-control" name="cetak" value="spending">
                                    <?php if (!empty($tgl_1)) {
                                        echo "  <input type='hidden' class='form-control' name='tgl_1' value='$tgl_1'>
                                                        <input type='hidden' class='form-control' name='tgl_2' value='$tgl_2'>";
                                    } ?>

                                    <button type="submit" class="btn btn-icon btn-block btn-secondary"><span class="btn-inner--text">Cetak Laporan </span><span class="btn-inner--icon"><i class="fa fa-print"></i></span></button>

                                </form>

                            </div>
                        </div>
                    </div>

                    <!-- <div class="card card-stats">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h2 class="card-title text-uppercase text-muted mb-0">Cetak Laporan Pengeluaran</h2>
                                </div>
                                <div class="col-auto">
                                    <form target="_blank" action="<?php echo base_url('admin/report') ?>" method="POST">
                                        <input type="hidden" class="form-control" name="cetak" value="spending">
                                        <?php if (!empty($tgl_1)) {
                                            echo "  <input type='hidden' class='form-control' name='tgl_1' value='$tgl_1'>
                                                        <input type='hidden' class='form-control' name='tgl_2' value='$tgl_2'>";
                                        } ?>
                                        <button type="submit" class="btn btn-outline-default" title="Cetak Laporan">
                                            <div class="icon icon-shape text-red ">
                                                <i class="fa fa-print"></i>
                                            </div>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>

                <div class="col-xl-6 col-md-6">

                    <div class="card bg-gradient-success">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">

                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <h5 class="h3 mb-0 text-white text-uppercase text-muted">Laporan Penjualan</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                                <form class="form-primary">
                                    <input type="hidden" class="form-control" name="cetak" value="spending">
                                    <?php if (!empty($tgl_1)) {
                                        echo "  <input type='hidden' class='form-control' name='tgl_1' value='$tgl_1'>
                                                        <input type='hidden' class='form-control' name='tgl_2' value='$tgl_2'>";
                                    } ?>

                                    <button onclick="return alert('Coming Soon...')" type="submit" class="btn btn-icon btn-block btn-secondary"><span class="btn-inner--text">Cetak Laporan </span><span class="btn-inner--icon"><i class="fa fa-print"></i></span></button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="col-xl-6 col-md-6">

                    <div class="card bg-gradient-info">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">

                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <h5 class="h3 mb-0 text-white text-uppercase text-muted">Laporan Piutang</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                                <form class="form-primary">
                                    <input type="hidden" class="form-control" name="cetak" value="spending">
                                    <?php if (!empty($tgl_1)) {
                                        echo "  <input type='hidden' class='form-control' name='tgl_1' value='$tgl_1'>
                                                        <input type='hidden' class='form-control' name='tgl_2' value='$tgl_2'>";
                                    } ?>

                                    <button onclick="return alert('Coming Soon...')" type="submit" class="btn btn-icon btn-block btn-secondary"><span class="btn-inner--text">Cetak Laporan </span><span class="btn-inner--icon"><i class="fa fa-print"></i></span></button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                

                <div class="col-xl-6 col-md-6">

                    <div class="card bg-gradient-danger">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">

                                <div class="col-auto">
                                    <div class="d-flex align-items-center">
                                        <h5 class="h3 mb-0 text-white text-uppercase text-muted">Laporan Utang</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">

                                <form class="form-primary">
                                    <input type="hidden" class="form-control" name="cetak" value="spending">
                                    <?php if (!empty($tgl_1)) {
                                        echo "  <input type='hidden' class='form-control' name='tgl_1' value='$tgl_1'>
                                                        <input type='hidden' class='form-control' name='tgl_2' value='$tgl_2'>";
                                    } ?>

                                    <button onclick="return alert('Coming Soon...')" type="submit" class="btn btn-icon btn-block btn-secondary"><span class="btn-inner--text">Cetak Laporan </span><span class="btn-inner--icon"><i class="fa fa-print"></i></span></button>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>


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