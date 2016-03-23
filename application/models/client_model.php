<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Client_model extends BF_Model
{
    protected $table = 'clients';   
    
    public function __construct()
    {
        parent::__construct();
    }
}//end User_model
