<?php
	
	/*
	 * Controller for new season
	 * This class handles new seasons
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('VehicleController.php');
	 
	class AddController extends VehicleController {
		
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
					if (file_exists (_VEHICLES_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
						try {	
							
							require_once (_VEHICLES_MODELS_ .'/DisplayModel.php');
							require_once (_INSTRUCTORS_MODELS_ .'/DisplayModel.php');
							require_once (_BRANDS_MODELS_ .'/DisplayModel.php');
							require_once (_MODELS_MODELS_ .'/DisplayModel.php');
							$brands = \Brands\DisplayModel::getInstance()->display_brands();
							$models = \Models\DisplayModel::getInstance()->display_models();
							$instructors = \Instructor\DisplayModel::getInstance()->display_instructors();
							echo $this->twig->render($this->view_name .'.tpl', array('models'=>$models, 'brands'=>$brands,'instructors'=>$instructors,'bootstrapPath' => _BOOTSTRAP_FILE_));
							
						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant l\'affichage des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._VEHICLES_VIEWS_.'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see StudentController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see StudentController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}