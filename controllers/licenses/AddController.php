<?php
	
	/*
	 * Controller for new license
	 * This class handles new licenses
	 *
	 * @author J�r�mie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LicenseController.php');
	 
	class AddController extends LicenseController {
		
		/**
		 * Name of called view
		 */
		private $view_name = 'add';
		
		/**
		 * The constructor of AddController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the AddController class and their parents
		 */
		public function init() {
			try {
				parent::init();	
			} catch (Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			
			if (file_exists (_CONTROLLERS_DIR_ .'/Tools.php')) {
				$url = Tools::getInstance()->request_url;
				$url .= '&id=ukn';
				$controller = Tools::getInstance()->getUrl_controller($url);
				
				if ($controller == 'AddController') {		
					if (file_exists (_LICENSES_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
						try {	
							echo $this->twig->render($this->view_name .'.tpl', array('bootstrapPath' => _BOOTSTRAP_FILE_));
							
						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant l\'affichage des donn�es: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._LICENSES_VIEWS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas �valuable!');
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