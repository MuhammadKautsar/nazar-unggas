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
        $this->db->select('BaseTbl.iddata, BaseTbl.minggu_ke, BaseTbl.tanggal, BaseTbl.umur, BaseTbl.ayam_mati, BaseTbl.afkir, BaseTbl.pakan, BaseTbl.berat_ayam, BaseTbl.periode_id');
        $this->db->from('data_harian as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.status LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        // $this->db->order_by('BaseTbl.iddata', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * @return number $insert_id : This is last inserted id
     */
    function addNewDataHarian($dataHarianInfo)
    {
        $this->db->trans_start();
        $this->db->insert('data_harian', $dataHarianInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getDataHarianInfo($dataHarianId)
    {
        $this->db->select('BaseTbl.iddata, BaseTbl.minggu_ke, BaseTbl.tanggal, BaseTbl.umur, BaseTbl.ayam_mati, BaseTbl.afkir, BaseTbl.pakan, BaseTbl.berat_ayam, BaseTbl.periode_id');
        $this->db->from('data_harian as BaseTbl');
        $this->db->where('iddata', $dataHarianId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function editDataHarian($dataHarianInfo, $dataHarianId)
    {
        $this->db->where('iddata', $dataHarianId);
        $this->db->update('data_harian', $dataHarianInfo);
        
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