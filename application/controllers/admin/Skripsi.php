<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Skripsi extends MY_Controller
{

    public function index()
    {
        return $this->load->view('admin/skripsi');
    }

    public function detail($id = null)
    {
        if ($id) {
            return $this->load->view('admin/skripsi_jadwal', ['skripsi_id' => $id]);
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

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                return redirect(base_url('admin/skripsi'));
            } else {
                $jadwal_skripsi = $this->input->post('jadwal_skripsi');
                $tempat = $this->input->post('tempat');
                $dosen_penguji = $this->input->post('dosen_penguji_id');
                $dosen_penguji_2 = $this->input->post('dosen_penguji_id2');

                // Konversi datetime-local ke format datetime jika diperlukan
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
