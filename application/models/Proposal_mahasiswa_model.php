<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $load
 * @property $table
 * @property $app
 * @property $fileupload
 * @property $emailm
 * @property $session
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

        $periode_aktif = $this->db->select('id, periode')
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

        $dosen_id = !empty($input['dosen_id']) ? $input['dosen_id'] : $this->session->userdata('dosen_id');
        $dosen2_id = !empty($input['dosen2_id']) ? $this->session->userdata('dosen2_id') : null;

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


        $this->db->distinct();
        $this->db->select("proposal_mahasiswa.*");
        $this->db->where($kondisi);
        $query = $this->db->get($this->table);

        if ($query === false) {
            return [
                'error' => true,
                'message' => 'Terjadi kesalahan dalam query.',
                'data' => []
            ];
        }

        $proposal_mahasiswa = $query->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($proposal_mahasiswa) ? "Data berhasil ditemukan" : "Data tidak tersedia";
        $hasil['data'] = $proposal_mahasiswa;

        foreach ($proposal_mahasiswa as $key => $item) {
            $hasil['data'][$key]['mahasiswa'] = $this->db->get_where('mahasiswa_v', ['mahasiswa_v.id' => $item['mahasiswa_id']])->row_array();
            $hasil['data'][$key]['pembimbing'] = $this->db->get_where('dosen', ['dosen.id' => $item['dosen_id']])->row_array();
            $hasil['data'][$key]['pembimbing2'] = $this->db->get_where('dosen', ['dosen.id' => $item['dosen2_id']])->row_array();
            $hasil['data'][$key]['created_at'] = tgl_indo($item['created_at']);
        }
        return $hasil;
    }

    public function create($input)
    {
        $this->load->library('FileUpload');

        $this->db->trans_start();

        $tahun_sekarang = date('Y');

        $this->db->select('id');
        $this->db->from('periode');
        $this->db->where('periode', $tahun_sekarang);
        $this->db->where('status', 1);
        $periode = $this->db->get()->row();

        if (!$periode) {
            $this->db->trans_rollback();
            return [
                'error' => true,
                'message' => 'Periode untuk tahun ' . $tahun_sekarang . ' tidak ditemukan atau belum aktif.'
            ];
        }

        $this->db->select('nilai');
        $this->db->from('kuota_bimbingan');
        $kuota = $this->db->get()->row();

        $this->db->select('COUNT(*) as jumlah_mahasiswa');
        $this->db->from('bimbingan_dosen_v');
        $this->db->where('id', $input['dosen_id']);
        $jumlah_mahasiswa_dosen1 = $this->db->get()->row()->jumlah_mahasiswa;

        if ($jumlah_mahasiswa_dosen1 >= $kuota->nilai) {
            $this->db->trans_rollback();
            return [
                'error' => true,
                'message' => 'Kuota dosen pembimbing pertama telah penuh.'
            ];
        }

        $this->db->select('nilai');
        $this->db->from('kuota_dospem');
        $kuota_dospem = $this->db->get()->row();

        if ($kuota_dospem->nilai == 1) {
            $data = [
                'mahasiswa_id' => $input['mahasiswa_id'],
                'judul' => htmlspecialchars($input['judul'], ENT_QUOTES, 'UTF-8'),
                'dosen_id' => (int)$input['dosen_id'],
                'lulus_metopen' => (int)$input['lulus_metopen'],
                'lulus_mkwajib' => (int)$input['lulus_mkwajib'],
                'id_periode' => $periode->id,
            ];
        } else {
            if (empty($input['dosen2_id'])) {
                $this->db->trans_rollback();
                return [
                    'error' => true,
                    'message' => 'Dosen Pembimbing 2 harus diisi.'
                ];
            }

            $this->db->select('COUNT(*) as jumlah_mahasiswa');
            $this->db->from('bimbingan_dosen_v');
            $this->db->where('id', $input['dosen2_id']);
            $jumlah_mahasiswa_dosen2 = $this->db->get()->row()->jumlah_mahasiswa;

            if ($jumlah_mahasiswa_dosen2 >= $kuota->nilai) {
                $this->db->trans_rollback();
                return [
                    'error' => true,
                    'message' => 'Kuota dosen pembimbing kedua telah penuh.'
                ];
            }

            $data = [
                'mahasiswa_id' => (int)$input['mahasiswa_id'],
                'judul' => htmlspecialchars($input['judul'], ENT_QUOTES, 'UTF-8'),
                'dosen_id' => (int)$input['dosen_id'],
                'dosen2_id' => (int)$input['dosen2_id'],
                'lulus_metopen' => (int)$input['lulus_metopen'],
                'lulus_mkwajib' => (int)$input['lulus_mkwajib'],
                'id_periode' => $periode->id,
            ];
        }

        $validate = $this->app->validate($data);

        if ($validate === true) {
            try {
                if (!empty($input['krs'])) {
                    $data['krs'] = $this->fileupload->upload($input['krs'], 'cdn/vendor/krs/');
                }

                if (!empty($input['transkip'])) {
                    $data['transkip'] = $this->fileupload->upload($input['transkip'], 'cdn/vendor/transkip/');
                }

                if (!empty($input['outline'])) {
                    $data['outline'] = $this->fileupload->upload($input['outline'], 'cdn/vendor/outline/');
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }

            $this->db->insert($this->table, $data);
            $data_id = $this->db->insert_id();

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                return [
                    'error' => true,
                    'message' => 'Terjadi kesalahan saat menyimpan data.'
                ];
            }

            return [
                'error' => false,
                'message' => "Data berhasil ditambah, Harap Cek Email Secara Berkala",
                'data_id' => $data_id
            ];
        } else {
            $this->db->trans_rollback();
            return $validate;
        }
    }

    public function update($input, $id)
    {
        $this->load->library('FileUpload');

        $this->db->trans_start();

        $tahun_sekarang = date('Y');

        $this->db->select('id');
        $this->db->from('periode');
        $this->db->where('periode', $tahun_sekarang);
        $this->db->where('status', 1);
        $periode = $this->db->get()->row();

        if (!$periode) {
            $this->db->trans_rollback();
            return [
                'error' => true,
                'message' => 'Periode untuk tahun ' . $tahun_sekarang . ' tidak ditemukan atau belum aktif.'
            ];
        }

        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->row();

        if (!$cek) {
            $this->db->trans_rollback();
            return [
                'error' => true,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $data = [
            'mahasiswa_id' => (int)$input['mahasiswa_id'],
            'judul' => htmlspecialchars($input['judul'], ENT_QUOTES, 'UTF-8'),
            'dosen_id' => (int)$input['dosen_id'],
            'id_periode' => $periode->id,
        ];

        if (isset($input['dosen2_id'])) {
            $data['dosen2_id'] = (int)$input['dosen2_id'];
        }

        $validate = $this->app->validate($data);

        if ($validate === true) {
            try {
                if (!empty($input['krs'])) {
                    if (!empty($cek->krs)) {
                        unlink(FCPATH . 'cdn/vendor/krs/' . $cek->krs);
                    }
                    $data['krs'] = $this->fileupload->upload($input['krs'], 'cdn/vendor/krs/');
                } else {
                    $data['krs'] = $cek->krs;
                }

                if (!empty($input['transkip'])) {
                    if (!empty($cek->transkip)) {
                        unlink(FCPATH . 'cdn/vendor/transkip/' . $cek->transkip);
                    }
                    $data['transkip'] = $this->fileupload->upload($input['transkip'], 'cdn/vendor/transkip/');
                } else {
                    $data['transkip'] = $cek->transkip;
                }

                if (!empty($input['outline'])) {
                    if (!empty($cek->outline)) {
                        unlink(FCPATH . 'cdn/vendor/outline/' . $cek->outline);
                    }
                    $data['outline'] = $this->fileupload->upload($input['outline'], 'cdn/vendor/outline/');
                } else {
                    $data['outline'] = $cek->outline;
                }
            } catch (Exception $e) {
                $this->db->trans_rollback();
                return [
                    'error' => true,
                    'message' => $e->getMessage()
                ];
            }

            $this->db->update($this->table, $data, $kondisi);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return [
                    'error' => true,
                    'message' => 'Terjadi kesalahan saat mengupdate data.'
                ];
            }

            return [
                'error' => false,
                'message' => "Data berhasil diperbarui, Harap Cek Email Secara Berkala"
            ];
        } else {
            $this->db->trans_rollback();
            return $validate;
        }
    }

    /**
     * @param $id
     * @return array
     */
    public function destroy($id): array
    {
        $kondisi = ['proposal_mahasiswa.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->row();

        if ($cek) {
            if (!empty($cek->krs)) {
                $krs_file_path = FCPATH . 'cdn/vendor/krs/' . $cek->krs;
                if (file_exists($krs_file_path)) {
                    unlink($krs_file_path);
                }
            }

            if (!empty($cek->transkip)) {
                $transkip_file_path = FCPATH . 'cdn/vendor/transkip/' . $cek->transkip;
                if (file_exists($transkip_file_path)) {
                    unlink($transkip_file_path);
                }
            }

            if (!empty($cek->outline)) {
                $outline_file_path = FCPATH . 'cdn/vendor/outline/' . $cek->outline;
                if (file_exists($outline_file_path)) {
                    unlink($outline_file_path);
                }
            }

            $this->db->delete($this->table, $kondisi);

            $hasil = [
                'error' => false,
                'message' => "Data berhasil dihapus dan file terkait berhasil dihapus"
            ];
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

    public function kuota_dospem()
    {
        return $this->db->get('kuota_dospem')->row_array();
    }
}

/* End of file Proposal_mahasiswa_model.php */
