<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Laporan extends BaseController
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
        redirect('laporan/laporanListing');
    }
    
    function laporanListing()
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

        $tahun_selected = $this->input->get('tahun') ? $this->input->get('tahun') : '';
        $periode_selected = $this->input->get('periode') ? $this->input->get('periode') : '';
        $minggu_selected = $this->input->get('minggu') ? $this->input->get('minggu') : '';
        
        $data['records'] = $this->dhm->dataHarianListing($searchText, $returns["page"], $returns["segment"]);
        $data['tahun'] = $this->dhm->get_years();
        $data['periode'] = $this->dhm->get_periodes();
        $data['minggu'] = $this->dhm->get_minggus();
        $data['tahun_selected'] = $tahun_selected;
        $data['periode_selected'] = $periode_selected;
        $data['minggu_selected'] = $minggu_selected;
        
        $this->global['pageTitle'] = 'Nazar Unggas : Periode';
        
        $this->loadViews("laporan/list", $this->global, $data, NULL);
    }

    public function pdf($jenis='pdf')
    {
        if($jenis=='pdf'){            
            $this->load->library('pagination');

            $tahun = $this->input->get('tahun');
            $periode = $this->input->get('periode');
            $minggu = $this->input->get('minggu');

            $data['title'] = 'Laporan';
            $data['records'] = $this->dhm->filter_data($tahun, $periode, $minggu);
            $data['tahun_selected'] = $tahun;
            $data['periode_selected'] = $periode;
            $data['minggu_selected'] = $minggu;
            
            $html = $this->load->view("laporan/pdf", $data, TRUE);

            generatePDF($html, 'Laporan');
        }
    }

    public function filter()
    {
        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('periode');
        $minggu = $this->input->post('minggu');
        
        $data['records'] = $this->dhm->filter_data($tahun, $periode, $minggu);
        $data['tahun'] = $this->dhm->get_years();
        $data['periode'] = $this->dhm->get_periodes();
        $data['minggu'] = $this->dhm->get_minggus();
        $data['tahun_selected'] = $tahun;
        $data['periode_selected'] = $periode;
        $data['minggu_selected'] = $minggu;
        
        $this->load->library('pagination');

        $this->global['pageTitle'] = 'Nazar Unggas : Laporan';
        
        $this->loadViews("laporan/list", $this->global, $data, NULL);
    }
}

?>