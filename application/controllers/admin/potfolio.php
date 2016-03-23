<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Potfolio extends Admin_Controller {
    
    protected $menu = 'potfolio';
    protected $submenu = '';
    protected $pagetitle = 'Potfolios';
    
    public function __construct()
    {
        parent::__construct();
        
        $this->limit = 10;
        
        $this->load->model('potfolio_model');
        $this->load->model('potfolio_photo_model');
    }
    
    /////////////////////////////////////////////////////////////////////
    // ACTION METHODS
    /////////////////////////////////////////////////////////////////////
    public function index($offset = 0)
    {
        //$this->include_datatable_assets(array(3,4));
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
            case 'created_at':
                $orders['created_at'] = $orderby;
                break;
            default:
                $orders['id'] = 'asc';
                break;
        }
        
        $total_rows = $this->potfolio_model
            ->set_alias()
            ->order_by($orders)
            ->count_all();
          
        $rows = $this->potfolio_model
            ->set_alias()
            ->order_by($orders)
            ->limit($this->limit, $offset)
            ->find_all_empty_array();
        Template::set('rows', $rows);
        
        //setup pagination
        $this->setup_pagination('potfolio/index', $total_rows);
        
        Template::set('base_uri', admin_uri('potfolio/index')); 
        $this->set_view('potfolio/index');
        $this->render();
    }
    
    public function create()
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($id = $this->_save_info())
            {
                $this->_process_images($id); 
                
                Template::set_message('Potfolio is created.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('potfolio'));
                }
                else
                {
                    redirect(admin_uri('potfolio/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_css('js/plugins/uploadify/uploadify.css');
        Assets::add_js('js/plugins/uploadify/jquery.uploadify.js');
        Assets::add_js('js/pages/potfolio.js');
        
        $this->set_view('potfolio/create');
        $this->render();    
    }
    
    public function edit($id)
    {
        if($this->input->post('btn-save') || $this->input->post('btn-save-edit'))
        {
            if($this->_save_info($id))
            {
                $this->_process_images($id); 
                
                Template::set_message('Potfolio is updated.', 'success');
                
                if($this->input->post('btn-save'))
                {
                    redirect(admin_uri('potfolio'));
                }
                else
                {
                    redirect(admin_uri('potfolio/edit/'.$id));
                }
            } 
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }   
        }
        
        Assets::add_css('js/plugins/uploadify/uploadify.css');
        Assets::add_js('js/plugins/uploadify/jquery.uploadify.js');
        Assets::add_js('js/pages/potfolio.js');
        
        $row = $this->potfolio_model->find($id);
        Template::set('row', $row);
        
        $images = $this->potfolio_photo_model
            ->where('potfolio_id', $id)
            ->order_by('sort')
            ->find_all_empty_array();
        Template::set('images', $images);
        
        $this->set_view('potfolio/edit');
        $this->render();    
    }
    
    public function delete($id)
    {
        $row = $this->potfolio_model->find($id);
        if(empty($row))
        {
            Template::set_message('Potfolio doesn\'t exist.', 'danger');
        }
        else
        {
            if($this->potfolio_model->delete($id))
            {
                Template::set_message("$row->name is deleted from system.", 'success');
            }
            else
            {
                Template::set_message('There is an error in saving.', 'danger');
            }
        }
        
        redirect(admin_uri('potfolio'));
    }
    
    /////////////////////////////////////////////////////////////////////
    // PRIVATE METHODS
    /////////////////////////////////////////////////////////////////////
    private function _save_info($id=0)
    {
        $this->form_validation->set_rules('potfolio-name', 'Name', 'required|trim|xss_clean|strip_tags');        
        $this->form_validation->set_rules('potfolio-slug', 'Slug', 'required|trim|xss_clean|strip_tags');        
        if ($this->form_validation->run($this) === FALSE)
        {
            return FALSE;
        } 
        
        $data = [
            'name' => $this->input->post('potfolio-name'),
            'slug' => strtolower($this->input->post('potfolio-slug')),
        ]; 
        
        if($id == 0)
        {
            return $this->potfolio_model->insert($data);
        }
        else
        {
            return $this->potfolio_model->update($id, $data);
        }
        
        return FALSE;
    }
    
    public function _process_images($slide_id)
    {
        $jdata = json_decode($this->input->post('image_data'));
        foreach($jdata as $d)
        {
            if($d->type == 'new')
            {
                $upload_path = UPLOAD_PATH . '/';
                
                // Move images to right place
                if(!file_exists($upload_path . $d->src)) continue;
                if($d->remove == '1') continue;
                
                $imagePath = str_replace('tmp/', '', $d->src);
                $targetPath = $upload_path . dirname($imagePath);
                if(!mkpath($targetPath)) continue;
                @rename($upload_path.$d->src, $upload_path.$imagePath);
                
                $image_data = [
                    'potfolio_id' => $slide_id,
                    'link'      => $imagePath,
                    //'url'       => prep_url($d->url),
                    'label'     => $d->label,
                    'main'     => $d->main,
                    'sort'      => $d->sort,
                ];         
                $this->potfolio_photo_model->insert($image_data);
            }
            else
            {
                if($d->remove == '1') 
                {
                    $this->potfolio_photo_model
                        ->delete($d->id); 
                }
                else
                {
                    $data = [
                        'label' => $d->label, 
                        //'url'   => prep_url($d->url), 
                        'main'  => $d->main,
                        'sort'  => $d->sort
                    ];
                    $this->potfolio_photo_model
                        ->update($d->id, $data);
                }
            }
        }  
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */