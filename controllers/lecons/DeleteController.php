<?php
	
	/*
	 * Controller for sector deletions
	 * This class handles the sectors deletions
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('LeconController.php');
	 
	class DeleteController extends LeconController {
		
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
					if (file_exists (_LECONS_MODELS_ .'/'. $this->model_name .'Model.php')) {				
						try {	
							require_once (_LECONS_MODELS_ .'/'. $this->model_name .'Model.php');
							$id = Tools::getInstance()->getUrl_id($url);
							
							switch ($id) {
								case 'all':
									\Lecon\DeleteModel::getInstance()->delete_lecons();
									break;
								default:
									if(\Lecon\DeleteModel::getInstance()->has_lecon($id) >= 1) {
										\Lecon\DeleteModel::getInstance()->delete_lecon($id);	
									} else {
										header('Location: /AutoEcole-05-01-2016/errors/404');
									}	
									break;
							}
							header('Location: /AutoEcole-05-01-2016/lecons/show/all');
							
						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la suppression des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._LECONS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see LeconController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see LeconController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}
		
	}