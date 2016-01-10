<?php
	
	/*
	 * Controller for confirm new Billing
	 * This class handles news Billings
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('ExamController.php');
	 
	class ConfirmAddController extends ExamController {
		
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
					if (file_exists (_EXAMS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_EXAMS_MODELS_ .'/'. $this->model_name .'Model.php');							
							Tools::getInstance()->createPost($_POST);
							var_dump($_POST);
							if(!empty($_POST['DATE_DE_PASSAGE']) && !empty($_POST['NOM']) && !empty($_POST['FK_PERMIS']) && !empty($_POST['FK_ELEVE'])) {
								\Exam\AddModel::getInstance()->add_exam($_POST['NOM'], $_POST['DATE_DE_PASSAGE'], $_POST['FK_ELEVE'], $_POST['FK_PERMIS']);
								header('Location: /AutoEcole-05-01-2016/billings/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/billings/renting');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._BILLINGS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see BillingController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see BillingController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}
