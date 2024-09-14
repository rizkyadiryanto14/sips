<?php

/**
 * @property $db
 */

class PengujianSempro_model extends CI_Model
{
    protected string $table = 'pengujian_sempro';

    /**
     * @return array
     */
    public function get():array
    {
        $this->db->select("*");
        $pengujian_sempro = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($pengujian_sempro) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $pengujian_sempro;

        return $hasil;
    }

    public function listing_sempro($id_dosen): array
    {
        $this->db->select('
        seminar_view.id AS seminar_id,
        seminar_view.*,
        mahasiswa.nama AS nama_mahasiswa,
        mahasiswa.nim AS mahasiswa_nim,
        proposal_mahasiswa.judul AS judul_proposal,
        dosen_penguji_1.nama AS nama_dosen_penguji_1,
        dosen_penguji_2.nama AS nama_dosen_penguji_2,
        dosen_pembimbing_1.nama AS nama_dosen_pembimbing_1,
        dosen_pembimbing_2.nama AS nama_dosen_pembimbing_2,
        pengujian_sempro.id_dosen AS dosen_nilai_id,
        pengujian_sempro.status AS status_pengujian
    ');
        $this->db->from('seminar_view');
        $this->db->join('proposal_mahasiswa', 'seminar_view.proposal_mahasiswa_id = proposal_mahasiswa.id', 'left');
        $this->db->join('mahasiswa', 'seminar_view.mahasiswa_id = mahasiswa.id', 'left');
        $this->db->join('dosen as dosen_penguji_1', 'seminar_view.dosen_penguji_1 = dosen_penguji_1.id', 'left');
        $this->db->join('dosen as dosen_penguji_2', 'seminar_view.dosen_penguji_2 = dosen_penguji_2.id', 'left');
        $this->db->join('dosen as dosen_pembimbing_1', 'seminar_view.dosen_pembimbing_1 = dosen_pembimbing_1.id', 'left');
        $this->db->join('dosen as dosen_pembimbing_2', 'seminar_view.dosen_pembimbing_2 = dosen_pembimbing_2.id', 'left');
        $this->db->join('pengujian_sempro', 'pengujian_sempro.id_sempro = seminar_view.id AND pengujian_sempro.id_dosen = ' . $id_dosen, 'left');
        $this->db->group_start();
        $this->db->where('seminar_view.dosen_penguji_1', $id_dosen);
        $this->db->or_where('seminar_view.dosen_penguji_2', $id_dosen);
        $this->db->or_where('seminar_view.dosen_pembimbing_1', $id_dosen);
        $this->db->or_where('seminar_view.dosen_pembimbing_2', $id_dosen);
        $this->db->group_end();

        $result = $this->db->get()->result();

        $hasil['error'] = false;
        $hasil['message'] = ($result) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $result;

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
            'id_sempro'             => $input['id_sempro'],
            'id_dosen'              => $input['id_dosen'],
            'presentasi'            => $input['presentasi'],
            'alat_bantu'            => $input['alat_bantu'],
            'penampilan'            => $input['penampilan'],
            'penguasaan_materi'     => $input['penguasaan_materi'],
            'kelayakan_proposal'    => $input['kelayakan_proposal'],
            'status'                => 1,
            'id_periode'            => $periode->id
        ];

        // Validasi data sebelum insert
        $validate = $this->app->validate($data);

        if ($validate === true) {
            // Simpan data ke database
            $this->db->insert($this->table, $data);
            $hasil = [
                'error' => false,
                'message' => 'Data berhasil ditambah',
                'data_id' => $this->db->insert_id()
            ];

            // Cek apakah sudah ada 3 dosen yang memberikan nilai
            $pengujian_data = $this->cek_dosen_menilai($input['id_sempro']);

            // Kembalikan informasi ke controller jika 3 dosen sudah memberikan nilai
            if (count($pengujian_data) == 3) {
                // Beri tanda bahwa pengiriman email harus dilakukan
                $hasil['send_email'] = true;
            } else {
                $hasil['send_email'] = false;
            }

        } else {
            // Jika validasi gagal
            $hasil = $validate;
        }

        return $hasil;
    }

