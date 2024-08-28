<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Composer autoload
require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @property $load
 * @property $PengujianSempro_model
 * @property $PengujianSkripsi_model
 * @property $session
 * @property $form_validation
 */

class Pengujian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengujianSempro_model');
        $this->load->model('PengujianSkripsi_model');
    }
    public function pengujian_sempro()
    {
        $id_dosen = $this->session->userdata('id');
        $listing_sempro = $this->PengujianSempro_model->listing_sempro($id_dosen);
        $pengujian_data = $this->PengujianSempro_model->get();

        // Menggabungkan data listing sempro dan pengujian
        foreach ($listing_sempro['data'] as $key => $item) {
            // Inisialisasi pengujian menjadi null untuk setiap item
            $listing_sempro['data'][$key]->pengujian = null;

            // Cek data pengujian berdasarkan id_dosen dan id_sempro yang sesuai
            foreach ($pengujian_data['data'] as $pengujian) {
                if ($pengujian['id_sempro'] == $item->seminar_id && $pengujian['id_dosen'] == $id_dosen) {
                    $listing_sempro['data'][$key]->pengujian = $pengujian;
                    break;
                }
            }
        }

        $data['listing_sempro'] = $listing_sempro['data'];
        return $this->load->view('dosen/pengujian_sempro', $data);
    }

    public function pengujian_skripsi()
    {
        $id_dosen = $this->session->userdata('id');
        $listing_sempro = $this->PengujianSkripsi_model->listing_sempro($id_dosen);
        $pengujian_data = $this->PengujianSkripsi_model->get();

        // Menggabungkan data listing sempro dan pengujian
        foreach ($listing_sempro['data'] as $key => $item) {
            // Inisialisasi pengujian menjadi null untuk setiap item
            $listing_sempro['data'][$key]->pengujian = null;

            // Cek data pengujian berdasarkan id_dosen dan id_sempro yang sesuai
            foreach ($pengujian_data['data'] as $pengujian) {
                if ($pengujian['id_sempro'] == $item->seminar_id && $pengujian['id_dosen'] == $id_dosen) {
                    $listing_sempro['data'][$key]->pengujian = $pengujian;
                    break;
                }
            }
        }

        $data['listing_sempro'] = $listing_sempro['data'];
        return $this->load->view('dosen/pengujian_sempro', $data);
    }


    public function cetak_pdf($id_sempro)
    {
        $data['showData'] = $this->PengujianSempro_model->get_berita_acara($id_sempro);

        if (empty($data['showData'])) {
            $data['showData'] = [];
        }

        // Load view menjadi string
        $html = $this->load->view('cetak/cetak_sempro', $data, true);

        // Set options untuk Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsFontSubsettingEnabled(true);

        // Inisialisasi Dompdf dengan options
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');


        // Render PDF
        $dompdf->render();

        // Output PDF
        $dompdf->stream('berita_acara_' . $id_sempro . '.pdf', array("Attachment" => 1));
    }



}
