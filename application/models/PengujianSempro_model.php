<?php

/**
 * @property $db
 */

class PengujianSempro_model extends CI_Model
{
    protected $table = 'pengujian_sempro';

    public function get()
    {
        $this->db->select("*");
        $pengujian_sempro = $this->db->get($this->table)->result_array();

        $hasil['error'] = false;
        $hasil['message'] = ($pengujian_sempro) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $pengujian_sempro;

        return $hasil;
    }

    public function listing_sempro($id_dosen): array
    {
        $this->db->select('
        seminar_view.id AS seminar_id,
        seminar_view.*,
        mahasiswa.nama AS nama_mahasiswa,
        mahasiswa.nim AS mahasiswa_nim,
        proposal_mahasiswa.judul AS judul_proposal,
        dosen_penguji_1.nama AS nama_dosen_penguji_1,
        dosen_penguji_2.nama AS nama_dosen_penguji_2,
        dosen_pembimbing_1.nama AS nama_dosen_pembimbing_1,
        dosen_pembimbing_2.nama AS nama_dosen_pembimbing_2
    ');
        $this->db->from('seminar_view');
        $this->db->join('proposal_mahasiswa', 'seminar_view.proposal_mahasiswa_id = proposal_mahasiswa.id', 'left');
        $this->db->join('mahasiswa', 'seminar_view.mahasiswa_id = mahasiswa.id', 'left');
        $this->db->join('dosen as dosen_penguji_1', 'seminar_view.dosen_penguji_1 = dosen_penguji_1.id', 'left');
        $this->db->join('dosen as dosen_penguji_2', 'seminar_view.dosen_penguji_2 = dosen_penguji_2.id', 'left');
        $this->db->join('dosen as dosen_pembimbing_1', 'seminar_view.dosen_pembimbing_1 = dosen_pembimbing_1.id', 'left');
        $this->db->join('dosen as dosen_pembimbing_2', 'seminar_view.dosen_pembimbing_2 = dosen_pembimbing_2.id', 'left');
        $this->db->group_start();
        $this->db->where('seminar_view.dosen_penguji_1', $id_dosen);
        $this->db->or_where('seminar_view.dosen_penguji_2', $id_dosen);
        $this->db->or_where('seminar_view.dosen_pembimbing_1', $id_dosen);
        $this->db->or_where('seminar_view.dosen_pembimbing_2', $id_dosen);
        $this->db->group_end();

        $result = $this->db->get()->result();

        $hasil['error'] = false;
        $hasil['message'] = ($result) ? "data berhasil ditemukan" : "data tidak tersedia";
        $hasil['data'] = $result;

        return $hasil;
    }

    public function create($input)
    {
        $data = [
            'id_sempro' => $input['id_sempro'],
            'id_dosen'  => $input['id_dosen'],
            'presentasi' => $input['presentasi'],
            'alat_bantu' => $input['alat_bantu'],
            'penampilan' => $input['penampilan'],
            'penguasaan_materi' => $input['penguasaan_materi'],
            'kelayakan_proposal' => $input['kelayakan_proposal'],
            'status'        => 1
        ];

        $validate = $this->app->validate($data);

        if ($validate === true) {
            $this->db->insert($this->table, $data);
            $hasil = [
                'error' => false,
                'message' => 'data berhasil ditambah',
                'data_id' => $this->db->insert_id()
            ];
        }else {
            $hasil = $validate;
        }
        return $hasil;
    }

}