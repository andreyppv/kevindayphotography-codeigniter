<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends Base_Controller {
    
    public function __construct()
    {
        parent::__construct();
        
        Template::set_theme($this->config->item('template.admin_theme'), 'junk');
    }
   
    public function login()
    {
        // if the user is not logged in continue to show the login page
        if ($this->admin_auth->is_logged_in()) redirect(admin_uri());  
        
        if ($this->input->post('btn-login'))
        {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember = $this->input->post('remember_me') == '1' ? TRUE : FALSE;
        
            // Try to login
            if ($this->admin_auth->login($username, $password, $remember) === TRUE)
            {
                if (!empty($this->requested_page))
                {
                    redirect($this->requested_page);
                }
                else                
                {
                    redirect(admin_uri()); 
                }
            }//end if
        }//end if
    
        Template::set_view('account/login');
        $this->render('auth');
    }
    
    public function logout()
    {
        $this->admin_auth->logout();

        redirect(admin_url('login'));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */