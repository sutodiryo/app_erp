<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('log_valid') == FALSE) {
      redirect(base_url('auth'));
    }
  }

  function index()
  {
    if ($this->session->userdata('log_admin') == TRUE) {
      redirect(base_url('admin'));
    } elseif ($this->session->userdata('log_pilot') == TRUE) {
      // $this->session->flashdata();
      redirect(base_url('pilot'));
    } elseif ($this->session->userdata('log_sales') == TRUE) {
      redirect(base_url('sales'));
    } elseif ($this->session->userdata('log_user') == TRUE) {
      redirect(base_url('user'));
    }
  }

  // if ($this->session->userdata('log_pilot') == TRUE) {
  //   redirect(base_url('pilot'));
  // } else {
  //   redirect(base_url('pilot/auth'));
  // }

}
