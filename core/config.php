<?php

/**
 * Config
 * provides interface for user's configuration options
 */
class Config {
	
	private $directory;
	public $database;
	
	public function __construct() {
		// Save current directory path
		$this->directory = dirname(__FILE__);
	}
	
}

return new Config();
