<?php

	/*
	 * Controller for confirm locations modifications
	 * This class handles modifications locations
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LocationController.php');
	 
	class ConfirmModifyController extends LocationController {
		
		/**
		 * Name of called model
		 */
		private $model_nameModify = 'Modify';
		private $model_nameDisplay = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'modify';
		
		/**
		 * The constructor of ConfirmModifyController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ConfirmModifyController class and their parents
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
				
				if ($controller == 'ConfirmModifyController') {
					if (file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_nameModify .'Model.php') && file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php')) {			
						try {	
							require_once (_LOCATIONS_MODELS_ .'/'. $this->model_nameModify .'Model.php');
							require_once (_LOCATIONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['sector']) && !empty($_POST['location'])) {
								$data = \Location\DisplayModel::getInstance()->display_location($id);
								
								\Location\ModifyModel::getInstance()->modify_location(
									$data[0]['loc_sec_id'], 
									$data[0]['loc_type_id'],
									$_POST['sector'], $_POST['location']
								);
								header('Location: /Cas-M-Ping/locations/show/'.$id);
								
							} else {
								header('Location: /Cas-M-Ping/locations/modify/'.$id);
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_nameModify .'" ou "'. $this->model_nameDisplay .'" n\'existe pas dans "'._LOCATIONS_MODELS_ .'"!');
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
