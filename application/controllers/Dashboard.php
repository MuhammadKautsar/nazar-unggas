<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Dashboard extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('dashboard_model');
        $this->isLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'Nazar Unggas : Dashboard';

        $total_users = $this->dashboard_model->get_total_users();
        $total_periode = $this->dashboard_model->get_total_periode();
        $total_dokumentasi = $this->dashboard_model->get_total_dokumentasi();
        $total_data_harian = $this->dashboard_model->get_total_data_harian();
        $total_biaya_operasional = $this->dashboard_model->get_total_biaya_operasional();

        $data = array(
            'total_users' => $total_users,
            'total_periode' => $total_periode,
            'total_dokumentasi' => $total_dokumentasi,
            'total_data_harian' => $total_data_harian,
            'total_biaya_operasional' => $total_biaya_operasional,
        );

        $this->loadViews('general/dashboard', array_merge($this->global, $data));
    }
}
