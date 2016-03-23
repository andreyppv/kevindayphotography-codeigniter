<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends BF_Model
{
    protected $table = 'categories';   
    protected $key = 'cat_id';
    protected $set_created = FALSE;
    protected $set_modified = FALSE;
    
    public function __construct()
    {
        parent::__construct();
    }
}//end User_model
