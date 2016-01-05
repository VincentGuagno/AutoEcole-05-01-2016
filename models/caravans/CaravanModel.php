<?php
	/*
	 * Model for caravan modifications
	 * This class handles the add  of a caravan
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	namespace Caravan; 
	 
	class CaravanModel {

		/**
		 * Database object
		 */
		public $db = null;
	
		/**
		 * Initialize the CaravanModel class
		 */
		public function init() {}
		/**
		 * Modify caravan's informations
		 *
		 * @param car_id, caravan's id		
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_Caravan($car_id) {
			try {
	
				$qry = $this->db->prepare('SELECT caravan.car_id FROM caravan WHERE caravan.car_id = ?');	
				$qry->bindValue(1, $car_id, \PDO::PARAM_STR);				
				$qry->execute();
				//put  the result into an object
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);
				$qry->closeCursor();
				return (!empty($return_qry->car_id)) ? 1 : 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>