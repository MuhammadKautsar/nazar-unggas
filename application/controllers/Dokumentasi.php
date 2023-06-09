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
        
        $count = $this->dm->dokumentasiListingCount($searchText);

        $returns = $this->paginationCompress ( "dokumentasiListing/", $count, 10 );

        $tahun_selected = $this->input->get('tahun') ? $this->input->get('tahun') : '';
        $periode_selected = $this->input->get('periode') ? $this->input->get('periode') : '';
        
        $data['records'] = $this->dm->dokumentasiListing($searchText, $returns["page"], $returns["segment"]);
        $data['tahun'] = $this->dm->get_years();
        $data['periode'] = $this->dm->get_periodes();
        $data['tahun_selected'] = $tahun_selected;
        $data['periode_selected'] = $periode_selected;
        
        $this->global['pageTitle'] = 'Nazar Unggas : Dokumentasi';
        
        $this->loadViews("dokumentasi/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $data['periodes'] = $this->dm->getDataPeriodes();

        $this->global['pageTitle'] = 'Nazar Unggas : Tambah Periode Baru';

        $this->loadViews("dokumentasi/add", $this->global, $data, NULL);
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
        
        $data['periodes'] = $this->dm->getDataPeriodes();
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

    public function pdf($dokumentasiId = NULL)
    {
        $this->load->library('pagination');

        $tahun = $this->input->get('tahun');
        $periode = $this->input->get('periode');

        if(!empty($dokumentasiId)){
            // Load data for a single row using the ID
            $data['title'] = 'Dokumentasi';
            $data['record'] = $this->dm->getDokumentasiInfo($dokumentasiId);
            
            $html = $this->load->view("dokumentasi/pdf_single", $data, TRUE);

            // Set the filename as the ID of the record
            $filename = 'Dokumentasi-'. $dokumentasiId . '.pdf';
            generatePDF($html, $filename);
        } else {
            // Load data for all rows based on the filter
            $data['title'] = 'Dokumentasi';
            $data['records'] = $this->dm->filter_data($tahun, $periode);
            $data['tahun_selected'] = $tahun;
            $data['periode_selected'] = $periode;
            
            $html = $this->load->view("dokumentasi/pdf", $data, TRUE);

            generatePDF($html, 'Dokumentasi');
        }
    }

    public function filter()
    {
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;

        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('periode');
        
        $data['records'] = $this->dm->filter_data($tahun, $periode);
        $data['tahun'] = $this->dm->get_years();
        $data['periode'] = $this->dm->get_periodes();
        $data['tahun_selected'] = $tahun;
        $data['periode_selected'] = $periode;
        
        $this->load->library('pagination');

        $this->global['pageTitle'] = 'Nazar Unggas : Dokumentasi';
        
        $this->loadViews("dokumentasi/list", $this->global, $data, NULL);
    }
}

?>