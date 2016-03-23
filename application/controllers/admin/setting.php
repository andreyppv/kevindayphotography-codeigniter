<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Admin_Controller {
    
    protected $menu = 'setting';
    protected $submenu = '';
    protected $pagetitle = 'Settings';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('setting_model');
        
        Assets::add_js('js/pages/settings.js');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index()
    {
        if($this->input->post('btn-save-general'))
        {
            if($this->_save_general())
            {
                Template::set_message('General settings are updated.', 'success');
                redirect($this->uri->uri_string());
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        else if($this->input->post('btn-save-email'))
        {
            if($this->_save_email())
            {
                Template::set_message('Email settings are updated.', 'success');
                redirect($this->uri->uri_string());
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        // Read our current settings
        $settings = $this->settings_lib->find_all();
        Template::set('settings', $settings);
        
        $this->set_view('setting/edit');
        $this->render();    
    }
    
    public function emailtest()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST')
        {
            $this->security->csrf_show_error();
        }

        $this->load->library('emailer');
        $this->emailer->enable_debug(TRUE);

        $data = array(
            'to'        => $this->input->post('email'),
            'subject'   => 'Test Email',
            'message'   => 'If you are seeing this email, then it appears your Bonfire Emailer is working!'
         );

        $results = $this->emailer->send($data, FALSE);

        //Template::set('results', $results);
        
        echo Template::block('test', 'admin/setting/test', array('results' => $results));

    }//end test()
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_general()
    {
        $this->form_validation->set_rules('title', 'Site Title', 'required|trim|strip_tags|xss_clean');
        $this->form_validation->set_rules('status', 'Site Status', 'required|trim|strip_tags|xss_clean');
        
        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }
        
        $data = array(
            array('name' => 'site.title', 'value' => $this->input->post('title')),
            array('name' => 'site.status', 'value' => $this->input->post('status')),
        );

        // save the settings to the DB
        return $this->setting_model->update_batch($data, 'name');
    }
    
    private function _save_email()
    {
        $this->form_validation->set_rules('sender_email', 'System Email', 'required|trim|valid_email|max_length[120]|xss_clean');
        $this->form_validation->set_rules('protocol', 'Email Server', 'trim|xss_clean');

        if ($this->input->post('protocol') == 'sendmail')
        {
            $this->form_validation->set_rules('mailpath', 'Sendmail Path', 'required|trim|xss_clean');
        }
        elseif ($this->input->post('protocol') == 'smtp')
        {
            $this->form_validation->set_rules('smtp_host', 'SMTP Server Address', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('smtp_user', 'SMTP Username', 'trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('smtp_pass', 'SMTP Password', 'trim|strip_tags|matches_pattern[[A-Za-z0-9!@#\%$^&+=]{2,20}]');
            $this->form_validation->set_rules('smtp_port', 'SMTP Port', 'trim|strip_tags|numeric|xss_clean');
            $this->form_validation->set_rules('smtp_timeout', 'SMTP timeout', 'trim|strip_tags|numeric|xss_clean');
        }
        
        if ($this->form_validation->run() === FALSE)
        {
            return FALSE;
        }
        
        $data = array(
            array('name' => 'site.system_email', 'value' => $this->input->post('sender_email')),
            array('name' => 'mailtype', 'value' => $this->input->post('mailtype')),
            array('name' => 'protocol', 'value' => strtolower($_POST['protocol'])),
            array('name' => 'mailpath', 'value' => $_POST['mailpath']),
            array('name' => 'smtp_host', 'value' => isset($_POST['smtp_host']) ? $_POST['smtp_host'] : ''),
            array('name' => 'smtp_user', 'value' => isset($_POST['smtp_user']) ? $_POST['smtp_user'] : ''),
            array('name' => 'smtp_pass', 'value' => isset($_POST['smtp_pass']) ? $_POST['smtp_pass'] : ''),
            array('name' => 'smtp_port', 'value' => isset($_POST['smtp_port']) ? $_POST['smtp_port'] : ''),
            array('name' => 'smtp_timeout', 'value' => isset($_POST['smtp_timeout']) ? $_POST['smtp_timeout'] : '5')
         );

        // save the settings to the DB
        return $this->setting_model->update_batch($data, 'name');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */