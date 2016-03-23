<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends BF_Model
{
    protected $table = 'admins';   
    
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns the most recent login attempts and their description.
     *
     * @access public
     *
     * @param int $limit An INT which is the number of results to return.
     *
     * @return bool|array An array of objects with the login information.
     */
    public function get_login_attempts($limit=15)
    {
        $this->db->limit($limit);
        $this->db->order_by('login', 'desc');
        $query = $this->db->get('admin_login_attempts');

        if ($query->num_rows())
        {
            return $query->result();
        }

        return FALSE;

    }//end get_login_attempts()
}//end User_model
