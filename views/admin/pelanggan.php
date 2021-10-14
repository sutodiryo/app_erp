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
                    <a href="#" class="btn btn-sm btn-neutral">New</a>
                    <a href="#" class="btn btn-sm btn-neutral">Filters</a>
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
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0"><?php echo $title ?></h3>
                    <!-- <p class="text-sm mb-0">
                        This is an exmaple of datatable using the well known datatables.net plugin. This is a minimal setup in order to get started fast.
                    </p> -->
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="29%">Nama</th>
                                <th width="10%">No HP</th>
                                <th width="30%">Alamat</th>
                                <th width="10%" class="text-center">Tipe</th>
                                <th width="10%" class="text-center">Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($pelanggan as $p) {
                                $no++;
                                echo "<tr>
                                <td>$no</td>
                                <td>$p->nama_pelanggan</td>
                                <td>$p->no_hp</td>
                                <td>$p->kota<br>$p->alamat</td>";

                                echo "<td class='text-center'>";
                                if ($p->tipe == 0) {
                                    echo "<button type='button' class='btn btn-info btn-sm'>Petani</button>";
                                } elseif ($p->tipe == 1) {
                                    echo "<button type='button' class='btn btn-primary btn-sm'>Kios</button>";
                                } elseif ($p->tipe == 2) {
                                    echo "<button type='button' class='btn btn-default btn-sm'>Corporate</button>";
                                }
                                echo "</td>";

                                echo "<td>";
                                if ($p->status == 0) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Pending</span></span>";
                                } elseif ($p->status == 1) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Aktif</span></span>";
                                } elseif ($p->status == 2) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Banned</span></span>";
                                }

                                echo "</td>";

                                echo "<td class='text-center'>
                                <a class='btn-inner--icon' title='Edit' href='#'><i class='fa fa-edit'></i></a>
                                </td>
                            </tr>";
                            } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php $this->load->view('_/footer') ?>