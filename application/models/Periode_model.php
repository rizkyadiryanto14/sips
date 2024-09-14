<?php

class Periode_model extends CI_Model
{
    protected $table = 'periode';

    public function get()
    {
        $this->db->select("*");
        $periode = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($periode) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $periode;

        return $hasil;
    }

    /**
     * @return array
     */
    public function getById(): array
    {
        $periode = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($periode) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $periode;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'periode' => $input['periode'],
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
            'periode' => $input['periode'],
            'status' => $input['status'],
        ];

        $kondisi = ['periode.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $this->db->trans_start();

                if ($input['status'] == 1) {
                    $this->db->update($this->table, ['status' => 0]);
                }

                $this->db->where('id', $id);
                $this->db->update($this->table, $data);

                $this->db->trans_complete();

                if ($this->db->trans_status() === FALSE) {
                    $hasil = [
                        'error' => true,
                        'message' => "Terjadi kesalahan dalam proses pembaruan"
                    ];
                } else {
                    $hasil = [
                        'error' => false,
                        'message' => "Data berhasil diedit"
                    ];
                }
            } else {
                $hasil = $validate;
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "Data tidak ditemukan"
            ];
        }

        return $hasil;
    }


    /**
     * @param $id
     * @return array
     */
    public function destroy($id): array
    {
        $kondisi = ['periode.id' => $id];
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

    public function admin_index($input)
    {
        $periode = $this->db->get('periode')->result_array();

        $hasil = [
            'error' => false,
            'message' => ($periode) ? "data berhasil ditemukan" : "data tidak tersedia",
            'data' => $periode,
        ];

        return $hasil;
    }

    /**
     * @param $id
     * @return array
     */
    public function details($id): array
    {
        $kondisi = [
            'id' => $id
        ];

        $periode = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => ($periode) ? false : true,
            'message' => ($periode) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $periode
        ];
    }

    public function agree($id)
    {

        $this->db->update($this->table, ['status' => "0"]);

        $kondisi = ['periode.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        if ($cek->num_rows() > 0) {
            if ($this->db->update($this->table, ['status' => "1"], $kondisi)) {
                $hasil = [
                    'error' => false,
                    'message' => "Periode berhasil disetujui"
                ];
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "Data tidak ditemukan"
            ];
        }

        return $hasil;
    }

    public function disagree($id)
    {
        $kondisi = ['periode.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        if ($cek->num_rows() > 0) {
            if ($this->db->update($this->table, ['status' => "0"], $kondisi)) {
                $hasil = [
                    'error' => false,
                    'message' => "Periode batal disetujui"
                ];
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "Data tidak ditemukan"
            ];
        }
        return $hasil;
    }
}
