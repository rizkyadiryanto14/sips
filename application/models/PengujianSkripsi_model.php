<?php

/**
 * @property $db
 */
class PengujianSkripsi_model extends CI_Model
{
    protected string $table = 'pengujian_skripsi';

    /**
     * @return array
     */
    public function get():array
    {
        $this->db->select("*");
        $pengujian_skripsi = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($pengujian_skripsi) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $pengujian_skripsi;

        return $hasil;
    }

    public function listing_skripsi($id_dosen): array
    {
        $this->db->select('
        skripsi_v.nim AS nim,
        skripsi_v.nama_prodi AS nama_prodi,
        skripsi_v.nama_mahasiswa AS nama_mahasiswa,
        skripsi_v.id AS id,
        skripsi.id AS id_skripsi,
        skripsi_v.judul_skripsi AS judul_skripsi,
        skripsi_v.dosen_id AS dosen_id,
        skripsi_v.dosen2_id AS dosen2_id,
        skripsi_v.dosen_penguji_id AS dosen_penguji_id,
        skripsi_v.dosen_penguji_id2 AS dosen_penguji_id2,
        skripsi_v.sk_tim AS sk_tim,
        skripsi_v.mahasiswa_id AS mahasiswa_id,
        pembimbing1.nama AS nama_pembimbing1,
        pembimbing2.nama AS nama_pembimbing2,
        penguji1.nama AS nama_penguji1,
        penguji2.nama AS nama_penguji2,
        skripsi_v.jadwal_skripsi AS jadwal_skripsi,
        skripsi_v.tempat AS tempat,
        skripsi_v.file_skripsi AS file_skripsi,
        skripsi_v.status AS status,
        skripsi_v.persetujuan AS persetujuan,
        skripsi_v.bukti_konsultasi AS bukti_konsultasi,
        skripsi_v.email AS email,
        skripsi_v.created_at AS created_at,
        skripsi_v.id_periode AS id_periode,
        pengujian_skripsi.id_dosen AS dosen_nilai_id,
        pengujian_skripsi.status AS status_pengujian
    ');

        $this->db->from('skripsi_v');
        $this->db->join('skripsi', 'skripsi_v.mahasiswa_id = skripsi.mahasiswa_id', 'left');
        $this->db->join('dosen AS pembimbing1', 'skripsi_v.dosen_id = pembimbing1.id', 'left');
        $this->db->join('dosen AS pembimbing2', 'skripsi_v.dosen2_id = pembimbing2.id', 'left');
        $this->db->join('dosen AS penguji1', 'skripsi_v.dosen_penguji_id = penguji1.id', 'left');
        $this->db->join('dosen AS penguji2', 'skripsi_v.dosen_penguji_id2 = penguji2.id', 'left');
        $this->db->join('pengujian_skripsi', 'pengujian_skripsi.id_skripsi = skripsi.id AND pengujian_skripsi.id_dosen = ' . $id_dosen, 'left');

        $this->db->group_start();
        $this->db->where('skripsi_v.dosen_id', $id_dosen);
        $this->db->or_where('skripsi_v.dosen2_id', $id_dosen);
        $this->db->or_where('skripsi_v.dosen_penguji_id', $id_dosen);
        $this->db->or_where('skripsi_v.dosen_penguji_id2', $id_dosen);
        $this->db->group_end();

        $result = $this->db->get()->result();

        $hasil['error'] = false;
        $hasil['message'] = ($result) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $result;

        return $hasil;
    }

    public function get_berita_acara($id_skripsi)
    {
        $this->db->select('
        skripsi_v.nim AS nim,
        skripsi_v.nama_mahasiswa AS nama_mahasiswa,
        skripsi_v.nama_prodi AS nama_prodi,
        skripsi_v.id AS id_skripsi,
        skripsi_v.judul_skripsi AS judul_skripsi,
        skripsi_v.dosen_id AS dosen_id,
        skripsi_v.dosen2_id AS dosen2_id,
        skripsi_v.dosen_penguji_id AS dosen_penguji_id,
        skripsi_v.dosen_penguji_id2 AS dosen_penguji_id2,
        skripsi_v.jadwal_skripsi AS jadwal_skripsi,
        skripsi_v.tempat AS tempat_skripsi,
        dosen_pembimbing1.nama AS nama_pembimbing1,
        dosen_pembimbing1.nip AS nip_pembimbing1,
        dosen_pembimbing1.qr_code AS barcode_pembimbing1,
        dosen_pembimbing2.nama AS nama_pembimbing2,
        dosen_pembimbing2.nip AS nip_pembimbing2,
        dosen_pembimbing2.qr_code AS barcode_pembimbing2,
        dosen_penguji1.nama AS nama_penguji1,
        dosen_penguji1.nip AS nip_penguji1,
        dosen_penguji1.qr_code AS barcode_penguji1,
        dosen_penguji2.nama AS nama_penguji2,
        dosen_penguji2.nip AS nip_penguji2,
        dosen_penguji2.qr_code AS barcode_penguji2,
        
        pengujian1.pokok_permasalahan AS penguji1_pokok_permasalahan,
        pengujian2.pokok_permasalahan AS penguji2_pokok_permasalahan,
        pengujian_pembimbing1.pokok_permasalahan AS pembimbing1_pokok_permasalahan,
        pengujian_pembimbing2.pokok_permasalahan AS pembimbing2_pokok_permasalahan,
        
        pengujian1.kerangka_pemikiran AS penguji1_kerangka_pemikiran,
        pengujian2.kerangka_pemikiran AS penguji2_kerangka_pemikiran,
        pengujian_pembimbing1.kerangka_pemikiran AS pembimbing1_kerangka_pemikiran,
        pengujian_pembimbing2.kerangka_pemikiran AS pembimbing2_kerangka_pemikiran,
        
        pengujian1.metode_penelitian AS penguji1_metode_penelitian,
        pengujian2.metode_penelitian AS penguji2_metode_penelitian,
        pengujian_pembimbing1.metode_penelitian AS pembimbing1_metode_penelitian,
        pengujian_pembimbing2.metode_penelitian AS pembimbing2_metode_penelitian,
        
        pengujian1.hasil_penelitian AS penguji1_hasil_penelitian,
        pengujian2.hasil_penelitian AS penguji2_hasil_penelitian,
        pengujian_pembimbing1.hasil_penelitian AS pembimbing1_hasil_penelitian,
        pengujian_pembimbing2.hasil_penelitian AS pembimbing2_hasil_penelitian,
        
        pengujian1.bahasa AS penguji1_bahasa,
        pengujian2.bahasa AS penguji2_bahasa,
        pengujian_pembimbing1.bahasa AS pembimbing1_bahasa,
        pengujian_pembimbing2.bahasa AS pembimbing2_bahasa,
        
        pengujian1.teknik_penulisan AS penguji1_teknik_penulisan,
        pengujian2.teknik_penulisan AS penguji2_teknik_penulisan,
        pengujian_pembimbing1.teknik_penulisan AS pembimbing1_teknik_penulisan,
        pengujian_pembimbing2.teknik_penulisan AS pembimbing2_teknik_penulisan,
        
        pengujian1.manfaat_akademis_praktis AS penguji1_manfaat_akademis_praktis,
        pengujian2.manfaat_akademis_praktis AS penguji2_manfaat_akademis_praktis,
        pengujian_pembimbing1.manfaat_akademis_praktis AS pembimbing1_manfaat_akademis_praktis,
        pengujian_pembimbing2.manfaat_akademis_praktis AS pembimbing2_manfaat_akademis_praktis,
        
        pengujian1.penguasaan_materi AS penguji1_penguasaan_materi,
        pengujian2.penguasaan_materi AS penguji2_penguasaan_materi,
        pengujian_pembimbing1.penguasaan_materi AS pembimbing1_penguasaan_materi,
        pengujian_pembimbing2.penguasaan_materi AS pembimbing2_penguasaan_materi,
        
        pengujian1.penguasaan_metode AS penguji1_penguasaan_metode,
        pengujian2.penguasaan_metode AS penguji2_penguasaan_metode,
        pengujian_pembimbing1.penguasaan_metode AS pembimbing1_penguasaan_metode,
        pengujian_pembimbing2.penguasaan_metode AS pembimbing2_penguasaan_metode,
        
        pengujian1.kemampuan_argumentasi AS penguji1_kemampuan_argumentasi,
        pengujian2.kemampuan_argumentasi AS penguji2_kemampuan_argumentasi,
        pengujian_pembimbing1.kemampuan_argumentasi AS pembimbing1_kemampuan_argumentasi,
        pengujian_pembimbing2.kemampuan_argumentasi AS pembimbing2_kemampuan_argumentasi,
        
        pengujian1.nilai_rata_rata AS penguji1_nilai_rata_rata,
        pengujian2.nilai_rata_rata AS penguji2_nilai_rata_rata,
        pengujian_pembimbing1.nilai_rata_rata AS pembimbing1_nilai_rata_rata,
        pengujian_pembimbing2.nilai_rata_rata AS pembimbing2_nilai_rata_rata,
        
        pengujian1.jumlah AS penguji1_jumlah,
        pengujian2.jumlah AS penguji2_jumlah,
        pengujian_pembimbing1.jumlah AS pembimbing1_jumlah,
        pengujian_pembimbing2.jumlah AS pembimbing2_jumlah
    ');

        $this->db->from('pengujian_skripsi');
        $this->db->join('skripsi_v', 'pengujian_skripsi.id_skripsi = skripsi_v.id', 'left');
        $this->db->join('dosen AS dosen_pembimbing1', 'skripsi_v.dosen_id = dosen_pembimbing1.id', 'left');
        $this->db->join('dosen AS dosen_pembimbing2', 'skripsi_v.dosen2_id = dosen_pembimbing2.id', 'left');
        $this->db->join('dosen AS dosen_penguji1', 'skripsi_v.dosen_penguji_id = dosen_penguji1.id', 'left');
        $this->db->join('dosen AS dosen_penguji2', 'skripsi_v.dosen_penguji_id2 = dosen_penguji2.id', 'left');
        $this->db->join('pengujian_skripsi AS pengujian1', 'pengujian1.id_skripsi = skripsi_v.id AND pengujian1.id_dosen = skripsi_v.dosen_penguji_id', 'left');
        $this->db->join('pengujian_skripsi AS pengujian2', 'pengujian2.id_skripsi = skripsi_v.id AND pengujian2.id_dosen = skripsi_v.dosen_penguji_id2', 'left');
        $this->db->join('pengujian_skripsi AS pengujian_pembimbing1', 'pengujian_pembimbing1.id_skripsi = skripsi_v.id AND pengujian_pembimbing1.id_dosen = skripsi_v.dosen_id', 'left');
        $this->db->join('pengujian_skripsi AS pengujian_pembimbing2', 'pengujian_pembimbing2.id_skripsi = skripsi_v.id AND pengujian_pembimbing2.id_dosen = skripsi_v.dosen2_id', 'left');
        $this->db->where('pengujian_skripsi.id_skripsi', $id_skripsi);

        $result = $this->db->get()->row_array();

        // Perhitungan nilai
        if ($result) {

            $penguji1_rata_nilai = $result['penguji1_nilai_rata_rata'];
            $penguji2_rata_nilai = $result['penguji2_nilai_rata_rata'];
            $pembimbing1_rata_nilai = $result['pembimbing1_nilai_rata_rata'];
            $pembimbing2_rata_nilai = $result['pembimbing2_nilai_rata_rata'];
            $result['total_rata_rata'] = (($penguji1_rata_nilai + $penguji2_rata_nilai) / 2 + $pembimbing1_rata_nilai) / 2;

            // Cari predikat
            $this->db->select('nama_predikat, keterangan');
            $this->db->from('predikat_penilaian');
            $this->db->where('nilai_minimum <=', $result['total_rata_rata']);
            $this->db->where('nilai_maximum >=', $result['total_rata_rata']);
            $predikat = $this->db->get()->row_array();

            if ($predikat) {
                $result['nama_predikat'] = $predikat['nama_predikat'];
                $result['keterangan'] = $predikat['keterangan'];
            }
        }

        return $result;
    }

    public function create($input)
    {
        // Ambil tahun sekarang
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

        $penguasaan_materi = !empty($input['penguasaan_materi']) ? $input['penguasaan_materi'] : ' ';
        $penguasaan_metode = !empty($input['penguasaan_metode']) ? $input['penguasaan_metode'] : ' ';
        $kemampuan_argumentasi = !empty($input['kemampuan_argumentasi']) ? $input['kemampuan_argumentasi'] : ' ';

        $data = [
            'id_skripsi' => $input['id_skripsi'],
            'id_dosen' => $input['id_dosen'],
            'pokok_permasalahan' => $input['pokok_permasalahan'],
            'kerangka_pemikiran' => $input['kerangka_pemikiran'],
            'metode_penelitian' => $input['metode_penelitian'],
            'hasil_penelitian' => $input['hasil_penelitian'],
            'bahasa' => $input['bahasa'],
            'teknik_penulisan' => $input['teknik_penulisan'],
            'manfaat_akademis_praktis' => $input['manfaat_akademis_praktis'],
            'penguasaan_materi' => $penguasaan_materi,
            'penguasaan_metode' => $penguasaan_metode,
            'kemampuan_argumentasi' => $kemampuan_argumentasi,
            'nilai_rata_rata' => $input['nilai_rata_rata'],
            'jumlah' => $input['total_nilai'],
            'id_periode' => $periode->id,
            'status' => 1
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $this->db->insert($this->table, $data);

            $hasil = [
                'error' => false,
                'message' => 'Data berhasil ditambah',
                'data_id' => $this->db->insert_id()
            ];

            // Cek apakah sudah ada 3 dosen yang memberikan nilai
            $pengujian_data = $this->cek_dosen_menilai($input['id_skripsi']);

            // Kembalikan informasi ke controller jika 3 dosen sudah memberikan nilai
            if (count($pengujian_data) == 3) {
                // Beri tanda bahwa pengiriman email harus dilakukan
                $hasil['send_email'] = true;
            } else {
                $hasil['send_email'] = false;
            }

        } else {
            $hasil = $validate;
        }
        return $hasil;
    }

    public function details_skripsi($id)
    {
        return $this->db->get_where('skripsi_vl', ['id' => $id])->row_array();
    }

    // Fungsi untuk mengecek jumlah dosen yang sudah memberikan nilai
    public function cek_dosen_menilai($id_sempro)
    {
        $this->db->select('*');
        $this->db->from('pengujian_skripsi');
        $this->db->where('id_skripsi', $id_sempro);
        $this->db->where('status', 1);  // Hanya dosen yang sudah memberi nilai
        $result = $this->db->get()->result_array();

        return $result;
    }
}