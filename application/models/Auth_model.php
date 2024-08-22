<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 * @property $session
 */

class Auth_model extends CI_Model
{

    public function login($input)
    {
        $email = $input['email'];
        $password = $input['password'];

        if (empty($email)) {
            $hasil = [
                'error' => true,
                'message' => "email harus diisi"
            ];
            goto output;
        }
        if (empty($password)) {
            $hasil = [
                'error' => true,
                'message' => "Password harus diisi"
            ];
            goto output;
        }

        $dosen = $this->db->get_where('dosen', ['email' => $email]);

        if ($dosen->num_rows() > 0) {
            foreach ($dosen->result_array() as $key => $item) {
                if (password_verify($password, $item['password'])) {
                    $hasil = [
                        'error' => false,
                        'message' => "berhasil login",
                        'data' => $item
                    ];
                    $usersession = [
                        'nama'  => $item['nama'],
                    ];
                    $this->session->set_userdata($usersession);
                    goto output;
                }
            }
            $hasil = [
                'error' => true,
                'message' => "Password salah"
            ];
            goto output;
        } else {
            $hasil = [
                'error' => true,
                'message' => "email tidak ditemukan"
            ];
            goto output;
        }

        output:
        return $hasil;
    }

}

/* End of file Auth_model.php */
