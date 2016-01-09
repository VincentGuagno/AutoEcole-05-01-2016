<?php
	
	/*
	 * Controller for Billings displays
	 * This class handles the Billings displays
	 *
	 * @author J�r�mie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('BillingsController.php');
	 
	class DisplayController extends BillingsController {
		
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
					if (file_exists (_BILLINGS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						if (file_exists (_BILLINGS_VIEWS_ .'/'. $this->view_name .'.tpl')) {	
							try {	
							echo _BILLINGS_MODELS_ .'/'. $this->model_name .'Model.php';
								require_once (_BILLINGS_MODELS_ .'/'. $this->model_name .'Model.php');
								$id = Tools::getInstance()->getUrl_id($url);

								switch ($id) {
									case 'all':
										$data = \Billings\DisplayModel::getInstance()->display_facturations();
										break;
									default:
										if(\Billings\DisplayModel::getInstance()->has_Billings($id) == 1) {
											$data = \Billings\DisplayModel::getInstance()->display_facturation($id);
										} else {
											header('Location: /Cas-M-Ping/errors/404');
										}
										break;
								}
								echo $this->twig->render($this->view_name .'.tpl', array('Billings' => $data, 'bootstrapPath' => _BOOTSTRAP_FILE_));
								
							} catch (Exception $e) {
								throw new Exception('Une erreur est survenue durant la r�cup�ration des donn�es: '.$e->getMessage());
							}
						} else {
							throw new Exception('Le template "'.$this->view_name .'" n\'existe pas dans "'._BILLINGS_VIEWS_ .'"!');
						}
					} else {
						throw new Exception('Le mod�le "'. $this->model_name .'" n\'existe pas dans "'._BILLINGS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas �valuable!');
			}
		}
		
		/**
	     * @see BillingsController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see BillingsController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}
		
	}