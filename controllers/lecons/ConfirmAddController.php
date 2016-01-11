<?php
	
	/*
	 * Controller for confirm new instructor
	 * This class handles news instructors
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LeconController.php');
	 
	class ConfirmAddController extends LeconController {
		
		/**
		 * Name of called model
		 */
		private $model_nameDisplay = 'Display';
		private $model_nameCreate = 'add';
		
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
					if (file_exists (_LECONS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php')) {			
						try {
							require_once (_LECONS_MODELS_ .'/'. $this->model_nameCreate .'Model.php');							
							Tools::getInstance()->createPost($_POST);
							$nrows = \Lecon\AddModel::getInstance()->has_lecon_date($_POST['DATE_LECON'],$_POST['FK_ELEVE']);
							
							if(!empty($_POST['FK_ELEVE']) && !empty($_POST['DATE_LECON']) && $nrows == 0){
								\Lecon\AddModel::getInstance()->add_lecon($_POST['FK_ELEVE'], $_POST['DATE_LECON']);
								header('Location: /AutoEcole-05-01-2016/lecons/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/lecons/show/all');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant l\'ajout des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_nameDisplay .'" n\'existe pas dans "'._INSTRUCTORS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see InstructorController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see InstructorController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}