    // Fungsi untuk mengambil detail sempro
    public function details_sempro($id)
    {
        $this->db->select('
            seminar.id,
            seminar.proposal_mahasiswa_id,
            seminar.tanggal,
            seminar.jam_mulai,
            seminar.jam_selesai,
            seminar.tempat,
            seminar.persetujuan,
            seminar.file_proposal,
            seminar.sk_tim,
            seminar.bukti_konsultasi,
            proposal_mahasiswa.judul as proposal_mahasiswa_judul,
            mahasiswa.id as mahasiswa_id,
            mahasiswa.nama as mahasiswa_nama,
            mahasiswa.email
        ');

        $this->db->from('seminar');
        $this->db->join('proposal_mahasiswa', 'proposal_mahasiswa.id = seminar.proposal_mahasiswa_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id = proposal_mahasiswa.mahasiswa_id', 'left');
        $this->db->where('seminar.id', $id);

        $seminar = $this->db->get()->row_array();

        $hasil = [
            'error' => !$seminar,
            'message' => ($seminar) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $seminar
        ];

        if ($hasil['data']) {
            $hasil['data']['hasil'] = $this->db->get_where('hasil_seminar', ['seminar_id' => $hasil['data']['id']])->row_array();
        }

        return $hasil;
    }

    public function cek_dosen_menilai($id_sempro)
    {
        $this->db->select('*');
        $this->db->from('pengujian_sempro');
        $this->db->where('id_sempro', $id_sempro);
        $this->db->where('status', 1);
        $result = $this->db->get()->result_array();

        return $result;
    }


    public function get_berita_acara($id_sempro)
    {
        $this->db->select('
        pengujian_sempro.id_pengujian,
        mahasiswa.nama AS nama_mahasiswa, 
        mahasiswa.nim, 
        mahasiswa.tempat_lahir,
        mahasiswa.tanggal_lahir,
        proposal_mahasiswa.judul AS proposal_mahasiswa_judul, 
        proposal_mahasiswa_v.nama_prodi, 
        dosen_penguji_1.nama AS penguji1_nama, 
        dosen_penguji_1.nip AS penguji1_nip,
        dosen_penguji_1.qr_code AS penguji1_barcode,
        dosen_penguji_2.nama AS penguji2_nama, 
        dosen_penguji_2.nip AS penguji2_nip,
        dosen_penguji_2.qr_code AS penguji2_barcode,
        dosen_pembimbing_1.nama AS pembimbing_nama, 
        dosen_pembimbing_1.nip AS pembimbing_nip,
        dosen_pembimbing_1.qr_code AS pembimbing_barcode,
        penguji1.presentasi AS penguji1_presentasi,
        penguji1.alat_bantu AS penguji1_alat_bantu,
        penguji1.penampilan AS penguji1_penampilan,
        penguji1.penguasaan_materi AS penguji1_penguasaan_materi,
        penguji1.kelayakan_proposal AS penguji1_kelayakan_proposal,
        penguji2.presentasi AS penguji2_presentasi,
        penguji2.alat_bantu AS penguji2_alat_bantu,
        penguji2.penampilan AS penguji2_penampilan,
        penguji2.penguasaan_materi AS penguji2_penguasaan_materi,
        penguji2.kelayakan_proposal AS penguji2_kelayakan_proposal,
        pembimbing.presentasi AS pembimbing_presentasi,
        pembimbing.alat_bantu AS pembimbing_alat_bantu,
        pembimbing.penampilan AS pembimbing_penampilan,
        pembimbing.penguasaan_materi AS pembimbing_penguasaan_materi,
        pembimbing.kelayakan_proposal AS pembimbing_kelayakan_proposal,
        seminar_view.tanggal, 
        seminar_view.jam_mulai,
        seminar_view.jam_selesai, 
        seminar_view.tempat
    ');

        $this->db->from('pengujian_sempro');
        $this->db->join('seminar_view', 'pengujian_sempro.id_sempro = seminar_view.id', 'left');
        $this->db->join('mahasiswa', 'seminar_view.mahasiswa_id = mahasiswa.id', 'left');
        $this->db->join('proposal_mahasiswa', 'seminar_view.proposal_mahasiswa_id = proposal_mahasiswa.id', 'left');
        $this->db->join('proposal_mahasiswa_v', 'proposal_mahasiswa.id = proposal_mahasiswa_v.id', 'left');
        $this->db->join('dosen as dosen_penguji_1', 'seminar_view.dosen_penguji_1 = dosen_penguji_1.id', 'left');
        $this->db->join('dosen as dosen_penguji_2', 'seminar_view.dosen_penguji_2 = dosen_penguji_2.id', 'left');
        $this->db->join('dosen as dosen_pembimbing_1', 'seminar_view.dosen_pembimbing_1 = dosen_pembimbing_1.id', 'left');
        $this->db->join('pengujian_sempro as penguji1', 'penguji1.id_sempro = seminar_view.id AND penguji1.id_dosen = seminar_view.dosen_penguji_1', 'left');
        $this->db->join('pengujian_sempro as penguji2', 'penguji2.id_sempro = seminar_view.id AND penguji2.id_dosen = seminar_view.dosen_penguji_2', 'left');
        $this->db->join('pengujian_sempro as pembimbing', 'pembimbing.id_sempro = seminar_view.id AND pembimbing.id_dosen = seminar_view.dosen_pembimbing_1', 'left');

        $this->db->where('pengujian_sempro.id_sempro', $id_sempro);

        $result = $this->db->get()->row_array();

        if ($result) {

            $result['penguji1_jumlah_rata_nilai'] = $result['penguji1_presentasi'] + $result['penguji1_alat_bantu'] + $result['penguji1_penampilan'] + $result['penguji1_penguasaan_materi'] + $result['penguji1_kelayakan_proposal'];

            $result['penguji1_rata_nilai'] = $result['penguji1_jumlah_rata_nilai'] / 5;

            $result['penguji2_jumlah_rata_nilai'] = $result['penguji2_presentasi'] + $result['penguji2_alat_bantu'] + $result['penguji2_penampilan'] + $result['penguji2_penguasaan_materi'] + $result['penguji2_kelayakan_proposal'];

            $result['penguji2_rata_nilai'] = $result['penguji2_jumlah_rata_nilai'] / 5;

            $result['pembimbing_jumlah_rata_nilai'] = $result['pembimbing_presentasi'] + $result['pembimbing_alat_bantu'] + $result['pembimbing_penampilan'] + $result['pembimbing_penguasaan_materi'] + $result['pembimbing_kelayakan_proposal'];

            $result['pembimbing_rata_nilai'] = $result['pembimbing_jumlah_rata_nilai'] / 5;

            $result['total_rata_rata'] = ($result['penguji1_rata_nilai'] + $result['penguji2_rata_nilai'] + $result['pembimbing_rata_nilai']) / 3;

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

}