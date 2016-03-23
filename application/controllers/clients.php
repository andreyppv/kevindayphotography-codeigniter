<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clients extends Base_Controller {

    protected $page_title2 = 'Kevin&rsquo;s Clients';
    protected $menu = 'clients';
        
    public function index()
    {   
        $this->load->model('client_model');
        
        $rows = $this->client_model
            ->order_by('name')
            ->find_all_empty_array();
        Template::set('rows', $rows);
        
        $this->render();
    }
}