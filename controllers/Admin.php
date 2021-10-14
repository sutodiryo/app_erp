<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    if ($this->session->userdata('log_valid') == TRUE) {

      if ($this->session->userdata('log_admin') == FALSE) {
        $this->session->set_flashdata("report", "<div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\"><span class=\"alert-icon\"><i class=\"ni ni-like-2\"></i></span><span class=\"alert-text\"><strong>Warning!</strong> Anda tidak diperkenankan mengakses halaman tersebut!</span><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">×</span></button></div>");
        if ($this->session->userdata('log_pilot') == TRUE) {
          redirect(base_url('pilot'));
        } elseif ($this->session->userdata('log_sales') == TRUE) {
          redirect(base_url('sales'));
        } elseif ($this->session->userdata('log_user') == TRUE) {
          redirect(base_url('user'));
        }
      }
    } else {
      redirect(base_url('auth'));
    }

    if (($this->session->userdata('log_valid') == FALSE) && ($this->session->userdata('log_admin') == FALSE)) {
      redirect(base_url());
    }
  }

  function index()
  {
    $data['page']   = 'dashboard';
    $data['title']  = 'Admin Dashboard';
    $id             = $this->session->userdata('log_id');

    // $data['piutang']    = $this->db->query("SELECT (SUM(total)) - (SUM(total_dibayar)) AS piutang FROM transaksi WHERE (tipe=1 AND status=3) OR (tipe=1 AND status=0)")->result();

    $data['total']            = $this->db->query("SELECT  (SELECT SUM(total) FROM transaksi WHERE tipe=0) AS tk,
                                                          (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=0) AS tkbl,
                                                          (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=1) AS tkl,

                                                          (SELECT SUM(total) FROM transaksi WHERE tipe=1) AS tj, -- total omset transaksi jual
                                                          (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1) AS tjl, -- total transaksi jual lunas
                                                          (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0) AS tjdp, -- total dp transaksi jual blm lunas
                                                          -- (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1) AS tjbl,
                                                          -- (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=4) AS tjpo,
                                                          (SELECT (SUM(total)) - (SUM(total_dibayar)) FROM transaksi WHERE tipe=1 AND status=0) AS tjp -- total piutang transaksi jual blm lunas

                                                  FROM transaksi")->result();

    $data['total_pelanggan']  = $this->db->query('SELECT * FROM pelanggan')->num_rows();
    $data['tgl']              = $this->db->query("SELECT  EXTRACT(MONTH FROM MIN(dibuat)) AS minim,
                                                          EXTRACT(MONTH FROM MAX(dibuat)) AS maks,
                                                          EXTRACT(YEAR FROM MAX(dibuat)) AS maxy
                                                  FROM pelanggan")->result();

    $data['last_pelanggan']   = $this->db->query("SELECT * FROM pelanggan ORDER BY dibuat DESC LIMIT 10")->result();

    $data['penjualan']        = $this->db->query("SELECT  MONTHNAME(tgl_input) AS m,
                                                          SUM(total) AS t,
                                                          SUM(jumlah) AS j
                                                  FROM transaksi
                                                          GROUP BY YEAR(tgl_input), MONTH(tgl_input)")->result_array();

    $this->load->view("admin/dashboard", $data);
  }

  public function pelanggan($x)
  {
    if ($x == "s") {

      $data['page']       = 'pelanggan';
      $data['title']      = 'Daftar Semua Pelanggan';
      $data['pelanggan']  = $this->db->query("SELECT * FROM pelanggan")->result();

      $this->load->view("admin/pelanggan", $data);
    } elseif ($x == "all") { }
  }

  public function bid($x)
  {
    $data['page']         = 'bid';
    $data['bid_all']      = $this->db->query("SELECT * FROM bid")->num_rows();
    $data['bid_process']  = $this->db->query("SELECT * FROM bid WHERE status=1")->num_rows();
    $data['bid_so']       = $this->db->query("SELECT * FROM bid WHERE status=2")->num_rows();

    // $data['utang']      = $this->db->query("SELECT SUM(total) AS utang FROM transaksi WHERE tipe=0 AND status=0")->result();
    // $data['piutang']    = $this->db->query("SELECT SUM(total) AS piutang FROM transaksi WHERE tipe=1 AND (status=1 OR status=2)")->result();
    // $data['semua']      = $this->db->query("SELECT SUM(total) AS semua FROM transaksi WHERE tipe=1")->result();

    $data['admin']      = $this->db->query("SELECT * FROM admin")->result();
    $data['pelanggan']  = $this->db->query("SELECT id_pelanggan,nama_pelanggan FROM pelanggan ORDER BY nama_pelanggan ASC")->result();
    $data['komoditas']  = $this->db->query("SELECT id_komoditas,nama_komoditas FROM komoditas ORDER BY nama_komoditas ASC")->result();
    $data['produk']     = $this->db->query("SELECT id_produk,nama_produk FROM produk ORDER BY nama_produk ASC")->result();

    $qbid   = " SELECT  id_bid,username,id_pelanggan,nilai_penawaran,tgl_penawaran,tgl_deal,nilai_deal,isi_surat,lampiran,status,
                        -- (SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan=transaksi.id_pelanggan) AS pelanggan,
                        (SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan=bid.id_pelanggan) AS pelanggan,
                        (SELECT nama_admin FROM admin WHERE username=bid.username) AS admin
                FROM bid";

    if ($x == "all") {
      $data['title']  = 'Daftar Semua Penawaran';
      $data['bid']    = $this->db->query("$qbid")->result();
    } elseif ($x == "p") {
      $data['title']  = 'Daftar Penawaran Dalam Proses';
      $data['bid']    = $this->db->query("$qbid WHERE status=1")->result();
    } elseif ($x == "so") {
      $data['title']  = 'Daftar Sales Order';
      $data['bid']    = $this->db->query("$qbid WHERE status=2")->result();
    }

    $this->load->view("admin/bid", $data);
  }

  public function surat($x)
  {
    $data['penawaran'] = $this->db->query(" SELECT  id_bid,username,id_pelanggan,nilai_penawaran,tgl_penawaran,tgl_deal,nilai_deal,isi_surat,lampiran,status,luas,
                                                    (SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan=bid.id_pelanggan) AS pelanggan,
                                                    (SELECT kota FROM pelanggan WHERE id_pelanggan=bid.id_pelanggan) AS kota,
                                                    (SELECT alamat FROM pelanggan WHERE id_pelanggan=bid.id_pelanggan) AS alamat,
                                                    (SELECT nama_admin FROM admin WHERE username=bid.username) AS admin
                                            FROM bid WHERE id_bid=$x")->result();
    $this->load->view("admin/surat", $data);
  }

  public function sales($x)
  {
    $data['page']       = 'sales';
    // $data['utang']      = $this->db->query("SELECT SUM(total) AS utang FROM transaksi WHERE tipe=1 AND status=2")->result();
    $data['piutang']    = $this->db->query("SELECT (SUM(total)) - (SUM(total_dibayar)) AS piutang FROM transaksi WHERE (tipe=1 AND status=3) OR (tipe=1 AND status=0)")->result();
    $data['semua']      = $this->db->query("SELECT SUM(total) AS semua FROM transaksi WHERE tipe=1")->result();

    $data['admin']      = $this->db->query("SELECT username,nama_admin FROM admin")->result();
    $data['pelanggan']  = $this->db->query("SELECT id_pelanggan,nama_pelanggan FROM pelanggan")->result();
    $data['komoditas']  = $this->db->query("SELECT id_komoditas,nama_komoditas FROM komoditas")->result();
    $data['produk']     = $this->db->query("SELECT id_produk,nama_produk FROM produk")->result();
    $data['kota_kab']   = $this->db->query("SELECT kode,nama FROM tbl_master_daerah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama")->result();

    $q = "  SELECT  id_transaksi,id_produk,username,id_pelanggan,jumlah,total,total_dibayar,tgl_input,tgl_pesan,tgl_eksekusi,tgl_bayar,keterangan,tipe,status,
                    (SELECT nama_pelanggan FROM pelanggan WHERE id_pelanggan=transaksi.id_pelanggan) AS pelanggan,
                    (SELECT nama_produk FROM produk WHERE id_produk=transaksi.id_produk) AS produk,
                    (SELECT nama_komoditas FROM komoditas WHERE id_komoditas=transaksi.id_komoditas) AS komoditas
            FROM transaksi";

    if ($x == "all") {
      $data['title']  = 'Daftar Semua Penjualan';
      $data['income'] = $this->db->query("$q WHERE tipe=1 ORDER BY tgl_input DESC")->result();
    } elseif ($x == "credit") {
      $data['title']  = 'Daftar Piutang Penjualan';
      $data['income'] = $this->db->query("$q WHERE (tipe=1 AND status=3) OR (tipe=1 AND status=0) ORDER BY tgl_input DESC")->result();
    } elseif ($x == "paid") { }

    $this->load->view("admin/sales", $data);
  }

  public function spending($x)
  {
    $data['page']       = 'spending';
    $data['admin']      = $this->db->query("SELECT username,nama_admin FROM admin")->result();
    $data['pelanggan']  = $this->db->query("SELECT id_pelanggan,nama_pelanggan FROM pelanggan")->result();

    $data['utang']      = $this->db->query("SELECT SUM(total) AS utang FROM transaksi WHERE tipe=0 AND ((status=2) OR (status=0))")->result();
    $data['piutang']    = $this->db->query("SELECT SUM(total) AS piutang FROM transaksi WHERE tipe=0 AND status=3")->result();

    $data['l']          = $this->db->query("SELECT SUM(total) AS langsung FROM transaksi WHERE tipe=0 AND tipe_pengeluaran=0")->result();
    $data['tl']         = $this->db->query("SELECT SUM(total) AS tak_langsung FROM transaksi WHERE tipe=0 AND tipe_pengeluaran=1")->result();

    $data['semua']      = $this->db->query("SELECT SUM(total) AS semua FROM transaksi WHERE tipe=0")->result();

    if ($x == "all") {
      $data['title']  = 'Daftar Pengeluaran';
      $data['beli']   = $this->db->query("SELECT * FROM transaksi WHERE tipe=0")->result();
    } elseif ($x == "l") {
      // Pengeluaran Langsung
      $data['title']  = 'Daftar Pengeluaran Langsung';
      $data['beli']   = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 AND tipe_pengeluaran=0")->result();
    } elseif ($x == "tl") {
      // Pengeluaran Tak Langsung
      $data['title']  = 'Daftar Pengeluaran Tak Langsung';
      $data['beli']   = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 AND tipe_pengeluaran=1")->result();
    } elseif ($x == "unpaid") {
      $data['title']  = 'Daftar Pengeluaran Belum Dibayar';
      $data['beli']   = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 AND status=0")->result();
    } elseif ($x == "paid") {
      $data['title']  = 'Daftar Pengeluaran Dibayar';
      $data['beli']   = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 AND status=1")->result();
    }

    $this->load->view("admin/spending", $data);
  }

  public function cash($x)
  {
    $data['page']     = 'cash';
    $data['admin']    = $this->db->query("SELECT * FROM admin")->result();

    $total = "  SELECT  (SELECT SUM(total) FROM transaksi WHERE tipe=0) AS tk,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=0) AS tkbl,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=1) AS tkl,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=1) AS tj, -- total omset transaksi jual
                        (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1) AS tjl, -- total transaksi jual lunas
                        (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0) AS tjdp, -- total dp transaksi jual blm lunas
                        (SELECT (SUM(total)) - (SUM(total_dibayar)) FROM transaksi WHERE tipe=1 AND status=0) AS tjp, -- total piutang transaksi jual blm lunas

                        -- (SELECT SUM(total) FROM transaksi WHERE tipe=1) AS income,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1) AS income_lunas,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=0) AS income_blunas,
                        (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0) AS income_blunas,
                        -- (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0) AS income_blunas,
                        -- (SELECT SUM(total) FROM transaksi WHERE tipe=0) AS spending,
                        (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=1) AS spending_lunas,
                        (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=0 AND status=0) AS spending_blunas,
                        (SELECT SUM(total) FROM transaksi WHERE status=0 AND tipe=0) AS utang,
                        (SELECT (SUM(total)-SUM(total_dibayar)) FROM transaksi WHERE tipe=1 AND status=0) AS piutang
                FROM transaksi";

    $tgl_1  = $this->input->post('tgl_1');
    $tgl_2  = $this->input->post('tgl_2');
    if ($x == "total") {
      if (empty($tgl_1 && $tgl_2)) {
        $data['title']  = 'Kas Perusahaan';
        $data['kas']    = $this->db->query("$total")->result();
      } else {
        $data['title']  = 'Kas Perusahaan';

        $tgl = "AND tgl_input BETWEEN '$tgl_1' AND '$tgl_2'";
        $total_p = "  SELECT  (SELECT SUM(total) FROM transaksi WHERE tipe=0 $tgl) AS tk,
        (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=0 $tgl) AS tkbl,
        (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=1 $tgl) AS tkl,
        (SELECT SUM(total) FROM transaksi WHERE tipe=1 $tgl) AS tj, -- total omset transaksi jual
        (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1 $tgl) AS tjl, -- total transaksi jual lunas
        (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0 $tgl) AS tjdp, -- total dp transaksi jual blm lunas
                        (SELECT (SUM(total)) - (SUM(total_dibayar)) FROM transaksi WHERE tipe=1 AND status=0 $tgl) AS tjp, -- total piutang transaksi jual blm lunas
        
                              (SELECT SUM(total) FROM transaksi WHERE tipe=1 AND status=1 $tgl) AS income_lunas,
                              (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=1 AND status=0 $tgl) AS income_blunas,
                              (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=1 $tgl) AS spending_lunas,
                              (SELECT SUM(total_dibayar) FROM transaksi WHERE tipe=0 AND status=0 $tgl) AS spending_blunas,
                              (SELECT (SUM(total)-SUM(total_dibayar)) FROM transaksi WHERE status=0 $tgl) AS utang,
                              (SELECT (SUM(total)-SUM(total_dibayar)) FROM transaksi WHERE tgl_input BETWEEN '$tgl_1' AND '$tgl_2') AS piutang
                      FROM transaksi";

        $data['kas']    = $this->db->query("$total_p")->result();
        $data['tgl_1']  = $tgl_1;
        $data['tgl_2']  = $tgl_2;
      }
    }
    $this->load->view("admin/cash", $data);
  }


  //PRODUCT
  public function material($x)
  {
    $data['page']       = 'material';
    $data['admin']      = $this->db->query("SELECT * FROM admin")->result();

    if ($x == "all") {
      $data['title']    = 'Bahan Produk';
      $data['material'] = $this->db->query("SELECT * FROM produk WHERE tipe_produk=0")->result();
    } elseif ($x == "ready") { } elseif ($x == "sold") { } elseif ($x == "process") { }

    $this->load->view("admin/product_material", $data);
  }

  public function product($x)
  {
    $data['page']       = 'product';
    $data['admin']      = $this->db->query("SELECT * FROM admin")->result();

    if ($x == "all") {
      $data['title']    = 'Produk Setengah Jadi';
      $data['product']  = $this->db->query("SELECT * FROM produk WHERE tipe_produk=1")->result();
    } elseif ($x == "ready") { } elseif ($x == "sold") { } elseif ($x == "process") { }

    $this->load->view("admin/product", $data);
  }

  public function stock($x)
  {
    $data['page']     = 'stock';
    $data['admin']    = $this->db->query("SELECT * FROM admin")->result();

    if ($x == "all") {
      $data['title']  = 'Stok Produk';
      $data['stock'] = $this->db->query("SELECT * FROM produk")->result();
    } elseif ($x == "ready") { } elseif ($x == "sold") { } elseif ($x == "process") { }

    $this->load->view("admin/product_stock", $data);
  }

  // JSON
  public function get_transaksi($id)
  {
    $data = $this->db->query("SELECT * FROM transaksi WHERE id_transaksi = '$id'")->row();
    echo json_encode($data);
  }


  // REKAP
  public function report()
  {
    $data['page']     = 'report';
    $data['title']    = 'Laporan Transaksi';

    $tgl_1            = $this->input->post('tgl_1');
    $tgl_2            = $this->input->post('tgl_2');
    $data['tgl_1']    = $tgl_1;
    $data['tgl_2']    = $tgl_2;
    $cetak            = $this->input->post('cetak');

    if (empty($cetak)) {
      $this->load->view("admin/report", $data);
    } else {
      if ($cetak == "all") {
        $this->load->view('admin/print/report_all', $data);
      } elseif ($cetak == "sales") {
        $this->load->view('admin/print/report_spending', $data);
      } elseif ($cetak == "spending") {
        if (empty($tgl_1 && $tgl_2)) {

          $data['semua']      = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 ORDER BY status DESC, username ASC")->result();
          $data['t']          = $this->db->query("SELECT  (SELECT SUM(total) FROM transaksi WHERE tipe=0) AS jumlah,
                                                      (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=0) AS blunas
                                              FROM transaksi")->result();
        } else {
          $data['semua']      = $this->db->query("SELECT * FROM transaksi WHERE tipe=0 AND (tgl_input BETWEEN '$tgl_1' AND '$tgl_2') ORDER BY status DESC, username ASC")->result();
          $data['t']          = $this->db->query("SELECT  (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND tgl_input BETWEEN '$tgl_1' AND '$tgl_2') AS jumlah,
                                                      (SELECT SUM(total) FROM transaksi WHERE tipe=0 AND status=0 AND tgl_input BETWEEN '$tgl_1' AND '$tgl_2') AS blunas
                                              FROM transaksi")->result();
        }
        $this->load->view('admin/print/report_spending', $data);
      }
    }
  }


  // ACTION
  function add($x)
  {
    date_default_timezone_set('Asia/Jakarta');
    $now  = date("Y-m-d\TH:i:sP");
    // 2020-07-21 00:00:00
    if ($x == "transaksi") {
      $data = array(
        'id_transaksi'      => NULL,
        'id_produk'         => NULL,
        'username'          => $this->input->post('username'),
        'jumlah'            => NULL,
        'total'             => $this->input->post('total'),
        'tgl_input'         => $now,
        'tgl_pesan'         => NULL,
        'tgl_bayar'         => NULL,
        'keterangan'        => $this->input->post('keterangan'),
        'tipe'              => 0, //Pengeluaran
        'tipe_pengeluaran'  => $this->input->post('tipe_pengeluaran'), //Tipe Pengeluaran
        'status'            => $this->input->post('status')
      );

      $this->db->insert('transaksi', $data);

      $this->session->set_flashdata("report", "<div class='alert alert-success alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Pengeluaran berhasil ditambahkan...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/spending/all'));
    } elseif ($x == "sales") {
      $data = array(
        'id_transaksi'  => NULL,
        'id_produk'     => $this->input->post('id_produk'),
        'username'      => $this->input->post('username'),
        'id_pelanggan'  => $this->input->post('id_pelanggan'),
        'id_komoditas'  => $this->input->post('id_komoditas'),
        'pestisida'     => $this->input->post('pestisida'),
        'jumlah'        => $this->input->post('jumlah'),
        'total'         => $this->input->post('total'),
        'total_dibayar' => $this->input->post('total_dibayar'),
        'tgl_input'     => $now,
        'tgl_pesan'     => $this->input->post('tgl_pesan'),
        'tgl_eksekusi'  => $this->input->post('tgl_eksekusi'),
        'tgl_bayar'     => NULL,
        'keterangan'    => $this->input->post('keterangan'),
        'tipe'          => 2, //penjualan
        'status'        => $this->input->post('status')
      );

      $this->db->insert('transaksi', $data);

      $this->session->set_flashdata("report", "<div class='alert alert-success alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Penjualan berhasil ditambahkan...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/sales/all'));
    } elseif ($x == "bid") {
      $data = array(
        'id_bid'      => NULL,
        'username'          => $this->input->post('username'),
        'id_pelanggan'      => $this->input->post('id_pelanggan'),
        'id_komoditas'      => $this->input->post('id_komoditas'),
        'pestisida'         => $this->input->post('pestisida'),
        'luas'              => $this->input->post('luas'),
        'nilai_penawaran'   => $this->input->post('nilai_penawaran'),
        'tgl_penawaran'     => $this->input->post('tgl_penawaran'),
        'tgl_deal'          => $this->input->post('tgl_deal'),
        'nilai_deal'        => $this->input->post('nilai_deal'),
        'isi_surat'         => $this->input->post('isi_surat'),
        'status'            => $this->input->post('status')
      );

      $this->db->insert('bid', $data);

      $this->session->set_flashdata("report", "<div class='alert alert-success alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Penawaran berhasil ditambahkan...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/bid/all'));
    }
  }

  function update($x)
  {
    date_default_timezone_set('Asia/Jakarta');
    $now  = date("Y-m-d\TH:i:sP");
    // 2020-07-21 00:00:00

    if ($x == "spending") {
      $id   = $this->input->post('id_transaksi');
      $data = array(
        'id_transaksi'      => $id,
        'total'             => $this->input->post('total'),
        'keterangan'        => $this->input->post('keterangan'),
        'tipe_pengeluaran'  => $this->input->post('tipe_pengeluaran'),
        'status'            => $this->input->post('status')
      );

      $this->db->update('transaksi',  $data, array('id_transaksi' => $id));
      // $this->db->insert('transaksi', $data);

      $this->session->set_flashdata("report", "<div class='alert alert-warning alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Pengeluaran berhasil diupdate...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/spending/all'));
    } elseif ($x == "sales") {
      $id   = $this->input->post('id_transaksi');
      $data = array(
        'id_komoditas'  => $this->input->post('id_komoditas'),
        'pestisida'     => $this->input->post('pestisida'),
        'jumlah'        => $this->input->post('jumlah'),
        'total'         => $this->input->post('total'),
        'total_dibayar' => $this->input->post('total_dibayar'),
        'tgl_pesan'     => $this->input->post('tgl_pesan'),
        'tgl_eksekusi'  => $this->input->post('tgl_eksekusi'),
        'keterangan'    => $this->input->post('keterangan'),
        'status'        => $this->input->post('status')
      );

      $this->db->update('transaksi',  $data, array('id_transaksi' => $id));
      // $this->db->insert('transaksi', $data);

      $this->session->set_flashdata("report", "<div class='alert alert-warning alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='ni ni-like-2'></i></span><span class='alert-text'><strong>Pengeluaran berhasil diupdate...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/spending/all'));
    }
  }


  public function get_kota()
  {
    $data = $this->db->query("SELECT kode,nama FROM tbl_master_daerah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama")->result();
    echo json_encode($data);
  }

  public function reset($id)
  {
    $this->db->query("UPDATE santri SET password = '5f4dcc3b5aa765d61d8327deb882cf99' WHERE nis = '$id'");

    $this->session->set_flashdata("sucess_report", "<div class=\"alert alert-block alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\"><i class=\"ace-icon fa fa-times\"></i></button><i class=\"ace-icon fa fa-check green\"></i> Password santri berhasil di reset...</div>");
    $referred_from = $this->session->userdata('ref_santri');
    redirect($referred_from);
  }

  public function del($table, $id, $x)
  {
    $idt = "id_" . $table . "";
    $this->db->delete($table, array($idt => $id));

    if ($x == "spending") {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='fas fa-trash'></i></span><span class='alert-text'><strong>Pengeluaran berhasil dihapus...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/spending/all'));
    } elseif ($x == "sales") {
      $this->session->set_flashdata("report", "<div class='alert alert-danger alert-dismissible fade show' role='alert'><span class='alert-icon'><i class='fas fa-trash'></i></span><span class='alert-text'><strong>Penjualan berhasil dihapus...</strong></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span></button></div>");
      redirect(base_url('admin/sales/all'));
    }
  }
}
