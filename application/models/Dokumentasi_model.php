<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dokumentasi_model extends CI_Model
{
    /**
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function dokumentasiListingCount($searchText)
    {
        $this->db->select('BaseTbl.iddokumentasi, BaseTbl.jumlah_panen, BaseTbl.tgl_panen, BaseTbl.sisa_pakan, BaseTbl.berat_ayam, BaseTbl.jumlah_biaya, BaseTbl.periode_id');
        $this->db->from('dokumentasi as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.jumlah_panen LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function dokumentasiListing($searchText, $page, $segment)
    {
        $this->db->select('BaseTbl.iddokumentasi, BaseTbl.jumlah_panen, BaseTbl.tgl_panen, BaseTbl.sisa_pakan, BaseTbl.berat_ayam, BaseTbl.jumlah_biaya, BaseTbl.periode_id,
        Periode.jumlah_doc, Periode.tanggal_mulai');
        $this->db->from('dokumentasi as BaseTbl');
        $this->db->join('periode as Periode', 'Periode.idperiode = BaseTbl.periode_id','left');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.jumlah_panen LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->order_by('BaseTbl.iddokumentasi', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * @return number $insert_id : This is last inserted id
     */
    function addNewDokumentasi($dokumentasiInfo)
    {
        $this->db->trans_start();
        $this->db->insert('dokumentasi', $dokumentasiInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getDokumentasiInfo($dokumentasiId)
    {
        $this->db->select('iddokumentasi, jumlah_panen, tgl_panen, sisa_pakan, berat_ayam, jumlah_biaya, periode_id');
        $this->db->from('dokumentasi');
        $this->db->where('iddokumentasi', $dokumentasiId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function editDokumentasi($dokumentasiInfo, $dokumentasiId)
    {
        $this->db->where('iddokumentasi', $dokumentasiId);
        $this->db->update('dokumentasi', $dokumentasiInfo);
        
        return TRUE;
    }

    function getDataPeriodes()
    {
        $this->db->select('idperiode, tanggal_mulai, jumlah_doc, status');
        $this->db->from('periode');
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_years()
    {
        $this->db->select('YEAR(tgl_panen) as tahun');
        $this->db->from('dokumentasi');
        $this->db->group_by('tahun');
        $this->db->order_by('tahun', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_periodes()
    {
        $this->db->select('periode_id as periode');
        $this->db->from('dokumentasi');
        $this->db->group_by('periode');
        $query = $this->db->get();
        return $query->result();
    }

    public function filter_data($tahun = null, $periode = null)
    {
        $this->db->select('BaseTbl.iddokumentasi, BaseTbl.jumlah_panen, BaseTbl.tgl_panen, BaseTbl.sisa_pakan, BaseTbl.berat_ayam, BaseTbl.jumlah_biaya, BaseTbl.periode_id,
        Periode.jumlah_doc, Periode.tanggal_mulai');
        $this->db->from('dokumentasi as BaseTbl');
        $this->db->join('periode as Periode', 'Periode.idperiode = BaseTbl.periode_id','left');

        if ($tahun != null) {
            $this->db->where("YEAR(tgl_panen) = $tahun");
        }
        if ($periode != null) {
            $this->db->where("periode_id = $periode");
        }

        $query = $this->db->get();
        return $query->result();
    }
}