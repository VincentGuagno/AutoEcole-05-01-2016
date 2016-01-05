<?php

	/*
	 * Model for rentals modifications
	 * This class handles the display of a rent
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Rental;		
	require_once('RentalModel.php'); 
	
	class DisplayModel extends RentalModel{

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
		* All rental's informations		
		* @return return_qry : result into an object, exception message any others cases
		*/		
		public function display_rentals() {
			try {
				$qry = $this->db->prepare("SELECT rental.*,CONCAT(cust_firstName,' ',cust_lastName) as cust_name 
											FROM rental
					 						INNER JOIN customer ON customer.cust_id = rental.rent_cust_id
					 						ORDER BY rent_id");
				$qry->execute();
				$return_qry = $qry->fetchAll();

				$qry->closeCursor();
				return $return_qry;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * All customer's informations from one customer 
		 * @param rent_id, rental's id
		 * @return return_qry : result into an object, exception message any others cases
		 */		
		public function display_rental($rent_id) {
			try {
				$qry = $this->db->prepare("SELECT rental.*,CONCAT(cust_firstName,' ',cust_lastName) as cust_name 
											FROM rental
											INNER JOIN customer ON  customer.cust_id = rental.rent_cust_id 
												 WHERE rent_id = ?");	
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);
				
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
		 * return rental's id
		 *
		 * @param rent_id, rental's id		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_rentalId($rent_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM rental WHERE rent_id = ?');	
														
				$qry->bindValue(1, $rent_id, \PDO::PARAM_STR);		

				$qry->execute();
				//get customer's ID      put  the result into an object
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);

				$qry->closeCursor();
				return $return_qry;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * return rental's id
		 *
		 * @param rent_cust_id, rent_cust_id's id		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_rentalByClientId($rent_cust_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM rental WHERE rent_cust_id = ?');	
														
				$qry->bindValue(1, $rent_id, \PDO::PARAM_STR);		

				$qry->execute();
				//get customer's ID      put  the result into an object
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);

				$qry->closeCursor();
				return $return_qry;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
