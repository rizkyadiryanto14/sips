<?php

class FileUploadController extends CI_Controller
{
    public function upload($base64_file, $path): string
    {
        // Generate file name
        $file_name = date('Ymdhis') . '.png';

        // Decode and save the file
        $file_data = explode(';base64,', $base64_file)[1];
        file_put_contents(FCPATH . $path . $file_name, base64_decode($file_data));

        // Return file name for saving to database
        return $file_name;
    }
}
