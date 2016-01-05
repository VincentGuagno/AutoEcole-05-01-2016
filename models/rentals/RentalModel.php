<?php
	/*
	 * Model for rental modifications
	 * This class handles the add  of a rental
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	
	namespace Rental;	
	
	class RentalModel {
	
		/**
		 * Database object
		 */
		public $db = null;
	
		/**
		 * Initialize the RentalModel class
		 */
		public function init() {}

		/**
		 * Modify rental's informations
		 *
		 * @param car_id, rental's id		
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_rental($rent_id) {
			try {	
				$qry = $this->db->prepare('SELECT rent_id FROM rental WHERE rent_id = ?');	
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);	
							
				$qry->execute();
				
				//put  the result into an object
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);
				$qry->closeCursor();
				
				return (!empty($return_qry->rent_id)) ? 1 : 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>