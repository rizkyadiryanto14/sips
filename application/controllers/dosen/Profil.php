<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property $load
 * @property $dosen
 * @property $input
 * @property $session
 * @property $upload
 * @property $db
 */

class Profil extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dosen_model', 'dosen');
    }

	public function index()
	{
        $data['row'] = $this->dosen->getSignature($this->session->userdata('id'));

        return $this->load->view('dosen/profil', $data);
	}

    public function update_signature()
    {
        $post = $this->input->post(null, TRUE);

        $config['upload_path']          = './cdn/vendor/signature/';
        $config['allowed_types']        = 'png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;
        $config['file_name']            = 'signature-' . substr(md5(rand()), 0, 10);

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('ttd')) {
            $post['ttd'] = $this->upload->data('file_name');

            $this->dosen->update_signature('dosen',$post);

            if ($this->db->affected_rows() > 0) {
                set_pesan('Tanda tangan berhasil diperbarui');
            }

            redirect('dosen/profil');
        } else {
            set_pesan('Terjadi kesalahan, pastikan file berekstensi png', false);

            redirect('dosen/profil');
        }
    }

}

/* End of file Profil.php */
/* Location: ./application/controllers/dosen/Profil.php */