<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $Skripsi_model
 * @property $form_validation
 * @property $load
 * @property $input
 * @property $session
 * @property $db
 * @property $emailm
 */

class Skripsi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Skripsi_model');
        $this->load->model('Email_model', 'emailm');
    }

    public function index()
    {
        return $this->load->view('admin/skripsi');
    }

    public function detail($id = null)
    {
        if ($id) {
            $cek = $this->Skripsi_model->details($id);
            if ($cek['status'] != 1) {
                $this->session->set_flashdata('error', 'Seminar Akhir Skripsi Belum Disetujui Pembimbing');
            }else {
                return $this->load->view('admin/skripsi_jadwal', ['skripsi_id' => $id]);
            }
        }
        return redirect(base_url('admin/skripsi'));
    }

    public function updatestatus($id = null): array
    {
        if ($id) {
            $this->form_validation->set_rules('jadwal_skripsi', 'Jadwal Skripsi', 'required');
            $this->form_validation->set_rules('tempat', 'Tempat', 'required');
            $this->form_validation->set_rules('dosen_penguji_id', 'Dosen Penguji 1', 'required|numeric');
            $this->form_validation->set_rules('dosen_penguji_id2', 'Dosen Penguji 2', 'required|numeric');

            if (!$this->form_validation->run()) {
                $this->session->set_flashdata('error', validation_errors());
                return redirect(base_url('admin/skripsi'));
            } else {
                $jadwal_skripsi = $this->input->post('jadwal_skripsi');
                $tempat = $this->input->post('tempat');
                $dosen_penguji = $this->input->post('dosen_penguji_id');
                $dosen_penguji_2 = $this->input->post('dosen_penguji_id2');

                $jadwal_skripsi = date('Y-m-d H:i:s', strtotime($jadwal_skripsi));
                $data = [
                    'jadwal_skripsi' => $jadwal_skripsi,
                    'tempat' => $tempat,
                    'dosen_penguji_id' => $dosen_penguji,
                    'dosen_penguji_id2' => $dosen_penguji_2
                ];

                $this->db->where('id', $id);
                $update = $this->db->update('skripsi', $data);

                if ($update) {
                    $data_skripsi = $this->Skripsi_model->details($id);
                    $subjek_email = 'Jadwal Seminar Akhir ' . $data_skripsi['nama_mahasiswa'];
                    $isi_email = '
                <p>Yth. ' . $data_skripsi['mahasiswa_nama'] . ',</p>
                <p>Usulan proposal Anda telah disetujui. Berikut adalah detail seminar Anda:</p>
                <ul>
                    <li><strong>Judul Proposal:</strong> ' . $data_skripsi['judul_skripsi'] . '</li>
                    <li><strong>Nama Mahasiswa:</strong> ' . $data_skripsi['nama_mahasiswa'] . '</li>
                    <li><strong>Tanggal Seminar:</strong> ' . tgl_indoFull($data_skripsi['jadwal_skripsi']) . '</li>
                    <li><strong>Tempat:</strong> ' . $data_skripsi['tempat'] . '</li>
                     <li><strong>Dosen Pembimbing Utama:</strong> ' . $data_skripsi['nama_pembimbing1'] . '</li>
                     <li><strong>Dosen Penguji 1:</strong> ' . $data_skripsi['nama_penguji1'] . '</li>
                     <li><strong>Dosen Penguji 2:</strong> ' . $data_skripsi['nama_penguji2'] . '</li>
                </ul>
                <p>Terima kasih atas perhatian Anda.</p>
                <p>Salam hormat,</p>
                <p><strong>Admin Sistem Informasi Skripsi Informatika</strong></p>
            ';

                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: siskripsi@mancaksa.my.id' . "\r\n";

                    $this->emailm->send($subjek_email, $data_skripsi['email'], $isi_email, $headers);
                    $this->session->set_flashdata('success', "Data berhasil diperbarui");
                    return redirect(base_url('admin/skripsi'));
                } else {
                    $this->session->set_flashdata('error', "Terjadi kesalahan saat memperbarui data");
                    return redirect(base_url('admin/skripsi'));
                }
            }
        } else {
            $this->session->set_flashdata('error', "ID tidak valid atau data tidak ditemukan");
            return redirect(base_url('admin/skripsi'));
        }
    }
}

/* End of file Seminar.php */
