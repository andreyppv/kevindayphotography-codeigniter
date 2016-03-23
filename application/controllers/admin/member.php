<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends Admin_Controller {
    
    protected $menu = 'member';
    protected $submenu = '';
    protected $pagetitle = 'Members';
    
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
        $this->include_datatable_assets(array(1, 5));
        
        $members = $this->admin_model
            ->where('id !=', $this->current_user->id)
            ->find_all_empty_array();
        Template::set('rows', $members);
         
        $this->set_view('member/index');
        $this->render();
    }
    
    public function create()
    {
        if($this->input->post('btn-save'))
        {
            if($this->_save_info())
            {
                Template::set_message('New member is created.', 'success');
                redirect(admin_uri('member'));
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/member_avatar.js');
        
        $this->set_view('member/create');
        $this->render();    
    }
    
    public function edit($id)
    {
        if($this->input->post('btn-save'))
        {
            if($this->_save_info($id))
            {
                Template::set_message('Member is updated.', 'success');
                redirect(admin_uri('member'));
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/member_avatar.js');
        
        $row = $this->admin_model->find($id);
        Template::set('row', $row);
        
        $this->set_view('member/edit');
        $this->render();    
    }
    
    public function delete($id)
    {
        $user = $this->admin_model->find($id);
        if(empty($user))
        {
            Template::set_message('User doesn\'t exist.', 'danger');
        }
        else
        {
            if($this->admin_model->delete($id))
            {
                Template::set_message("$user->name is deleted from system.", 'success');
            }
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }
        }
        
        redirect(admin_uri('member'));
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info($id=0)
    {
        //for when edit user
        $email_extra_rule = '';
        $new_password = FALSE;
        if($id != 0)
        {
            $_POST['id'] = $id;
            $email_extra_rule = ',admins.id';
            
            if($this->input->post('password') || $this->input->post('password-confirm'))
            {
                $this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|strip_tags');
                $this->form_validation->set_rules('password-confirm', 'Password Confirmation', 'trim|xss_clean|strip_tags|matches[password]');
                $new_password = TRUE;
            }            
        }
        else
        {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean|strip_tags');
            $this->form_validation->set_rules('password-confirm', 'Password Confirmation', 'required|trim|xss_clean|strip_tags|matches[password]');
            
            $new_password = TRUE;
        }
        
        $this->form_validation->set_rules('user-email', 'Email', "required|trim|unique_email[admins.email$email_extra_rule]|valid_email|xss_clean|strip_tags");
        $this->form_validation->set_rules('user-name', 'Name', 'required|trim|xss_clean|strip_tags');
        
        
        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'name'  => $this->input->post('user-name'),
            'email'  => $this->input->post('user-email'),
        ]; 
        
        //need to update password
        if($new_password == TRUE)
        {
            $salt = random_string('alnum', 7);
            $data['salt'] = $salt;
            $data['password_hash'] = do_hash($salt . $this->input->post('password'));
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
        
        if($id == 0)
        {
            return $this->admin_model->insert($data);
        }
        else
        {
            return $this->admin_model->update($id, $data);
        }
        
        return FALSE;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */