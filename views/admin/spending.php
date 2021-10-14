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
                    <a data-toggle="modal" href="#modal_add_spending" class="btn btn-sm btn-neutral" title="Pengeluaran Baru"><i class="fa fa-plus"></i></a>
                    <!-- <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-upload"></i></a> -->
                    <!-- <a href="#" class="btn btn-sm btn-neutral"><i class="fa fa-download"></i></a> -->
                </div>
            </div>

            <div class="row">

                <div class="col-xl-4 col-md-6">
                    <a href="<?php echo base_url('admin/spending/all') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Semua Pengeluaran</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($semua as $sm) {
                                                                                    echo "Rp " . number_format($sm->semua, 0, ",", ".") . "";
                                                                                } ?>
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                            <i class="ni ni-cart"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-4 col-md-6">
                    <a href="<?php echo base_url('admin/spending/l') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pengeluaran Langsung</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($l as $l) {
                                                                                    echo "Rp " . number_format($l->langsung, 0, ",", ".") . "";
                                                                                } ?>
                                        </span>
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

                <div class="col-xl-4 col-md-6">
                    <a href="<?php echo base_url('admin/spending/tl') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Pengeluaran Tak Langsung</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($tl as $tl) {
                                                                                    echo "Rp " . number_format($tl->tak_langsung, 0, ",", ".") . "";
                                                                                } ?>
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-yellow text-white rounded-circle shadow">
                                            <i class="fa fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!--
                <div class="col-xl-6 col-md-6">
                    <a href="<?php echo base_url('admin/spending/unpaid') ?>">
                        <div class="card card-stats">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Utang/Belum Dibayar</h5>
                                        <span class="h2 font-weight-bold mb-0"><?php foreach ($utang as $u) {
                                                                                    echo "Rp " . number_format($u->utang, 0, ",", ".") . "";
                                                                                } ?>
                                        </span>
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
                </div> -->

                <!-- <div class="col-xl-4 col-md-6">
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
                                    <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                        <i class="fa fa-dollar-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
                    <table class="table table-flush" id="datatable-basic">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">PJ</th>
                                <th width="29%">Detail Pengeluaran</th>
                                <th width="20%">Total</th>
                                <th width="20%" class="text-center">Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($beli as $b) {
                                $no++;
                                echo "<tr>
                                <td>$no</td>
                                <td>$b->username</td>
                                <td>$b->keterangan</td>";

                                echo "<td><strong><font color='red'>Rp " . number_format($b->total, 0, ",", ".") . "</font></strong></td>";

                                echo "<td class='text-center'>";
                                if ($b->status == 0) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Belum Lunas</span></span>";
                                } elseif ($b->status == 1) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Lunas</span></span><br>$b->tgl_input";
                                } elseif ($b->status == 2) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Utang</span></span>";
                                } elseif ($b->status == 3) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-default'></i><span class='status'>Piutang</span></span>";
                                }

                                echo "</td>";

                                echo "
                                <td class='table-actions'>
                                    <a href='javascript:void(0)' onclick=\"edit_spending('$b->id_transaksi')\" class='table-action' data-toggle='tooltip' data-original-title='Edit Pengeluaran'>
                                        <i class='fas fa-edit text-green'></i>
                                    </a>
                                    <a href='" . base_url('admin/del/transaksi/') . "$b->id_transaksi/spending' onclick=\"return confirm('Anda yakin ingin menghapus data ini?')\" class='table-action table-action-delete' data-toggle='tooltip' data-original-title='Hapus Pengeluaran'>
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

    <div class="modal fade" id="modal_add_spending" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <div class="header-body">
                        <h4 class="modal-title">Pengeluaran Baru</h4>
                    </div>
                </div>

                <form action="<?php echo base_url('admin/add/transaksi'); ?>" method="POST">
                    <input name="login" type="hidden" value="invoice">
                    <div class="modal-body">

                        <?php if ($this->session->userdata('log_id') == 'admin') { ?>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">

                                        <label class="form-control-label" for="username">Penanggung Jawab (PJ)</label>
                                        <select name="username" id="username" class="form-control select2-hidden-accessible" data-toggle="select" data-select2-id_admin="1" tabindex="-1" aria-hidden="true" required>

                                            <?php
                                                $no = 0;
                                                foreach ($admin as $ad) {
                                                    $no++;
                                                    echo "<option data-select2-id_admin='$no' value='$ad->username'>$ad->nama_admin</option>";
                                                }
                                                ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="form-control-label" for="tipe_pengeluaran">Jenis Pengeluaran</label>
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="tipe_pengeluaran" class="custom-control-input" id="langsung" type="radio" value="0" required>
                                            <label class="custom-control-label" for="langsung">Langsung</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-3">
                                            <input name="tipe_pengeluaran" class="custom-control-input" id="taklangsung" type="radio" value="1" required>
                                            <label class="custom-control-label" for="taklangsung">Tak Langsung</label>
                                        </div>
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
        function edit_spending(id_transaksi) {
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
                    $('[name="status"]').val(data.status);
                    $('[name="tipe_pengeluaran"]').val(data.tipe_pengeluaran);

                    $('#modal_edit_spending').modal('show');
                    $('.modal-title').text('Edit Pengeluaran');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax server');
                }
            });
        }
    </script>


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