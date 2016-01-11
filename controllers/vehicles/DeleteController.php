<?php
	
	/*
	 * Controller for vehicle deletions
	 * This class handles the vehicles deletions
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('VehicleController.php');
	 
	class DeleteController extends VehicleController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Delete';
		
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

				if ($controller == 'DeleteController') {
					if (file_exists (_VEHICLES_MODELS_ .'/'. $this->model_name .'Model.php')) {				
						try {	
							require_once (_VEHICLES_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							switch ($id) {
								case 'all':
									\vehicle\DeleteModel::getInstance()->delete_vehicles();
									break;
								default:
									if(\vehicle\DeleteModel::getInstance()->has_vehicle($id) >= 1) {
										\vehicle\DeleteModel::getInstance()->delete_vehicle($id);	
									} else {
										header('Location: /AutoEcole-05-01-2016/errors/404');
									}	
									break;
							}
							header('Location: /AutoEcole-05-01-2016/vehicles/show/all');
							
						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._vehicleS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see VehicleController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see VehicleController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}
		
	}