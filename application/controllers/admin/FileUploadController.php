<?php

class FileUploadController extends CI_Controller
{
    public function upload($base64_file, $path): string
    {
        $file_name = date('Ymdhis') . '.png';

        $file_data = explode(';base64,', $base64_file)[1];
        file_put_contents(FCPATH . $path . $file_name, base64_decode($file_data));

        return $file_name;
    }
}
