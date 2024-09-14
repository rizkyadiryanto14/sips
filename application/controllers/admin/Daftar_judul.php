<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * @property $load
 * @property $model
 * @property $db
 *
 */

class Daftar_judul extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DaftarJudul_model', 'model');
    }

    public function index()
    {
        return $this->load->view('admin/daftar_judul');
    }

    public function cekJudul()
    {
        $judulInput = $this->input->post('judul_skripsi');

        $response = $this->model->cekJudulSkripsi($judulInput);

        echo json_encode($response);
    }

    public function import()
    {
        $file_mimes = array('application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['importexcel']['name']) && in_array($_FILES['importexcel']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['importexcel']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = IOFactory::createReader('Csv');
            } else {
                $reader = IOFactory::createReader('Xlsx');
            }

            $spreadsheet = $reader->load($_FILES['importexcel']['tmp_name']);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $error = false;
            $error_messages = [];

            foreach ($sheetData as $key => $value) {
                if ($key != 0) { // Lewati header
                    $nim = trim($value[0]);
                    $judul_skripsi = trim($value[1]);
                    $nama = trim($value[2]);
                    $abstrak = trim($value[3]);
                    $tahun_lulus = trim($value[4]);

                    if (empty($nim) && empty($judul_skripsi) && empty($nama) && empty($abstrak) && empty($tahun_lulus)) {
                        continue;
                    }

                    if (empty($nim) || empty($judul_skripsi) || empty($nama) || empty($tahun_lulus)) {
                        $error = true;
                        $error_messages[] = "Baris $key: Data tidak lengkap.";
                        continue;
                    }

                    $cek = $this->db->get_where('daftar_judul', ['judul_skripsi' => $judul_skripsi])->num_rows();
                    if ($cek > 0) {
                        $error = true;
                        $error_messages[] = "Baris $key: Judul Skripsi '$judul_skripsi' sudah digunakan.";
                    } else {
                        $data = array(
                            'nim'          => $nim,
                            'judul_skripsi' => $judul_skripsi,
                            'nama'         => $nama,
                            'abstrak'      => $abstrak,
                            'tahun_lulus'  => $tahun_lulus,
                        );
                        $this->db->insert('daftar_judul', $data);
                    }
                }
            }

            if ($error) {
                echo json_encode([
                    'error' => true,
                    'message' => "Import selesai dengan beberapa kesalahan: " . implode(" | ", $error_messages)
                ]);
            } else {
                echo json_encode([
                    'error' => false,
                    'message' => "Data berhasil diimport"
                ]);
            }

        } else {
            echo json_encode([
                'error' => true,
                'message' => "File tidak valid. Pastikan Anda mengunggah file Excel dengan format yang benar."
            ]);
        }
    }



}

/* End of file Daftar_judul.php */
/* Location: ./application/controllers/admin/Daftar_judul.php */
