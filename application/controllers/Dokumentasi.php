<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dokumentasi extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokumentasi_model', 'dm');
        $this->isLoggedIn();
        $this->module = 'Dokumentasi';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('dokumentasi/dokumentasiListing');
    }
    
    function dokumentasiListing()
    {
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
        
        // $count = $this->pm->bookingListingCount($searchText);

        // $returns = $this->paginationCompress ( "dokumentasiListing/", $count, 10 );

        $returns = $this->paginationCompress ( "dokumentasiListing/", 10 );
        
        $data['records'] = $this->dm->dokumentasiListing($searchText, $returns["page"], $returns["segment"]);
        
        $this->global['pageTitle'] = 'Nazar Unggas : Dokumentasi';
        
        $this->loadViews("dokumentasi/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $this->global['pageTitle'] = 'Nazar Unggas : Tambah Periode Baru';

        $this->loadViews("dokumentasi/add", $this->global, NULL, NULL);
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewDokumentasi()
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('jumlah_panen','Jumlah Panen','trim|required');
        $this->form_validation->set_rules('tgl_panen','Tanggal Panen','trim|required');
        $this->form_validation->set_rules('sisa_pakan','Sisa pakan (sak)','trim|required');
        $this->form_validation->set_rules('berat_ayam','Berat Ayam','trim|required');
        $this->form_validation->set_rules('jumlah_biaya','Jumlah Biaya','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
            $jumlah_panen = $this->security->xss_clean($this->input->post('jumlah_panen'));
            $tgl_panen = $this->security->xss_clean($this->input->post('tgl_panen'));
            $sisa_pakan = $this->security->xss_clean($this->input->post('sisa_pakan'));
            $berat_ayam = $this->security->xss_clean($this->input->post('berat_ayam'));
            $jumlah_biaya = $this->security->xss_clean($this->input->post('jumlah_biaya'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
            
            $dokumentasiInfo = array('jumlah_panen'=>$jumlah_panen, 'tgl_panen'=>$tgl_panen, 'sisa_pakan'=>$sisa_pakan, 'berat_ayam'=>$berat_ayam, 'jumlah_biaya'=>$jumlah_biaya, 'periode_id'=>$periode_id);
            
            $result = $this->dm->addNewDokumentasi($dokumentasiInfo);
            
            if($result > 0) {
                $this->session->set_flashdata('success', 'Dokumentasi baru sukses dibuat');
            } else {
                $this->session->set_flashdata('error', 'Dokumentasi gagal dibuat');
            }
            
            redirect('dokumentasi/dokumentasiListing');
        }
    }

    function edit($dokumentasiId = NULL)
    {
        if($dokumentasiId == null)
        {
            redirect('dokumentasi/dokumentasiListing');
        }
        
        $data['dokumentasiInfo'] = $this->dm->getDokumentasiInfo($dokumentasiId);

        $this->global['pageTitle'] = 'Nazar Unggas : Ubah Dokumentasi';
        
        $this->loadViews("dokumentasi/edit", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editDokumentasi()
    {
        $this->load->library('form_validation');
            
        $dokumentasiId = $this->input->post('iddokumentasi');
        
        $this->form_validation->set_rules('jumlah_panen','Jumlah Panen','trim|required');
        $this->form_validation->set_rules('tgl_panen','Tanggal Panen','trim|required');
        $this->form_validation->set_rules('sisa_pakan','Sisa pakan (sak)','trim|required');
        $this->form_validation->set_rules('berat_ayam','Berat Ayam','trim|required');
        $this->form_validation->set_rules('jumlah_biaya','Jumlah Biaya','trim|required');
        $this->form_validation->set_rules('periode_id','Periode','trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->edit($dokumentasiId);
        }
        else
        {
            $jumlah_panen = $this->security->xss_clean($this->input->post('jumlah_panen'));
            $tgl_panen = $this->security->xss_clean($this->input->post('tgl_panen'));
            $sisa_pakan = $this->security->xss_clean($this->input->post('sisa_pakan'));
            $berat_ayam = $this->security->xss_clean($this->input->post('berat_ayam'));
            $jumlah_biaya = $this->security->xss_clean($this->input->post('jumlah_biaya'));
            $periode_id = $this->security->xss_clean($this->input->post('periode_id'));
            
            $dokumentasiInfo = array('jumlah_panen'=>$jumlah_panen, 'tgl_panen'=>$tgl_panen, 'sisa_pakan'=>$sisa_pakan, 'berat_ayam'=>$berat_ayam, 'jumlah_biaya'=>$jumlah_biaya, 'periode_id'=>$periode_id);

            $result = $this->dm->editDokumentasi($dokumentasiInfo, $dokumentasiId);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Dokumentasi updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Dokumentasi updation failed');
            }
            
            redirect('dokumentasi/dokumentasiListing');
        }
    }

    public function delete($id)
    {
        // Hapus data dari database
        $this->db->where('iddokumentasi', $id);
        $this->db->delete('dokumentasi');

        // Tampilkan pesan berhasil dihapus dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect($_SERVER['HTTP_REFERER']);
    }
}

?>