<?php

	/*
	 * Model for caravan modifications
	 * This class handles the renting of a caravan
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	namespace Caravan; 
	require_once('CaravanModel.php'); 
	
	class RentingModel extends CaravanModel {

		/**
		 * RentingModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of RentingModel
		 */
		public function __construct() {
			try {
				RentingModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of RentingModel (singleton)
		 *
		 * @return RentingModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new RentingModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the RentingModel class
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
		 * Rent a caravans.  You need to find the => rent_cust_id!
		 *		
		 * @param car_society_name, car_society_name's name 
		 * @param car_price, car_price's price
		 * @param car_nb_person, the number of person in the car
		 * @param car_id_location, car's location id
		 * @return 0 without errors, exception message any others cases
		 */
		public function renting_caravan($car_society_name, $car_price, 
										$car_nb_person, $car_id_location) {
			try {

				$qry = $this->db->prepare('INSERT INTO caravan (car_society_name, 
																car_price, 
																car_nb_person, 
																car_id_location)
												  VALUES (?, ?, ?, ?)');
				
				$qry->bindValue(1, $car_society_name, \PDO::PARAM_STR);
				$qry->bindValue(2, $car_price, \PDO::PARAM_INT);
				$qry->bindValue(3, $car_nb_person, \PDO::PARAM_INT);
				$qry->bindValue(4, $car_id_location, \PDO::PARAM_INT);

				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>