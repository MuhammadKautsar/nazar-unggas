<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 */
class User extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->isLoggedIn();
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        // $this->global['pageTitle'] = 'Nazar Unggas : Dashboard';
        
        // $this->loadViews("general/dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function userListing()
    { 
        $searchText = '';
        if(!empty($this->input->post('searchText'))) {
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
        }
        $data['searchText'] = $searchText;
        
        $this->load->library('pagination');
        
        $count = $this->user_model->userListingCount($searchText);

        $returns = $this->paginationCompress ( "userListing/", $count, 10 );
        
        $data['userRecords'] = $this->user_model->userListing($searchText, $returns["page"], $returns["segment"]);
        
        $this->global['pageTitle'] = 'Nazar Unggas : User Listing';
        
        $this->loadViews("users/users", $this->global, $data, NULL);
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        $this->load->model('user_model');
            
        $this->global['pageTitle'] = 'Nazar Unggas : Add New User';

        $this->loadViews("users/addNew", $this->global, NULL);
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post("userId");
        $email = $this->input->post("email");

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ echo("true"); }
        else { echo("false"); }
    }
    
    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','required|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|required|matches[password]|max_length[20]');
        $this->form_validation->set_rules('phone','Phone Number','required|min_length[12]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->addNew();
        }
        else
        {
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');
            $phone = $this->security->xss_clean($this->input->post('phone'));
            // $isAdmin = $this->input->post('isAdmin');
            $level = 2;
            
            $userInfo = array('username'=>$username, 'password'=>getHashedPassword($password),
                    'nama'=> $nama, 'phone'=>$phone, 'level'=>$level);
            
            $this->load->model('user_model');
            $result = $this->user_model->addNewUser($userInfo);
            
            if($result > 0){
                $this->session->set_flashdata('success', 'New User created successfully');
            } else {
                $this->session->set_flashdata('error', 'User creation failed');
            }
            
            redirect('userListing');
        }
    }

    
    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = NULL)
    {
        if($userId == null)
        {
            redirect('userListing');
        }
        
        $data['userInfo'] = $this->user_model->getUserInfo($userId);

        $this->global['pageTitle'] = 'Nazar Unggas : Edit User';
        
        $this->loadViews("users/editOld", $this->global, $data, NULL);
    }
    
    
    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        $this->load->library('form_validation');
            
        $userId = $this->input->post('userId');
        
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('username','Username','required');
        $this->form_validation->set_rules('password','Password','matches[cpassword]|max_length[20]');
        $this->form_validation->set_rules('cpassword','Confirm Password','matches[password]|max_length[20]');
        $this->form_validation->set_rules('phone','Phone Number','required|min_length[12]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->editOld($userId);
        }
        else
        {
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            $password = $this->input->post('password');
            $phone = $this->security->xss_clean($this->input->post('phone'));
            // $isAdmin = $this->input->post('isAdmin');
            $level = 2;
            
            $userInfo = array();
            
            if(empty($password))
            {
                $userInfo = array('username'=>$username, 'nama'=> $nama, 'phone'=>$phone, 'level'=>$level);
            }
            else
            {
                $userInfo = array('username'=>$username, 'password'=>getHashedPassword($password),
                    'nama'=> $nama, 'phone'=>$phone, 'level'=>$level);
            }
            
            $result = $this->user_model->editUser($userInfo, $userId);
            
            if($result == true)
            {
                $this->session->set_flashdata('success', 'User updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'User updation failed');
            }
            
            redirect('userListing');
        }
    }


    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    public function delete($id)
    {
        // Hapus data dari database
        $this->db->where('userId', $id);
        $this->db->delete('user');

        // Tampilkan pesan berhasil dihapus dan kembali ke halaman sebelumnya
        $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        redirect($_SERVER['HTTP_REFERER']);
    }
    
    /**
     * Page not found : error 404
     */
    function pageNotFound()
    {
        $this->global['pageTitle'] = 'Nazar Unggas : 404 - Page Not Found';
        
        $this->loadViews("general/404", $this->global, NULL, NULL);
    }

    /**
     * This function is used to show users profile
     */
    function profile($active = "details")
    {
        $data["userInfo"] = $this->user_model->getUserInfoById($this->vendorId);
        $data["active"] = $active;
        
        $this->global['pageTitle'] = $active == "details" ? 'Nazar Unggas : My Profile' : 'Nazar Unggas : Change Password';
        $this->loadViews("users/profile", $this->global, $data, NULL);
    }

    /**
     * This function is used to update the user details
     * @param text $active : This is flag to set the active tab
     */
    function profileUpdate($active = "details")
    {
        $this->load->library('form_validation');
            
        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('phone','Phone Number','required|min_length[12]');
        $this->form_validation->set_rules('username','Username','required');        
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $nama = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $username = strtolower($this->security->xss_clean($this->input->post('username')));
            
            $userInfo = array('nama'=>$nama, 'username'=>$username, 'phone'=>$phone);
            
            $result = $this->user_model->editUser($userInfo, $this->vendorId);
            
            if($result == true)
            {
                $this->session->set_userdata('nama', $nama);
                $this->session->set_flashdata('success', 'Profile updated successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile updation failed');
            }

            redirect('profile/'.$active);
        }
    }

    /**
     * This function is used to change the password of the user
     * @param text $active : This is flag to set the active tab
     */
    function changePassword($active = "changepass")
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('oldPassword','Old password','required|max_length[20]');
        $this->form_validation->set_rules('newPassword','New password','required|max_length[20]');
        $this->form_validation->set_rules('cNewPassword','Confirm new password','required|matches[newPassword]|max_length[20]');
        
        if($this->form_validation->run() == FALSE)
        {
            $this->profile($active);
        }
        else
        {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');
            
            $resultPas = $this->user_model->matchOldPassword($this->vendorId, $oldPassword);
            
            if(empty($resultPas))
            {
                $this->session->set_flashdata('nomatch', 'Your old password is not correct');
                redirect('profile/'.$active);
            }
            else
            {
                $usersData = array('password'=>getHashedPassword($newPassword));
                
                $result = $this->user_model->changePassword($this->vendorId, $usersData);
                
                if($result > 0) { $this->session->set_flashdata('success', 'Password updation successful'); }
                else { $this->session->set_flashdata('error', 'Password updation failed'); }
                
                redirect('profile/'.$active);
            }
        }
    }

    /**
     * This function is used to check whether email already exist or not
     * @param {string} $email : This is users email
     */
    function emailExists($email)
    {
        $userId = $this->vendorId;
        $return = false;

        if(empty($userId)){
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if(empty($result)){ $return = true; }
        else {
            $this->form_validation->set_message('emailExists', 'The {field} already taken');
            $return = false;
        }

        return $return;
    }
}

?>