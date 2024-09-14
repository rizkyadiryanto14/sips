<?php

class Predikat_penilaian_model extends CI_Model
{
    protected $table = 'predikat_penilaian';

    public function get()
    {
        $this->db->select("*");
        $predikat = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($predikat) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $predikat;

        return $hasil;
    }

    /**
     * @return array
     */
    public function getById():array
    {
        $predikat = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($predikat) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $predikat;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'nama_predikat' => $input['nama_predikat'],
            'nilai_minimum' => $input['nilai_minimum'],
            'nilai_maximum' => $input['nilai_maximum'],
            'keterangan' => $input['keterangan'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['predikat_penilaian.nama_predikat' => $data['nama_predikat']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "Nama predikat sudah digunakan"
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
            'nama_predikat' => $input['nama_predikat'],
            'nilai_minimum' => $input['nilai_minimum'],
            'nilai_maximum' => $input['nilai_maximum'],
            'keterangan' => $input['keterangan'],
        ];

        $kondisi = ['predikat_penilaian.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['predikat_penilaian.id <>' => $id, 'predikat_penilaian.nama_predikat' => $data['nama_predikat']])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "Nama Predikat sudah digunakan"
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
        $kondisi = ['predikat_penilaian.id' => $id];
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

        $predikat = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => !$predikat,
            'message' => ($predikat) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $predikat
        ];
    }
}