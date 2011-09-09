<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$template_conf = array(
	'template' => 'default',
	'site_name' => 'Site Name',
	'site_title' => 'Some slonag here',
	'devmode' => true,
	'content' => '',
	'css' => '',
	'js' => '',
	'head' => '',
	'messages' => '',
	'assets_dir' => 'assets/'
);

$template_css = array('base');

$template_js = array();

$template_head = array(
	'jquery' => '<script type="text/javascript" src="http://www.google.com/jsapi"></script>
					<script type="text/javascript">
					google.load("jquery", "1.6.0");
					</script>',
	'bootstrap' => '<link rel="stylesheet" href="http://twitter.github.com/bootstrap/assets/css/bootstrap-1.2.0.min.css">'
);
