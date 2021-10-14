<html>

<?php
$t1 = new DateTime($tgl_1);
$t2 = new DateTime($tgl_2);

$tg1 = $t1->format('d M Y');
$tg2 = $t2->format('d M Y');
?>
<head>
    <title>Laporan Pengeluaran Sentragro <?php if (!empty($tgl_1)) {
                                                echo " Periode ($tg1 - $tg2)";
                                            } ?></title>
    <link rel="icon" href="<?php echo ASSETS ?>img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo ASSETS ?>css/argon.css?v=1.1.0" type="text/css">
</head>

<body class="dt-print-view" onload="window.print()">

    <hr>
    <h1 class="text-center">Laporan Pengeluaran Sentragro <?php if (!empty($tgl_1)) {
                                                                echo " Periode ($tg1 - $tg2)";
                                                            } ?></h1>

    <hr>

    <table class="table table-flush dataTable">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%">Penanggung Jawab</th>
                <th width="35%">Detail Pengeluaran</th>
                <th width="10" class="text-center">Tanggal Input</th>
                <th width="15%" class="text-right">Total</th>
                <th width="15%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($semua)) {
                echo "<tr><td colspan='7'>Tidak ada data...</td></tr>";
            } else {
                $no = 0;
                foreach ($semua as $s) {
                    $no++;
                    $tgl = new DateTime($s->tgl_input);
                    echo "<tr><td class='text-center'>$no</td>
                    <td>$s->username</td>
                    <td>$s->keterangan</td>
                    <td class='text-center'>" . $tgl->format('d/m/Y') . "</td>";
                    // class='text-center'

                    if ($s->status == 0) {
                        echo "
                        <td class='text-right'><font color='orange'>Rp " . number_format($s->total, 0, ",", ".") . "</font></td>
                        <td><font color='orange'>Belum Lunas</font></td>";
                    } elseif ($s->status == 1) {
                        echo "
                        <td class='text-right'><font color='green'>Rp " . number_format($s->total, 0, ",", ".") . "</font></td>
                        <td><font color='green'>Lunas</font></td>";
                    }
                }
            }

            foreach ($t as $t) {
                $blunas = $t->blunas;
                $jumlah = $t->jumlah;
            }
            echo "
            <tr>
                <th class='text-right' colspan='4'><font color='orange'>Total Belum Lunas : </font></th>
                <th class='text-right'><font color='orange'>Rp " . number_format($blunas, 0, ",", ".") . "</font></th>
                <th></th>
            </tr>
            <tr>
                <th class='text-right' colspan='4'><font color='black'>Grand Total : </font></th>
                <th class='text-right'><font color='black'>Rp " . number_format($jumlah, 0, ",", ".") . "</font></th>
                <th></th>
            </tr>";

            ?>
        </tbody>
    </table>
    <footer class="text-center">
        <small>
            <font color="lavender"><?php echo "".base_url()." (".date('d F Y').")"; ?></font>
        </small>
    </footer>
</body>

</html>