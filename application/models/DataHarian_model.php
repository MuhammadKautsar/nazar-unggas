<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class DataHarian_model extends CI_Model
{
    /**
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function bookingListingCount($searchText)
    {
        $this->db->select('BaseTbl.bookingId, BaseTbl.roomName, BaseTbl.description, BaseTbl.createdDtm');
        $this->db->from('data_harian as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.roomName LIKE '%".$searchText."%')";
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
    function dataHarianListing($searchText, $page, $segment)
    {
        // $this->db->select('BaseTbl.iddata, BaseTbl.minggu_ke, BaseTbl.tanggal, BaseTbl.umur');
        $this->db->from('data_harian as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.status LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.iddata', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * @return number $insert_id : This is last inserted id
     */
    function addNewPeriode($periodeInfo)
    {
        $this->db->trans_start();
        $this->db->insert('periode', $periodeInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getPeriodeInfo($periodeId)
    {
        $this->db->select('idperiode, tanggal_mulai, jumlah_doc, status');
        $this->db->from('periode');
        $this->db->where('idperiode', $periodeId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function editPeriode($periodeInfo, $periodeId)
    {
        $this->db->where('idperiode', $periodeId);
        $this->db->update('periode', $periodeInfo);
        
        return TRUE;
    }
}