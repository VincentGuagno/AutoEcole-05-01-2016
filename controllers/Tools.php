<?php
	
	/*
	 * Tools class for make any things
	 * This class handles the process for application
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	class Tools {
		
		/**
		 * Tools instance
		 */
		public static $instance = null;
		
		/**
		 * Current request url
		 */
		public $request_url;
		
		/**
		 * Current request post
		 */
		public $request_post;

		/**
		 * The constructor of Dispatcher
		 */
		public function __construct() {
			$this->request_url = null;
		}
		
		/**
		 * Get current instance of Dispatcher (singleton)
		 *
		 * @return Dispatcher
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new Tools();
			}
			return self::$instance;
		}
		
		/**
		 * Create a backend post variables
		 *
		 * @param postVar, is an array of post variables
		 */
		public function createPost($postVar) {
			$this->request_post = $postVar;
		}
		
		/**
		 * Create a backend url with url rewrites parameters
		 *
		 * @param controller, is the controller to insert in the url link
		 * @param uri, is the uri to insert in the url link
		 */
		public function createUrl($controller, $uri) {
			if(preg_match('#errors/[0-9]{3}$#', $uri)) {
				$this->request_url = 'index.php?controller='.$controller;
			} elseif(preg_match('#/[0-9]{1,}#', $uri) || preg_match('#all$#', $uri)) {
				$this->request_url = 'index.php?controller='.$controller.'&id='.preg_replace('#^(.+)/(.+)$#', '$2', $uri);
			} else {
				$this->request_url = 'index.php?controller='.$controller;
			}
		}
		
		/**
		 * Extract controller's name into url
		 *
		 * @param url, the url
		 * @return controller's name
		 */
		public function getUrl_controller($url) {
			return preg_replace('#(.+)controller=(.+)\&(.+)#', '$2', $url);
		}
		
		/**
		 * Extract id's value into url
		 *
		 * @param url, the url
		 * @return id's value
		 */
		public function getUrl_id($url) {
			return preg_replace('#(.+)id=(.+)$#', '$2', $url);
		}
	}