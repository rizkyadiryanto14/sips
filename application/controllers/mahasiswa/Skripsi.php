<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $load
 */

class Skripsi extends MY_Controller
{

    public function index()
    {
        return $this->load->view('mahasiswa/skripsi');
    } 
}

/* End of file Seminar.php */
