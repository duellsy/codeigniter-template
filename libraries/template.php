<?php
/**
 * @name subootmpl
 * @author Chris Duell
 * @author_url http://www.subooa.com.au
 * @version 2.0
 * @license GPL
 *
 */
class Template
{
	var $CI;

	var $css_raw = '';
	var $css_load = '';
	var $js_raw = '';
	var $js_load = '';
	var $messages = array('success' => array(), 'notice' => array(), 'warning' => array());
	

	public function __construct($config = array())
	{
			
		$this->CI =& get_instance();
			
		if (count($config) > 0) {
			$this->initialize($config);
		} else {
			$this->_load_config_file();
		}
		
		$this->data['user'] = $this->CI->quickauth->user();		

			
	}


	/**
	 * Initialize the template base preferences
	 *
	 * Accepts an associative array as input, containing display preferences
	 *
	 * @access	public
	 * @param	array	config preferences
	 * @return	void
	 */
	function initialize($config = array())
	{
		foreach ($config as $key => $val)
		{
			$this->$key = $val;
		}
	}
	
	
	/**
	 * Load template specific config items 
	 * from config/subooatmpl.php
	 *
	 * including loading up default css, js and head tags
	 */
	private function _load_config_file()
	{
		if ( ! @include(APPPATH.'config/template'.EXT))
		{
			return FALSE;
		}

		foreach($template_conf as $citem => $cval)
		{
			$this->data[$citem] = $cval;
		}
		unset($tempalte_conf);
		
		
		// display the profiler if in dev mode
		if($this->data['devmode']){
			$this->CI->output->enable_profiler(TRUE);
		}


		foreach($template_css as $css)
		{
			$this->add_css($css);
		}
		unset($tempalte_css);


		foreach($template_js as $js)
		{
			$this->add_js($js);
		}
		unset($tempalte_js);


		foreach($template_head as $head)
		{
			$this->add_head($head);
		}
		unset($tempalte_head);

		return true;
	}
		
		
	
	/**
	 * Load the content for the main area of the page, and store
	 * in the data array to be later sent to the template
	 */
	function set_content($view, $data = array()){
		
		$this->data['content'] = $this->CI->load->view($view, $data, true);
        
	}
	
	
	/**
	 * Clears all CSS. Raw and scripts
	 */
	function clear_css(){
		
		$this->css_raw = '';
		$this->css_scripts = '';
		
	}
	
	
	/**
	 * Add CSS
	 * 
	 * By default, the CSS will be loaded using the normal <link> method
	 * Optionally, you can choose to have the contents of the file dumped 
	 * straight to screen to reduce the number of resources the browser
	 * needs to load at run time
	 */
	function add_css($css, $load = true){
		
		if($load){
			
			$this->css_load .= '<link href="'.$this->CI->config->item('base_url') . $this->data['assets_dir'] . 'css/' . $css . '.css" media="screen" rel="stylesheet" type="text/css" />';
		
		} else {

			$css_contents = @implode(file($this->CI->config->item('base_url') . $this->data['assets_dir'] . 'css/' . $css . '.css', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
		
			$this->css_raw .= $css_contents;

		}
		
	}
	
	
	/**
	 * Clears all JS. Raw and scripts
	 */
	function clear_js(){
		
		$this->data['js'] = '';
		
	}
	
	
	/**
	 * Add CSS
	 * 
	 * By default, the CSS will be loaded using the normal <link> method
	 * Optionally, you can choose to have the contents of the file dumped 
	 * straight to screen to reduce the number of resources the browser
	 * needs to load at run time
	 */
	function add_js($js, $load = true){
		
		if($load){
		
			$this->js_load .= '<script src="'.$this->CI->config->item('base_url') . $this->data['assets_dir'] . 'js/' . $js . '.js" type="text/javascript"></script>';

		} else {
		
			$js_contents = @implode(file($this->CI->config->item('base_url') . $this->data['assets_dir'] . 'js/' . $js . '.js', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

			$this->js_raw = $js_contents;
		
		}
		
	}
	
	
	/**
	 * Clear all data in the head
	 */
	function clear_head(){
		
		$this->data['head'] = '';
		
	}
	
	
	/**
	 * Add tag to head
	 */
	function add_head($head){
		
		$this->data['head'] .= $head;
		
	}
	
	
	/**
	 * Adds a message to the current page stack
	 * Available types are success, notice and warning
	 */
	function add_message($type, $message){
	
		$this->messages[$type][] = $message;
	
	}
	
	
	/**
	 * Serves purely as a wrapper for the CI flashdata
	 * Just to keep syntax organised
	 */
	function set_flashdata($type, $message){
	
		$this->CI->session->set_flashdata($type, $message);
		
	}
	
	
	/**
	 * Formats the messages added to the stack, 
	 * and any success, notice or warning messages 
	 * that were added via session->flashdata
	 */
	function prepare_messages(){
		
		foreach($this->messages as $type => $messages){
			
			// add flash data for this type to the stack
			$flash = $this->CI->session->flashdata($type);
			if($flash != ''){
				$messages[] = $flash;
			}
			
			// if there's messages of this type, prepare for printing
			if(sizeof($messages)){
				$this->data['messages'] .= '<ul class="messages '.$type.'">';
			
				foreach($messages as $message){
					$this->data['messages'] .= '<li>'.$message.'</li>';
				}
			
				$this->data['messages'] .= '</ul>';
			}
			
		}
	
	}
	
	
	
	/**
	 * Combine and organise the raw and loaded
	 * javascript and css files
	 */
	function prepare_jcss(){

		// combine the raw and loaded css
		if(strlen($this->css_raw)){
			$this->data['css'] .= '<style type="text/css">' . $this->css_raw . '</style>';
		}
		if(strlen($this->css_load)){
			$this->data['css'] .= $this->css_load;
		}
	
		// combine the raw and loaded css
		if(strlen($this->js_raw)){
			$this->data['js'] .= '<script lang="text/javascript">' . $this->js_raw . '</script>';
		}
		if(strlen($this->js_load)){
			$this->data['js'] .= $this->js_load;
		}
			
	}
	
	
	
	/**
	 * Send the data compiled data to the screen
	 */
	function build(){
	
		$this->prepare_jcss();
		$this->prepare_messages();
	
		$this->CI->load->view('templates/'.$this->data['template'].'/index.php', $this->data);
		
	}
}