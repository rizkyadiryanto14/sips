<?php

class Komponen_model extends CI_Model
{
    protected $table = 'komponen_penilaian';

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
        $komponen = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($komponen) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $komponen;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'komponen_penilaian' => $input['komponen_penilaian'],
            'keterangan' => $input['keterangan'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['komponen_penilaian.komponen_penilaian' => $data['komponen_penilaian']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "Komponen Penilaian sudah digunakan"
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
            'komponen_penilaian' => $input['komponen_penilaian'],
            'keterangan' => $input['keterangan'],
        ];

        $kondisi = ['komponen_penilaian.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['komponen_penilaian.id <>' => $id, 'komponen_penilaian.komponen_penilaian' => $data['komponen_penilaian']])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "Nama Komponen sudah digunakan"
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
        $kondisi = ['komponen_penilaian.id' => $id];
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

        $komponen = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => ($komponen) ? false : true,
            'message' => ($komponen) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $komponen
        ];
    }
}