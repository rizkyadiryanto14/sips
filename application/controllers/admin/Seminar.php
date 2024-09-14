<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $input
 * @property $session
 * @property $load
 * @property $db
 * @property $Seminar_model
 * @property $Hasil_seminar_model
 * @property $emailm
 */

class Seminar extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hasil_seminar_model');
        $this->load->model('Seminar_model');
        $this->load->model('Email_model', 'emailm');
    }

	public function index()
	{
		return $this->load->view('admin/seminar');
	}

	public function detail($id = null)
	{
		if ($id) {
            $cek = $this->Hasil_seminar_model->get($id);
            if ($cek['status'] == 3) {
                $this->session->set_flashdata('error', "Seminar Belum Disetujui Pembimbing");
            }else {
                return $this->load->view('admin/seminar_jadwal', ['seminar_id' => $id]);
            }
		}
		return redirect(base_url('admin/seminar'));
	}

    public function updatestatus($id = null)
    {
        if ($id) {
            $data = [
                'tanggal' => $this->input->post('tanggal'),
                'jam_mulai' => $this->input->post('jam_mulai'),
                'jam_selesai' => $this->input->post('jam_selesai'),
                'tempat' => $this->input->post('tempat'),
                'dosen_penguji_id' => $this->input->post('dosen_penguji_id'),
                'dosen_penguji_id2' => $this->input->post('dosen_penguji2_id')
            ];

            $this->db->where('id', $id);
            $update = $this->db->update('seminar', $data);

            if ($update) {
                $data_seminar = $this->Seminar_model->details($id);
                $dProposal = $this->db->get_where('proposal_mahasiswa_v', ['id' => $data_seminar['data']['proposal_mahasiswa_id']])->row_array();

                $subjek_email = 'Jadwal Seminar ' . $data_seminar['data']['mahasiswa_nama'];
                $isi_email = '
                <p>Yth. ' . $data_seminar['data']['mahasiswa_nama'] . ',</p>
                <p>Usulan proposal Anda telah disetujui. Berikut adalah detail seminar Anda:</p>
                <ul>
                    <li><strong>Judul Proposal:</strong> ' . $data_seminar['data']['proposal_mahasiswa_judul'] . '</li>
                    <li><strong>Nama Mahasiswa:</strong> ' . $data_seminar['data']['mahasiswa_nama'] . '</li>
                    <li><strong>Tanggal Seminar:</strong> ' . tgl_indo($data_seminar['data']['tanggal']) . '</li>
                    <li><strong>Jam Mulai:</strong> ' . $data_seminar['data']['jam_mulai'] . '</li>
                    <li><strong>Jam Selesai:</strong> ' . $data_seminar['data']['jam_selesai'] . '</li>
                    <li><strong>Tempat:</strong> ' . $data_seminar['data']['tempat'] . '</li>
                     <li><strong>Dosen Pembimbing Utama:</strong> ' . $data_seminar['data']['dosen_pembimbing_1_nama'] . '</li>
                     <li><strong>Dosen Penguji 1:</strong> ' . $data_seminar['data']['dosen_penguji_1_nama'] . '</li>
                     <li><strong>Dosen Penguji 2:</strong> ' . $data_seminar['data']['dosen_penguji_2_nama'] . '</li>
                </ul>
                <p>Terima kasih atas perhatian Anda.</p>
                <p>Salam hormat,</p>
                <p><strong>Admin Sistem Informasi Skripsi Informatika</strong></p>
            ';

                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: siskripsi@mancaksa.my.id' . "\r\n";

                $this->emailm->send($subjek_email, $dProposal['email'], $isi_email, $headers);

                $this->session->set_flashdata('success', "Data berhasil diperbarui dan email dikirim.");
            } else {
                $this->session->set_flashdata('error', "Terjadi kesalahan saat memperbarui data.");
            }
        } else {
            $this->session->set_flashdata('error', "ID tidak valid atau data tidak ditemukan.");
        }
        return redirect(base_url('admin/seminar'));
    }

}

/* End of file Seminar.php */
/* Location: ./application/controllers/admin/Seminar.php */