<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template {
			
	private $CI;
	private $template = 'progress/wd1/layout';
	private $datas = array();
		
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	function view($view = '' , $view_data = array(), $return = FALSE)
	{               
		$this->set('content', $this->CI->load->view($view, $view_data, TRUE));			
		return $this->CI->load->view($this->template, $this->datas, $return);
	}

	function set($name, $value)
	{
		if(is_string($value) AND !empty($value)) {
			$this->datas[$name] = $value;
			return true;
		}
		return false;
	}
	
	function set_template($value) 
	{
		if(is_string($value) AND !empty($value) AND file_exists('./application/views/progress/wd1/' . $value . '.php'))	{
			$this->template = $value;
			return true;
		}
		return false;
	}
		
}
/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */