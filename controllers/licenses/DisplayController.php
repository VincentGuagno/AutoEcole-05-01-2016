<?php
	
	/*
	 * Controller for license displays
	 * This class handles the license displays
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LicenseController.php');
	 
	class DisplayController extends LicenseController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'display';
		
		/**
		 * The constructor of DisplayController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the DisplayController class and their parents
		 */
		public function init() {
			try {
				parent::init();	
			} catch (Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			
			if (file_exists (_CONTROLLERS_DIR_ .'/Tools.php')) {
				$url = Tools::getInstance()->request_url;
				$controller = Tools::getInstance()->getUrl_controller($url);
				
				if ($controller == 'DisplayController') {
					if (file_exists (_LICENSES_MODELS_ .'/'. $this->model_name .'Model.php') ) {			
						if (file_exists (_LICENSES_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
								require_once (_LICENSES_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);
								
								switch ($id) {
									case 'all':
										$licenses = \License\DisplayModel::getInstance()->display_licenses();
										break;
									default:
										if(\License\DisplayModel::getInstance()->has_license($id) == 1) {
											$data = \License\DisplayModel::getInstance()->display_license($id);
											
											$licenses = \License\DisplayModel::getInstance()->display_license($id);
										} else {
											header('Location: /Cas-M-Ping/errors/404');
										}
										break;
								}
								
								echo $this->twig->render($this->view_name .'.tpl', array('licenses' => $licenses, 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant la récupération des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._LICENSES_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._LICENSES_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see LicenseController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see LicenseController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}
		
	}