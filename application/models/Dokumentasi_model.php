<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Dokumentasi_model extends CI_Model
{
    /**
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bookingListingCount($searchText)
    {
        $this->db->select('BaseTbl.bookingId, BaseTbl.roomName, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('tbl_booking as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.roomName LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.isDeleted', 0);
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
        $this->db->order_by('BaseTbl.iddokumentasi', 'DESC');
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
}