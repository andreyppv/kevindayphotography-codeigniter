<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends Admin_Controller {
   
    protected $menu = 'client';
    protected $submenu = '';
    protected $pagetitle = 'Clients';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('client_model');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index()
    {
        //$this->include_datatable_assets(array(1,6));
        Assets::add_css('js/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');
        Assets::add_css('js/plugins/datatables-responsive/css/dataTables.responsive.css');
        
        $rows = $this->client_model
            ->order_by('name', 'asc')
            ->find_all_empty_array();
        Template::set('rows', $rows);
         
        $this->set_view('client/index');
        $this->render();
    }
    
    public function create()
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($id = $this->_save_info())
            {
                Template::set_message('Client is created.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('client'));
                }
                else
                {
                    redirect(admin_uri('client/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/client_avatar.js');
        
        $this->set_view('client/create');
        $this->render();    
    }
    
    public function edit($id)
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($this->_save_info($id))
            {
                Template::set_message('Client is updated.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('client'));
                }
                else
                {
                    redirect(admin_uri('client/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/client_avatar.js');
        
        $row = $this->client_model->find($id);
        Template::set('row', $row);
        
        $this->set_view('client/edit');
        $this->render();    
    }
    
    public function delete($id)
    {
        if($this->client_model->delete($id))
        {
            Template::set_message("One of client is deleted from system.", 'success');
        }
        else
        {
            Template::set_message('There is an error in saving.', 'danger');
        }
        
        redirect(admin_uri('client'));
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info($id=0)
    {        
        $this->form_validation->set_rules('client-name', 'Name', 'required|trim|xss_clean|strip_tags');
        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'name'     => $this->input->post('client-name'),
        ]; 
        
        //if avatar
        if(isset($_FILES['client-avatar']) && $_FILES['client-avatar']['name'] != '')
        {
            $result = $this->upload_image('client-avatar', 'client');
            if($result['status'])
            {
                $data['avatar'] = $result['image_name'];
            }            
            else
            {
                //$this->form_validation->set_message('tstm-avatar', $result['error'][0]);
                Template::set('client_avatar_message', $result['error'][0]);
                return false;
            }
        }  
        
        if($id == 0)
        {
            return $this->client_model->insert($data);
        }
        else
        {
            return $this->client_model->update($id, $data);
        }
        
        return FALSE;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */