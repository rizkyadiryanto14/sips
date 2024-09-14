<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;


/**
 * @property $Report_model
 * @property $load
 */

class Report extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Report_model');
    }

    public function index()
    {
        $semester = $this->input->get('semester');

        $data['report'] = $this->Report_model->get_report_by_dosen($semester);

        return $this->load->view('admin/report', $data);
    }

    public function download_pdf()
    {
        $semester = $this->input->get('semester');

        $data['report'] = $this->Report_model->get_report_by_dosen($semester);

        $html = $this->load->view('admin/report_pdf', $data, true);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->setIsHtml5ParserEnabled(true);
        $options->setIsFontSubsettingEnabled(true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Download file PDF
        $dompdf->stream('report_dosen.pdf', array("Attachment" => 1));
    }

}

/* End of file Report.php */
/* Location: ./application/controllers/admin/Report.php */
