<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Periode extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Periode_model', 'pm');
        $this->isLoggedIn();
        $this->module = 'Periode';
    }

    /**
     * This is default routing method
     * It routes to default listing page
     */
    public function index()
    {
        redirect('periode/periodeListing');
    }
    
    function periodeListing()
    {
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;
            
        $this->load->library('pagination');
            
        $count = $this->pm->periodeListingCount($searchText);

		$returns = $this->paginationCompress ( "periodeListing/", $count, 10 );
            
        $data['records'] = $this->pm->periodeListing($searchText, $returns["page"], $returns["segment"]);
            
        $this->global['pageTitle'] = 'Nazar Unggas : Periode';
            
        $this->loadViews("periode/list", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function add()
    {
        $this->global['pageTitle'] = 'Nazar Unggas : Tambah Periode Baru';

        $this->loadViews("periode/add", $this->global, NULL, NULL);
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewPeriode()
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('tanggal_mulai','Tanggal Mulai','trim|required');
        $this->form_validation->set_rules('jumlah_doc','Jumlah_doc','trim|required|max_length[5]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->add();
        }
        else
        {
            $tanggal_mulai = $this->security->xss_clean($this->input->post('tanggal_mulai'));
            $jumlah_doc = $this->security->xss_clean($this->input->post('jumlah_doc'));
           
            $periodeInfo = array('tanggal_mulai'=>$tanggal_mulai, 'jumlah_doc'=>$jumlah_doc, 'status'=>'Aktif');
                
            $result = $this->pm->addNewPeriode($periodeInfo);
                
            if($result > 0) {
                $this->session->set_flashdata('success', 'Periode baru sukses dibuat');
            } else {
                 $this->session->set_flashdata('error', 'Periode gagal dibuat');
            }
                
            redirect('periode/periodeListing');
        }
    }

    function edit($periodeId = NULL)
    {
        if($periodeId == null)
        {
            redirect('periode/periodeListing');
        }
            
        $data['periodeInfo'] = $this->pm->getPeriodeInfo($periodeId);

        $this->global['pageTitle'] = 'Nazar Unggas : Ubah Periode';
            
        $this->loadViews("periode/edit", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editPeriode()
    {
        $this->load->library('form_validation');
            
        $periodeId = $this->input->post('idperiode');
            
        // $this->form_validation->set_rules('tanggal_mulai','Tanggal Mulai','trim|required');
        // $this->form_validation->set_rules('jumlah_doc','Jumlah_doc','trim|required|max_length[5]');
        $this->form_validation->set_rules('status','Status','trim|required');
            
        if($this->form_validation->run() == FALSE)
        {
            $this->edit($periodeId);
        }
        else
        {
            // $tanggal_mulai = $this->security->xss_clean($this->input->post('tanggal_mulai'));
            // $jumlah_doc = $this->security->xss_clean($this->input->post('jumlah_doc'));
            $status = $this->security->xss_clean($this->input->post('status'));
                
            // $periodeInfo = array('tanggal_mulai'=>$tanggal_mulai, 'jumlah_doc'=>$jumlah_doc, 'status'=>$status);
            $periodeInfo = array('status'=>$status);

            $result = $this->pm->editPeriode($periodeInfo, $periodeId);
                
            if($result == true)
            {
                $this->session->set_flashdata('success', 'Periode updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Periode updation failed');
            }
                
            redirect('periode/periodeListing');
        }
    }

    public function delete($id)
    {
        // Lakukan penghapusan data berdasarkan id
        $this->db->where('idperiode', $id);
        $this->db->delete('periode');

        if ($this->db->affected_rows() > 0) {
            // Data berhasil dihapus
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            redirect('periodeListing');
        } else {
            // Tidak ada data yang dihapus
            $this->session->set_flashdata('error', 'Data tidak berhasil dihapus karena sudah memiliki relasi.');
            redirect('periodeListing');
        }
    }
}

?>