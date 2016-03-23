<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('e'))
{
	/*
		Function: e()

		A convenience function to make sure your output is safe to display.
		Helps to defeat XSS attacks by running the text through htmlentities().

		Should be used anywhere you are displaying user-submitted text.
	*/
	function e($str)
	{
		echo htmlentities($str, ENT_QUOTES, 'UTF-8');
	}
}

if ( !function_exists('array_with_empty') )
{
    function array_with_empty($array, $empty_text='Select')
    {
        $empty = array('' => $empty_text);
        
        return array_merge($empty, (array)$array);
    }
}

if(!function_exists('mkpath')) 
{
    function mkpath($path)
    {
        if(@mkdir($path) or file_exists($path)) return true;
        return (mkpath(dirname($path)) and mkdir($path));
    }
}

if ( !function_exists('cache_image_path') )
{
    function cache_image_path($file, $width=50, $height=50, $crop=true, $force=false)
    {
        if (empty($file) || !is_string($file))
        {
            //die('No image to process.');
            return '';   
        }

        $ci =& get_instance();
        $ci->output->enable_profiler(false);

        // Get our params
        $assets = UPLOAD_PATH;
        $ext = pathinfo($file, PATHINFO_EXTENSION);

        if (empty($ext))
        {            
            //die('Filename does not include a file extension.');
            return '';
        }

        // For now, simply return the file....
        $img_file = $assets .'/'. $file;
        if (!is_file($img_file))
        {
            //die('Image could not be found.');
            return '';
        }
        
        //$new_file_uri = CACHE_PATH . '/'. str_replace('.'. $ext, '', $file) ."_{$width}x{$height}.". $ext;   
        $uri = CACHE_PATH . "/{$width}x{$height}/". str_replace('.'. $ext, '', $file) . ".". $ext;
        $new_file = FCPATH . $uri;
        $new_file_path = dirname($new_file);
        if(!mkpath($new_file_path))
        {
            //die('Path is not writeable.');
            return '';
        }
        
        if (!is_file($new_file))
        {                                    
            $config = array(
                'image_library' => 'gd2',
                'source_image'  => $img_file,
                'new_image'     => $new_file,
                'create_thumb'  => false,
                'maintain_ratio'=> $crop,
                'width'         => $width,
                'height'        => $height,
            );

            $ci->load->library('image_lib', $config);

            $ci->image_lib->resize();
        }

        return site_url($uri);
        /*$ci->output
            ->set_content_type($ext)
            ->set_output(file_get_contents($new_file));*/
    }//end index()
}

if ( !function_exists('thumbnail') )
{
    function thumbnail($file, $width=50, $height=50, $crop='yes')
    {
        $upload_base_path = UPLOAD_PATH;
        
        /*$result = cache_image_path($file, $width, $height);
        if($result == '') 
        {
            $result = Template::theme_url('images/placeholder.png');
        }*/
        
        //return $result;
        
        $url = site_url("thumbnail?file=$file&width=$width&height=$height&crop=$crop");
        return $url;
    }         
}

if ( !function_exists('th_sort_column') )
{
    function th_sort_column($base_uri, $col_label, $order_field)
    {
        $ci =& get_instance();
        
        $order = $ci->input->get('order');
        $order_by = $ci->input->get('orderby');
        
        $class = 'sorting';
        if($order_field == $order)
        {
            if($order_by == 'asc') 
            {
                $class = 'sorting_asc';
            }
            else 
            {
                $class = 'sorting_desc';
            }
        }
        
        $link = site_url($base_uri . sort_link($order_field)); 
        $result = "<th class='sort_th $class' data-href='$link'>$col_label</th>";
        return $result;        
    }
}

if ( !function_exists('sort_link') )
{
    function sort_link($order_field='')
    {     
        $ci = &get_instance();
        
        $order = $ci->input->get('order');
        $order_by = $ci->input->get('orderby');
        
        $stack = array();
        $stack[] = "order=" . $order_field;  
        if($order == $order_field) $stack[] = 'orderby=' . ($order_by == 'asc' ? 'desc' : 'asc');         
        else $stack[] = 'orderby=asc';
        
        $query = '';
        if(!empty($stack))
        {
            $query .= '?' . join('&', $stack);
        }
        
        return $query;
    }
}