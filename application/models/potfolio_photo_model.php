<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Potfolio_photo_model extends BF_Model
{
    protected $table = 'potfolio_photos';   
    protected $set_created = FALSE;
    protected $set_modified = FALSE;
    
    public function __construct()
    {
        parent::__construct();
    }    
    
    public function main_image($potfolio_id)
    {
        $row = $this
            ->where('potfolio_id', $potfolio_id)
            ->where('main', 1)
            ->find_one();
        
        if(empty($row)) return '';
        
        return $row->link;
    }
}//end User_model
