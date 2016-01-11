<?php
	
	/*
	 * Controller for season deletions
	 * This class handles the seasons deletions
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('StudentController.php');
	 
	class DeleteController extends StudentController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Delete';
		
		/**
		 * The constructor of DeleteController
		 */
		public function __construct() {
			try {
				$this->init();
			} catch (Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Initialize the DeleteController class and their parents
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
				
				if ($controller == 'DeleteController') {
					if (file_exists (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php')) {				
						try {	
							require_once (_STUDENTS_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							switch ($id) {
								case 'all':
									\Student\DeleteModel::getInstance()->delete_students();
									break;
								default:
									if(\Student\DeleteModel::getInstance()->has_student($id) >= 1) {
										\Student\DeleteModel::getInstance()->delete_student($id);	
									} else {
										header('Location: /AutoEcole-05-01-2016/errors/404');
									}	
									break;
							}
							header('Location: /AutoEcole-05-01-2016/students/show/all');
							
						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la suppression des données: '.$e->getMessage());
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