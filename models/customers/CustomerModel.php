<?php
	/*
	 * Model for customer modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Customer; 
	 
	class CustomerModel {
		


		
		/**
		 * Database object
		 */
		public $db = null;
		
		/**
		 * Initialize the CustomerModel class
		 */
		public function init() {}
		
		/**
		 * Modify customer's informations
		 *
		 * @param cust_id, customer's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_customer($cust_id) {
			try {
	
				$qry = $this->db->prepare('SELECT customer.cust_id FROM customer WHERE customer.cust_id =?');	
				$qry->bindValue(1, $cust_id, \PDO::PARAM_STR);
				$qry->execute();
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);
				$qry->closeCursor();
				return (!empty($return_qry->cust_id)) ? 1 : 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}