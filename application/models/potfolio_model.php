<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Potfolio_model extends BF_Model
{
    protected $table = 'potfolios';   
    protected $set_created = TRUE;
    protected $set_modified = FALSE;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function delete($id)
    {
        $status = parent::delete($id);
        if($status)
        {
            $this->db
                ->where('potfolio_id', $id)
                ->delete('potfolio_photos');
        }
        
        return $status;
    }
}//end User_model
