<?php
	
	/*
	 * Controller for billing modifications
	 * This class handles modifications billings
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('BillingsController.php');
	 
	class ModifyController extends BillingsController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'modify';
		
		/**
		 * The constructor of ModifyController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ModifyController class and their parents
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
				
				if ($controller == 'ModifyController') {
					if (file_exists (_BILLINGS_MODELS_ .'/'. $this->model_name .'Model.php') && file_exists (_BILLINGSTYPE_MODELS_ .'/'. $this->model_name .'Model.php')) {
						if (file_exists (_BILLINGS_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
								require_once (_BILLINGS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_BILLINGSTYPE_MODELS_ .'/'. $this->model_name .'Model.php');
								//require_once (_SECTORS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);
								
								//$sectors = \Sector\DisplayModel::getInstance()->display_sectors();
								$type_billings = \billingsType\DisplayModel::getInstance()->display_billingsType();
								$data = \billings\DisplayModel::getInstance()->display_billing($id);
								echo $this->twig->render($this->view_name .'.tpl', array('sectors' => $sectors, 'typeLocations' => $type_billings, 'id' => $data[0], 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant l\'affichage des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._BILLINGS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._BILLINGS_MODELS_ .'" ou "'._BILLINGSTYPE_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see LocationController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see LocationController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}