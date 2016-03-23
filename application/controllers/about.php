<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends Base_Controller {

    protected $page_title2 = 'About Us';
    protected $menu = 'about';
        
    public function index()
    {                           
        $this->render();
    }
}