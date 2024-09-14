<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $cache
 * @property $fileupload
 *
 */

class Seminar_model extends CI_Model
{

	protected $table = "seminar";

    public function index($input)
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

        $id_periode = $periode_aktif['id'];

        $this->db->select('
        seminar.id AS id,
        seminar.proposal_mahasiswa_id AS proposal_mahasiswa_id,
        seminar.tanggal AS tanggal,
        seminar.jam_mulai AS jam_mulai,
        seminar.jam_selesai AS jam_selesai,
        seminar.tempat AS tempat,
        seminar.created_at AS created_at,
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

        $this->db->from('seminar');
        $this->db->join('proposal_mahasiswa_v', 'seminar.proposal_mahasiswa_id = proposal_mahasiswa_v.id', 'left');

        $this->db->join('dosen AS dosen1', 'seminar.dosen_penguji_id = dosen1.id', 'left');

        $this->db->join('dosen AS dosen2', 'seminar.dosen_penguji_id2 = dosen2.id', 'left');

        $this->db->join('dosen AS dosen3', 'proposal_mahasiswa_v.dosen_id = dosen3.id', 'left');

        $this->db->join('dosen AS dosen4', 'proposal_mahasiswa_v.dosen2_id = dosen4.id', 'left');

        if (isset($input['mahasiswa_id'])) {
            $this->db->where('proposal_mahasiswa_v.mahasiswa_id', $input['mahasiswa_id']);
        }

        if (isset($input['dosen_id'])) {
            $this->db->group_start()
                ->where('proposal_mahasiswa_v.dosen_id', $input['dosen_id'])
                ->or_where('proposal_mahasiswa_v.dosen2_id', $input['dosen_id'])
                ->group_end();
        }

        $this->db->where('proposal_mahasiswa_v.id_periode', $id_periode);

        $seminar = $this->db->get()->result_array();

        $hasil = [
            'error' => false,
            'message' => ($seminar) ? "Data berhasil ditemukan" : "Data tidak tersedia",
            'data' => $seminar,
        ];

        // Format tanggal menggunakan helper tgl_indo
        foreach ($hasil['data'] as $key => $item) {
            $hasil['data'][$key]['created_at'] = tgl_indo($item['created_at']);
            $hasil['data'][$key]['tanggal'] = tgl_indo($item['tanggal']);
        }

        return $hasil;
    }

    public function create($input)
    {
        $this->load->library('FileUpload');

        $this->load->driver('cache', array('adapter' => 'file', 'backup' => 'file'));

        $tahun_sekarang = date('Y');

        $periode = $this->cache->get('periode_' . $tahun_sekarang);

        if (!$periode) {
            $this->db->select('id');
            $this->db->from('periode');
            $this->db->where('periode', $tahun_sekarang);
            $this->db->where('status', 1);
            $periode = $this->db->get()->row();

            if ($periode) {
                $this->cache->save('periode_' . $tahun_sekarang, $periode, 3600);
            }
        }

        if (!$periode) {
            return [
                'error' => true,
                'message' => 'Periode untuk tahun ' . $tahun_sekarang . ' tidak ditemukan atau belum aktif.'
            ];
        }

        $data = [
            'proposal_mahasiswa_id' => $input['proposal_mahasiswa_id'],
            'id_periode' => $periode->id,
        ];

        $validation = $this->app->validate($data);

        if ($validation === true) {
            $upload_result = $this->handle_file_upload($input, $data);

            if ($upload_result['error']) {
                return $upload_result;
            }

            $this->db->insert($this->table, $upload_result['data']);
            $data_id = $this->db->insert_id();

            $this->db->insert("hasil_seminar", [
                'seminar_id' => $data_id,
                'berita_acara' => "",
                'masukan' => "",
                'status' => '3'
            ]);

            return [
                'error' => false,
                'message' => "Data berhasil ditambahkan",
                'data_id' => $data_id
            ];
        } else {
            return $validation;
        }
    }

    private function handle_file_upload($input, $data)
    {
        try {
            if (!empty($input['file_proposal'])) {
                $data['file_proposal'] = $this->fileupload->upload($input['file_proposal'], 'cdn/vendor/file_proposal/');
            }

            if (!empty($input['sk_tim'])) {
                $data['sk_tim'] = $this->fileupload->upload($input['sk_tim'], 'cdn/vendor/sk_tim/');
            }

            if (!empty($input['bukti_konsultasi'])) {
                $data['bukti_konsultasi'] = $this->fileupload->upload($input['bukti_konsultasi'], 'cdn/vendor/bukti_konsultasi/');
            }

            if (!empty($input['persetujuan'])) {
                $data['persetujuan'] = $this->fileupload->upload($input['persetujuan'], 'cdn/vendor/persetujuan/');
            }

            return [
                'error' => false,
                'data' => $data
            ];
        } catch (Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
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
            mahasiswa.email,
            seminar.dosen_penguji_id, 
            seminar.dosen_penguji_id2,
            dosen_penguji_1.nama as dosen_penguji_1_nama, 
            dosen_penguji_2.nama as dosen_penguji_2_nama,
            dosen_pembimbing_1.nama as dosen_pembimbing_1_nama,
            dosen_pembimbing_2.nama as dosen_pembimbing_2_nama
        ');

        $this->db->from($this->table);
        $this->db->join('proposal_mahasiswa', 'proposal_mahasiswa.id = seminar.proposal_mahasiswa_id', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id = proposal_mahasiswa.mahasiswa_id', 'left');
        $this->db->join('dosen as dosen_penguji_1', 'dosen_penguji_1.id = seminar.dosen_penguji_id', 'left');
        $this->db->join('dosen as dosen_penguji_2', 'dosen_penguji_2.id = seminar.dosen_penguji_id2', 'left');
        $this->db->join('dosen as dosen_pembimbing_1', 'dosen_pembimbing_1.id = proposal_mahasiswa.dosen_id', 'left');
        $this->db->join('dosen as dosen_pembimbing_2', 'dosen_pembimbing_2.id = proposal_mahasiswa.dosen2_id', 'left');

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