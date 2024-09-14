<?php

class KuotaBimbingan_model extends CI_Model
{
    protected $table = 'kuota_bimbingan';

    public function get()
    {
        $this->db->select("*");
        $kuotabimbingan = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($kuotabimbingan) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $kuotabimbingan;

        return $hasil;
    }

    /**
     * @return array
     */
    public function getById():array
    {
        $kuotabimbingan = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($kuotabimbingan) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $kuotabimbingan;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'nilai' => $input['nilai'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $this->db->insert($this->table, $data);
            $hasil = [
                'error' => false,
                'message' => "data berhasil ditambah",
                'data_id' => $this->db->insert_id()
            ];
        } else {
            $hasil = $validate;
        }

        return $hasil;
    }

    public function update($input, $id)
    {
        $data = [
            'nilai' => $input['nilai'],
        ];

        $kondisi = ['kuota_bimbingan.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $this->db->update($this->table, $data, $kondisi);
                $hasil = [
                    'error' => false,
                    'message' => "data berhasil diedit"
                ];
            } else {
                $hasil = $validate;
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "data tidak ditemukan"
            ];
        }

        return $hasil;
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id):array
    {
        $kondisi = ['kuota_bimbingan.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        if ($cek > 0) {
            $this->db->delete($this->table, $kondisi);
            $hasil = [
                'error' => false,
                'message' => "data berhasil dihapus"
            ];
        } else {
            $hasil = [
                'error' => true,
                'message' => "data tidak ditemukan"
            ];
        }

        return $hasil;
    }

    /**
     * @param $id
     * @return array
     */
    public function details($id):array
    {
        $kondisi = [
            'id' => $id
        ];

        $jabatan = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => !$jabatan,
            'message' => ($jabatan) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $jabatan
        ];
    }
}