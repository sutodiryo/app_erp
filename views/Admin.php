<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('log_valid') == FALSE || $this->session->userdata('log_admin') == FALSE) {
            redirect(base_url());
        }
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['page']   = "dashboard";
        $data['title']  = "Dashboard";

        $data['transaksi']  = $this->db->query("SELECT * FROM transaksi")->num_rows();
        $data['produk']     = $this->db->query("SELECT * FROM produk")->num_rows();
        $data['user']       = $this->db->query("SELECT * FROM user")->num_rows();

        $this->load->view('admin/dashboard', $data);
    }


    public function kategori()
    {
        $data['page']   = "kategori";
        $data['title']  = "Kategori";

        $data['kategori']   = $this->db->query("SELECT DISTINCT id_produk_kategori, nama_kategori, kategori_slug FROM produk_kategori")->result_array();

        $this->load->view('admin/_/header', $data);
        $this->load->view('admin/kategori/list', $data);
        $this->load->view('admin/_/footer');
    }

    public function add_kategori()
    {
        if (isset($_POST['submit'])) {
            $dataKategori = array(
                'nama_kategori' => $this->input->post('kategori'),
                'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE)
            );

            $query = $this->Admin_model->tambahKategori($dataKategori);
            if ($query) {
                redirect('admin/kategori');
            }
        }
    }

    public function hapus_kategori($id)
    {
        $this->Admin_model->hapusKategori($id);

        redirect('admin/kategori');
    }

    public function edit_kategori($id)
    {
        $data['kategori'] = $this->Admin_model->getKategoriById($id);
        $data['title'] = "Edit Kategori";

        $this->load->view('admin/_/header', $data);
        $this->load->view('admin/dashboard');
        $this->load->view('admin/kategori/e_kategori', $data);
        $this->load->view('admin/_/footer');

        if (isset($_POST['edit'])) {
            $idt = $this->input->post('id_kategori');
            $dataEditKategori = array(
                'nama_kategori' => $this->input->post('kategori'),
                'kategori_slug' => url_title($this->input->post('kategori'), 'dash', TRUE)
            );

            $query = $this->Admin_model->editKategori($idt, $dataEditKategori);
            if ($query) {
                redirect('admin/kategori');
            }
        }
    }

    public function satuan($x)
    {
        $data['page'] = "satuan";

        if ($x == "list") {
            $data['title']    = "Daftar Satuan Produk";
            $data['satuan']   = $this->db->query("SELECT * FROM produk_satuan")->result();

            $this->load->view('admin/_/header', $data);
            $this->load->view('admin/satuan/list', $data);
            $this->load->view('admin/_/footer');
        } elseif ($x == "edit") {
            # code...
        }
    }

    public function produk($x)
    {
        $data['page']  = "produk";

        if ($x == "list") {
            $data['title']  = "Produk";
            // $sess = $this->session->userdata('username');
            $data['produk'] = $this->db->query("SELECT  id_produk,nama_produk,produk_slug,stok,harga_modal,harga_reseller,harga_konsumen,berat,diskon,gambar,gambar_1,gambar_2,keterangan,username,waktu_input,varian,nama_varian,status,
                                                        (SELECT nama_satuan FROM produk_satuan WHERE id_satuan=produk.id_satuan) AS satuan,
                                                        (SELECT nama_kategori FROM produk_kategori WHERE id_produk_kategori=produk.id_produk_kategori) AS kategori
                                                        -- (SELECT CASE WHEN varian > 0 THEN (SELECT )
                                                        -- WHEN Quantity = 30 THEN 'The quantity is 30'
                                                        -- ELSE 'The quantity is under 30'
                                                        -- END)
                                                        FROM produk")->result();

            $this->load->view('admin/_/header', $data);
            $this->load->view('admin/produk/list', $data);
            $this->load->view('admin/_/footer');
        } elseif ($x == "add") {
            $data['page']       = "produk";
            $data['title']      = "Tambah Produk";
            $data['kategori']   = $this->db->query("SELECT DISTINCT id_produk_kategori, nama_kategori, kategori_slug FROM produk_kategori")->result_array();
            $data['satuan']     = $this->db->query("SELECT * FROM produk_satuan")->result();

            $this->load->view('admin/_/header', $data);
            // $this->load->view('admin/dashboard');
            $this->load->view('admin/produk/add', $data);
            $this->load->view('admin/_/footer');
        } elseif ($x == "") { }
    }

    //CONFIG UPLOAD
    private function set_upload_options()
    {
        $config = array();

        $config['upload_path']      = './assets/img/';
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['max_size']         = 0;
        $config['encrypt_name']     = TRUE;
        $config['overwrite']        = FALSE;

        return $config;
    }
    //END of CONFIG UPLOAD


    public function act($x)
    {
        if ($x == "add_produk") {
            $this->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;
            $cpt = count($_FILES['userfile']['name']);

            for ($i = 0; $i < $cpt; $i++) {
                $_FILES['userfile']['name']     = $files['userfile']['name'][$i];
                $_FILES['userfile']['type']     = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error']    = $files['userfile']['error'][$i];
                $_FILES['userfile']['size']     = $files['userfile']['size'][$i];

                $this->upload->initialize($this->set_upload_options());
                $this->upload->do_upload();
                $dataInfo[] = $this->upload->data();
            }

            if ($cpt >= 3) {
                $g1 = $dataInfo[0]['file_name'];
                $g2 = $dataInfo[1]['file_name'];
                $g3 = $dataInfo[2]['file_name'];
            } elseif ($cpt = 2) {
                $g1 = $dataInfo[0]['file_name'];
                $g2 = $dataInfo[1]['file_name'];
                $g3 = NULL;
            } elseif ($cpt = 1) {
                $g1 = $dataInfo[0]['file_name'];
                $g2 = NULL;
                $g3 = NULL;
            }

            $data = array(
                'id_produk_kategori'    => $this->input->post('kategori'),
                'nama_produk'           => $this->input->post('nama_produk'),
                'produk_slug'           => url_title($this->input->post('nama_produk'), 'dash', TRUE),
                'stok'                  => $this->input->post('stok'),
                'id_satuan'             => $this->input->post('satuan'),
                'harga_modal'           => $this->input->post('harga_modal'),
                'harga_reseller'        => $this->input->post('harga_reseller'),
                'harga_konsumen'        => $this->input->post('harga_konsumen'),
                'berat'                 => $this->input->post('berat'),
                'diskon'                => $this->input->post('diskon'),
                'varian'                => $this->input->post('varian'),
                'nama_varian'           => $this->input->post('nama_varian'),
                'keterangan'            => $this->input->post('keterangan'),
                'username'              => $this->session->userdata('log_name'),
                'waktu_input'           => date('Y-m-d H:i:s'),
                'gambar'                => $g1,
                'gambar_1'              => $g2,
                'gambar_2'              => $g3
            );
            $this->upload->display_errors();
            $this->Admin_model->tambahProduk($data);

            $this->session->set_flashdata("report", "<div class='alert alert-primary alert-dismissable fade show has-icon'><i class='la la-check alert-icon'></i><button class='close' data-dismiss='alert' aria-label='Close'></button>Produk berhasil ditambahkan....</div>");
            redirect('admin/produk/list');
        } elseif ($x == "add_varian") {
            $data = array(
                'id_produk'      => $this->input->post('id_produk'),
                'nama_varian'    => $this->input->post('nama_varian'),
                'stok'           => $this->input->post('stok')
            );
            $this->db->insert('produk_varian', $data);
            redirect('admin/produk/list');
        } elseif ($x == "add_member") {
            $data = array(
                'nama'      => $this->input->post('nama'),
                'no_hp'     => $this->input->post('no_hp'),
                'kota'      => $this->input->post('kota'),
                'email'     => $this->input->post('email'),
                'level'     => $this->input->post('level')
            );

            $this->db->insert('member', $data);

            $this->session->set_flashdata("report", "<div class='alert alert-primary alert-dismissable fade show has-icon'><i class='la la-check alert-icon'></i><button class='close' data-dismiss='alert' aria-label='Close'></button>Produk berhasil ditambahkan....</div>");
            redirect('admin/member/all');
        }
    }

    public function hapus_produk($id_produk)
    {
        $data = $this->Admin_model->getIdGambar($id_produk);
        $path = 'assets/upload/gambar_produk/';
        @unlink($path . $data->gambar);
        if ($this->Admin_model->hapus_produk($id_produk) == TRUE) {
            redirect('admin/produk');
        }
    }

    public function edit_produk($id_produk)
    { }

    public function edit($x, $y)
    {
        if ($x == "produk") {
            $data['page']       = "produk";
            $data['title']      = "Edit Produk";
            // $data['produk']     = $this->Admin_model->getProdukId($id_produk);
            $data['produk']     = $this->db->query("SELECT * FROM produk WHERE id_produk='$y'")->result();
            $data['kategori']   = $this->db->query("SELECT * FROM produk_kategori")->result();
            $data['satuan']     = $this->db->query("SELECT * FROM produk_satuan")->result();

            $this->load->view('admin/_/header', $data);
            $this->load->view('admin/produk/edit');
            $this->load->view('admin/_/footer');

            if (isset($_POST['edit_produk'])) {

                $data = array(
                    'id_produk_kategori'    => $this->input->post('kategori'),
                    'nama_produk'           => $this->input->post('nama_produk'),
                    'produk_slug'           => url_title($this->input->post('nama_produk'), 'dash', TRUE),
                    'stok'                  => $this->input->post('stok'),
                    'id_satuan'             => $this->input->post('satuan'),
                    'harga_modal'           => $this->input->post('harga_modal'),
                    'harga_reseller'        => $this->input->post('harga_reseller'),
                    'harga_konsumen'        => $this->input->post('harga_konsumen'),
                    'berat'                 => $this->input->post('berat'),
                    'diskon'                => $this->input->post('diskon'),
                    'varian'                => $this->input->post('varian'),
                    'nama_varian'           => $this->input->post('nama_varian'),
                    'keterangan'            => $this->input->post('keterangan'),
                    'username'              => $this->session->userdata('log_name'),
                    'waktu_input'           => date('Y-m-d H:i:s')
                    
                );
                // $this->upload->display_errors();
                // } else { 
                // die("tidak");
                // $data = array(
                //     'id_produk_kategori'    => $this->input->post('kategori'),
                //     'nama_produk'           => $this->input->post('nama_produk'),
                //     'produk_slug'           => url_title($this->input->post('nama_produk'), 'dash', TRUE),
                //     'stok'                  => $this->input->post('stok'),
                //     'id_satuan'             => $this->input->post('satuan'),
                //     'harga_modal'           => $this->input->post('harga_modal'),
                //     'harga_reseller'        => $this->input->post('harga_reseller'),
                //     'harga_konsumen'        => $this->input->post('harga_konsumen'),
                //     'berat'                 => $this->input->post('berat'),
                //     'diskon'                => $this->input->post('diskon'),
                //     'keterangan'            => $this->input->post('keterangan'),
                //     'username'              => $this->session->userdata('log_name'),
                //     'waktu_input'           => date('Y-m-d H:i:s')
                // );
                // }
                $this->Admin_model->edit_produk($y, $data);
                redirect('admin/produk/list');
            }
        } elseif ($x == "member") {
            # code...
        }
    }

    function member($x)
    {
        $data['page'] = 'member';
        $q = "	SELECT *
                        -- m1.id_member,m1.nama,m1.no_hp,m1.level,m1.status,
						-- 	(SELECT nama FROM member m2 WHERE m2.id_member=m1.id_upline) AS member,
						-- 	(SELECT id_member FROM member m2 WHERE m2.id_member=m1.id_upline) AS id_member_up,
						-- 	(SELECT COUNT(*) FROM member m2 WHERE m2.id_upline=m1.id_member AND level=2) AS dst
					FROM member
                    -- m1
                    ";

        $data['sel_member']  = $this->db->query("SELECT id_member,nama,no_hp FROM member ORDER BY nama ASC")->result();

        if ($x == "all") {
            $data['title']      = 'Daftar Semua Member';
            $data['member']  = $this->db->query("$q ORDER BY level DESC")->result();
        } elseif ($x == "pelanggan") {
            $data['title']      = 'Daftar Member Pelanggan';
            $data['member']  = $this->db->query("$q WHERE level=0")->result();
        } elseif ($x == "reseller") {
            $data['title']      = 'Daftar Member Reseller';
            $data['member']  = $this->db->query("$q WHERE level=1")->result();
        }

        $this->load->view('admin/_/header', $data);
        $this->load->view('admin/member/list', $data);
        $this->load->view('admin/_/footer');
    }

    public function transaksi($x)
    {
        $data['page']  = "transaksi";

        if ($x == "all") {
            $data['title']      = "Transaksi";
            $data['transaksi']  = $this->db->query("SELECT  *
                                                            -- ,(SELECT sum(total+ongkir) as total FROM transaksi_detail WHERE kode_transaksi=transaksi.kode_transaksi) as total,
                                                            -- (SELECT deadline_pengiriman FROM transaksi_detail WHERE kode_transaksi=transaksi.kode_transaksi) as deadline
                                                            FROM transaksi ORDER BY id_transaksi DESC")->result();

            $this->load->view('admin/_/header', $data);
            $this->load->view('admin/transaksi/list', $data);
            $this->load->view('admin/_/footer');
        } elseif ($x == "edit") {
            # code...
        }
    }

    public function orders_status($kode, $id, $st)
    {
        $this->Admin_model->update_orders_status($id, $st);
        redirect("admin/tracking/" . $kode);
    }

    public function rekening()
    {
        $data['page']       = "rekening";
        $data['title']      = "Daftar Rekening";
        $data['rekening']   = $this->db->query("SELECT * FROM rekening")->result();

        $this->load->view('admin/_/header', $data);
        // $this->load->view('admin/dashboard');
        $this->load->view('admin/rekening/list', $data);
        $this->load->view('admin/_/footer');
    }

    public function hapus_seller($id)
    {
        $this->Admin_model->hapusSeller($id);

        redirect('admin/seller');
    }

    public function pengembalian()
    {
        $data['page']   = "retur";
        $data['title']  = "Transaksi Retur";

        $data['retur']  = $this->db->query("SELECT * FROM pengembalian ORDER BY id_pengembalian")->result();

        $this->load->view('admin/_/header', $data);
        $this->load->view('admin/retur/list', $data);
        $this->load->view('admin/_/footer');
    }

    public function pembukuan()
    {
        $data['page']   = "pembukuan";
        $data['title']  = "Pembukuan";

        $data['retur']  = $this->db->query("SELECT * FROM transaksi")->result();

        $this->load->view('admin/pembukuan/cetak', $data);
    }

    public function profile()
    {
        $data['page']       = "profile";
        $data['title']      = "Profil Toko";

        $data['profile']    = $this->db->query("SELECT * FROM profile")->result();

        $this->load->view('admin/_/header', $data);
        $this->load->view('admin/profile/edit', $data);
        $this->load->view('admin/_/footer', $data);
    }

    function del($x, $id)
    {
        if ($x == "area") {
            $data = array(
                'status' => 3
            );
            $this->db->update("area", array('id_area'  => $id), $data);

            $this->session->set_flashdata("report", "<div class='panel panel-danger'><div class='panel-heading'><div class='panel-title'>Data area berhasil dihapus...</div><div class='panel-options'><a href='#' data-rel='close'><i class='entypo-cancel'></i></a></div></div></div>");
            redirect(base_url('admin/area'));
        } elseif ($x == "produk_link") {
            $data = array(
                'status' => 3
            );
            $this->db->delete($x, array('id_produk_link'  => $id));

            $this->session->set_flashdata("report", "<div class='panel panel-danger'><div class='panel-heading'><div class='panel-title'>Video berhasil dihapus...</div><div class='panel-options'><a href='#' data-rel='close'><i class='entypo-cancel'></i></a></div></div></div>");
            $referred_from = $this->session->userdata('referred_edit_video');
            redirect($referred_from);
        } elseif ($x == "produk") {
            $this->db->query("DELETE FROM produk WHERE produk.id_produk = '$id'");
            $this->session->set_flashdata("report", "<div class='alert alert-pink alert-dismissable fade show has-icon'><i class='la la-info-circle alert-icon'></i><button class='close' data-dismiss='alert' aria-label='Close'></button><strong>Produk berhasil dihapus....</strong></div>");
            redirect(base_url('admin/produk/list'));
        } elseif ($x == "member") {
            $this->db->delete($x, array('id_member'  => $id));
            $this->session->set_flashdata("report", "<div class='panel panel-danger'><div class='panel-heading'><div class='panel-title'>Member berhasil dihapus...</div><div class='panel-options'><a href='#' data-rel='close'><i class='entypo-cancel'></i></a></div></div></div>");
            redirect(base_url('admin/member/list'));
        }
    }
}
