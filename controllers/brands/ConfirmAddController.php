<?php
	
	/*
	 * Controller for confirm new customer
	 * This class handles news customers
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	require_once('CustomerController.php');
	 
	class ConfirmAddController extends CustomerController {
		
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
					if (file_exists (_CUSTOMERS_MODELS_ .'/'. $this->model_name .'Model.php')) {			
						try {	
							require_once (_CUSTOMERS_MODELS_ .'/'. $this->model_name .'Model.php');						
							Tools::getInstance()->createPost($_POST);
							
							if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['adress']) && !empty($_POST['zipCode']) && !empty($_POST['city']) && !empty($_POST['telephone'])) {
								\Customer\AddModel::getInstance()->add_customer($_POST['lastName'], $_POST['adress'], $_POST['zipCode'], $_POST['city'],$_POST['telephone'],$_POST['firstName']);
								header('Location: /Cas-M-Ping/customers/show/all');
								
							} else {
								header('Location: /Cas-M-Ping/customers/add');
							}

						} catch (Exception $e) {
							throw new Exception('Une erreur est survenue durant la modification des données: '.$e->getMessage());
						}
					} else {
						throw new Exception('Le modèle "'. $this->model_name .'" n\'existe pas dans "'._CUSTOMERS_MODELS_ .'"!');
					}
				} else {
					throw new Exception('Une erreur est survenue durant la phase de routage!');
				}
			} else {
				throw new Exception('L\'URL n\'est pas évaluable!');
			}
		}
		
		/**
	     * @see CustomerController::checkAccess()
	     * @return true if the controller is available for the current user/visitor, false any other cases
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see CustomerController::viewAccess()
		 * @return true if the current user/visitor has valid view permissions, false any other cases
		 */
		public function viewAccess() {
			return true;
		}		
	}
