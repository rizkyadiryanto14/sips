<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $load
 * @property $table
 * @property $app
 * @property $fileupload
 * @property $emailm
 */

class Proposal_mahasiswa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model', 'emailm');
    }

    protected string $table = "proposal_mahasiswa";

    /**
     * @param $input
     * @return array
     */
    public function get($input): array
    {
        $kondisi = [];

        // Ambil id_periode dari tabel periode dengan status = 1
        $periode_aktif = $this->db->select('id')
            ->from('periode')
            ->where('status', 1)
            ->get()
            ->row_array();

        if (empty($periode_aktif)) {
            return [
                'error' => true,
                'message' => 'Tidak ada periode aktif yang ditemukan',
                'data' => []
            ];
        }

        $id_periode = $periode_aktif['id'];
        $kondisi['id_periode'] = $id_periode;

        // Ambil dosen_id dan dosen2_id dari input atau session userdata
        $dosen_id = !empty($input['dosen_id']) ? $input['dosen_id'] : $this->session->userdata('dosen_id');
        $dosen2_id = !empty($input['dosen2_id']) ? $input['dosen2_id'] : $this->session->userdata('dosen2_id');

        if (!empty($dosen_id) || !empty($dosen2_id)) {
            $this->db->group_start();
            if (!empty($dosen_id)) {
                $this->db->where('proposal_mahasiswa.dosen_id', $dosen_id);
            }
            if (!empty($dosen2_id)) {
                $this->db->or_where('proposal_mahasiswa.dosen2_id', $dosen2_id);
            }
            $this->db->group_end();
        }

        if (!empty($input['status'])) {
            $kondisi['status'] = $input['status'];
        }

        if (!empty($input['mahasiswa_id'])) {
            $kondisi['mahasiswa_id'] = $input['mahasiswa_id'];
        }

        $this->db->select("*");
        $this->db->where($kondisi);
        $proposal_mahasiswa = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($proposal_mahasiswa) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $proposal_mahasiswa;

        foreach ($proposal_mahasiswa as $key => $item) {
            $hasil['data'][$key]['mahasiswa'] = $this->db->get_where('mahasiswa_v', ['mahasiswa_v.id' => $item['mahasiswa_id']])->row_array();
            $hasil['data'][$key]['pembimbing'] = $this->db->get_where('dosen', ['dosen.id' => $item['dosen_id']])->row_array();
            $hasil['data'][$key]['pembimbing2'] = $this->db->get_where('dosen', ['dosen.id' => $item['dosen2_id']])->row_array();
        }

        return $hasil;
    }




    public function create($input)
    {
        $this->load->library('FileUpload');

        $data = [
            'mahasiswa_id' => $input['mahasiswa_id'],
            'judul' => $input['judul'],
            'dosen_id' => $input['dosen_id'],
            'dosen2_id' => $input['dosen2_id'],
            'krs' => $input['krs'],
            'transkip' => $input['transkip'],
            'outline' => $input['outline'],
            'lulus_metopen' => $input['lulus_metopen'],
            'lulus_mkwajib' => $input['lulus_mkwajib'],
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            // Upload files using FileUpload library
            $data['krs'] = $this->fileupload->upload($input['krs'], 'cdn/vendor/krs/');
            $data['transkip'] = $this->fileupload->upload($input['transkip'], 'cdn/vendor/transkip/');
            $data['outline'] = $this->fileupload->upload($input['outline'], 'cdn/vendor/outline/');

            // Insert data into database
            $this->db->insert($this->table, $data);
            $data_id = $this->db->insert_id();
            $hasil = [
                'error' => false,
                'message' => "data berhasil ditambah",
                'data_id' => $data_id
            ];
        } else {
            $hasil = $validate;
        }
        return $hasil;
    }

    public function update($input, $id)
    {
        $this->load->library('FileUpload');
        $data = [
            'mahasiswa_id' => $input['mahasiswa_id'],
            'judul' => $input['judul'],
            'dosen_id' => $input['dosen_id'],
            'dosen2_id' => $input['dosen2_id'],
            'lulus_metopen' => $input['lulus_metopen'],
            'lulus_mkwajib' => $input['lulus_mkwajib'],

        ];
        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->row();

        if ($cek) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                // File handling
                if (!empty($input['krs'])) {
                    if (!empty($cek->krs)) {
                        unlink(FCPATH . 'cdn/vendor/krs/' . $cek->krs); // Hapus file lama
                    }
                    $data['krs'] = $this->fileupload->upload($input['krs'], 'cdn/vendor/krs/');
                }

                if (!empty($input['transkip'])) {
                    if (!empty($cek->transkip)) {
                        unlink(FCPATH . 'cdn/vendor/transkip/' . $cek->transkip); // Hapus file lama
                    }
                    $data['transkip'] = $this->fileupload->upload($input['transkip'], 'cdn/vendor/transkip/');
                }

                if (!empty($input['outline'])) {
                    if (!empty($cek->outline)) {
                        unlink(FCPATH . 'cdn/vendor/outline/' . $cek->outline); // Hapus file lama
                    }
                    $data['outline'] = $this->fileupload->upload($input['outline'], 'cdn/vendor/outline/');
                }

                // Update data
                $this->db->update($this->table, $data, $kondisi);
                $hasil = [
                    'error' => false,
                    'message' => "Data berhasil diedit"
                ];
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
        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

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
     * @param $deadline
     * @return array
     */
    public function agree($id, $deadline):array
    {
        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        if ($cek > 0) {
            $dataUpdate = array(
                'status' => '1',
                'deadline' => $deadline
            );

            $email = '';
            $dProposal = $this->db->get_where('proposal_mahasiswa_v', array('id' => $id))->result();
            foreach ($dProposal as $dp) {
                $email = $dp->email;
            }

            if ($this->db->update($this->table, $dataUpdate, $kondisi)) {
                $isi_email = '
                    <p>Usulan proposal anda telah disetujui, silahkan lanjut ke tahap berikutnya.</p>
                    ';
                $this->emailm->send('Usulan Proposal Disetujui', $email, $isi_email);

                $hasil = [
                    'error' => false,
                    'message' => "proposal berhasil disetujui",
                ];
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "data tidak ditemukan"
            ];
        }

        return $hasil;
    }

    public function disagree($id)
    {
        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        if ($cek > 0) {

            $email = '';
            $dProposal = $this->db->get_where('proposal_mahasiswa_v', array('id' => $id))->result();
            foreach ($dProposal as $dp) {
                $email = $dp->email;
            }

            if ($this->db->update($this->table, ['status' => "0", 'deadline' => null], $kondisi)) {
                $isi_email = '
                    <p>Usulan proposal anda tidak disetujui, silahkan membenarkan usulan proposal anda.</p>
                    ';
                $this->emailm->send('Usulan Proposal Tidak Disetujui', $email, $isi_email);

                $hasil = [
                    'error' => false,
                    'message' => "proposal batal disetujui"
                ];
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "data tidak ditemukan"
            ];
        }

        return $hasil;
    }
}

/* End of file Proposal_mahasiswa_model.php */
