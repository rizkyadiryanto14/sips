<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $load
 */

class Daftar_judul extends MY_Controller
{
    public function index()
    {
        return $this->load->view('admin/daftar_judul');
    }

    public function cekJudul()
    {
        // Ambil input judul dari user
        $judulInput = $this->input->post('judul_skripsi');

        // Load model
        $this->load->model('DaftarJudul_model', 'model');

        // Panggil fungsi untuk cek judul
        $response = $this->model->cekJudulSkripsi($judulInput);

        // Return hasilnya sebagai JSON
        echo json_encode($response);
    }
}

/* End of file Daftar_judul.php */
/* Location: ./application/controllers/admin/Daftar_judul.php */
