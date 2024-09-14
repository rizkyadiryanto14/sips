<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ciqrcode
{

    public function generate($params = array())
    {
        include_once APPPATH . '/third_party/phpqrcode/qrlib.php';

        $params['data'] = isset($params['data']) ? $params['data'] : 'https://www.example.com';
        $params['level'] = isset($params['level']) ? $params['level'] : 'H';
        $params['size'] = isset($params['size']) ? $params['size'] : 10;
        $params['savename'] = isset($params['savename']) ? $params['savename'] : FCPATH . 'uploads/qrcode.png';

        QRcode::png($params['data'], $params['savename'], $params['level'], $params['size']);
    }
}
