<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $db
 */

class Jabatan_model extends CI_Model
{
    protected $table = 'jabatan';

    public function get()
    {
        $this->db->select("*");
        $jabatan = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($jabatan) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $jabatan;

        return $hasil;
    }

    /**
     * @return array
     */
    public function getById():array
    {
        $jabatan = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($jabatan) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $jabatan;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'nama_jabatan' => $input['nama_jabatan'],
            'keterangan' => $input['keterangan'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['jabatan.nama_jabatan' => $data['nama_jabatan']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "Nama jabatan sudah digunakan"
                ];
            } else {
                $this->db->insert($this->table, $data);
                $hasil = [
                    'error' => false,
                    'message' => "data berhasil ditambah",
                    'data_id' => $this->db->insert_id()
                ];
            }
        } else {
            $hasil = $validate;
        }

        return $hasil;
    }

    public function update($input, $id)
    {
        $data = [
            'nama_jabatan' => $input['nama_jabatan'],
            'keterangan' => $input['keterangan'],
        ];

        $kondisi = ['jabatan.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['jabatan.id <>' => $id, 'jabatan.nama_jabatan' => $data['nama_jabatan']])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "Nama jabatan sudah digunakan"
                    ];
                } else {
                    $this->db->update($this->table, $data, $kondisi);
                    $hasil = [
                        'error' => false,
                        'message' => "data berhasil diedit"
                    ];
                }
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
        $kondisi = ['jabatan.id' => $id];
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

        $jabatan = $this->db->get_where($this->table, ['id' => $id])->row_array();

        return [
            'error' => ($jabatan) ? false : true,
            'message' => ($jabatan) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $jabatan
        ];
    }
}