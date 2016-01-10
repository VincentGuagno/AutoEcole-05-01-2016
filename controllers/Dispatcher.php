<?php
	
	/*
	 * Dispatcher for all controllers
	 * This class handles the routes for all controllers
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	class Dispatcher {
		
		/**
		 * Dispatcher instance
		 */
		public static $instance = null;

		/**
		 * Current request uri
		 */
		private $request_uri;
		
		/**
		 * Current controller directory and name
		 */
		private $controller = array(
			'directory',
			'controller',
			'formatter'
			);
			
		
		/**
		 * Any routes for application
		 */
		private $routes = array(
			
			'display-home' => array(
				'controller' => 'DisplayController',
				'directory' => 'lecons/',
				'url-formatter' => '/'
			),
			
			// lecons routes
			'display-lecons' => array(
				'controller' => 'DisplayController',
				'directory' => 'lecons/',
				'url-formatter' => 'lecons/show/{id|all}'
			),
			'add-lecons' => array(
				'controller' => 'AddController',
				'directory' => 'lecons/',
				'url-formatter' => 'lecons/add'
			),
			'confirm-add-lecons' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'lecons/',
				'url-formatter' => 'lecons/add/confirm'
			),
			'delete-lecons' => array(
				'controller' => 'DeleteController',
				'directory' => 'lecons/',
				'url-formatter' => 'lecons/return/{id|all}'
			),
			
			// billings routes
			'add-billings' => array(
				'controller' => 'AddController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/add'
			),
			'confirm-add-billings' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/add/confirm'
			),
			'delete-billings' => array(
				'controller' => 'DeleteController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/delete/{id|all}'
			),
			'display-billings' => array(
				'controller' => 'DisplayController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/show/{id|all}'
			),
			'modify-billings' => array(
				'controller' => 'ModifyController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/modify/{id}'
			),
			'confirm-modify-billings' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'billings/',
				'url-formatter' => 'billings/modify/confirm/{id}'
			),
			
			// Home routes
			'home' => array(
				'controller' => 'DisplayController',
				'directory' => 'home/',
				'url-formatter' => 'home'
			),
			
			// billingsType routes
			'add-billingsType' => array(
				'controller' => 'AddController',
				'directory' => 'billingsType/',
				'url-formatter' => 'billingsType/add'
			),
			'confirm-add-billingsType' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'billingsType/',
				'url-formatter' => 'billingsType/add/confirm/{id}'
			),
			'delete-billingsType' => array(
				'controller' => 'DeleteController',
				'directory' => 'billingsType/',
				'url-formatter' => 'billingsType/delete/{id|all}'
			),
			'display-billingsType' => array(
				'controller' => 'DisplayController',
				'directory' => 'billingsType/',
				'url-formatter' => 'billingsType/show/{id|all}'
			),
			
			// brands routes
			'add-brands' => array(
				'controller' => 'AddController',
				'directory' => 'brands/',
				'url-formatter' => 'brands/add/{id|all}'
			),
			'confirm-add-brands' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'brands/',
				'url-formatter' => 'brands/add/confirm/{id}'
			),
			'delete-brands' => array(
				'controller' => 'CreateController',
				'directory' => 'brands/',
				'url-formatter' => 'brands/delete/{id}'
			),
			'display-brands' => array(
				'controller' => 'DisplayController',
				'directory' => 'brands/',
				'url-formatter' => 'brands/show/{id|all}'
			),
			
			// exams routes
			'add-exams' => array(
				'controller' => 'AddController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/add'
			),
			'confirm-add-exams' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/add/confirm'
			),
			'delete-exams' => array(
				'controller' => 'DeleteController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/delete/{id|all}'
			),
			'display-exams' => array(
				'controller' => 'DisplayController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/show/{id|all}'
			),
			'modify-exams' => array(
				'controller' => 'ModifyController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/modify/{id}'
			),
			'confirm-modify-exams' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'exams/',
				'url-formatter' => 'exams/modify/confirm/{id}'
			),
			
			// formulas routes
			'add-formulas' => array(
				'controller' => 'AddController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/add'
			),
			'confirm-add-formulas' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/add/confirm'
			),
			'delete-formulas' => array(
				'controller' => 'DeleteController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/delete/{id|all}'
			),
			'display-formulas' => array(
				'controller' => 'DisplayController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/show/{id|all}'
			),
			'modify-formulas' => array(
				'controller' => 'ModifyController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/modify/{id}'
			),
			'confirm-modify-formulas' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'formulas/',
				'url-formatter' => 'formulas/modify/confirm/{id}'
			),
			
			// instructors routes
			'add-instructors' => array(
				'controller' => 'AddController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/add'
			),
			'confirm-add-instructors' => array(
				'controller' => 'ConfirmAddController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/add/confirm'
			),
			'delete-instructors' => array(
				'controller' => 'DeleteController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/delete/{id|all}'
			),
			'display-instructors' => array(
				'controller' => 'DisplayController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/show/{id|all}'
			),
			'modify-instructors' => array(
				'controller' => 'ModifyController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/modify/{id}'
			),
			'confirm-modify-instructors' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'instructors/',
				'url-formatter' => 'instructors/modify/confirm/{id}'
			),
			
			// licenses routes
			'add-licenses' => array(
				'controller' => 'AddController',
				'directory' => 'licenses/',
				'url-formatter' => 'licenses/add'
			),
			'delete-licenses' => array(
				'controller' => 'DeleteController',
				'directory' => 'licenses/',
				'url-formatter' => 'licenses/delete/{id|all}'
			),
			'display-licenses' => array(
				'controller' => 'DisplayController',
				'directory' => 'licenses/',
				'url-formatter' => 'licenses/show/{id|all}'
			),
			
			// models routes
			'add-models' => array(
				'controller' => 'AddController',
				'directory' => 'models/',
				'url-formatter' => 'models/add'
			),
			'delete-models' => array(
				'controller' => 'DeleteController',
				'directory' => 'models/',
				'url-formatter' => 'models/delete/{id|all}'
			),
			'display-models' => array(
				'controller' => 'DisplayController',
				'directory' => 'models/',
				'url-formatter' => 'models/show/{id|all}'
			),
			'modify-models' => array(
				'controller' => 'ModifyController',
				'directory' => 'models/',
				'url-formatter' => 'models/modify/{id}'
			),
			'confirm-modify-models' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'models/',
				'url-formatter' => 'models/modify/confirm/{id}'
			),
			
			// students routes
			'add-students' => array(
				'controller' => 'AddController',
				'directory' => 'students/',
				'url-formatter' => 'students/add'
			),
			'delete-students' => array(
				'controller' => 'DeleteController',
				'directory' => 'students/',
				'url-formatter' => 'students/delete/{id|all}'
			),
			'display-students' => array(
				'controller' => 'DisplayController',
				'directory' => 'students/',
				'url-formatter' => 'students/show/{id|all}'
			),
			'modify-students' => array(
				'controller' => 'ModifyController',
				'directory' => 'students/',
				'url-formatter' => 'students/modify/{id}'
			),
			'confirm-modify-students' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'students/',
				'url-formatter' => 'students/modify/confirm/{id}'
			),
			
			// vehicles routes
			'add-vehicles' => array(
				'controller' => 'AddController',
				'directory' => 'vehicles/',
				'url-formatter' => 'vehicles/add'
			),
			'delete-vehicles' => array(
				'controller' => 'DeleteController',
				'directory' => 'vehicles/',
				'url-formatter' => 'vehicles/delete/{id|all}'
			),
			'display-vehicles' => array(
				'controller' => 'DisplayController',
				'directory' => 'vehicles/',
				'url-formatter' => 'vehicles/show/{id|all}'
			),
			'modify-vehicles' => array(
				'controller' => 'ModifyController',
				'directory' => 'vehicles/',
				'url-formatter' => 'vehicles/modify/{id}'
			),
			'confirm-modify-vehicles' => array(
				'controller' => 'ConfirmModifyController',
				'directory' => 'vehicles/',
				'url-formatter' => 'vehicles/modify/confirm/{id}'
			),
			// Errors routes
			'403-errors' => array(
				'controller' => 'Display403Controller',
				'directory' => 'errors/',
				'url-formatter' => 'errors/403'
			),
			'404-errors' => array(
				'controller' => 'Display404Controller',
				'directory' => 'errors/',
				'url-formatter' => 'errors/404'
			),
			'500-errors' => array(
				'controller' => 'Display500Controller',
				'directory' => 'errors/',
				'url-formatter' => 'errors/500'
			)
		);

		/**
		 * The constructor of Dispatcher
		 */
		public function __construct() {
			$this->request_uri = null;
			$this->controller = null;
		}
		
		/**
		 * Get current instance of Dispatcher (singleton)
		 *
		 * @return Dispatcher
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new Dispatcher();
			}
			return self::$instance;
		}
		
		/**
		 * Find the controller and instantiate it
		 */
		public function dispatch() {
			try {
				Dispatcher::get_requestUri();
				
				foreach ($this->routes as $key => $value) {
					if (Dispatcher::hasRoute($this->routes[$key]['url-formatter'])) {
						$this->controller['directory'] = $this->routes[$key]['directory'];
						$this->controller['controller'] = $this->routes[$key]['controller'];
						$this->controller['formatter'] = $this->routes[$key]['url-formatter'];
						break;
					}
				}
				
				if($this->request_uri == null) {
					header('Location: /'._PROJECT_NAME_ .'/lecons/show/all');
				}
				
				if($this->controller == null) {
					$this->controller['directory'] = $this->routes['404-errors']['directory'];
					$this->controller['controller'] = $this->routes['404-errors']['controller'];
					$this->controller['formatter'] = $this->routes['404-errors']['url-formatter'];
				}
				
				if (file_exists(_CONTROLLERS_DIR_ .'/Tools.php')) {
					require_once(_CONTROLLERS_DIR_ .'/Tools.php');		
				} else {
					throw new Exception('Fichier "'._CONTROLLERS_DIR_ .'/Tool.php" introuvable!');
				}	
				
				if (file_exists(_CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php')) {
					require_once(_CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php');		
				} else {
					throw new Exception('Fichier "'._CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php" introuvable!');
				}
				
				Tools::getInstance()->createPost($_POST); 
				Tools::getInstance()->createUrl($this->controller['controller'], $this->request_uri);
				$controllerInstance = new $this->controller['controller']();
				
				if(!$controllerInstance->checkAccess() || !$controllerInstance->viewAccess()) {
					$this->controller['directory'] = $this->routes['403-errors']['directory'];
					$this->controller['controller'] = $this->routes['403-errors']['controller'];
					$this->controller['formatter'] = $this->routes['403-errors']['url-formatter'];
					
					if (file_exists(_CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php')) {
						require_once(_CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php');		
					} else {
						throw new Exception('Fichier "'._CONTROLLERS_DIR_ .'/'.$this->controller['directory'].$this->controller['controller'].'.php" introuvable!');
					}
					
					$controllerInstance = new $this->controller['controller']();
				}
			} catch (Exception $e) {
				throw new Exception('Une erreur est survenue durant la phase de routage: '.$e->getMessage());
			}
		}
		
		/**
		 * Get request's uri
		 */
		private function get_requestUri() {
			if (isset($_SERVER['REQUEST_URI'])) { // Any servers without IIS 
				$this->request_uri = $_SERVER['REQUEST_URI'];
			} elseif (isset($_SERVER['HTTP_X_REWRITE_URL'])) { // IIS only
				$this->request_uri = $_SERVER['HTTP_X_REWRITE_URL'];
			} else {
				$this->request_uri = null;
			}
			
			$this->request_uri = substr($this->request_uri, strlen(_PROJECT_NAME_)+2);
		}
		
		/**
		 * Check if the route exists
		 *
		 * @param route, route to test
		 * @return true if exist, false any others cases
		 */
		private function hasRoute($route) {
			if(preg_match('#errors/[0-9]{3}$#', $this->request_uri)) {
				return (preg_match('#^'.$this->request_uri .'$#', $route)) ? true : false;
			} elseif (preg_match('#/[0-9]{1,}$#', $this->request_uri) || (preg_match('#all$#', $this->request_uri) && preg_match('#{(.*)all(.*)}$#', $route))) {
				$urlBody = preg_replace('#^(.+)/(.+)$#', '$1', $this->request_uri);
				return (preg_match('#^'.$urlBody.'/(.+)#', $route)) ? true : false;
			} else {
				return (preg_match('#^'.$this->request_uri .'$#', $route)) ? true : false;
			}
		}	
	}