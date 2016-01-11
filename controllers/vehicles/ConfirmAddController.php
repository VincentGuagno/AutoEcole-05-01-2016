<?php
	
	/*
	 * Controller for confirm new Vehicle
	 * This class handles news Vehicles
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('VehicleController.php');
	 
	class ConfirmAddController extends VehicleController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'add';
		
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
					if (file_exists (_VEHICLES_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_VEHICLES_MODELS_ .'/'. $this->model_name .'Model.php');							
							Tools::getInstance()->createPost($_POST);
							var_dump($_POST);
							if(!empty($_POST['FK_MODELE']) && !empty($_POST['FK_MONITEUR']) && !empty($_POST['NUMERO']) && !empty($_POST['KM'])
													 && !empty($_POST['DATE_ACHAT']) && !empty($_POST['PRIX_ACHAT'])&& !empty($_POST['FK_MARQUE'])) {
								\Vehicle\AddModel::getInstance()->add_vehicle($_POST['FK_MODELE'], $_POST['FK_MONITEUR'],$_POST['FK_MARQUE'], $_POST['NUMERO'], $_POST['KM'], $_POST['DATE_ACHAT'], $_POST['PRIX_ACHAT']);
								header('Location: /AutoEcole-05-01-2016/vehicles/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/vehicles/add');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._VehicleS_MODELS_ .'"!');
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
