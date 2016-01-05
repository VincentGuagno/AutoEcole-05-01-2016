<?php
	
	/*
	 * Controller for confirm new caravan
	 * This class handles news caravans
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('CaravanController.php');
	 
	class ConfirmAddController extends CaravanController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Renting';
		
		/**
		 * The constructor of ConfirmAddController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ConfirmAddController class and their parents
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
				
				if ($controller == 'ConfirmAddController') {
					if (file_exists (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php');							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['person']) && !empty($_POST['location'])) {
								\Caravan\RentingModel::getInstance()->renting_caravan($_POST['name'], $_POST['price'], $_POST['person'], $_POST['location']);
								header('Location: /Cas-M-Ping/caravans/show/all');
								
							} else {
								header('Location: /Cas-M-Ping/caravans/renting');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._CARAVANS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see CaravanController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see CaravanController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}
