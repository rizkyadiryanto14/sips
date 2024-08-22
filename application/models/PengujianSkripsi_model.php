<?php


class PengujianSkripsi_model extends CI_Model
{
    protected string $table = 'pengujian_skripsi';

    /**
     * @return array
     */
    public function get():array
    {
        $this->db->select("*");
        $pengujian_skripsi = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($pengujian_skripsi) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $pengujian_skripsi;

        return $hasil;
    }
}