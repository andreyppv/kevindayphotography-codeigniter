<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends Admin_Controller {
    
    protected $menu = 'category';
    protected $submenu = '';
    protected $pagetitle = 'Categories';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('category_model');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index()
    {
        $this->include_datatable_assets(array(2));
        
        $rows = $this->category_model
            ->order_by('cat_name', 'asc')
            ->find_all_empty_array();
        Template::set('rows', $rows);
         
        $this->set_view('category/index');
        $this->render();
    }
    
    public function create()
    {
        if($this->input->post('btn-save'))
        {
            if($this->_save_info())
            {
                Template::set_message('New member is created.', 'success');
                redirect(admin_uri('category'));
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        $this->set_view('category/create');
        $this->render();    
    }
    
    public function edit($id)
    {
        if($this->input->post('btn-save'))
        {
            if($this->_save_info($id))
            {
                Template::set_message('Category is updated.', 'success');
                redirect(admin_uri('category'));
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        $row = $this->category_model->find($id);
        Template::set('row', $row);
        
        $this->set_view('category/edit');
        $this->render();    
    }
    
    public function delete($id)
    {
        $row = $this->category_model->find($id);
        if(empty($row))
        {
            Template::set_message('Category doesn\'t exist.', 'danger');
        }
        else
        {
            if($this->category_model->delete($id))
            {
                Template::set_message("$row->cat_name is deleted from system.", 'success');
            }
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }
        }
        
        redirect(admin_uri('category'));
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info($id=0)
    {
        $this->form_validation->set_rules('cat-name', 'Name', 'required|trim|xss_clean|strip_tags');
        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'cat_name'  => $this->input->post('cat-name'),
        ]; 
        
        if($id == 0)
        {
            return $this->category_model->insert($data);
        }
        else
        {
            return $this->category_model->update($id, $data);
        }
        
        return FALSE;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */