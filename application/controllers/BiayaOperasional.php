<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class BiayaOperasional extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('BiayaOperasional_model', 'bom');
        $this->isLoggedIn();
        $this->module = 'BiayaOperasional';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('biayaOperasional/biayaOperasionalListing');
    }
    
    function biayaOperasionalListing()
    {
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
        
        $count = $this->bom->biayaOperasionalListingCount($searchText);

        $returns = $this->paginationCompress ( "biayaOperasionalListing/", $count, 10 );
        
        $data['records'] = $this->bom->biayaOperasionalListing($searchText, $returns["page"], $returns["segment"]);
        
        $this->global['pageTitle'] = 'Nazar Unggas : Biaya Operasional';
        
        $this->loadViews("biaya_operasional/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $data['kebutuhans'] = $this->bom->getDataKebutuhans();
        $data['periodes'] = $this->bom->getDataPeriodes();

        $this->global['pageTitle'] = 'Nazar Unggas : Tambah Biaya Operasional Baru';

        $this->loadViews("biaya_operasional/add", $this->global, $data, NULL);
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewBiayaOperasional()
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('tanggal','Tanggal','trim|required');
        $this->form_validation->set_rules('kebutuhan_id','Jenis Kebutuhan','trim|required');
        $this->form_validation->set_rules('harga','Harga','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
            $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
            $kebutuhan_id = $this->security->xss_clean($this->input->post('kebutuhan_id'));
            $harga = $this->security->xss_clean($this->input->post('harga'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
            
            $biayaOperasionalInfo = array('tanggal'=>$tanggal, 'kebutuhan_id'=>$kebutuhan_id, 'harga'=>$harga, 'periode_id'=>$periode_id);
            
            $result = $this->bom->addNewBiayaOperasional($biayaOperasionalInfo);
            
            if($result > 0) {
                $this->session->set_flashdata('success', 'Biaya Operasional baru sukses dibuat');
            } else {
                $this->session->set_flashdata('error', 'Biaya Operasional gagal dibuat');
            }
            
            redirect('biayaOperasional/biayaOperasionalListing');
        }
    }

    function edit($periodeId = NULL)
    {
        if($periodeId == null)
        {
            redirect('biayaOperasional/biayaOperasionalListing');
        }
        
        $data['kebutuhans'] = $this->bom->getDataKebutuhans();
        $data['periodes'] = $this->bom->getDataPeriodes();
        $data['biayaOperasionalInfo'] = $this->bom->getbiayaOperasionalInfo($periodeId);

        $this->global['pageTitle'] = 'Nazar Unggas : Ubah Biaya Operasional';
        
        $this->loadViews("biaya_operasional/edit", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editBiayaOperasional()
    {
        $this->load->library('form_validation');
            
        $biayaOperasionalId = $this->input->post('idbiaya');
        
        $this->form_validation->set_rules('tanggal','Tanggal','trim|required');
        $this->form_validation->set_rules('kebutuhan_id','Jenis Kebutuhan','trim|required');
        $this->form_validation->set_rules('harga','Harga','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->edit($biayaOperasionalId);
        }
        else
        {
            $tanggal = $this->security->xss_clean($this->input->post('tanggal'));
            $kebutuhan_id = $this->security->xss_clean($this->input->post('kebutuhan_id'));
            $harga = $this->security->xss_clean($this->input->post('harga'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
            
            $biayaOperasionalInfo = array('tanggal'=>$tanggal, 'kebutuhan_id'=>$kebutuhan_id, 'harga'=>$harga, 'periode_id'=>$periode_id);

            $result = $this->bom->editBiayaOperasional($biayaOperasionalInfo, $biayaOperasionalId);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Biaya Operasional updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Biaya Operasional updation failed');
            }
            
            redirect('biayaOperasional/biayaOperasionalListing');
        }
    }

    public function delete($id)
    {
        // Hapus data dari database
        $this->db->where('idbiaya', $id);
        $this->db->delete('biaya_operasional');

        // Tampilkan pesan berhasil dihapus dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>