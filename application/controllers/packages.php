<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packages extends Base_Controller {

    protected $page_title2 = 'Photography Packages';
    protected $menu = 'packages';
        
    public function index()
    {   
        $this->render();
    }
}