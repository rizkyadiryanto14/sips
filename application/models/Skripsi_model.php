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

        if (empty($periode_aktif)) {
            return [
                'error' => true,
                'message' => 'Tidak ada periode aktif yang ditemukan',
                'data' => []
            ];
        }

        // Simpan id_periode dari periode aktif ke dalam kondisi
        $kondisi['skripsi_vl.id_periode'] = $periode_aktif['id'];

        // Tambahkan kondisi untuk mahasiswa_id jika diberikan
        if (!empty($input['mahasiswa_id'])) {
            $kondisi['skripsi_vl.mahasiswa_id'] = $input['mahasiswa_id'];
        }

        // Terapkan kondisi untuk query
        $this->db->where($kondisi);

        // Eksekusi query dan ambil hasilnya
        $skripsi = $this->db->get('skripsi_vl')->result_array();

        // Format hasil untuk output
        $hasil = [
            'error' => false,
            'message' => ($skripsi) ? "data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $skripsi,
        ];

        return $hasil;
    }


    public function admin_index($input)
    {
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

        // Terapkan filter berdasarkan id_periode dari periode yang aktif
        $this->db->where('skripsi_vl.id_periode', $periode_aktif['id']);

        // Eksekusi query dan ambil hasilnya
        $skripsi = $this->db->get('skripsi_vl')->result_array();

        // Format hasil untuk output
        $hasil = [
            'error' => false,
            'message' => ($skripsi) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $skripsi,
        ];

        return $hasil;
    }


    public function create($input)
    {
        // Ambil tahun sekarang
        $tahun_sekarang = date('Y');

        // Cari ID periode berdasarkan tahun sekarang
        $this->db->select('id');
        $this->db->from('periode');
        $this->db->where('periode', $tahun_sekarang);
        $this->db->where('status', 1); // Anda bisa mengubah ini sesuai kondisi status yang dibutuhkan
        $periode = $this->db->get()->row();

        if (!$periode) {
            // Jika tidak ada data periode yang cocok, kembalikan error
            return [
                'error' => true,
                'message' => 'Periode untuk tahun ' . $tahun_sekarang . ' tidak ditemukan atau belum aktif.'
            ];
        }

        $data = [
            'judul_skripsi' => $input['judul_skripsi'],
            'mahasiswa_id' => $input['mahasiswa_id'],
            'persetujuan' => $input['persetujuan'],
            'file_skripsi' => $input['file_skripsi'],
            'sk_tim' => $input['sk_tim'],
            'bukti_konsultasi' => $input['bukti_konsultasi'],
            'id_periode'    => $periode->id
        ];

        $validation = $this->app->validate($data);

        if ($validation === true) {
            $file_nama = date('Ymdhis') . '.pdf';

            // upload base64 file_skripsi
            $persetujuan_file = explode(';base64,', $data['persetujuan'])[1];
            file_put_contents(FCPATH . 'cdn/vendor/skripsi/persetujuan/' . $file_nama, base64_decode($persetujuan_file));
            $data['persetujuan'] = $file_nama;

            // upload base64 file_skripsi
            $file_skripsi_file = explode(';base64,', $data['file_skripsi'])[1];
            file_put_contents(FCPATH . 'cdn/vendor/skripsi/file_skripsi/' . $file_nama, base64_decode($file_skripsi_file));
            $data['file_skripsi'] = $file_nama;

            // upload sk_tim
            $sk_tim_file = explode(';base64,', $data['sk_tim'])[1];
            file_put_contents(FCPATH . 'cdn/vendor/skripsi/sk_tim/' . $file_nama, base64_decode($sk_tim_file));
            $data['sk_tim'] = $file_nama;

            // upload base64 file_skripsi
            $bukti_konsultasi_file = explode(';base64,', $data['bukti_konsultasi'])[1];
            file_put_contents(FCPATH . 'cdn/vendor/skripsi/bukti_konsultasi/' . $file_nama, base64_decode($bukti_konsultasi_file));
            $data['bukti_konsultasi'] = $file_nama;

            if ($this->db->insert('skripsi', $data)) {
                $data_id = $this->db->insert_id();

                $hasil = [
                    'error' => false,
                    'message' => "data berhasil ditambahkan",
                    'data_id' => $data_id
                ];
            }
        } else {
            $hasil = $validation;
        }

        return $hasil;
    }

    public function update($input, $id)
    {
        $data = [
            'mahasiswa_id' => $input['mahasiswa_id'],
            'judul_skripsi' => $input['judul_skripsi'],
        ];

        $kondisi = ['skripsi.id' => $id];
        $cek = $this->db->get_where($this->table, $kondisi)->num_rows();

        if ($cek > 0) {
            $validate = $this->app->validate($data);
            if ($validate === true) {

                if ($input['persetujuan'] != '') {
                    unlink(FCPATH . 'cdn/vendor/skripsi/persetujuan/' . $input['def_persetujuan']);
                    $file_nama = date('Ymdhis') . '.pdf';
                    // upload base64 persetujuan
                    $persetujuan_file = explode(';base64,', $input['persetujuan'])[1];
                    file_put_contents(FCPATH . 'cdn/vendor/skripsi/persetujuan/' . $file_nama, base64_decode($persetujuan_file));
                    $data['persetujuan'] = $file_nama;
                }
                if ($input['file_skripsi'] != '') {
                    unlink(FCPATH . 'cdn/vendor/skripsi/file_skripsi/' . $input['def_file_skripsi']);
                    $file_nama = date('Ymdhis') . '.pdf';
                    // upload base64 file_skripsi 
                    $file_skripsi_file = explode(';base64,', $input['file_skripsi'])[1];
                    file_put_contents(FCPATH . 'cdn/vendor/skripsi/file_skripsi/' . $file_nama, base64_decode($file_skripsi_file));
                    $data['file_skripsi'] = $file_nama;
                }
                if ($input['sk_tim'] != '') {
                    unlink(FCPATH . 'cdn/vendor/skripsi/sk_tim/' . $input['def_sk_tim']);
                    $file_nama = date('Ymdhis') . '.pdf';
                    // upload base64 sk_tim
                    $sk_tim_file = explode(';base64,', $input['sk_tim'])[1];
                    file_put_contents(FCPATH . 'cdn/vendor/skripsi/sk_tim/' . $file_nama, base64_decode($sk_tim_file));
                    $data['sk_tim'] = $file_nama;
                }
                if ($input['bukti_konsultasi'] != '') {
                    unlink(FCPATH . 'cdn/vendor/skripsi/bukti_konsultasi/' . $input['def_bukti_konsultasi']);
                    $file_nama = date('Ymdhis') . '.pdf';
                    // upload base64 bukti_konsultasi
                    $bukti_konsultasi_file = explode(';base64,', $input['bukti_konsultasi'])[1];
                    file_put_contents(FCPATH . 'cdn/vendor/skripsi/bukti_konsultasi/' . $file_nama, base64_decode($bukti_konsultasi_file));
                    $data['bukti_konsultasi'] = $file_nama;
                }

                $this->db->update($this->table, $data, $kondisi);
                $hasil = [
                    'error' => false,
                    'message' => "data berhasil diedit",
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
}

/* End of file skripsi_model.php */
/* Location: ./application/models/skripsi_model.php */