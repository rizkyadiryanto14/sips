<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $table
 * @property $input
 * @property $app
 */

class Dosen_model extends CI_Model
{

    protected string $table = "dosen";

    /**
     * @return array
     */
    public function get():array
    {
        $this->db->select("*");
        $dosen = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($dosen) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $dosen;

        foreach ($dosen as $key => $item) {
            $hasil['data'][$key]['jabatan'] = $this->db->get_where('jabatan', ['jabatan.id' => $item['id_jabatan']])->row_array();
        }
        return $hasil;
    }

    public function update_signature($table, $post)
    {
        $params = [
            'signature' => $post['ttd']
        ];

        $this->db->where('id', $post['id']);
        $this->db->update($table, $params);
    }

    public function getSignature($where = null)
    {
        $this->db->select('signature');
        $this->db->from('dosen');
        if ($where != null) {
            $this->db->where('id', $where);
        }
        return $this->db->get()->row_array();
    }


    /**
     * @return array
     */
    public function getById():array
    {
        $dosen = $this->db->get_where($this->table, array('id' => $this->input->post('id')))->result();

        $hasil['error'] = false;
        $hasil['message'] = ($dosen) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $dosen;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'nip' => $input['nip'],
            'nama' => $input['nama'],
            'nomor_telepon' => $input['nomor_telepon'],
            'email' => $input['email'],
            'fokus' => $input['fokus'],
            'no_japung'=> $input['no_japung'],
            'id_jabatan'    => $input['id_jabatan'],
            'tema_riset' => $input['tema_riset'],
            'password'  => PASSWORD_HASH($input['password'], PASSWORD_DEFAULT)
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $cek = $this->db->get_where($this->table, ['dosen.nip' => $data['nip']])->num_rows();
            if ($cek > 0) {
                $hasil = [
                    'error' => true,
                    'message' => "nip sudah digunakan"
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
            'nip' => $input['nip'],
            'nama' => $input['nama'],
            'nomor_telepon' => $input['nomor_telepon'],
            'email' => $input['email'],
            'fokus' => $input['fokus'],
            'id_jabatan'    => $input['id_jabatan'],
            'no_japung'=> $input['no_japung'],
            'tema_riset' => $input['tema_riset'],
            'password'  => PASSWORD_HASH($input['password'], PASSWORD_DEFAULT)
        ];

        $kondisi = ['dosen.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['dosen.id <>' => $id, 'dosen.nip' => $data['nip']])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "nip sudah digunakan"
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
        $kondisi = ['dosen.id' => $id];
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

        $dosen = $this->db->get_where($this->table, ['id' => $id])->row_array();

        return [
            'error' => ($dosen) ? false : true,
            'message' => ($dosen) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $dosen
        ];
    }
}

/* End of file Dosen_model.php */
