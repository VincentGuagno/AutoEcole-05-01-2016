<?php
	
	/*
	 * Controller for confirm new season
	 * This class handles news seasons
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('StudentController.php');
	 
	class ConfirmAddController extends StudentController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Add';
		
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
					if (file_exists (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php');

							$datetime1 = new DateTime($_POST['beginDate']);
							$datetime2 = new DateTime($_POST['endDate']);
							$interval = $datetime1->diff($datetime2);
							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['name']) && !empty($_POST['beginDate']) && !empty($_POST['endDate']) && !empty($_POST['coefficient']) && $interval->days > 0) {
								$_POST['coefficient'] = ($_POST['coefficient'] > 1) ? 1 : $_POST['coefficient'];
								$_POST['coefficient'] = ($_POST['coefficient'] <= 0) ? 0.1 : $_POST['coefficient'];
								
								\Season\addModel::getInstance()->add_season($_POST['name'], $_POST['beginDate'], $_POST['endDate'], $_POST['coefficient']);
								header('Location: /Cas-M-Ping/seasons/show/all');
								
							} else {
								header('Location: /Cas-M-Ping/seasons/add');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._STUDENTS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see StudentController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see StudentController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}
