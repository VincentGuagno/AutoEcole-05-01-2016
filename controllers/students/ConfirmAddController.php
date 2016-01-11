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

							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['FK_FORMULES']) && !empty($_POST['FK_MONITEUR']) && !empty($_POST['PRENOM']) && !empty($_POST['NOM']) && !empty($_POST['LIEU_ETUDE'])
												&& !empty($_POST['ADRESSE']) && !empty($_POST['NUM_TEL']) && !empty($_POST['DATE_NAISSANCE'])) {
								\Student\AddModel::getInstance()->add_student($_POST['NOM'], $_POST['PRENOM'], $_POST['ADRESSE'], $_POST['NUM_TEL'], $_POST['DATE_NAISSANCE'], $_POST['LIEU_ETUDE']
																					, $_POST['FK_FORMULES'], $_POST['FK_MONITEUR']);
								header('Location: /AutoEcole-05-01-2016/students/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/students/add');
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
