<?php

class Admin_Controller extends Base_Controller
{
    protected $side = '';
    protected $menu = '';
    protected $submenu = '';
    protected $pagetitle = '';
    
    public function __construct()
    {
        parent::__construct();
        
        // Make sure we're logged in.  
        $this->admin_auth->restrict();
        
        // Pagination config
        $this->pager = array();
        $this->pager['full_tag_open']   = '<div id="data-table_paginate" class="dataTables_paginate paging_simple_numbers"><ul class="pagination">';
        $this->pager['full_tag_close']  = '</ul></div>';
        $this->pager['next_link']       = 'Next';
        $this->pager['prev_link']       = 'Previous';
        $this->pager['next_tag_open']   = '<li>';
        $this->pager['next_tag_close']  = '</li>';
        $this->pager['prev_tag_open']   = '<li>';
        $this->pager['prev_tag_close']  = '</li>';
        $this->pager['first_tag_open']  = '<li>';
        $this->pager['first_tag_close'] = '</li>';
        $this->pager['last_tag_open']   = '<li>';
        $this->pager['last_tag_close']  = '</li>';
        $this->pager['cur_tag_open']    = '<li class="active"><a href="#">';
        $this->pager['cur_tag_close']   = '</a></li>';
        $this->pager['num_tag_open']    = '<li>';
        $this->pager['num_tag_close']   = '</li>';

        $this->limit = 20;
        
        Template::set_theme($this->config->item('template.admin_theme'), 'junk');
    }
    
    protected function set_view($view)
    {
        Template::set('side', $this->side);
        Template::set('menu', $this->menu);
        Template::set('submenu', $this->submenu);
        Template::set('pagetitle', $this->pagetitle);
        
        parent::set_view("admin/$view");
    }
    
    protected function include_datatable_assets($inds= array(1))
    {
        Assets::add_css('js/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css');
        Assets::add_css('js/plugins/datatables-responsive/css/dataTables.responsive.css');
        Assets::add_js('js/plugins/datatables/media/js/jquery.dataTables.min.js');
        Assets::add_js('js/plugins/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js');
        Assets::add_js(theme_view('parts/datatable_js', array('inds' => $inds), true), 'inline');
    }
    
    //--------------------------------------------------------------------
    protected function setup_pagination($base_uri, $total_rows, $uri_segment=3)
    {
        $this->load->library('pagination');
        
        $this->pager['base_url']    = site_url($base_uri);
        $this->pager['total_rows']  = $total_rows;
        $this->pager['per_page']    = $this->limit;
        $this->pager['uri_segment'] = $uri_segment;
        $this->pager['first_url']   = site_url($base_uri . $this->_get_pagination_suffix());
        $this->pager['suffix']      = $this->_get_pagination_suffix();   
        
        $this->pagination->initialize($this->pager);
    }
    
    protected function _get_pagination_orderby()
    {
        $result = 'asc';
        
        $orderby = $this->input->get('orderby');
        switch($orderby)
        {
            case 'asc':
            case 'desc':
                $result = $orderby;
                break;
        } 
        
        return $result;
    }
    
    private function _get_pagination_suffix()
    {
        $result = array();
        
        //add order fields
        $order = $this->input->get('order');
        $order_by = $this->_get_pagination_orderby();
        if($order != '') 
        {
            $result[] = "order=".$this->input->get('order');
            $result[] = "orderby=$order_by";
        }
        
        $str = '';
        if(!empty($result))
        {
            $str = "?" . join('&amp;', $result);
        }
        
        return $str;
    }
}