<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Thumbnail extends Base_Controller {

	/**
	 * Simply redirects all calls to the index() method.
	 *
	 * @param string $file The name of the image to return.
	 */
	public function _remap($file=null)
	{
		$this->index($file);
	}//end _remap()

	//--------------------------------------------------------------------

	/**
	 * Performs the image processing based on the parameters provided in the GET request
	 *
	 * @param string $file The name of the image to return.
	 */
	public function index()
	{
        $file   = $this->input->get('file');
        $height = $this->input->get('height');
        $width  = $this->input->get('width');
        $crop   = $this->input->get('crop');
        $force  = $this->input->get('force');
        
		if (empty($file) || !is_string($file))
        {
            //die('No image to process.');
            //return '';   
            $file = 'placeholder.png';
        }

        $this->output->enable_profiler(false);

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
        
        if (!is_file($new_file) || $force == 'yes')
        {                                   
            $config = array(
                'image_library' => 'gd2',
                'source_image'  => $img_file,
                'new_image'     => $new_file,
                'create_thumb'  => false,
                'maintain_ratio'=> $crop == 'no' ? false: true,
                'width'         => $width,
                'height'        => $height,
            );

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
        }

        $this->output
            ->set_content_type($ext)
            ->set_output(file_get_contents($new_file));
	}//end index()

	//--------------------------------------------------------------------

}//end class
