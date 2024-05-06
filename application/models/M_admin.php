<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_admin extends CI_Model
{
    //Login
    public function __construct()
    {
        parent::__construct();
    }

    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function update_data($where, $dataaa, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $dataaa);
    }
    function masuk()
    {
        $this->db->select('*');
        $this->db->from('arsip');
        $this->db->join('user', 'user.user_id = arsip.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip.arsip_kategori  ', 'left');
        $this->db->where('arsip_kategori', 2);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    // function export()
    // {

    //     $this->db->select('*');
    //     $this->db->from('arsip');
    //     $this->db->join('user', 'user.user_id = arsip.arsip_user  ');
    //     $this->db->join('kategori', 'kategori.kategori_id = arsip.arsip_kategori  ');
    //     $this->db->where('arsip_kategori', 2);
    //     $this->db->order_by('arsip_tanggal', 'DESC');
    //     $query = $this->db->get();
    //     return $query->result();
    // }
    public function masuk_edit($arsip_id)
    {
        return $this->db->get_where('arsip', ['arsip_id' => $arsip_id])->row();
    }


    function keluar()
    {
        $this->db->select('*');
        $this->db->from('arsip');
        $this->db->join('user', 'user.user_id = arsip.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip.arsip_kategori  ', 'left');
        $this->db->where('arsip_kategori', 3);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function doklain()
    {
        $this->db->select('*');
        $this->db->from('arsip2');
        $this->db->join('user', 'user.user_id = arsip2.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip2.arsip_kategori  ', 'left');
        $this->db->join('naskah', 'naskah.naskah_id = arsip2.arsip_naskah', 'left');
        $this->db->where('arsip_kategori', 4);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function doklain_edit($arsip_id)
    {
        return $this->db->get_where('arsip2', ['arsip_id' => $arsip_id])->row();
    }

    function hapus($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    public function ambiliduser($user_id)
    {
        return $this->db->get_where('user', ['user_id' => $user_id])->row();
    }


    // MODEL OPERATOR
    function masuk_op($id_user)
    {
        $this->db->select('*');
        $this->db->from('arsip');
        $this->db->join('user', 'user.user_id = arsip.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip.arsip_kategori  ', 'left');
        $this->db->where('arsip_user', $id_user);
        $this->db->where('arsip_kategori', 2);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function keluar_op($id_user)
    {
        $this->db->select('*');
        $this->db->from('arsip');
        $this->db->join('user', 'user.user_id = arsip.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip.arsip_kategori  ', 'left');
        $this->db->where('arsip_user', $id_user);
        $this->db->where('arsip_kategori', 3);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    function doklain_op($id_user)
    {
        $this->db->select('*');
        $this->db->from('arsip2');
        $this->db->join('user', 'user.user_id = arsip2.arsip_user  ', 'left');
        $this->db->join('kategori', 'kategori.kategori_id = arsip2.arsip_kategori  ', 'left');
        $this->db->join('naskah', 'naskah.naskah_id = arsip2.arsip_naskah', 'left');
        $this->db->where('arsip_user', $id_user);
        $this->db->where('arsip_kategori', 4);
        $this->db->order_by('arsip_tanggal', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
