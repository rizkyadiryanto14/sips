<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload
{
    public function upload($base64_file, $path): string
    {
        // Decode the base64 file
        $file_data = explode(';base64,', $base64_file);

        // Get the file extension from MIME type
        $mime_type = explode(':', $file_data[0])[1];
        $extension = $this->get_extension_from_mime($mime_type);

        if (!$extension) {
            throw new Exception('Unsupported file type.');
        }

        // Generate a unique file name with the correct extension
        $file_name = date('Ymdhis') . '.' . $extension;

        // Save the decoded file data to the specified path
        file_put_contents(FCPATH . $path . $file_name, base64_decode($file_data[1]));

        // Return the file name for saving to the database
        return $file_name;
    }

    private function get_extension_from_mime($mime_type): ?string
    {
        $mime_map = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'application/pdf' => 'pdf',
            'application/msword' => 'doc',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
            'application/vnd.ms-excel' => 'xls',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
            'application/vnd.ms-powerpoint' => 'ppt',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
            // Tambahkan MIME type lainnya sesuai kebutuhan
        ];

        return $mime_map[$mime_type] ?? null;
    }
}

