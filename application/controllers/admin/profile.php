<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends Admin_Controller {
    
    protected $menu = 'profile';
    protected $submenu = '';
    protected $pagetitle = 'My Profile';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin_model');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index()
    {
        if($this->input->post('btn-save'))
        {
            if($this->_save_info())
            {
                Template::set_message('Your account info is updated.', 'success');
                redirect($this->uri->uri_string());
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/member_avatar.js');
        
        $row = $this->admin_model->find($this->current_user->id);
        Template::set('row', $row);
        
        $this->set_view('profile/edit');
        $this->render();    
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info()
    {
        $id = $this->current_user->id;
        $_POST['id'] = $id;
        
        $this->form_validation->set_rules('user-email', 'Email', "required|trim|unique_email[admins.email,admins.id]|valid_email|xss_clean|strip_tags");
        $this->form_validation->set_rules('user-name', 'Name', 'required|trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('user-password', 'Password', 'required|trim|check_old_password|xss_clean|strip_tags');
        
        if($this->input->post('check-new-password'))
        {
            $this->form_validation->set_rules('new-password', 'New Password', 'required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('new-password-confirm', 'New Password Confirmation', 'required|trim|xss_clean|strip_tags|matches[new-password]');
        }
        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'name'  => $this->input->post('user-name'),
            'email'  => $this->input->post('user-email'),
        ]; 
        
        //if new password
        if($this->input->post('check-new-password'))
        {
            $salt = random_string('alnum', 7);
            $data['salt'] = $salt;
            $data['password_hash'] = do_hash($salt . $this->input->post('new-password'));
        }
        
        //if avatar
        if(isset($_FILES['user-avatar']) && $_FILES['user-avatar']['name'] != '')
        {
            $result = $this->upload_image('user-avatar', 'user');
            if($result['status'])
            {
                $data['avatar'] = $result['image_name'];
            }            
            else
            {
                //$this->form_validation->set_message('tstm-avatar', $result['error'][0]);
                Template::set('user_avatar_message', $result['error'][0]);
                return false;
            }
        }  
        
        return $this->admin_model->update($id, $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */