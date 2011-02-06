#subooatmpl

* [By Subooa](http://www.subooa.com.au/)
* Version: 2.0

## Description

subooatmpl is a templating library for CodeIgniter 2.0, which allows you to quickly build and organise your CI site using a templating system.


##Development by

* Chris Duell - Lead Developer ([http://duellsy.com](http://duellsy.com))
* With thanks to Matt Trimarchi - ([http://studio372.com.au](http://studio372.com), worked on V1.0 together.

##Requirements

Code Igniter 2.0

##Usage

Download and place the files in your CI installation.

Add subooatmpl to your autoload file in the libraries config item.

Update the config/subooatmpl.php file to set your base template settings such as the sites name, title, and other items like which css and js files are always loaded.

An example of updating the base welcome controller in CI to use this library is below:

<code>
class Welcome extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index() {
		$data = array('some_variable' => 'some_data')
		
		$this->subooatmpl->add_message('notice', 'You are using the subooatmpl library');
		
		$this->subooatmpl->set_content('welcome_message', $data);
		$this->subooatmpl->build();
	}
}
</code>

##Available methods

####function set_content($view, $data = array())
Load the content for the main area of the page, and store
in the data array to be later sent to the template
	
####function clear_css()
Clears all CSS. Raw and scripts
	
####function add_css($css, $load = true)
By default, the CSS will be loaded using the normal <link> method
Optionally, you can choose to have the contents of the file dumped 
straight to screen to reduce the number of resources the browser
needs to load at run time
	
####function clear_js()
Clears all JS. Raw and scripts
	
####function add_js($js, $load = true)
By default, the CSS will be loaded using the normal <link> method
Optionally, you can choose to have the contents of the file dumped 
straight to screen to reduce the number of resources the browser
needs to load at run time
			
####function clear_head()
Clear all data in the head

####function add_head($head)
Add tag to head

####function add_message($type, $message)
Adds a message to the current page stack
Available types are success, notice and warning

####function set_flashdata($type, $message)
Serves purely as a wrapper for the CI flashdata
Just to keep syntax organised

####function prepare_messages()
Formats the messages added to the stack, 
and any success, notice or warning messages 
that were added via session->flashdata

####function build()
Send the data compiled data to the screen