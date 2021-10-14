<?php
foreach ($penawaran as $p) {
    $nama               = $p->pelanggan;
    $kota               = $p->kota;
    $alamat             = $p->alamat;
    $nilai_penawaran    = $p->nilai_penawaran;
    $luas               = $p->luas;
}
?>

<html>

<head>
    <title>Surat Penawaran</title>
    <!-- K(J7.2*@d8V@y8N -->
    <style type="text/css">
        body {
            font-family: Arial;
        }

        .doc {

            font-size: 12px;
        }

        .t-penawaran {
            border: 1px solid #dddddd;
            padding: 8px;
        }

        /* @font-face {
            font-family: tulisan_keren;
            src: url(Wolf.ttf);
        }

        h2 {
            font-family: 'tulisan_keren';
            font-size: 70pt;
            font-variant: inherit;
        } */
    </style>

</head>

<body onload="window.print()">

    <!-- <body> -->
    <table align="center" border="0" cellpadding="1" style="width: 700px;">
        <tbody>
            <tr>
                <td colspan="3">
                    <div align="center">
                        <img src="<?php echo base_url("public/img/surat/logo.png") ?>" height="90"><br>
                        <!-- <hr/> -->
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"></td>
                                <td width="600">
                                    <br>
                                    <span class="doc">Surabaya, <?php date_default_timezone_set('Asia/Jakarta');
                                                                echo date("d M Y"); ?></span>
                                    <br>
                                    <br>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table border="0" cellpadding="1" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"><span class="doc">No</span></td>
                                <td width="10"><span class="doc">:</span></td>
                                <td width="590"><span class="doc">005/ smk-if/ yps/ IV/ 2011</span></td>
                            </tr>
                            <tr>
                                <td><span class="doc">Lampiran</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">-</span></td>
                            </tr>
                            <tr>
                                <td><span class="doc">Perihal</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">Penawaran Jasa Penyemprotan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"></td>
                                <td width="600">
                                    <br>
                                    <span class="doc">Kepada Yth</span>
                                    <br>
                                    <span class="doc"><?php echo $nama; ?></span>
                                    <br>
                                    <span class="doc"><?php echo $kota; ?></span>
                                    <br>
                                    <span class="doc"><?php echo $alamat; ?></span>
                                    <br>
                                    <br>
                                    <span class="doc">Dengan hormat,</span>
                                    <br>
                                    <br>
                                    <span style="text-align: justify;" class="doc">Bersama ini kami sampaikan penawaran biaya jasa penyemprotan pupuk/pestisida menggunakan teknologi drone dan adjuvant, dengan perincian sebagai berikut :</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"></td>
                                <td width="600">
                                    <table  class="doc">
                                        <thead>
                                            <tr>
                                                <th class="t-penawaran" width="5%">No</th>
                                                <th class="t-penawaran" width="30%">Jenis Produk/Jasa</th>
                                                <th class="t-penawaran" width="30%">Spesifikasi</th>
                                                <th class="t-penawaran" width="10%">Kuantum</th>
                                                <th class="t-penawaran" width="35%">Harga Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="t-penawaran">1</td>
                                                <td class="t-penawaran">Penyemprotan menggunakan drone</td>
                                                <td class="t-penawaran">1 Unit Drone Sprayer Kapasitas 10 L</td>
                                                <td class="t-penawaran"><?php echo $luas; ?> Ha</td>
                                                <td class="t-penawaran">Rp <?php echo $nilai_penawaran; ?> /Ha</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table border="0" cellpadding="1" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"></td>
                                <td width="200"><span class="doc"><br>Keterangan</span>:</td>
                                <td width="10"></td>
                                <td width="390"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="doc">- Jenis Penyemprotan</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">Penyemprotan menggunakan teknologi Drone dan Adjuvant</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="doc">- Syarat dan Kondisi</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">Sudah termasuk biaya transportasi drone, pilot, aplikator, dan akomodasi lainnya</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="doc">- Durasi Penyemprotan</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">(Sesuai Permintaan)</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="doc">- Jadwal Penyemprotan</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">(Sesuai Permintaan)</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="doc">- Syarat Pembayaran</span></td>
                                <td><span class="doc">:</span></td>
                                <td><span class="doc">Pembayaran dan pelunasan setelah proses penyemprotan selesai dilakukan</span></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="100"></td>
                                <td width="600">
                                    <span style="text-align: justify;"  class="doc">Demikian penawaran kami, atas perhatian dan kerjasamanya disampaikan terimakasih.
                                        <br>
                                        <br>
                                        <b>PT Sentragro Solusi Tani</b>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table border="0" style="width: 700px;">
                        <tbody>

                            <tr>
                                <td width="53"></td>
                                <td width="647">
                                    <div style="align-content: left;">
                                        <img src="<?php echo ASSETS ?>img/surat/ttd.jpg" height="160px">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table border="0" style="width: 700px;">
                        <tbody>
                            <tr>
                                <td width="700">
                                    <img src="<?php echo base_url("public/img/surat/footer.png") ?>" width="700">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

        </tbody>
    </table>
</body>

</html>