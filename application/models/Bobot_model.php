<?php

class Bobot_model extends CI_Model
{
    protected $table = 'bobot_penilaian';

    public function get()
    {
        $this->db->select("*");
        $bobot = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($bobot) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $bobot;

        return $hasil;
    }

    /**
     * @return array
     */
    public function getById():array
    {
        $bobot = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($bobot) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $bobot;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'bobot_penilaian' => $input['bobot_penilaian'],
            'keterangan' => $input['keterangan'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['bobot_penilaian.bobot_penilaian' => $data['bobot_penilaian']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "Bobot Penilaian sudah digunakan"
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
            'bobot_penilaian' => $input['bobot_penilaian'],
            'keterangan' => $input['keterangan'],
        ];

        $kondisi = ['bobot_penilaian.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['bobot_penilaian.id <>' => $id, 'bobot_penilaian.bobot_penilaian' => $data['bobot_penilaian']])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "Bobot sudah digunakan"
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
        $kondisi = ['bobot_penilaian.id' => $id];
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