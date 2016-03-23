<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    
    protected $menu = 'dashboard';
    protected $submenu = '';
    protected $pagetitle = 'Dashboard';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('admin_model');
    }
   
    public function index()
    {
        $members = $this->admin_model->count_all();
        Template::set('members', $members);
        
        $this->set_view('dashboard/index');
        $this->render();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */