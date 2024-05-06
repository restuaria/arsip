<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('user_level') != "admin") {
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        $this->load->model('M_admin', 'm_admin');
    }
    //SURAT  MASUK
    public function masuk()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['masuk'] = $this->m_admin->masuk();
        $this->template->load('template', 'admin/v_surat_masuk', $data);
    }

    public function masuk_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['me'] = $this->m_admin->masuk_edit($arsip_id);
        $this->template->load('template', 'admin/v_surat_masuk_edit', $data);
    }
    public function proses_masuk_edit($arsip_id)
    {
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('surat/masuk/?' . 'alert=berhasil');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
                'arsip_file' => $file,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('surat/masuk/?' . 'alert=berhasil');
        }
    }

    public function masuk_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_surat_masuk_export', $data);
    }

    public function masuk_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_surat_masuk_export_pdf', $data);
    }

    public function hapus_surat_masuk($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip');
        redirect('surat/masuk/?' . 'alert=hapus');
    }




    //SURAT KELUAR
    public function keluar()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));

        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['masuk'] = $this->m_admin->keluar();
        $this->template->load('template', 'admin/v_surat_keluar', $data);
    }
    public function keluar_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['me'] = $this->m_admin->masuk_edit($arsip_id);
        $this->template->load('template', 'admin/v_surat_keluar_edit', $data);
    }
    public function proses_keluar_edit($arsip_id)
    {
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('surat/keluar/?' . 'alert=berhasil');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
                'arsip_file' => $file,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('surat/keluar/?' . 'alert=berhasil');
        }
    }
    public function keluar_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_surat_keluar_export', $data);
    }
    public function keluar_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_surat_keluar_export_pdf', $data);
    }
    public function hapus_surat_keluar($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip');
        redirect('surat/keluar/?' . 'alert=hapus');
    }


    //SURAT DOKUMEN LAIN 
    public function doklain()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['lain'] = $this->m_admin->doklain();
        $this->template->load('template', 'admin/v_doc_lain', $data);
    }
    public function doklain_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $data['lain'] = $this->m_admin->doklain();
        $this->load->view('admin/v_doc_lain_export', $data);
    }

    public function doklain_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['d'] = $this->m_admin->doklain_edit($arsip_id);
        $this->template->load('template', 'admin/v_doc_lain_edit', $data);
    }
    public function proses_doklain_edit($arsip_id)
    {
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);

            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,

            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip2', $dar);
            redirect('surat/doklain/?' . 'alert=berhasil');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $user = $this->input->post('user', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);

            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_file' => $file,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip2', $dar);
            redirect('surat/doklain/?' . 'alert=berhasil');
        }
    }
    public function hapus_doklain($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip2');
        redirect('surat/doklain/?' . 'alert=hapus');
    }
    public function doklain_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_doc_lain_export_pdf', $data);
    }

    public function grafik_surat()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/v_grafik_surat', $data);
    }
    public function grafik_sebaran()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/v_grafik_sebaran', $data);
    }

    public function masuk_sebaran_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_masuk_sebaran_pdf', $data);
    }
    public function keluar_sebaran_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/v_keluar_sebaran_pdf', $data);
    }

    public function laporan()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/laporan', $data);
    }

    public function laporan_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('admin/laporan_pdf', $data);
    }

    public function naskah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['naskah'] = $this->db->query("SELECT * FROM naskah ORDER BY naskah_nama ASC")->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/naskah', $data);
    }

    public function p_tambah_naskah()
    {
        $nama = $this->input->post('nama');
        $sql = $this->db->query("SELECT * FROM naskah WHERE naskah_nama = '" . $nama . "'")->num_rows();
        if ($sql > 0) {
            $msg = 'SILAHKAN INPUT DENGAN NAMA YANG BERBEDA';
            $_SESSION['error'] = $msg;
            redirect("surat/naskah");
        } else {

            $data = array(
                'naskah_nama' => $nama,
            );
            $this->db->insert('naskah', $data);
            redirect('surat/naskah/?' . 'alert=berhasil');
        }
    }

    public function p_edit_naskah($naskah_id)
    {
        $nama = $this->input->post('nama');
        $sql = $this->db->query("SELECT * FROM naskah WHERE naskah_nama = '" . $nama . "'")->num_rows();
        if ($sql > 0) {
            $msg = 'SILAHKAN INPUT DENGAN NAMA YANG BERBEDA';
            $_SESSION['error'] = $msg;
            redirect("surat/naskah");
        } else {
            $data = array(
                'naskah_nama' => $nama,
            );
            $this->db->where('naskah_id', $naskah_id);
            $this->db->update('naskah', $data);
            redirect('surat/naskah/?' . 'alert=berhasil');
        }
    }
    public function hapus_naskah($naskah_id)
    {
        $where = array('naskah_id' => $naskah_id);
        $this->m_admin->hapus($where, 'naskah');
        redirect('surat/naskah/?' . 'alert=hapus');
    }

    public function user()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/user', $data);
    }
    public function usertambah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/user_tambah', $data);
    }
    function p_tambah_user()
    {
        if (isset($_FILES["foto"]["name"])) {
            //konfigurasi 
            $config["upload_path"]      = './file/user/';
            $config["allowed_types"]    = 'jpg|jpeg|png|gif|';
            //load library upload
            $this->load->library("upload", $config);
            // lakukan upload
            if (!$this->upload->do_upload("foto")) {
                $user_nama = $this->input->post('nama', TRUE);
                $username = $this->input->post('username', true);
                $password = $this->input->post('password', true);
                $level = $this->input->post('level', true);
                $data_gambar2 = [
                    'user_nama' => $user_nama,
                    'user_username' => $username,
                    'user_password' => $password,
                    'user_level' => $level,
                    'user_foto' => 'user.png',
                ];

                // call method simpan gambar
                $this->db->insert('user', $data_gambar2);
                //response ke ajax
                redirect('surat/user/?' . 'alert=berhasil');
            } else {
                $data_gambar = $this->upload->data(); // simpan gambar
                $user_nama = $this->input->post('nama', TRUE);
                $username = $this->input->post('username', true);
                $password = $this->input->post('password', true);
                $level = $this->input->post('level', true);

                // compress image start
                $config['image_library'] = 'gd2';
                $config['source_image']  = './file/user/' . $data_gambar["file_name"];
                $config['create_thumb']  = false;
                $config['maintain_ratio'] = false;
                $config['width']         = 100;
                $config['height']        = 150;
                // $config['new_image']     = './file/user/' . $data_gambar["file_name"];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();
                // end compress setup

                // data yg akan dusernamempan
                $data_gambar2 = [
                    'user_nama' => $user_nama,
                    'user_username' => $username,
                    'user_password' => $password,
                    'user_level' => $level,
                    'user_foto' => $data_gambar["file_name"],
                ];

                // call method simpan gambar
                $this->db->insert('user', $data_gambar2);
                //response ke ajax
                redirect('surat/user/?' . 'alert=berhasil');
            }
        }
    }
    public function hapus_user($user_id)
    {
        $where = array('user_id' => $user_id);
        $this->m_admin->hapus($where, 'user');
        redirect('surat/user/?' . 'alert=hapus');
    }
    public function user_edit($user_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['us'] = $this->m_admin->ambiliduser($user_id);
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template->load('template', 'admin/user_edit', $data);
    }

    function p_edit_user($user_id)
    {
        if (isset($_FILES["foto"]["name"])) {
            $user_nama = $this->input->post('nama', TRUE);
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);
            $level = $this->input->post('level', true);
            if (empty($password)) {
                //konfigurasi 
                $config["upload_path"]      = './file/user/';
                $config["allowed_types"]    = 'jpg|jpeg|png|gif|';
                //load library upload
                $this->load->library("upload", $config);
                // lakukan upload
                if (!$this->upload->do_upload("foto")) {

                    $data_gambar2 = [
                        'user_nama' => $user_nama,
                        'user_username' => $username,
                        'user_level' => $level,
                    ];

                    // call method simpan gambar
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data_gambar2);
                    //response ke ajax
                    redirect('surat/user/?' . 'alert=berhasil');
                } else {
                    $data_gambar = $this->upload->data(); // simpan gambar
                    // compress image start
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = './file/user/' . $data_gambar["file_name"];
                    $config['create_thumb']  = false;
                    $config['maintain_ratio'] = false;
                    $config['width']         = 100;
                    $config['height']        = 150;
                    // $config['new_image']     = './file/user/' . $data_gambar["file_name"];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // end compress setup

                    // data yg akan dusernamempan
                    $data_gambar2 = [
                        'user_nama' => $user_nama,
                        'user_username' => $username,
                        'user_level' => $level,
                        'user_foto' => $data_gambar["file_name"],
                    ];

                    // call method simpan gambar
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data_gambar2);
                    //response ke ajax
                    redirect('surat/user/?' . 'alert=berhasil');
                }
            } else {
                //konfigurasi 
                $config["upload_path"]      = './file/user/';
                $config["allowed_types"]    = 'jpg|jpeg|png|gif|';
                //load library upload
                $this->load->library("upload", $config);
                // lakukan upload
                if (!$this->upload->do_upload("foto")) {

                    $data_gambar2 = [
                        'user_nama' => $user_nama,
                        'user_username' => $username,
                        'user_password' => md5($password),
                        'user_level' => $level,
                    ];

                    // call method simpan gambar
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data_gambar2);
                    //response ke ajax
                    redirect('surat/user/?' . 'alert=berhasil');
                } else {
                    $data_gambar = $this->upload->data(); // simpan gambar
                    // compress image start
                    $config['image_library'] = 'gd2';
                    $config['source_image']  = './file/user/' . $data_gambar["file_name"];
                    $config['create_thumb']  = false;
                    $config['maintain_ratio'] = false;
                    $config['width']         = 100;
                    $config['height']        = 150;
                    // $config['new_image']     = './file/user/' . $data_gambar["file_name"];
                    $this->load->library('image_lib', $config);
                    $this->image_lib->resize();
                    // end compress setup

                    // data yg akan dusernamempan
                    $data_gambar2 = [
                        'user_nama' => $user_nama,
                        'user_username' => $username,
                        'user_password' => md5($password),
                        'user_level' => $level,
                        'user_foto' => $data_gambar["file_name"],
                    ];

                    // call method simpan gambar
                    $this->db->where('user_id', $user_id);
                    $this->db->update('user', $data_gambar2);
                    //response ke ajax
                    redirect('surat/user/?' . 'alert=berhasil');
                }
            }
        }
    }
    function pass()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $this->template->load('template', 'admin/ganti_password', $data);
    }

    function update()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1);
        $id_user = $this->session->userdata("user_id");

        $user_password = $this->input->post('password');

        $data1 = array(
            'user_password' => md5($user_password)
        );

        $user_id = array(
            'user_id' => $id_user
        );

        $this->m_admin->update_data($user_id, $data1, 'user');
        redirect('surat/pass/?' . 'alert=sukses');
    }
}
