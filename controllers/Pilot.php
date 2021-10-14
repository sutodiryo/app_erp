<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pilot extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('log_valid') == TRUE) {
            if ($this->session->userdata('log_pilot') == FALSE) {
                redirect(base_url());
            }
        } else {
            redirect(base_url('auth/pilot'));
        }
    }



    function index()
    {
        $data['page']   = 'dashboard';
        $data['title']  = 'Selamat datang di AgroPilot';
        $id             = $this->session->userdata('log_id');

        $data['total_pelanggan']  = $this->db->query('SELECT * FROM pelanggan')->num_rows();
        $data['tgl']              = $this->db->query("SELECT  EXTRACT(MONTH FROM MIN(dibuat)) AS minim,
                                                              EXTRACT(MONTH FROM MAX(dibuat)) AS maks,
                                                              EXTRACT(YEAR FROM MAX(dibuat)) AS maxy
                                                      FROM pelanggan")->result();

        $data['last_pelanggan']   = $this->db->query("SELECT * FROM pelanggan ORDER BY dibuat DESC LIMIT 10")->result();

        $this->load->view("pilot/dashboard", $data);
    }
}
