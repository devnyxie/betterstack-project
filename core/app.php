<?php

require_once __DIR__ . '/path.php';

// Load BaseModel and all models from models directory
require __DIR__ . '/base_model.php';
foreach (glob( __DIR__ . '/../models/*.php') as $filename) {
	require $filename;
}

/**
 * App
 * provides interface for database manipulation, accessing config and rendering views
 */
class App {
	
	private $directory;
	public $db;
	public $config;
	
	public function __construct(){
		$this->directory = __DIR__;			
		$this->db = require resolveCorePath('database');
		$this->db->connect();
	}	
	
	/**
	 * Renders given view with given set of variables
	 * 
	 * param $viewfile: path of the view file relative to the views direcotry, without the ending .php
	 * param $vars: array of variables to be accessed insede the views
	 */
	public function renderView($viewfile, $vars = array()) {
		// Render array to usable variables
		foreach ($vars as $key => $value) {
			$$key = $value;
		}
		
		// Start capturing of output
		ob_start();

		// Resolve the full path to the view file
		$viewFilePath = resolveViewPath($viewfile);

		// Include the view file
		include $viewFilePath;

		// Assign output to $content which will be rendered in layout
		$content = ob_get_clean();

		// Render $content in layout
		$layout = resolveViewPath('layout');
		include $layout;
	}
	
}

return new App();
