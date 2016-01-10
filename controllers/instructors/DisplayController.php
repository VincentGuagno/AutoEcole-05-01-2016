<?php
	
	/*
	 * Controller for instructor displays
	 * This class handles the instructor displays
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('InstructorController.php');
	 
	class DisplayController extends InstructorController {
		
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
					if (file_exists (_INSTRUCTORS_MODELS_ .'/'. $this->model_name .'Model.php') 
					) {			
						if (file_exists (_INSTRUCTORS_VIEWS_ .'/'. $this->view_nameAll .'.tpl') && file_exists (_INSTRUCTORS_VIEWS_ .'/'. $this->view_nameId .'.tpl')) {	
							try {	
								require_once (_INSTRUCTORS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);
								
								switch ($id) {
									case 'all':
										$data = \Instructor\DisplayModel::getInstance()->display_instructors();
										echo $this->twig->render($this->view_nameAll .'.tpl', array('instructors' => $data, 'bootstrapPath' => _BOOTSTRAP_FILE_));
										break;
									default:
										if(\Instructor\DisplayModel::getInstance()->has_instructor($id) == 1) {
											$instructors = \Instructor\DisplayModel::getInstance()->display_instructor($id);
										
											echo $this->twig->render($this->view_nameId .'.tpl', array('instructor' => $instructors, 'bootstrapPath' => _BOOTSTRAP_FILE_));
										} else {
											header('Location: /Cas-M-Ping/errors/404');
										}	
										break;
								}	
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant la récupération des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_nameAll .'" ou "'.$this->view_nameId .'" n\'existe pas dans "'._INSTRUCTORS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._INSTRUCTORS_MODELS_ .'"!');
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