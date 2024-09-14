<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property $db
 */

class Report_model extends CI_Model
{
    public function get_report_by_dosen($semester = null) {
        $periode_aktif = $this->db->select('id')
            ->from('periode')
            ->where('status', 1)
            ->get()
            ->row_array();

        if (empty($periode_aktif)) {
            return [
                'error' => true,
                'message' => 'Tidak ada periode aktif yang ditemukan',
                'data' => []
            ];
        }

        $id_periode = $periode_aktif['id'];

        $this->db->select('
        d.nama AS nama_dosen,
        COUNT(DISTINCT CASE WHEN pm.status = "1" THEN pm.mahasiswa_id END) AS jumlah_proposal,
        COUNT(DISTINCT CASE WHEN hs.status = "1" THEN pm.mahasiswa_id END) AS jumlah_seminar,
        COUNT(DISTINCT CASE WHEN s.status = "1" THEN pm.mahasiswa_id END) AS jumlah_skripsi
    ');
        $this->db->from('skripsi.dosen d');

        $this->db->join('skripsi.proposal_mahasiswa_v pm', 'd.id = pm.dosen_id AND pm.id_periode = ' . $id_periode, 'left');
        $this->db->join('skripsi.seminar_view sv', 'pm.mahasiswa_id = sv.mahasiswa_id', 'left');
        $this->db->join('skripsi.hasil_seminar hs', 'sv.id = hs.seminar_id', 'left');
        $this->db->join('skripsi.skripsi_vl s', 'pm.mahasiswa_id = s.mahasiswa_id', 'left');

        if ($semester == 'ganjil') {
            // Filter semester ganjil: September (09) sampai Februari (02)
            $this->db->group_start();
            $this->db->where('MONTH(pm.created_at) >=', 9);
            $this->db->or_where('MONTH(pm.created_at) <=', 2);
            $this->db->group_end();
        } elseif ($semester == 'genap') {
            // Filter semester genap: Maret (03) sampai Agustus (08)
            $this->db->group_start();
            $this->db->where('MONTH(pm.created_at) >=', 3);
            $this->db->where('MONTH(pm.created_at) <=', 8);
            $this->db->group_end();
        }

        $this->db->group_by('d.nama');

        $query = $this->db->get();

        if ($query === false) {
            return [
                'error' => true,
                'message' => 'Query gagal dieksekusi',
                'data' => []
            ];
        }

        return $query->result_array();
    }


}