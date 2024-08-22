<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $load
 * @property $PengujianSempro_model
 * @property $session
 * @property $form_validation
 */

class Pengujian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengujianSempro_model');
    }

    public function pengujian_sempro()
    {
        $id_dosen = $this->session->userdata('id');
        $listing_sempro = $this->PengujianSempro_model->listing_sempro($id_dosen);
        $pengujian_data = $this->PengujianSempro_model->get();

        // Menggabungkan data listing sempro dan pengujian
        foreach ($listing_sempro['data'] as $key => $item) {
            // Cek data pengujian seminar_id
            foreach ($pengujian_data['data'] as $pengujian) {
                if ($pengujian['id_sempro'] == $item->seminar_id) {
                    $listing_sempro['data'][$key]->pengujian = $pengujian;
                    break;
                } else {
                    $listing_sempro['data'][$key]->pengujian = null;
                }
            }
        }

        $data['listing_sempro'] = $listing_sempro['data'];
        return $this->load->view('dosen/pengujian_sempro', $data);
    }
}
