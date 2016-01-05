<?php

	/*
	 * Model for customer modifications
	 * This class handles the delete of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Customer; 
	require_once('CustomerModel.php'); 
	
	class DeleteModel extends CustomerModel{

		/**
		 * DeleteModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of DeleteModel
		 */
		public function __construct() {
			try {
				DeleteModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of DeleteModel (singleton)
		 *
		 * @return DeleteModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new DeleteModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the DeleteModel class
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
		 * Delete a specified Customer
		 *
		 * @param cust_id, Customer's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_Customer($cust_id) {
			try {
				
				$qry = $this->db->prepare('DELETE FROM customer WHERE customer.cust_id  = ?');
				$qry->bindValue(1, $cust_id, \PDO::PARAM_INT);
		
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * Delete all Customer
		 *	
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_Customers() {
			try {								

				$qry = $this->db->prepare('DELETE FROM customer ');
			

				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>
