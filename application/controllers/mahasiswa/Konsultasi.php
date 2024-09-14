<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $load
 */

class Konsultasi extends MY_Controller {

    public function index()
    {
        return $this->load->view('mahasiswa/konsultasi');
    }

}

/* End of file Konsultasi.php */
