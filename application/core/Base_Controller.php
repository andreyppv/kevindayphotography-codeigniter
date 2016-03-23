<?php

class Base_Controller extends MX_Controller
{
    /**
     * Stores the previously viewed page's complete URL.
     *
     * @var string
     */
    protected $previous_page;

    /**
     * Stores the page requested. This will sometimes be
     * different than the previous page if a redirect happened
     * in the controller.
     *
     * @var string
     */
    protected $requested_page;

    /**
     * Stores the current user's details, if they've logged in.
     *
     * @var object
     */
    protected $current_user = NULL;

    protected $page_title = '';
    protected $page_title2 = '';
    protected $menu = '';
    //--------------------------------------------------------------------

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->driver('cache', array('adapter' => 'dummy'));
         
        // Load our current logged in user so we can access it anywhere.
        $this->load->library('admin_auth');
        if ($this->admin_auth->is_logged_in())
        {
            $this->current_user = $this->admin_model->find($this->admin_auth->user_id());
            $this->current_user->id = (int)$this->current_user->id;
        }

        // Make the current user available in the views
        $this->load->vars( array('current_user' => $this->current_user) );
        
        // Make sure no assets in up as a requested page or a 404 page.
        if ( ! preg_match('/\.(gif|jpg|jpeg|png|css|js|ico|shtml)$/i', $this->uri->uri_string()))
        {
            $this->previous_page = $this->session->userdata('previous_page');
            $this->requested_page = $this->session->userdata('requested_page');
        }
        
        Template::set_theme($this->config->item('default_theme'));
        
        //get settings
        $settings = $this->settings_lib->find_all();
        Template::set('settings', $settings);
    }//end __construct()

    //--------------------------------------------------------------------
    
    protected function render($layout='')
    {
        Template::set('page_title', $this->page_title);
        Template::set('page_title2', $this->page_title2);
        Template::set('menu', $this->menu);
        Template::render($layout);
    }
    
    protected function set_view($view)
    {
        Template::set_view($view);
    }
    
    protected function upload_image($filed_file_name, $sub_roo_path='')
    {
        $file_name = $_FILES[$filed_file_name]['name'];
        $file_path = strtolower($sub_roo_path . '/' . random_string('alnum', 1) . '/' . random_string('alnum', 1));
        
        $config['upload_path'] = FCPATH . UPLOAD_PATH . '/' . $file_path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '3000000';
        $config['max_width']  = '5500';
        $config['max_height']  = '5000';
        $config['overwrite'] = FALSE;
        //$config['encrypt_name'] = FALSE;
        //$config['remove_spaces'] = TRUE;
        if(!mkpath($config['upload_path'])) return NULL;
        
        $this->load->library('upload', $config);
        
        $status = $this->upload->do_upload($filed_file_name);
        $data = $this->upload->data();
        
        $result = array('status' => true, 'image_name' => '', 'error' => '');
        if($status)
        {
            $result['image_name'] = $file_path . '/' . $data['file_name'];
        }
        else 
        {
            $result['status'] = false;
            $result['error'] = $this->upload->error_msg;
        }
        
        return $result;
    }
}//end Base_Controller