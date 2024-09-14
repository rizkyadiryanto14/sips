<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $session
 * @property $fileupload
 */

class Konsultasi_model extends CI_Model
{

    protected $table = "konsultasi";

    public function get($input)
    {
        $this->db->select('
        konsultasi.id,
        konsultasi.proposal_mahasiswa_id,
        konsultasi.tanggal,
        konsultasi.jam,
        konsultasi.bukti,
        konsultasi.isi,
        konsultasi.sk_tim,
        konsultasi.persetujuan_pembimbing,
        konsultasi.persetujuan_kaprodi,
        konsultasi.komentar_pembimbing,
        konsultasi.komentar_kaprodi,
        proposal_mahasiswa.mahasiswa_id as proposal_mahasiswa_mahasiswa_id,
        proposal_mahasiswa.judul as proposal_mahasiswa_judul,
        proposal_mahasiswa.dosen_id as proposal_mahasiswa_pembimbing_id,
        proposal_mahasiswa.dosen2_id as proposal_mahasiswa_pembimbing2_id,
        mahasiswa.nama as mahasiswa_nama,
        mahasiswa.prodi_id as mahasiswa_prodi_id,
        prodi.dosen_id as prodi_kaprodi_id,
        dosen.nama as dosen_nama
    ');

        $this->db->from($this->table);
        $this->db->join('proposal_mahasiswa', 'proposal_mahasiswa.id = konsultasi.proposal_mahasiswa_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id = proposal_mahasiswa.mahasiswa_id', 'left');
        $this->db->join('prodi', 'prodi.id = mahasiswa.prodi_id', 'left');
        $this->db->join('dosen', 'dosen.id = proposal_mahasiswa.dosen_id', 'left');

        $dosen_id = $this->session->userdata('id');
        $level = $this->session->userdata('level');

        if ($level == 3) {
            $mahasiswa_id = $this->session->userdata('id');
            $this->db->where('proposal_mahasiswa.mahasiswa_id', $mahasiswa_id);
        }
        else if ($level == 2) {
            $this->db->group_start();
            $this->db->where('proposal_mahasiswa.dosen_id', $dosen_id);
            $this->db->or_where('proposal_mahasiswa.dosen2_id', $dosen_id);
            $this->db->or_where('prodi.dosen_id', $dosen_id);
            $this->db->group_end();
        }

        $konsultasi = $this->db->get()->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($konsultasi) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $konsultasi;

        return $hasil;
    }

    public function create($input)
    {
        $tahun_sekarang = date('Y');

        $this->db->select('id');
        $this->db->from('periode');
        $this->db->where('periode', $tahun_sekarang);
        $this->db->where('status', 1);
        $periode = $this->db->get()->row();

        if (!$periode) {
            return [
                'error' => true,
                'message' => 'Periode untuk tahun ' . $tahun_sekarang . ' tidak ditemukan atau belum aktif.'
            ];
        }

        $data = [
            'proposal_mahasiswa_id' => $input['proposal_mahasiswa_id'],
            'tanggal' => $input['tanggal'],
            'jam' => $input['jam'],
            'isi' => $input['isi'],
            'id_periode'    => $periode->id
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $this->load->library('FileUpload');

            try {
                if (!empty($input['bukti'])) {
                    $uploaded_file_name = $this->fileupload->upload($input['bukti'], 'cdn/vendor/bukti/');
                    $data['bukti'] = $uploaded_file_name;
                }

                $this->db->insert($this->table, $data);

                $hasil = [
                    'error' => false,
                    'message' => 'Data berhasil ditambah',
                    'data_id' => $this->db->insert_id()
                ];
            } catch (Exception $e) {
                $hasil = [
                    'error' => true,
                    'message' => 'Gagal mengunggah bukti: ' . $e->getMessage()
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
            'proposal_mahasiswa_id' => $input['proposal_mahasiswa_id'],
            'tanggal' => $input['tanggal'],
            'jam' => $input['jam'],
            'isi' => $input['isi']
        ];

        $kondisi = ['konsultasi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);

            if ($validate === true) {
                $cek = $this->db->get_where($this->table, ['konsultasi.proposal_mahasiswa_id' => $data['proposal_mahasiswa_id'], 'konsultasi.id <>' => $id])->num_rows();
                if ($cek > 0) {
                    $hasil = [
                        'error' => true,
                        'message' => "proposal sudah ada"
                    ];
                } else {
                    if ($input['bukti']) {
                        $bukti = explode(';base64,', $input['bukti'])[1];
                        $bukti_type = '.doc';
                        if ($input['bukti_file']) {
                            $bukti_type = explode('.', $input['bukti_file']);
                            $bukti_type = '.' . $bukti_type[count($bukti_type) - 1];
                        }
                        $bukti_nama = date('Ymdhis') . $bukti_type;

                        file_put_contents(FCPATH . 'cdn/vendor/bukti/' . $bukti_nama, base64_decode($bukti));
                        $data['bukti'] = $bukti_nama;

                        $bukti = $this->db->get_where($this->table, $kondisi)->row_array()['bukti'];
                        unlink(FCPATH . 'cdn/vendor/bukti/' . $bukti);
                    }

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

    public function destroy($id)
    {
        $kondisi = ['konsultasi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $bukti = $this->db->get_where($this->table, $kondisi)->row_array()['bukti'];
            unlink(FCPATH . 'cdn/vendor/bukti/' . $bukti);
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

    public function uploadsktim($input, $id)
    {
        if (empty($input['sktim'])) {
            $hasil = [
                'error' => true,
                'message' => "file SK Tim tidak diketahui"
            ];
            goto output;
        }

        $konsultasi = $this->db->get_where('konsultasi', ['id' => $id])->row_array();
        if (empty($konsultasi['persetujuan_pembimbing']) || empty($konsultasi['persetujuan_kaprodi'])) {
            $hasil = [
                'error' => true,
                'message' => "konsultasi belum disetujui oleh pembimbing atau kaprodi"
            ];
            goto output;
        }

        $file_sktim = explode(';base64,', $input['sktim'])[1];
        $sktim_nama = date('Ymdhis') . '.pdf';
        file_put_contents(FCPATH . 'cdn/vendor/sk_tim/' . $sktim_nama, base64_decode($file_sktim));

        $sk_tim = $this->db->get_where($this->table, ['id' => $id])->row_array()['sk_tim'];
        if ($sk_tim) {
            unlink(FCPATH . 'cdn/vendor/sk_tim/' . $sk_tim);
        }

        $this->db->update($this->table, [
            'sk_tim' => $sktim_nama
        ], [
            'id' => $id
        ]);

        $hasil = [
            'error' => false,
            'message' => "file SK Tim berhasil diupload"
        ];

        output:
        return $hasil;
    }

    public function agree($input, $id)
    {
        if (empty($id)) {
            $hasil = [
                'error' => true,
                'message' => "id konsultasi tidak diketahui"
            ];
            goto output;
        }

        if ($input['pembimbing_id']) {
            $data = ['persetujuan_pembimbing' => "1"];
        } else if ($input['kaprodi_id']) {
            $data = ['persetujuan_kaprodi' => "1"];
        } else {
            $hasil = [
                'error' => true,
                'message' => "konsultasi gagal disetujui"
            ];
            goto output;
        }

        $this->db->where(['id' => $id]);
        $this->db->update($this->table, $data);

        $hasil = [
            'error' => false,
            'message' => "konsultasi berhasil disetujui"
        ];

        output:
        return $hasil;
    }

    public function disagree($input, $id)
    {
        if (empty($id)) {
            $hasil = [
                'error' => true,
                'message' => "id konsultasi tidak diketahui"
            ];
            goto output;
        }

        if ($input['pembimbing_id']) {
            $data = [
                'persetujuan_pembimbing' => "0",
                'komentar_pembimbing' => $input['komentar']
            ];
        } else if ($input['kaprodi_id']) {
            $data = [
                'persetujuan_kaprodi' => "0",
                'komentar_kaprodi' => $input['komentar']
            ];
        } else {
            $hasil = [
                'error' => true,
                'message' => "konsultasi gagal disetujui"
            ];
            goto output;
        }

        $this->db->where(['id' => $id]);
        $this->db->update($this->table, $data);

        $hasil = [
            'error' => false,
            'message' => "konsultasi berhasil disetujui"
        ];

        output:
        return $hasil;
    }
}

/* End of file Konsultasi_model.php */
