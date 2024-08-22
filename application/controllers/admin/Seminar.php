<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $input
 * @property $session
 * @property $load
 * @property $db
 */

class Seminar extends MY_Controller {

	public function index()
	{
		return $this->load->view('admin/seminar');
	}

	public function detail($id = null)
	{
		if ($id) {
			return $this->load->view('admin/seminar_jadwal', ['seminar_id' => $id]);
		}
		return redirect(base_url('admin/seminar'));
	}

    /**
     * @param $id
     * @return array
     */
    public function updatestatus($id = null): array
    {
        if ($id) {
            // Ambil data dari input form
            $tgl = $this->input->post('tanggal');
            $jam_mulai = $this->input->post('jam_mulai');
            $jam_selesai = $this->input->post('jam_selesai');
            $tempat = $this->input->post('tempat');
            $dosen_penguji = $this->input->post('dosen_penguji_id');
            $dosen_penguji_2 = $this->input->post('dosen_penguji2_id');

            // Siapkan data yang akan diupdate
            // bentuk data dalam array
            $data = [
                'tanggal' => $tgl,
                'jam_mulai' => $jam_mulai,
                'jam_selesai' => $jam_selesai,
                'tempat' => $tempat,
                'dosen_penguji_id' => $dosen_penguji,
                'dosen_penguji_id2' => $dosen_penguji_2
            ];

            // Coba update data di tabel seminar
            //
            $this->db->where('id', $id);
            $update = $this->db->update('seminar', $data);

            // Umpan balik ke pengguna
            if ($update) {
                $hasil = [
                    'error' => false,
                    'message' => "Data berhasil diperbarui"
                ];
                return redirect(base_url('admin/seminar'));
            } else {
                $hasil = [
                    'error' => true,
                    'message' => "Terjadi kesalahan saat memperbarui data"
                ];
            }
        } else {
            $hasil = [
                'error' => true,
                'message' => "ID tidak valid atau data tidak ditemukan"
            ];
        }

        return $hasil;
    }


}

/* End of file Seminar.php */
/* Location: ./application/controllers/admin/Seminar.php */