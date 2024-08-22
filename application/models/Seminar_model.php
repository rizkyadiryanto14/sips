<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seminar_model extends CI_Model
{

	protected $table = "seminar";

    public function index($input)
    {
        // Pilih kolom yang akan diambil dari tabel seminar dan proposal_mahasiswa_v
        $this->db->select('
        seminar.id AS id,
        seminar.proposal_mahasiswa_id AS proposal_mahasiswa_id,
        seminar.tanggal AS tanggal,
        seminar.jam_mulai AS jam_mulai,
        seminar.jam_selesai AS jam_selesai,
        seminar.tempat AS tempat,
        seminar.dosen_penguji_id AS dosen_penguji_1_id,
        dosen1.nama AS dosen_penguji_1_nama,
        seminar.dosen_penguji_id2 AS dosen_penguji_2_id,
        dosen2.nama AS dosen_penguji_2_nama,
        seminar.file_proposal AS file_proposal,
        seminar.bukti_konsultasi AS bukti_konsultasi,
        seminar.persetujuan AS persetujuan,
        seminar.sk_tim AS sk_tim,
        proposal_mahasiswa_v.judul AS proposal_mahasiswa_judul,
        proposal_mahasiswa_v.nama_mahasiswa AS nama_mahasiswa,
        proposal_mahasiswa_v.nim AS nim,
        proposal_mahasiswa_v.nama_prodi AS nama_prodi,
        proposal_mahasiswa_v.dosen_id AS dosen_pembimbing_1_id,
        dosen3.nama AS dosen_pembimbing_1_nama,
        proposal_mahasiswa_v.dosen2_id AS dosen_pembimbing_2_id,
        dosen4.nama AS dosen_pembimbing_2_nama
    ');

        // Join tabel seminar dengan tabel proposal_mahasiswa_v
        $this->db->from('seminar');
        $this->db->join('proposal_mahasiswa_v', 'seminar.proposal_mahasiswa_id = proposal_mahasiswa_v.id', 'left');

        // Join tabel dosen untuk dosen penguji 1
        $this->db->join('dosen AS dosen1', 'seminar.dosen_penguji_id = dosen1.id', 'left');

        // Join tabel dosen untuk dosen penguji 2
        $this->db->join('dosen AS dosen2', 'seminar.dosen_penguji_id2 = dosen2.id', 'left');

        // Join tabel dosen untuk dosen pembimbing 1
        $this->db->join('dosen AS dosen3', 'proposal_mahasiswa_v.dosen_id = dosen3.id', 'left');

        // Join tabel dosen untuk dosen pembimbing 2
        $this->db->join('dosen AS dosen4', 'proposal_mahasiswa_v.dosen2_id = dosen4.id', 'left');

        // Filter data berdasarkan mahasiswa_id jika diberikan
        if (isset($input['mahasiswa_id'])) {
            $this->db->where('proposal_mahasiswa_v.mahasiswa_id', $input['mahasiswa_id']);
        }

        // Eksekusi query dan ambil hasilnya
        $seminar = $this->db->get()->result_array();

        // Format hasil untuk output
        $hasil = [
            'error' => false,
            'message' => ($seminar) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $seminar,
        ];

        return $hasil;
    }


    public function create($input)
	{
		$data = [
			'proposal_mahasiswa_id' => $input['proposal_mahasiswa_id'],
			'file_proposal' => $input['file_proposal'],
			'sk_tim' => $input['sk_tim'],
			'persetujuan' => $input['persetujuan'],
			'bukti_konsultasi' => $input['bukti_konsultasi'],
		];

		$validation = $this->app->validate($data);

		if ($validation === true) {
			$file_nama = date('Ymdhis') . '.pdf';

			// upload base64 file_proposal
			$file_proposal_file = explode(';base64,', $data['file_proposal'])[1];
			file_put_contents(FCPATH . 'cdn/vendor/file_proposal/' . $file_nama, base64_decode($file_proposal_file));
			$data['file_proposal'] = $file_nama;

			// upload sk_tim
			$sk_tim_file = explode(';base64,', $data['sk_tim'])[1];
			file_put_contents(FCPATH . 'cdn/vendor/sk_tim/' . $file_nama, base64_decode($sk_tim_file));
			$data['sk_tim'] = $file_nama;

			$bukti_konsultasi_file = explode(';base64,', $data['bukti_konsultasi'])[1];
			file_put_contents(FCPATH . 'cdn/vendor/bukti_konsultasi/' . $file_nama, base64_decode($bukti_konsultasi_file));
			$data['bukti_konsultasi'] = $file_nama;

			$persetujuan_file = explode(';base64,', $data['persetujuan'])[1];
			file_put_contents(FCPATH . 'cdn/vendor/persetujuan/' . $file_nama, base64_decode($persetujuan_file));
			$data['persetujuan'] = $file_nama;

			$this->db->insert($this->table, $data);
			$data_id = $this->db->insert_id();
			$this->db->insert("hasil_seminar", [
				'seminar_id' => $data_id,
				'berita_acara' => "",
				'masukan' => "",
				'status' => '3'
			]);

			$hasil = [
				'error' => false,
				'message' => "data berhasil ditambahkan",
				'data_id' => $data_id
			];
		} else {
			$hasil = $validation;
		}

		return $hasil;
	}

	public function details($id)
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

		$this->db->from($this->table);
		$this->db->join('proposal_mahasiswa', 'proposal_mahasiswa.id = seminar.proposal_mahasiswa_id', 'left');
		$this->db->join('mahasiswa', 'mahasiswa.id = proposal_mahasiswa.mahasiswa_id', 'left');
		$this->db->where('seminar.id', $id);

		$seminar = $this->db->get()->row_array();

		$hasil = [
			'error' => ($seminar) ? false : true,
			'message' => ($seminar) ? "data berhasil ditemukan" : "data tidak tersedia",
			'data' => $seminar
		];

		if ($hasil['data']) {
			$hasil['data']['hasil'] = $this->db->get_where('hasil_seminar', ['seminar_id' => $hasil['data']['id']])->row_array();
		}

		return $hasil;
	}

	public function destroy($id)
	{
		$kondisi = [
			'id' => $id
		];

		$seminar = $this->db->get_where($this->table, $kondisi)->row_array();

		if ($seminar) {
			$hasil_seminar = $this->db->get_where('hasil_seminar', ['seminar_id' => $id])->result_array();
			foreach ($hasil_seminar as $key => $item) {
				if ($item['berita_acara']) {
					unlink(FCPATH . 'cdn/vendor/berita_acara/' . $item['berita_acara']);
				}
				if ($item['masukan']) {
					unlink(FCPATH . 'cdn/vendor/masukan/' . $item['masukan']);
				}
			}
			unlink(FCPATH . 'cdn/vendor/file_proposal/' . $seminar['file_proposal']);
			unlink(FCPATH . 'cdn/vendor/sk_tim/' . $seminar['sk_tim']);
			$this->db->delete("hasil_seminar", ['seminar_id' => $id]);
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
}

/* End of file Seminar_model.php */
/* Location: ./application/models/Seminar_model.php */