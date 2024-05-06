<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('user_level') != "operator") {
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
        $this->load->model('M_admin', 'm_admin');
    }

    public function index()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $id_user =  $this->session->userdata("user_id");
        // $data['masuk'] = $this->m_admin->op_suma($id_user);
        $data['masuk'] = $this->db->query("SELECT * FROM arsip where arsip_user = $id_user AND arsip_kategori='2' ")->num_rows();
        $data['keluar'] = $this->db->query("SELECT * FROM arsip where arsip_user = $id_user AND arsip_kategori='3' ")->num_rows();
        $data['arsip'] = $this->db->query("SELECT * FROM arsip where arsip_user = $id_user ")->num_rows();
        $data['dl'] = $this->db->query("SELECT * FROM arsip2 where arsip_user = $id_user AND arsip_kategori='4' ")->num_rows();

        $this->template_op->load('template_op', 'operator/v_operator', $data);
    }
    public function masuk()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $id_user = $this->session->userdata("user_id");
        $data['masuk'] = $this->m_admin->masuk_op($id_user);
        $this->template_op->load('template_op', 'operator/v_surat_masuk', $data);
    }
    public function arsip_masuk_tambah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $this->template_op->load('template_op', 'operator/v_surat_masuk_tambah', $data);
    }
    public function proses_tambah()
    {
        $id_user = $this->session->userdata("user_id");
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            redirect('operator/masuk/?' . 'alert=gagal');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
                'arsip_file' => $file,
            );
            $this->db->insert('arsip', $dar);
            redirect('operator/masuk/?' . 'alert=berhasil');
        }
    }
    public function masuk_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['me'] = $this->m_admin->masuk_edit($arsip_id);
        $this->template_op->load('template_op', 'operator/v_surat_masuk_edit', $data);
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
            redirect('operator/masuk/?' . 'alert=berhasil');
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
            redirect('operator/masuk/?' . 'alert=berhasil');
        }
    }

    public function masuk_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();

        $this->load->view('operator/v_surat_masuk_export', $data);
    }
    public function masuk_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('operator/v_surat_masuk_export_pdf', $data);
    }
    public function hapus_surat_masuk($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip');
        redirect('operator/masuk/?' . 'alert=hapus');
    }

    public function keluar()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $id_user = $this->session->userdata("user_id");
        $data['masuk'] = $this->m_admin->keluar_op($id_user);
        $this->template_op->load('template_op', 'operator/v_surat_keluar', $data);
    }
    public function keluar_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['me'] = $this->m_admin->masuk_edit($arsip_id);
        $this->template_op->load('template_op', 'operator/v_surat_keluar_edit', $data);
    }
    public function arsip_keluar_tambah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $this->template_op->load('template_op', 'operator/v_surat_keluar_tambah', $data);
    }
    public function proses_tambah_keluar()
    {
        $id_user = $this->session->userdata("user_id");
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            redirect('operator/keluar/?' . 'alert=gagal');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
                'arsip_file' => $file,
            );
            $this->db->insert('arsip', $dar);
            redirect('operator/keluar/?' . 'alert=berhasil');
        }
    }
    public function proses_keluar_edit($arsip_id)
    {
        $id_user = $this->session->userdata("user_id");
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('operator/keluar/?' . 'alert=berhasil');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);
            $keterangan = $this->input->post('keterangan', true);
            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_keterangan' => $keterangan,
                'arsip_file' => $file,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip', $dar);
            redirect('operator/keluar/?' . 'alert=berhasil');
        }
    }
    public function keluar_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('operator/v_surat_keluar_export', $data);
    }
    public function keluar_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('operator/v_surat_keluar_export_pdf', $data);
    }
    public function hapus_surat_keluar($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip');
        redirect('operator/keluar/?' . 'alert=hapus');
    }

    //DOKLAIN
    public function doklain()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $id_user = $this->session->userdata("user_id");
        $data['lain'] = $this->m_admin->doklain_op($id_user);
        $this->template_op->load('template_op', 'operator/doklain', $data);
    }

    public function doklain_edit($arsip_id)
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['d'] = $this->m_admin->doklain_edit($arsip_id);
        $this->template_op->load('template_op', 'operator/v_doc_lain_edit', $data);
    }

    public function doklain_tambah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $this->template_op->load('template_op', 'operator/v_doc_lain_tambah', $data);
    }
    public function proses_doklain_tambah()
    {
        $id_user = $this->session->userdata("user_id");
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            redirect('operator/doklain/?' . 'alert=gagal');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);

            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_file' => $file,
            );

            $this->db->insert('arsip2', $dar);
            redirect('operator/doklain/?' . 'alert=berhasil');
        }
    }

    public function proses_doklain_edit($arsip_id)
    {
        $id_user = $this->session->userdata("user_id");
        $config['upload_path']          = './file/arsip/';
        $config['allowed_types']        = 'PDF|pdf';
        $config['max_size']             = 10000;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);

            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,

            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip2', $dar);
            redirect('operator/doklain/?' . 'alert=berhasil');
        } else {
            $file = $this->upload->data();
            $file = $file['file_name'];
            $nama = $this->input->post('nama', TRUE);
            $kode = $this->input->post('kode', TRUE);
            $tanggal = $this->input->post('tanggal', TRUE);
            $naskah = $this->input->post('naskah', TRUE);
            $kategori = $this->input->post('kategori', TRUE);

            $dar = array(
                'arsip_nama' => $nama,
                'arsip_kode' => $kode,
                'arsip_tanggal' => $tanggal,
                'arsip_user' => $id_user,
                'arsip_naskah' => $naskah,
                'arsip_kategori' => $kategori,
                'arsip_file' => $file,
            );
            $this->db->where('arsip_id', $arsip_id);
            $this->db->update('arsip2', $dar);
            redirect('operator/doklain/?' . 'alert=berhasil');
        }
    }

    public function doklain_export()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $user_id = $this->session->userdata("user_id");
        $data['lain'] = $this->m_admin->doklain_op($user_id);
        $this->load->view('admin/v_doc_lain_export', $data);
    }

    public function hapus_doklain($arsip_id)
    {
        $where = array('arsip_id' => $arsip_id);
        $this->m_admin->hapus($where, 'arsip2');
        redirect('operator/doklain/?' . 'alert=hapus');
    }
    public function doklain_export_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $user_id = $this->session->userdata("user_id");
        $data['lain'] = $this->m_admin->doklain_op($user_id);
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('operator/v_doc_lain_export_pdf', $data);
    }

    //GRAFIK 
    public function grafik_surat()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $this->template_op->load('template_op', 'operator/v_grafik_surat', $data);
    }
    public function laporan()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template_op->load('template_op', 'operator/laporan', $data);
    }

    public function laporan_pdf()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->load->view('operator/laporan_pdf', $data);
    }
    public function naskah()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $data['naskah'] = $this->db->query("SELECT * FROM naskah ORDER BY naskah_nama ASC")->result();
        $data['pts'] = $this->db->query("SELECT * FROM pts WHERE pts_id = 1 ")->row();
        $this->template_op->load('template_op', 'operator/naskah', $data);
    }
    function pass()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();
        $this->template_op->load('template_op', 'operator/ganti_password', $data);
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
        redirect('operator/pass/?' . 'alert=sukses');
    }
}
