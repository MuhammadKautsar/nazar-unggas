<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class BiayaOperasional_model extends CI_Model
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
    function biayaOperasionalListing($searchText, $page, $segment)
    {
        // $this->db->select('BaseTbl.iddata, BaseTbl.minggu_ke, BaseTbl.tanggal, BaseTbl.umur');
        $this->db->from('biaya_operasional as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.status LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->order_by('BaseTbl.idbiaya', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    
    /**
     * @return number $insert_id : This is last inserted id
     */
    function addNewBiayaOperasional($biayaOperasionalInfo)
    {
        $this->db->trans_start();
        $this->db->insert('biaya_operasional', $biayaOperasionalInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
    
    function getBiayaOperasionalInfo($biayaOperasionalId)
    {
        $this->db->select('idbiaya, tanggal, kebutuhan_id, harga, periode_id');
        $this->db->from('biaya_operasional');
        $this->db->where('idbiaya', $biayaOperasionalId);
        $query = $this->db->get();
        
        return $query->row();
    }
    
    function editBiayaOperasional($biayaOperasionalInfo, $biayaOperasionalId)
    {
        $this->db->where('idbiaya', $biayaOperasionalId);
        $this->db->update('biaya_operasional', $biayaOperasionalInfo);
        
        return TRUE;
    }
}