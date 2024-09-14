<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skripsi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Email_model', 'emailm');
    }
    protected $table = "skripsi";

    public function index($input)
    {
        $kondisi = [];

        // Ambil id_periode dari tabel periode dengan status = 1
        $periode_aktif = $this->db->select('id')
            ->from('periode')
            ->where('status', 1)
            ->get()
            ->row_array();

        // Cek apakah ada periode aktif
        if (empty($periode_aktif)) {
            return [
                'error' => true,
                'message' => 'Tidak ada periode aktif yang ditemukan',
                'data' => []
            ];
        }

        // Tambahkan kondisi untuk periode aktif
        $kondisi['skripsi_vl.id_periode'] = $periode_aktif['id'];

        // Filter berdasarkan mahasiswa_id jika ada
        if (!empty($input['mahasiswa_id'])) {
            if (!is_numeric($input['mahasiswa_id'])) {
                return [
                    'error' => true,
                    'message' => 'ID Mahasiswa tidak valid',
                    'data' => []
                ];
            }
            $kondisi['skripsi_vl.mahasiswa_id'] = $input['mahasiswa_id'];
        }

        // Filter berdasarkan dosen_id dan dosen2_id
        if (!empty($input['dosen_id'])) {
            if (!is_numeric($input['dosen_id'])) {
                return [
                    'error' => true,
                    'message' => 'ID Dosen tidak valid',
                    'data' => []
                ];
            }

            // Tambahkan kondisi untuk dosen_id dan dosen2_id
            $this->db->group_start()
                ->where('skripsi_vl.dosen_id', $input['dosen_id'])
                ->or_where('skripsi_vl.dosen2_id', $input['dosen_id'])
                ->group_end();
        }

        $this->db->where($kondisi);

        // Filter berdasarkan semester jika ada
        if (!empty($input['semester'])) {
            $this->db->where(function($query) use ($input) {
                if ($input['semester'] == 'ganjil') {
                    // Ganjil: September (09) sampai Februari (02)
                    $query->group_start()
                        ->where('MONTH(skripsi_vl.created_at) >=', 9)
                        ->or_where('MONTH(skripsi_vl.created_at) <=', 2)
                        ->group_end();
                } elseif ($input['semester'] == 'genap') {
                    // Genap: Maret (03) sampai Agustus (08)
                    $query->where('MONTH(skripsi_vl.created_at) >=', 3)
                        ->where('MONTH(skripsi_vl.created_at) <=', 8);
                }
            });
        }

        // Jalankan query
        $this->db->distinct();
        $this->db->select('skripsi_vl.*');
        $this->db->group_by('skripsi_vl.id');
        $query = $this->db->get('skripsi_vl');

        // Cek apakah query berhasil dieksekusi
        if (!$query) {
            return [
                'error' => true,
                'message' => 'Terjadi kesalahan dalam eksekusi query.',
                'data' => []
            ];
        }

        // Ambil hasil query
        $skripsi = $query->result_array();

        // Return hasil
        $hasil = [
            'error' => false,
            'message' => ($skripsi) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $skripsi,
        ];

        return $hasil;
    }


    public function admin_index($input)
    {
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

        $this->db->where('skripsi_vl.id_periode', $periode_aktif['id']);

        if (!empty($input['semester'])) {
            $this->db->where(function($query) use ($input) {
                if ($input['semester'] == 'ganjil') {
                    // Ganjil: September (09) sampai Februari (02)
                    $query->group_start()
                        ->where('MONTH(skripsi_vl.created_at) >=', 9)
                        ->or_where('MONTH(skripsi_vl.created_at) <=', 2)
                        ->group_end();
                } elseif ($input['semester'] == 'genap') {
                    // Genap: Maret (03) sampai Agustus (08)
                    $query->where('MONTH(skripsi_vl.created_at) >=', 3)
                        ->where('MONTH(skripsi_vl.created_at) <=', 8);
                }
            });
        }

        // Eksekusi query dan ambil hasilnya
        $skripsi = $this->db->get('skripsi_vl')->result_array();

        // Format hasil untuk output
        $hasil = [
            'error' => false,
            'message' => ($skripsi) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $skripsi,
        ];

        foreach ($hasil['data'] as $key => $item) {
            // Format created_at dengan tgl_indo
            $hasil['data'][$key]['created_at'] = tgl_indo($item['created_at']);
            // Format jadwal_skripsi jika ada
            $hasil['data'][$key]['jadwal_skripsi'] = tgl_indoFull($item['jadwal_skripsi']);
        }

        return $hasil;
    }

    public function create($input)
    {
        $this->load->library('FileUpload');

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
            'judul_skripsi' => $input['judul_skripsi'],
            'mahasiswa_id' => $input['mahasiswa_id'],
            'id_periode'    => $periode->id
        ];

        $validation = $this->app->validate($data);
        if ($validation !== true) {
            return $validation;
        }

        if (!empty($input['persetujuan'])) {
            $file_persetujuan = $this->fileupload->upload($input['persetujuan'], 'cdn/vendor/skripsi/persetujuan/');
            if (!$file_persetujuan) {
                return ['error' => true, 'message' => 'Gagal mengupload file persetujuan'];
            }
            $data['persetujuan'] = $file_persetujuan;
        }

        if (!empty($input['file_skripsi'])) {
            $file_skripsi = $this->fileupload->upload($input['file_skripsi'], 'cdn/vendor/skripsi/file_skripsi/');
            if (!$file_skripsi) {
                return ['error' => true, 'message' => 'Gagal mengupload file skripsi'];
            }
            $data['file_skripsi'] = $file_skripsi;
        }

        if (!empty($input['sk_tim'])) {
            $file_sk_tim = $this->fileupload->upload($input['sk_tim'], 'cdn/vendor/skripsi/sk_tim/');
            if (!$file_sk_tim) {
                return ['error' => true, 'message' => 'Gagal mengupload file SK tim'];
            }
            $data['sk_tim'] = $file_sk_tim;
        }

        if (!empty($input['bukti_konsultasi'])) {
            $file_bukti_konsultasi = $this->fileupload->upload($input['bukti_konsultasi'], 'cdn/vendor/skripsi/bukti_konsultasi/');
            if (!$file_bukti_konsultasi) {
                return ['error' => true, 'message' => 'Gagal mengupload bukti konsultasi'];
            }
            $data['bukti_konsultasi'] = $file_bukti_konsultasi;
        }

        if ($this->db->insert('skripsi', $data)) {
            $data_id = $this->db->insert_id();
            return [
                'error' => false,
                'message' => 'Data berhasil ditambahkan',
                'data_id' => $data_id
            ];
        }
        return ['error' => true, 'message' => 'Gagal menyimpan data ke database.'];
    }


    public function update($input, $id)
    {
        $this->load->library('FileUpload');

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

        $kondisi = ['skripsi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->row();

        if (!$cek) {
            return [
                'error' => true,
                'message' => 'Data tidak ditemukan'
            ];
        }

        $data = [
            'mahasiswa_id' => $input['mahasiswa_id'],
            'judul_skripsi' => $input['judul_skripsi'],
            'id_periode' => $periode->id
        ];

        // Validasi input
        $validation = $this->app->validate($data);
        if ($validation !== true) {
            return $validation;
        }

        if (!empty($input['persetujuan'])) {
            if (!empty($cek->persetujuan)) {
                unlink(FCPATH . 'cdn/vendor/skripsi/persetujuan/' . $cek->persetujuan);
            }
            $upload_persetujuan = $this->fileupload->upload($input['persetujuan'], 'cdn/vendor/skripsi/persetujuan/');
            if (!$upload_persetujuan['status']) {
                return ['error' => true, 'message' => $upload_persetujuan['error']];
            }
            $data['persetujuan'] = $upload_persetujuan['file_name'];
        } else {
            $data['persetujuan'] = $cek->persetujuan;
        }

        if (!empty($input['file_skripsi'])) {
            if (!empty($cek->file_skripsi)) {
                unlink(FCPATH . 'cdn/vendor/skripsi/file_skripsi/' . $cek->file_skripsi);
            }
            $upload_file_skripsi = $this->fileupload->upload($input['file_skripsi'], 'cdn/vendor/skripsi/file_skripsi/');
            if (!$upload_file_skripsi['status']) {
                return ['error' => true, 'message' => $upload_file_skripsi['error']];
            }
            $data['file_skripsi'] = $upload_file_skripsi['file_name'];
        } else {
            $data['file_skripsi'] = $cek->file_skripsi;
        }

        if (!empty($input['sk_tim'])) {
            if (!empty($cek->sk_tim)) {
                unlink(FCPATH . 'cdn/vendor/skripsi/sk_tim/' . $cek->sk_tim);
            }
            $upload_sk_tim = $this->fileupload->upload($input['sk_tim'], 'cdn/vendor/skripsi/sk_tim/');
            if (!$upload_sk_tim['status']) {
                return ['error' => true, 'message' => $upload_sk_tim['error']];
            }
            $data['sk_tim'] = $upload_sk_tim['file_name'];
        } else {
            $data['sk_tim'] = $cek->sk_tim;
        }

        if (!empty($input['bukti_konsultasi'])) {
            if (!empty($cek->bukti_konsultasi)) {
                unlink(FCPATH . 'cdn/vendor/skripsi/bukti_konsultasi/' . $cek->bukti_konsultasi);
            }
            $upload_bukti_konsultasi = $this->fileupload->upload($input['bukti_konsultasi'], 'cdn/vendor/skripsi/bukti_konsultasi/');
            if (!$upload_bukti_konsultasi['status']) {
                return ['error' => true, 'message' => $upload_bukti_konsultasi['error']];
            }
            $data['bukti_konsultasi'] = $upload_bukti_konsultasi['file_name'];
        } else {
            $data['bukti_konsultasi'] = $cek->bukti_konsultasi;
        }

        if ($this->db->update($this->table, $data, $kondisi)) {
            return [
                'error' => false,
                'message' => 'Data berhasil diperbarui'
            ];
        }

        return ['error' => true, 'message' => 'Gagal memperbarui data.'];
    }


    public function destroy($id)
    {
        $kondisi = [
            'id' => $id
        ];

        $skripsi = $this->db->get_where($this->table, $kondisi)->row_array();

        if ($skripsi) {
            unlink(FCPATH . 'cdn/vendor/skripsi/file_skripsi/' . $skripsi['file_skripsi']);
            unlink(FCPATH . 'cdn/vendor/skripsi/sk_tim/' . $skripsi['sk_tim']);
            unlink(FCPATH . 'cdn/vendor/skripsi/persetujuan/' . $skripsi['persetujuan']);
            unlink(FCPATH . 'cdn/vendor/skripsi/bukti_konsultasi/' . $skripsi['bukti_konsultasi']);
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

    public function agree($id)
    {
        $kondisi = ['skripsi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        $email = '';
        $dskripsi = $this->db->get_where('skripsi_vl', array('id' => $id))->result();
        foreach ($dskripsi as $ds) {
            $email = $ds->email;
        }

        if ($cek > 00) {
            if ($this->db->update($this->table, ['status' => "1"], $kondisi)) {
                $isi_email = '
                    <p>Seminar akhir / skripsi anda telah disetujui</p>
                    ';
                $this->emailm->send('Seminar Akhir Disetujui', $email, $isi_email);

                $hasil = [
                    'error' => false,
                    'message' => "skripsi berhasil disetujui"
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
        $kondisi = ['skripsi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi);

        $email = '';
        $dskripsi = $this->db->get_where('skripsi_vl', array('id' => $id))->result();
        foreach ($dskripsi as $ds) {
            $email = $ds->email;
        }
        if ($cek > 00) {
            if ($this->db->update($this->table, ['status' => "0"], $kondisi)) {
                $isi_email = '
                    <p>Seminar akhir / skripsi anda ditolak</p>
                    ';
                $this->emailm->send('Seminar Akhir Ditolak', $email, $isi_email);

                $hasil = [
                    'error' => false,
                    'message' => "skripsi batal disetujui"
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

    public function details($id)
    {
        return $this->db->get_where('skripsi_vl', array('id' => $id))->row_array();
    }
}

/* End of file skripsi_model.php */
/* Location: ./application/models/skripsi_model.php */