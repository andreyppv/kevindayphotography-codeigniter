<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Services extends Base_Controller {

    protected $menu = 'services';
        
    public function model_service()
    {   
        $this->page_title2 = 'Photography Model Services';
        $this->render();
    }
    
    public function headshot_service()
    {   
        $this->page_title2 = 'Photography Headshot Services';
        $this->render();
    }
    
    public function child_service()
    {          
        $this->page_title2 = 'Photography Children Services';
        $this->render();
    }
    
    public function life_service()
    {   
        $this->page_title2 = 'Photography Life Services';
        $this->render();
    }
    
    public function music_service()
    {   
        $this->page_title2 = 'Photography Music Services';
        $this->render();
    } 
    
    public function wedding_service()
    {   
        $this->page_title2 = 'Photography Wedding Services';
        $this->render();
    }
}