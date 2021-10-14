<!doctype html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?php echo MAIN_DESC ?>">
    <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.ico">
    <title><?php echo MAIN_TITLE ?></title>
    <meta name="msapplication-tap-highlight" content="no">

    <link href="<?php echo base_url() ?>assets/admin/main.07a59de7b920cd76b874.css" rel="stylesheet">
</head>

<body onload="window.print()">
    <div class="app-container app-theme-gray">
        <div class="app-main">

            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon pe-7s-graph2 mr-3 text-muted opacity-6"> </i><?php echo "$title";
                                                                                                if (!empty($tgl_1)) {
                                                                                                    echo " periode $tgl_1 - $tgl_2";
                                                                                                } ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="25%">
                                        <font color='black'>Nama Anggota</font>
                                    </th>
                                    <th width="25%" class="text-center">Level Keanggotaan</th>
                                    <th width="10%" class="text-center">
                                        <font color="green">Pembelian Pribadi</font>
                                    </th>
                                    <th width="10%" class="text-center">
                                        <font color="black">Jumlah Distributor</font>
                                    </th>
                                    <th width="10%" class="text-center">
                                        <font color="blue">Pembelian Distributor</font>
                                    </th>
                                    <th width="15%">
                                        <font color="red">Komisi</font>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php if (empty($member)) {
                                    echo "<tr class='odd gradeX'><td>Kosong...</td><td></td><td></td><td></td><td></td><td></td></tr>";
                                } else {
                                    $no = 0;
                                    foreach ($member as $m) {
                                        $no++;
                                        echo "<tr>
                                                                    <td class='text-center'>$no</td>
                                                                    <td>$m->nama</td>";

                                        $l  = $m->level;
                                        $h  = $m->hrg;              //harga menurut level member
                                        $p  = $m->pembelian;        //total pembelian pribadi
                                        $pt = $m->pembelian_team;   //total pembelian team
                                        $komisi = 0;
                                        //Level
                                        echo "<td class='text-center'>";
                                        if ($m->level == 0) {
                                            echo "<div class='mb-2 mr-2 btn btn-pill btn-focus btn-sm'>Reseller</div>";
                                        } elseif ($m->level == 1) {
                                            echo "<div class='mb-2 mr-2 btn btn-pill btn-alternate btn-sm'>Agen</div>";
                                        } elseif ($m->level == 2) {

                                            echo "<div role='group' class='btn-group-sm btn-group btn-group-toggle' data-toggle='buttons'>
                                                                        <div class='btn btn-pill btn-danger'>Distributor</div>";
                                            if ($m->dst == 0) {
                                                $komisi = 2000;
                                                echo "<div class='btn btn-pill btn-info btn-sm'>Biasa</div>";
                                            } elseif ($m->dst > 0 && $m->dst < 4) {
                                                if ($p > 100) {
                                                    $komisi = 5000;
                                                } else {
                                                    $komisi = 2000;
                                                }
                                                echo "<div class='btn btn-pill btn-secondary btn-sm'>Silver</div>";
                                            } elseif ($m->dst > 3 && $m->dst < 11) {
                                                if ($p > 100) {
                                                    $komisi = 7000;
                                                } else {
                                                    $komisi = 2000;
                                                }
                                                echo "<div class='btn btn-pill btn-warning btn-sm'>Gold</div>";
                                            } elseif ($m->dst > 10) {
                                                if ($p > 100) {
                                                    $komisi = 10000;
                                                } else {
                                                    $komisi = 2000;
                                                }
                                                echo "<div class='btn btn-pill btn-primary btn-sm'>Platinum</div>";
                                            }
                                        }
                                        echo "</div></td>";

                                        echo "<td class='text-center'><font color='green'>$p</font></td>";

                                        echo "<td class='text-center'><font color='black'>$m->dst</font></td>
                                                                    <td class='text-center'><font color='blue'>$pt</font></td>
                                                                    <td><font color='red'>Rp " . number_format(($pt * $komisi), 0, ",", ".") . "</font></td>
                                                                    
                                                                    </tr>";
                                    }
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
    </div>
    <div class="app-drawer-overlay d-none animated fadeIn"></div>
</body>

</html>