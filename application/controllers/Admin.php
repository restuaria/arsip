<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('M_admin', 'm_admin');
        if ($this->session->userdata('user_level') != "admin") {
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $where1 = array('user_id' => $this->session->userdata("user_id"));
        $data['user'] = $this->m_admin->cek_login('user', $where1)->result();

        $data['masuk'] = $this->db->query("SELECT * FROM arsip where arsip_kategori='2'")->num_rows();
        $data['keluar'] = $this->db->query("SELECT * FROM arsip where arsip_kategori='3' ")->num_rows();
        $data['arsip'] = $this->db->query("SELECT * FROM arsip")->num_rows();
        $data['dl'] = $this->db->query("SELECT * FROM arsip2 where arsip_kategori='4' ")->num_rows();
        $data['user'] = $this->db->query("SELECT * FROM user")->num_rows();

        $this->template->load('template', 'admin/v_admin', $data);
    }
}
