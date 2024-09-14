<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @property $load
 * @property $PengujianSempro_model
 * @property $PengujianSkripsi_model
 * @property $session
 * @property $form_validation
 * @property $emailm
 */

class Pengujian extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PengujianSempro_model');
        $this->load->model('PengujianSkripsi_model');
        $this->load->model('Email_model', 'emailm');
    }

    public function pengujian_sempro()
    {
        $id_dosen = $this->session->userdata('id');
        $listing_sempro = $this->PengujianSempro_model->listing_sempro($id_dosen);
        $pengujian_data = $this->PengujianSempro_model->get();

        foreach ($listing_sempro['data'] as $key => $item) {
            $listing_sempro['data'][$key]->pengujian = null;

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
        $listing_skripsi = $this->PengujianSkripsi_model->listing_skripsi($id_dosen);
        $pengujian_data = $this->PengujianSkripsi_model->get();

        foreach ($listing_skripsi['data'] as $key => $item) {
            $listing_skripsi['data'][$key]->pengujian = null;

            foreach ($pengujian_data['data'] as $pengujian) {
                if ($pengujian['id_skripsi'] == $item->seminar_id && $pengujian['id_dosen'] == $id_dosen) {
                    $listing_skripsi['data'][$key]->pengujian = $pengujian;
                    break;
                }
            }
        }

        $data['listing_skripsi'] = $listing_skripsi['data'];
        return $this->load->view('dosen/pengujian_skripsi', $data);
    }

    public function cetak_pdf($id_sempro)
    {
        $data['showData'] = $this->PengujianSempro_model->get_berita_acara($id_sempro);

        if (empty($data['showData'])) {
            $data['showData'] = [];
        }

        $html = $this->load->view('cetak/cetak_sempro', $data, true);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsFontSubsettingEnabled(true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('berita_acara_' . $id_sempro . '.pdf', array("Attachment" => 1));
    }

    public function cetak_pdf_skripsi($id_skripsi)
    {
        $data['showData'] = $this->PengujianSkripsi_model->get_berita_acara($id_skripsi);

        if (empty($data['showData'])) {
            $data['showData'] = [];
        }

        $html = $this->load->view('cetak/cetak_skripsi', $data, true);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsFontSubsettingEnabled(true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $dompdf->stream('berita_acara_' . $id_skripsi . '.pdf', array("Attachment" => 1));
    }

    public function create_pengujian_sempro()
    {
        $input = $this->input->post();

        $response = $this->PengujianSempro_model->create($input);

        if ($response['send_email']) {
            $this->kirim_email_berita_acara($input['id_sempro']);
        }

        echo json_encode($response);
    }

    public function create_pengujian_skripsi()
    {
        $input = $this->input->post();

        $response = $this->PengujianSkripsi_model->create($input);

        if ($response['send_email']) {
            $this->kirim_email_berita_acara_skripsi($input['id_skripsi']);
        }

        echo json_encode($response);
    }

    private function kirim_email_berita_acara($id_sempro)
    {
        $data_seminar = $this->PengujianSempro_model->details_sempro($id_sempro);
        $dProposal = $this->db->get_where('proposal_mahasiswa_v', ['id' => $data_seminar['data']['proposal_mahasiswa_id']])->row_array();

        $url = str_replace(' ', '', site_url('berita_acara/cetak_pdf/' . trim($id_sempro)));

        $subjek_email = 'Berita Acara Seminar Proposal ' . $data_seminar['data']['mahasiswa_nama'];
        $isi_email = '
        <p>Yth. ' . $data_seminar['data']['mahasiswa_nama'] . ',</p>
        <p>Seminar proposal Anda telah selesai dinilai oleh semua dosen penguji. Silakan unduh berita acara Anda melalui tautan di bawah ini:</p>
        <p>'. $url.'</p>
        <p>Terima kasih atas perhatian Anda.</p>
        <p>Salam hormat,</p>
        <p><strong>Admin Sistem Informasi Skripsi Informatika</strong></p>
    ';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: siskripsi@mancaksa.my.id' . "\r\n";

        $this->emailm->send($subjek_email, $dProposal['email'], $isi_email, $headers);
    }


    private function kirim_email_berita_acara_skripsi($id_skripsi)
    {
        $data_seminar = $this->PengujianSkripsi_model->details_skripsi($id_skripsi);

        $url = str_replace(' ', '', site_url('berita_acara/cetak_pdf_skripsi/' . trim($id_skripsi)));

        $subjek_email = 'Berita Acara Seminar Akhir Skripsi ' . $data_seminar['nama_mahasiswa'];
        $isi_email = '
        <p>Yth. ' . $data_seminar['mahasiswa_nama'] . ',</p>
        <p>Seminar proposal Anda telah selesai dinilai oleh semua dosen penguji. Silakan unduh berita acara Anda melalui tautan di bawah ini:</p>
        <p>'. $url.'</p>
        <p>Terima kasih atas perhatian Anda.</p>
        <p>Salam hormat,</p>
        <p><strong>Admin Sistem Informasi Skripsi Informatika</strong></p>
    ';

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: siskripsi@mancaksa.my.id' . "\r\n";

        $this->emailm->send($subjek_email, $data_seminar['email'], $isi_email, $headers);
    }



}
