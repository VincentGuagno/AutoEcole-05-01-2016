<?php

	/*
	 * Model for customer modifications
	 * This class handles the display of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Customer;  
	require_once('CustomerModel.php'); 

	class DisplayModel extends CustomerModel{
		
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
		 * Display all customer's informations from one customer 
		 *
	     * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_customers() {
			try {
				$qry = $this->db->prepare('SELECT * FROM customer ORDER BY cust_id');				
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
		 * return customer's id
		 *	
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_customer($cust_id) {
			try {
				$qry = $this->db->prepare('SELECT * FROM customer WHERE customer.cust_id  =?');	
                        								
				$qry->bindValue(1, $cust_id, \PDO::PARAM_STR);				

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
		 * return customer's id
		 *
		 * @param cust_firstName, customer's name
		 * @param cust_lastName, customer's name
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_customerId($cust_firstName, $cust_lastName) {
			try {
	
				$qry = $this->db->prepare('SELECT customer.cust_id FROM	customer
                        					WHERE customer.cust_firstName =? and customer.cust_lastName =?');	
                        								
				$qry->bindValue(1, $cust_firstName, \PDO::PARAM_STR);
				$qry->bindValue(2, $cust_lastName, \PDO::PARAM_STR);

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