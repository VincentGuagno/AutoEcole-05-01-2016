<?php
	
	/*
	 * Controller for new rental
	 * This class handles new rentals
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('RentalController.php');
	 
	class CreateController extends RentalController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'create';
		
		/**
		 * The constructor of CreateController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the CreateController class and their parents
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
				
				if ($controller == 'CreateController') {
					if (file_exists (_CUSTOMERS_MODELS_ .'/'. $this->model_name .'Model.php') && file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php')) {
						if (file_exists (_RENTALS_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
								require_once (_CUSTOMERS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php');
								
								$customers = \Customer\DisplayModel::getInstance()->display_customers();
								$locations = \Location\DisplayModel::getInstance()->display_locations();

								echo $this->twig->render($this->view_name .'.tpl', array('customers' => $customers, 'locations' => $locations, 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant l\'affichage des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._RENTALS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._CUSTOMERS_MODELS_ .'"!');
					}	
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see RentalController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see RentalController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}