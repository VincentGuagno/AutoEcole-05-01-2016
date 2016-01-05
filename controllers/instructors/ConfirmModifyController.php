<?php
	
	/*
	 * Controller for confirm rental modifications
	 * This class handles modifications rentals
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('RentalController.php');
	 
	class ConfirmModifyController extends RentalController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Modify';
		
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
					if (file_exists (_RENTALS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_RENTALS_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							$datetime1 = new DateTime($_POST['beginDate']);
							$datetime2 = new DateTime($_POST['endDate']);
							$interval = $datetime1->diff($datetime2);
							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['name']) && !empty($_POST['beginDate']) && !empty($_POST['endDate']) &&
								!empty($_POST['peopleNumber']) && $interval->days > 0 && !empty($_POST['paymentState'])
							) {
								\Rental\ModifyModel::getInstance()->modify_model(
									$_POST['name'], $_POST['beginDate'], $_POST['endDate'],
									$_POST['peopleNumber'], '', $_POST['paymentState'],
									$interval->days, $_POST['deposit'], $id
								);
								header('Location: /Cas-M-Ping/rentals/show/'.$id);
								
							} else {
								header('Location: /Cas-M-Ping/rentals/modify/'.$id);
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
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