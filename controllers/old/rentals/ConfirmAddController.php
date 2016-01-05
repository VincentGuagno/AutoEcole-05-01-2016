<?php
	
	/*
	 * Controller for confirm new rental
	 * This class handles news rentals
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('RentalController.php');
	 
	class ConfirmAddController extends RentalController {
		
		/**
		 * Name of called model
		 */
		private $model_nameDisplay = 'Display';
		private $model_nameCreate = 'Create';
		
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
					if (file_exists (_RENTALS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php') && file_exists (_SEASONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php') && file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php')) {			
						try {	
							require_once (_RENTALS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php');
							require_once (_RENTALS_MODELS_ .'/'. $this->model_nameCreate .'Model.php');
							require_once (_SEASONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php');
							require_once (_LOCATIONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php');
							
							Tools::getInstance()->createPost($_POST);
							
							$datetime1 = new DateTime($_POST['beginDate']);
							$datetime2 = new DateTime($_POST['endDate']);
							$interval = $datetime1->diff($datetime2);
							
							if(!empty($_POST['rent_cust_id']) && !empty($_POST['rent_name']) && !empty($_POST['beginDate']) && 
								!empty($_POST['location']) && !empty($_POST['endDate']) && !empty($_POST['person']) && !empty($_POST['price_c']) && !empty($_POST['val']) && $interval->days > 0
							) {
								$date = \Season\displayModel::getInstance()->display_seasonCoeff($_POST['beginDate']);
								$price = \Location\DisplayModel::getInstance()->display_location($_POST['location']);								
								$priceTT = ($date[0]['seas_coeff'] * $price[0]['type_location_price'] * $interval->days) + $_POST['price_c'];

								\Rental\CreateModel::getInstance()->create_rental($_POST['rent_name'], $_POST['beginDate'], 
										$_POST['endDate'], $_POST['person'],
									 	'', $_POST['price_c'], $interval->days,
										$priceTT , $_POST['rent_cust_id'], $_POST['val'], $_POST['location']);
								header('Location: /Cas-M-Ping/rentals/show/all');
								
							} else {
								header('Location: /Cas-M-Ping/rentals/add');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant l\'ajout des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_nameDisplay .'" n\'existe pas dans "'._RENTALS_MODELS_ .'"!');
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
