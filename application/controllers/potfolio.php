<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
class Potfolio extends Base_Controller {

    protected $menu = 'potfolio';
        
    public function index($slug='')
    {   
        $this->load->model('potfolio_model');
        $this->load->model('potfolio_photo_model');
        
        $row = $this->potfolio_model
            ->where('slug', $slug)
            ->find_one();
        $photos = array();
        if(!empty($row))
        {
            $photos = $this->potfolio_photo_model
                ->where('potfolio_id', $row->id)
                ->order_by('sort')
                ->find_all_empty_array();
        }
        Template::set('row', $row);
        Template::set('photos', $photos);
        
        $this->render();
    }
}