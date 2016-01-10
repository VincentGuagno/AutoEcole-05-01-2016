<?php
	
	/*
	 * Controller for confirm new instructor
	 * This class handles news instructors
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('InstructorController.php');
	 
	class ConfirmAddController extends InstructorController {
		
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
					if (file_exists (_INSTRUCTORS_MODELS_ .'/'. $this->model_nameDisplay .'Model.php')) {			
						try {
							require_once (_INSTRUCTORS_MODELS_ .'/'. $this->model_nameCreate .'Model.php');							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['NOM']) && !empty($_POST['PRENOM']) && !empty($_POST['ADRESSE']) && 
								!empty($_POST['NUM_TEL']) && !empty($_POST['SURNOM']) && !empty($_POST['DATE_EMBAUCHE'])){
								\Instructor\AddModel::getInstance()->add_instructor($_POST['NOM'], $_POST['PRENOM'], 
										$_POST['ADRESSE'], $_POST['NUM_TEL'], $_POST['SURNOM'], $_POST['DATE_EMBAUCHE']);
								header('Location: /AutoEcole-05-01-2016/instructors/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/instructors/add');
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
