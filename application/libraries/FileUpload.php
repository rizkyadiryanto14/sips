<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class FileUpload
{
    private $max_file_size = 4 * 1024 * 1024;
    private $chunk_size = 1024 * 1024;

    public function upload($base64_file, $path): string
    {
        if (strpos($base64_file, ';base64,') === false) {
            throw new Exception('Invalid base64 format.');
        }

        $file_data = explode(';base64,', $base64_file);
        $base64_content = $file_data[1];

        $mime_type = explode(':', $file_data[0])[1];
        $extension = $this->get_extension_from_mime($mime_type);

        if (!$extension) {
            throw new Exception('Unsupported file type.');
        }

        $file_size = (int)(strlen($base64_content) * 0.75);
        if ($file_size > $this->max_file_size) {
            throw new Exception('File size exceeds the maximum limit of 4MB.');
        }

        $file_name = date('Ymdhis') . '_' . uniqid() . '.' . $extension;

        $full_path = FCPATH . $path . $file_name;

        $file_handle = fopen($full_path, 'wb');
        if (!$file_handle) {
            log_message('error', 'Failed to open file for writing: ' . $full_path);
            throw new Exception('Failed to open file for writing: ' . $full_path);
        }

        // Decode dan tulis file base64 dalam chunks
        $decoded_file = base64_decode($base64_content, true);
        if ($decoded_file === false) {
            log_message('error', 'Failed to decode base64 file.');
            throw new Exception('Failed to decode base64 file.');
        }

        $offset = 0;
        while ($offset < strlen($decoded_file)) {
            $chunk = substr($decoded_file, $offset, $this->chunk_size);
            $bytes_written = fwrite($file_handle, $chunk);

            if ($bytes_written === false) {
                log_message('error', 'Failed to write chunk to file: ' . $full_path);
                throw new Exception('Failed to write chunk to file: ' . $full_path);
            }

            $offset += $bytes_written;
        }

        fclose($file_handle);

        return $file_name;
    }

    private function get_extension_from_mime($mime_type): ?string
    {
        $mime_map = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'application/pdf' => 'pdf',
        ];

        return $mime_map[$mime_type] ?? null;
    }
}
