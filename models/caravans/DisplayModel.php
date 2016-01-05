<?php
	
	/*
	 * Model for caravan modifications
	 * This class handles the display of a caravan
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	
	namespace Caravan;	
	require_once('CaravanModel.php'); 
	
	class DisplayModel extends CaravanModel {

		/**
		 * DisplayModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of DisplayModel
		 */
		public function __construct() {
			try {
				DisplayModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of DisplayModel (singleton)
		 *
		 * @return DisplayModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new DisplayModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the DisplayModel class
		 */
		public function init() {
			try {
				parent::init();	
			} catch(Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			try {	
				$pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
				$this->db = new \PDO('mysql:host='._HOST_ .';dbname='._DATABASE_, _LOGIN_, _PASSWORD_, $pdo_options);
				$this->db->exec('SET NAMES utf8');
			} catch(Exception $e) {
				throw new Exception('Connexion à la base de données impossible: '.$e->getMessage());
			}
		}

		/**
		 * Display all caravans's informations
		 *		
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_caravans() {
			try {
				$qry = $this->db->prepare('SELECT * FROM caravan ORDER BY caravan.car_id');	
				
				$qry->execute();

				//get customer's ID      put  the result into an object
				
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * All caravan's informations from one caravan 
		 *
		 * @param car_id, caravan's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_caravan($car_id) {
			try {
				$qry = $this->db->prepare('SELECT * FROM caravan WHERE car_id = ?');	
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);
				$qry->execute();

					//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;
				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	

		/**
		 * return caravan's id
		 *
		 * @param car_id, caravan's name		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_caravanId($car_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM caravan WHERE car_id = ?');	
                        								
				$qry->bindValue(1, $car_id, \PDO::PARAM_STR);
				
				$qry->execute();
					//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}


		/**
		 * return caravan's id
		 *
		 * @param lcl_rent_id, lcl_rent_id's name		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_caravanByRental($lcl_rent_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM caravan
													INNER JOIN link_car_location ON link_car_location.lcl_car_id = caravan.car_id
        											WHERE link_car_location.lcl_rent_id = ?');	
                        								
				$qry->bindValue(1, $lcl_rent_id, \PDO::PARAM_STR);
				
				$qry->execute();
					//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}
?>