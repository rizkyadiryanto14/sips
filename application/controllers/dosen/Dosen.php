<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $Dosen_model
 * @property $load
 */

class Dosen extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Memuat model dosen_model
        $this->load->model('Dosen_model');
    }

	public function index()
	{
		return $this->load->view('dosen/dosen');
	}

    public function detail($id)
    {
        $data['dosen'] = $this->Dosen_model->details($id)['data'];

        if ($data['dosen']) {
            $this->load->view('dosen/detail', $data);
        } else {
            show_404();
        }
    }

}

/* End of file Dosen.php */
/* Location: ./application/controllers/admin/Dosen.php */