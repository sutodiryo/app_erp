<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->load->view('login');
    }

    function pilot()
    {
        $this->load->view('pilot/login');
    }

    function sales()
    {
        $this->load->view('sales/login');
    }

    public function proses_login($x)
    {
        if ($x == 'admin') {

            $username = $this->security->xss_clean($this->input->post('username'));
            $password = md5($this->security->xss_clean($this->input->post('password')));

            $q1     = $this->db->query("SELECT * FROM admin WHERE username = '" . $username . "' AND password = '" . $password . "'");
            $cek1   = $q1->num_rows();
            $row1   = $q1->row();

            $q2     = $this->db->query("SELECT * FROM user WHERE username = '" . $username . "' AND password = '" . $password . "'");
            $cek2   = $q2->num_rows();
            $row2   = $q2->row();

            if ($cek1 == 1) {
                $data_login = array(
                    'log_id'            => $row1->username,
                    'log_user'          => $row1->username,
                    'log_name'          => $row1->nama_admin,
                    'log_level'         => $row1->level,
                    'log_foto'          => $row1->photo,
                    'log_admin'         => TRUE,
                    'log_valid'         => TRUE
                );
                $this->session->set_userdata($data_login);
                redirect(base_url('admin'));
            } elseif ($cek2 == 1) {
                $data_login = array(
                    'log_id'            => $row2->username,
                    'log_user'          => $row2->username,
                    'log_name'          => $row2->nama_pengguna,
                    'log_level'         => $row2->level,
                    'log_foto'          => $row2->photo,
                    'log_admin'         => FALSE,
                    'log_user'          => TRUE,
                    'log_valid'         => TRUE
                );
                $this->session->set_userdata($data_login);
                redirect(base_url('user'));
            } else {
                $this->session->set_flashdata("report", "<small style=\"color:red;\">Username atau password yang anda masukkan salah!</small>");
                redirect(base_url('auth'));
            }
        } elseif ($x == 'pilot') {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = md5($this->security->xss_clean($this->input->post('password')));

            $q1     = $this->db->query("SELECT * FROM pilot WHERE (username = '" . $username . "' AND password = '" . $password . "') OR (email = '" . $username . "' AND password = '" . $password . "')");
            $cek1   = $q1->num_rows();
            $row1   = $q1->row();

            if ($cek1 == 1) {
                $data_login = array(
                    'log_id'            => $row1->username,
                    'log_user'          => $row1->username,
                    'log_name'          => $row1->nama_pilot,
                    'log_admin'         => FALSE,
                    'log_pilot'         => TRUE,
                    'log_valid'         => TRUE
                );
                $this->session->set_userdata($data_login);
                redirect(base_url('pilot'));
            } else {
                $this->session->set_flashdata("report", "<small style=\"color:red;\">Username atau password yang anda masukkan salah!</small>");
                redirect(base_url('auth/pilot'));
            }
        } elseif ($x == 'sales') {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = md5($this->security->xss_clean($this->input->post('password')));

            $q1     = $this->db->query("SELECT * FROM sales WHERE (username = '" . $username . "' AND password = '" . $password . "') OR (email = '" . $username . "' AND password = '" . $password . "')");
            $cek1   = $q1->num_rows();
            $row1   = $q1->row();

            if ($cek1 == 1) {
                $data_login = array(
                    'log_id'            => $row1->username,
                    'log_user'          => $row1->username,
                    'log_name'          => $row1->nama_sales,
                    'log_admin'         => FALSE,
                    'log_sales'         => TRUE,
                    'log_valid'         => TRUE
                );
                $this->session->set_userdata($data_login);
                redirect(base_url('sales'));
            } else {
                $this->session->set_flashdata("report", "<small style=\"color:red;\">Username atau password yang anda masukkan salah!</small>");
                redirect(base_url('auth/pilot'));
            }
        }
    }

    public function logout($x)
    {
        $this->session->sess_destroy();
        if ($x == 'admin') {
            redirect(base_url('auth'));
        } elseif ($x == 'pilot') {
            redirect(base_url('auth/pilot'));
        } elseif ($x == 'sales') {
            redirect(base_url('auth/sales'));
        } elseif ($x == 'user') {
            redirect(base_url('auth/user'));
        }
    }
}
