<?php

	/*
	 * Model for rental modifications
	 * This class handles the creation of a rental
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Rental;  
	require_once('RentalModel.php'); 
	
	class CancelModel extends RentalModel{
		/**
		 * CancelModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of CancelModel
		 */
		public function __construct() {
			try {
				CancelModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of CancelModel (singleton)
		 *
		 * @return CancelModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new CancelModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the CancelModel class
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
		 * cancel rental's informations from one rental 
		 *
		 * @param rent_cust_id, cust_id's rent
		 * @param rent_validity, rental's validity
		 * @return 0 without errors, exception message any others cases
		 */
		public function cancel_rental($rent_validity, $rent_cust_id) {
			try {
				$qry = $this->db->prepare('UPDATE rental SET rent_validity=? WHERE rent_cust_id =?');
				$qry->bindValue(1, $rent_validity, \PDO::PARAM_INT);
				$qry->bindValue(2, $rent_cust_id, \PDO::PARAM_INT);
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

			
	}

?>