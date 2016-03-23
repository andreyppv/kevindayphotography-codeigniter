<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Base_Controller {

    protected $page_title = 'Corporate Headshot and Fashion Photographer';
    protected $menu = 'home';
        
    public function index()
	{   
        $this->load->model('slide_model');
        
        $slides = $this->slide_model
            ->order_by('id', 'asc')
            ->find_all();
        Template::set('slides', $slides);
                
        $this->render();
	}
}