<?php

class DaftarJudul_model extends CI_Model
{
    protected $table = 'daftar_judul';

    public function get()
    {
        $this->db->select("*");
        $daftar_judul = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($daftar_judul) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $daftar_judul;

        return $hasil;
    }

    public function cekJudulSkripsi($judulInput)
    {
        $this->db->select('nim, judul_skripsi, nama, tahun_lulus');
        $query = $this->db->get('daftar_judul');
        $daftarJudul = $query->result_array();

        $hasil = [];
        $threshold = 30;

        foreach ($daftarJudul as $judul) {
            similar_text($judulInput, $judul['judul_skripsi'], $percent);

            if ($percent >= $threshold) {
                $judul['kemiripan'] = $percent;
                $hasil[] = $judul;
            }
        }

        usort($hasil, function($a, $b) {
            return $b['kemiripan'] <=> $a['kemiripan'];
        });

        return array_slice($hasil, 0, 5);
    }

    /**
     * @return array
     */
    public function getById():array
    {
        $daftar_judul = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();
        $hasil['error'] = false;
        $hasil['message'] = ($daftar_judul) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $daftar_judul;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'nim' => $input['nim'],
            'judul_skripsi' => $input['judul_skripsi'],
            'nama' => $input['nama'],
            'abstrak' => $input['abstrak'],
            'tahun_lulus' => $input['tahun_lulus'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['daftar_judul.judul_skripsi' => $data['judul_skripsi']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "Judul Skripsi sudah digunakan"
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
            'nim' => $input['nim'],
            'judul_skripsi' => $input['judul_skripsi'],
            'nama' => $input['nama'],
            'abstrak' => $input['abstrak'],
            'tahun_lulus' => $input['tahun_lulus'],
        ];

        $kondisi = ['daftar_judul.id' => $id];
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
        $kondisi = ['daftar_judul.id' => $id];
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

        $daftar_judul = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => ($daftar_judul) ? false : true,
            'message' => ($daftar_judul) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $daftar_judul
        ];
    }
}