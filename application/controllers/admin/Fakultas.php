<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $load
 */

class Fakultas extends MY_Controller {

	public function index()
	{
		return $this->load->view('admin/fakultas');
	}

}

/* End of file Prodi.php */
/* Location: ./application/controllers/admin/Prodi.php */