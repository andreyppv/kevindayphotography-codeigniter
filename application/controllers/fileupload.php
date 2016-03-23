<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fileupload extends Base_Controller {
    
    public function __construct()
    {
        parent::__construct();
    }
   
    public function potfolio()
    {
        $this->_upload_files('tmp/potfolio');    
    }
    
    private function _upload_files($base_path='')
    {
        $result = $this->upload_image('Filedata', $base_path);
        
        $data = array('msg' => '', 'path' => '', 'src' => '');
        if($result['status'] == true)
        {
            $data['path'] =  site_url('assets/uploads/' . $result['image_name']);
            $data['src'] = $result['image_name'];
        } 
        else
        {
            $data['msg'] = $result['error'];
        }
        
        echo json_encode($data);
        exit;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */