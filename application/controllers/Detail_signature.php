<?php

class Detail_signature extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model');
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