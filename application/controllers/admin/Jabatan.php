<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $load
 */

class Jabatan extends MY_Controller
{
    public function index()
    {
        return $this->load->view('admin/jabatan');
    }
}

/* End of file Jabatan.php */
/* Location: ./application/controllers/admin/Jabatan.php */