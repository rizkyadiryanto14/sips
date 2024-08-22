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

        // Update tanda tangan
        $this->db->where('id', $post['id']);
        $this->db->update($table, $params);

        // Generate QR code setelah tanda tangan diperbarui
        $this->generate_qr_code_for_signature($post['id']);
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

    public function generate_qr_code_for_signature($id)
    {
        $this->load->library('ciqrcode');

        include_once APPPATH . 'third_party/phpqrcode/qrlib.php';

        // URL yang akan diembed ke dalam QR code
        $qr_url = base_url('dosen/detail_signature/' . $id);

        // Nama file QR code
        $file_name = 'dosen_' . $id . '.png';
        $file_path = FCPATH . 'cdn/vendor/qrcodes/' . $file_name;

        // Parameter untuk QR code
        $qr_params = [
            'data' => $qr_url,
            'level' => 'H',
            'size' => 10,
            'savename' => $file_path
        ];

        // Generate QR code
        QRcode::png($qr_params['data'], $qr_params['savename'], $qr_params['level'], $qr_params['size']);

        // Update tabel dosen dengan nama file QR code
        $this->db->where('id', $id);
        $this->db->update($this->table, ['qr_code' => $file_name]);

        // Mengembalikan nama file QR code
        return $file_name;
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

        $dosen = $this->db->get_where($this->table, $kondisi)->row_array();

        return [
            'error' => ($dosen) ? false : true,
            'message' => ($dosen) ? "data berhasil ditemukan" : "data tidak ditemukan",
            'data' => $dosen
        ];
    }
}

/* End of file Dosen_model.php */
