<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class DataHarian extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('DataHarian_model', 'dhm');
        $this->isLoggedIn();
        $this->module = 'DataHarian';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('dataHarian/dataHarianListing');
    }
    
    function dataHarianListing()
    {
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;
            
        $this->load->library('pagination');
            
        // $count = $this->pm->bookingListingCount($searchText);

		// $returns = $this->paginationCompress ( "dataHarianListing/", $count, 10 );

        $returns = $this->paginationCompress ( "dataHarianListing/", 10 );
            
        $data['records'] = $this->dhm->dataHarianListing($searchText, $returns["page"], $returns["segment"]);
            
        $this->global['pageTitle'] = 'Nazar Unggas : Data Harian';
            
        $this->loadViews("data_harian/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $this->global['pageTitle'] = 'Nazar Unggas : Tambah Data Harian Baru';

        $this->loadViews("data_harian/add", $this->global, NULL, NULL);
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewDataHarian()
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('minggu_ke','Minggu ke','trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal','trim|required');
        $this->form_validation->set_rules('umur','Umur Ayam','trim|required');
        $this->form_validation->set_rules('ayam_mati','Ayam Mati','trim|required');
        $this->form_validation->set_rules('afkir','Afkir','trim|required');
        $this->form_validation->set_rules('pakan','Pakan (sak)','trim|required');
        $this->form_validation->set_rules('berat_ayam','Berat Ayam','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
            $minggu_ke = $this->security->xss_clean($this->input->post('minggu_ke'));
            $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
            $umur = $this->security->xss_clean($this->input->post('umur'));
            $ayam_mati = $this->security->xss_clean($this->input->post('ayam_mati'));
            $afkir = $this->security->xss_clean($this->input->post('afkir'));
            $pakan = $this->security->xss_clean($this->input->post('pakan'));
            $berat_ayam = $this->security->xss_clean($this->input->post('berat_ayam'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
                
            $dataHarianInfo = array('minggu_ke'=>$minggu_ke, 'tanggal'=>$tanggal, 'umur'=>$umur, 'ayam_mati'=>$ayam_mati, 'afkir'=>$afkir, 'pakan'=>$pakan, 'berat_ayam'=>$berat_ayam, 'periode_id'=>$periode_id,);
                
            $result = $this->dhm->addNewDataHarian($dataHarianInfo);
                
            if($result > 0) {
                $this->session->set_flashdata('success', 'Data Harian baru sukses dibuat');
            } else {
                $this->session->set_flashdata('error', 'Data Harian gagal dibuat');
            }
                
            redirect('dataHarian/dataHarianListing');
        }
    }

    function edit($dataHarianId = NULL)
    {
        if($dataHarianId == null)
        {
            redirect('periode/periodeListing');
        }
            
        $data['dataHarianInfo'] = $this->dhm->getDataHarianInfo($dataHarianId);

        $this->global['pageTitle'] = 'Nazar Unggas : Ubah Data Harian';
            
        $this->loadViews("data_harian/edit", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editDataHarian()
    {
        $this->load->library('form_validation');
            
        $dataHarianId = $this->input->post('iddata');
            
        $this->form_validation->set_rules('minggu_ke','Minggu ke','trim|required');
        $this->form_validation->set_rules('tanggal','Tanggal','trim|required');
        $this->form_validation->set_rules('umur','Umur Ayam','trim|required');
        $this->form_validation->set_rules('ayam_mati','Ayam Mati','trim|required');
        $this->form_validation->set_rules('afkir','Afkir','trim|required');
        $this->form_validation->set_rules('pakan','Pakan (sak)','trim|required');
        $this->form_validation->set_rules('berat_ayam','Berat Ayam','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            $this->edit($dataHarianId);
        }
        else
        {
            $minggu_ke = $this->security->xss_clean($this->input->post('minggu_ke'));
            $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
            $umur = $this->security->xss_clean($this->input->post('umur'));
            $ayam_mati = $this->security->xss_clean($this->input->post('ayam_mati'));
            $afkir = $this->security->xss_clean($this->input->post('afkir'));
            $pakan = $this->security->xss_clean($this->input->post('pakan'));
            $berat_ayam = $this->security->xss_clean($this->input->post('berat_ayam'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
                
            $dataHarianInfo = array('minggu_ke'=>$minggu_ke, 'tanggal'=>$tanggal, 'umur'=>$umur, 'ayam_mati'=>$ayam_mati, 'afkir'=>$afkir, 'pakan'=>$pakan, 'berat_ayam'=>$berat_ayam, 'periode_id'=>$periode_id,);

            $result = $this->dhm->editDataHarian($dataHarianInfo, $dataHarianId);
                
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Data Harian updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Data Harian updation failed');
            }
                
            redirect('dataHarian/dataHarianListing');
        }
    }

    public function delete($id)
    {
        // Hapus data dari database
        $this->db->where('iddata', $id);
        $this->db->delete('data_harian');

        // Tampilkan pesan berhasil dihapus dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>