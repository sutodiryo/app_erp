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
                </div>
                <div class="table-responsive py-4">
                    <table class="table table-flush" id="datatable-buttons">
                        <thead class="thead-light">
                            <tr>
                                <th width="1%">No</th>
                                <th width="39%">Nama Produk</th>
                                <th width="30%">Keterangan</th>
                                <th width="20%">Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $no = 0;
                            foreach ($stock as $p) {
                                $no++;
                                echo "<tr>
                                <td>$no</td>
                                <td>
                                 <img src='" . base_url() . "public/img/produk/$p->foto' width='50'>
                                 $p->nama_produk
                                </td>
                                <td>$p->keterangan</td>";

                                echo "<td>";
                                if ($p->status == 0) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-warning'></i><span class='status'>Pending</span></span>";
                                } elseif ($p->status == 1) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-success'></i><span class='status'>Aktif</span></span>";
                                } elseif ($p->status == 2) {
                                    echo "<span class='badge badge-dot mr-4'><i class='bg-danger'></i><span class='status'>Banned</span></span>";
                                }
                                echo "</td>
                                
                                <td  class='text-center'>
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