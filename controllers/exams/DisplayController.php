<?php
	
	/*
	 * Controller for Exams displays
	 * This class handles the Exams displays
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('ExamController.php');
	 
	class DisplayController extends ExamController {
		
		/**
		 * Name of called model
		 */
		private $model_name = 'Display';
		
		/**
		 * Name of called view
		 */
		private $view_name = 'display';
		
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
					if (file_exists (_EXAMS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						if (file_exists (_EXAMS_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
							echo _EXAMS_MODELS_ .'/'. $this->model_name .'Model.php';
								require_once (_EXAMS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);

								switch ($id) {
									case 'all':
										$data = \Exams\DisplayModel::getInstance()->display_exams();
										break;
									default:
										if(\Exams\DisplayModel::getInstance()->has_Exams($id) == 1) {
											$data = \Exams\DisplayModel::getInstance()->display_exam($id);
										} else {
											header('Location: /Cas-M-Ping/errors/404');
										}
										break;
								}
								echo $this->twig->render($this->view_name .'.tpl', array('exams' => $data, 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant la récupération des données: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._EXAMS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._EXAMS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see ExamController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see ExamController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}
		
	}