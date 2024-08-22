<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $load
 */

class Periode extends MY_Controller
{
    public function index()
    {
        return $this->load->view('admin/periode');
    }
}