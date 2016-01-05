<?php
	
	/*
	 * Controller for rental displays
	 * This class handles the rental displays
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('RentalController.php');
	 
	class DisplayController extends RentalController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_nameAll = 'display';
		private $view_nameId = 'displayId';
		
		/**
		 * The constructor of DisplayController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the DisplayController class and their parents
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
				
				if ($controller == 'DisplayController') {
					if (file_exists (_RENTALS_MODELS_ .'/'. $this->model_name .'Model.php') 
						&& file_exists (_RENTALS_MODELS_ .'/'. $this->model_name .'Model.php')
						&& file_exists (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php')
						&& file_exists (_SEASONS_MODELS_ .'/'. $this->model_name .'Model.php')
						&& file_exists (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php')
					) {			
						if (file_exists (_RENTALS_VIEWS_ .'/'. $this->view_nameAll .'.tpl') && file_exists (_RENTALS_VIEWS_ .'/'. $this->view_nameId .'.tpl')) {	
							try {	
								require_once (_RENTALS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_LOCATIONS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_SEASONS_MODELS_ .'/'. $this->model_name .'Model.php');
								require_once (_CARAVANS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);
								
								switch ($id) {
									case 'all':
										$data = \Rental\DisplayModel::getInstance()->display_rentals();
										echo $this->twig->render($this->view_nameAll .'.tpl', array('rentals' => $data, 'bootstrapPath' => _BOOTSTRAP_FILE_));
										break;
									default:
										if(\Rental\DisplayModel::getInstance()->has_rental($id) == 1) {
											$rentals = \Rental\DisplayModel::getInstance()->display_rental($id);
											$seasons = array();
											$caravans = array();
											$locations = array();
											$buffer = null;
											
											for($i=0; $i<count($rentals); $i++) {
												$buffer = \Season\DisplayModel::getInstance()->get_SeasonByRental($rentals[$i]['rent_id']);											
												if(count($buffer) > 0) $seasons = array_merge($seasons, $buffer);
												$buffer = null;
												
												$buffer = \Caravan\DisplayModel::getInstance()->get_caravanByRental($rentals[$i]['rent_id']);											
												if(count($buffer) > 0) $caravans = array_merge($caravans, $buffer);
												$buffer = null;
												
												$buffer = \Location\DisplayModel::getInstance()->get_LocationByRental($rentals[$i]['rent_id']);											
												if(count($buffer) > 0) $locations = array_merge($locations, $buffer);
												$buffer = null;
											}
										
											echo $this->twig->render($this->view_nameId .'.tpl', array('rental' => $rentals, 'seasons' => $seasons, 'caravans' => $caravans, 'locations' => $locations, 'bootstrapPath' => _BOOTSTRAP_FILE_));
										} else {
											header('Location: /Cas-M-Ping/errors/404');
										}	
										break;
								}	
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant la récupération des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_nameAll .'" ou "'.$this->view_nameId .'" n\'existe pas dans "'._RENTALS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._RENTALS_MODELS_ .'"!');
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