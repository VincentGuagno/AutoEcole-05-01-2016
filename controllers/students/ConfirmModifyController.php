<?php

	/*
	 * Controller for confirm student modifications
	 * This class handles modifications students
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('StudentController.php');
	 
	class ConfirmModifyController extends StudentController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Modify';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'modify';
		
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
					if (file_exists (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							//$FK_MONITEUR, $NOM, $PRENOM, $ADRESSE, $NUM_TEL, $DATE_NAISSANCE, $LIEU_ETUDE, $PK_ELEVE
							
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['FK_MONITEUR']) && !empty($_POST['NOM']) && !empty($_POST['PRENOM']) && !empty($_POST['ADRESSE'])
											 && !empty($_POST['NUM_TEL']) && !empty($_POST['DATE_NAISSANCE']) && !empty($_POST['LIEU_ETUDE'])) {
								
								\Student\ModifyModel::getInstance()->modify_student( $_POST['FK_MONITEUR'], $_POST['NOM'], $_POST['PRENOM'], $_POST['ADRESSE'], $_POST['NUM_TEL'], $_POST['DATE_NAISSANCE'], $_POST['LIEU_ETUDE'],$id);
								header('Location: /AutoEcole-05-01-2016/students/show/all');
								
							} else {
								header('Location: /AutoEcole-05-01-2016/students/modify/'.$id);
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
