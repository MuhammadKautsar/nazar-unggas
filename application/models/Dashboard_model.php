<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_total_users()
    {
        // Ambil total user dari database
        $query = $this->db->get('user');
        $total_users = $query->num_rows();

        return $total_users;
    }

    public function get_total_periode()
    {
        $query = $this->db->get('periode');
        $total_periode = $query->num_rows();

        return $total_periode;
    }

    public function get_total_dokumentasi()
    {
        $query = $this->db->get('dokumentasi');
        $total_dokumentasi = $query->num_rows();

        return $total_dokumentasi;
    }

    public function get_total_data_harian()
    {
        $query = $this->db->get('data_harian');
        $total_data_harian = $query->num_rows();

        return $total_data_harian;
    }

    public function get_total_biaya_operasional()
    {
        $query = $this->db->get('biaya_operasional');
        $total_biaya_operasional = $query->num_rows();

        return $total_biaya_operasional;
    }
}
