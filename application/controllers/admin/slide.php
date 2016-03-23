<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slide extends Admin_Controller {
   
    protected $menu = 'slide';
    protected $submenu = '';
    protected $pagetitle = 'Homepage Slides';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->limit = 20;
        
        $this->load->model('slide_model');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index($offset = 0)
    {
        //$this->include_datatable_assets(array(1,6));
        Assets::add_css('js/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');
        Assets::add_css('js/plugins/datatables-responsive/css/dataTables.responsive.css');
        
        $orders = array();
        $orderby = $this->_get_pagination_orderby();
        $order = $this->input->get('order');
        switch($order)
        {
            case 'name':
                $orders['name'] = $orderby;
                break;
            default:
                $orders['id'] = 'asc';
                break;
        }
        
        $total_rows = $this->slide_model
            ->set_alias()
            ->order_by($orders)
            ->count_all();
            
        $rows = $this->slide_model
            ->order_by($orders)
            ->limit($this->limit, $offset)
            ->find_all_empty_array();
        Template::set('rows', $rows);
        
        //setup pagination
        $this->setup_pagination('slide/index', $total_rows);
        
        Template::set('base_uri', admin_uri('slide/index'));  
        $this->set_view('slide/index');
        $this->render();
    }
    
    public function create()
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($id = $this->_save_info())
            {
                Template::set_message('New slide is created.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('slide'));
                }
                else
                {
                    redirect(admin_uri('slide/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/slide_image.js');
        
        $this->set_view('slide/create');
        $this->render();    
    }
    
    public function edit($id)
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($this->_save_info($id))
            {
                Template::set_message('Slide is updated.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('slide'));
                }
                else
                {
                    redirect(admin_uri('slide/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_js('js/plugins/resample.js');
        Assets::add_js('js/pages/slide_image.js');
        
        $row = $this->slide_model->find($id);
        Template::set('row', $row);
        
        $this->set_view('slide/edit');
        $this->render();    
    }
    
    public function delete($id)
    {
        $row = $this->slide_model->find($id);
        if(empty($row))
        {
            Template::set_message('Slide doesn\'t exist.', 'danger');
        }
        else
        {
            if($this->slide_model->delete($id))
            {
                Template::set_message("$row->name is deleted from system.", 'success');
            }
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }
        }
        
        redirect(admin_uri('slide'));
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info($id=0)
    {        
        $this->form_validation->set_rules('slide-name', 'Name', 'required|trim|xss_clean|strip_tags');
        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'name' => $this->input->post('slide-name'),
            'text' => $this->input->post('slide-text'),
        ]; 
        
        //if avatar
        if(isset($_FILES['slide-image']) && $_FILES['slide-image']['name'] != '')
        {
            $result = $this->upload_image('slide-image', 'slide');
            if($result['status'])
            {
                $data['photo'] = $result['image_name'];
            }            
            else
            {
                //$this->form_validation->set_message('tstm-avatar', $result['error'][0]);
                Template::set('slide_image_message', $result['error'][0]);
                return false;
            }
        }  
        
        if($id == 0)
        {
            return $this->slide_model->insert($data);
        }
        else
        {
            return $this->slide_model->update($id, $data);
        }
        
        return FALSE;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */