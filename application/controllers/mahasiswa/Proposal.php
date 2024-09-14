<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $Proposal_mahasiswa_model
 */

/**
 * @property $load
 * @property $Proposal_mahasiswa_model
 */

class Proposal extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proposal_mahasiswa_model');
    }

    public function index()
    {
        $data['kuota_dospem'] = $this->Proposal_mahasiswa_model->kuota_dospem();
        return $this->load->view('mahasiswa/proposal', $data);
    }

}

/* End of file Proposal.php */
