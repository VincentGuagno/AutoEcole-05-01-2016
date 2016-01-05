<?php
	
	/*
	 * Controller for caravan deletions
	 * This class handles the caravans deletions
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('CaravanController.php');
	 
	class ReturnController extends CaravanController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Return';
		
		/**
		 * The constructor of ReturnController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the ReturnController class and their parents
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

				if ($controller == 'ReturnController') {
					if (file_exists (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php')) {				
						try {	
							require_once (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							switch ($id) {
								case 'all':
									\Caravan\ReturnModel::getInstance()->delete_caravans();
									break;
								default:
									if(\Caravan\ReturnModel::getInstance()->has_Caravan($id) == 1) {
										\Caravan\ReturnModel::getInstance()->delete_caravan($id);	
									} else {
										header('Location: /Cas-M-Ping/errors/404');
									}	
									break;
							}
							header('Location: /Cas-M-Ping/caravans/show/all');
							
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