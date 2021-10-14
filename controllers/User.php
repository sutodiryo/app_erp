<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      redirect(base_url());
    }
  }

  function index()
  {
    $data['page']   = 'dashboard';
    $data['title']  = 'Admin Dashboard';
    $id             = $this->session->userdata('log_id');

    $data['total_pelanggan']  = $this->db->query('SELECT * FROM pelanggan')->num_rows();
    $data['tgl']              = $this->db->query("SELECT  EXTRACT(MONTH FROM MIN(dibuat)) AS minim,
                                                          EXTRACT(MONTH FROM MAX(dibuat)) AS maks,
                                                          EXTRACT(YEAR FROM MAX(dibuat)) AS maxy
                                                  FROM pelanggan")->result();

    $data['last_pelanggan']   = $this->db->query("SELECT * FROM pelanggan ORDER BY dibuat DESC LIMIT 10")->result();

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

  public function produk()
  {
    $data['page']       = 'produk';
    $data['title']      = 'Daftar Produk';
    $data['produk']     = $this->db->query("SELECT * FROM produk")->result();

    $this->load->view("admin/produk", $data);
  }
}
