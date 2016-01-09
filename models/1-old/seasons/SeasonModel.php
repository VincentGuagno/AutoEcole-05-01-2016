<?php
	/*
	 * Model for season modifications
	 * This class handles the add  of a season
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Season; 
	 
	class SeasonModel {
	
		/**
		 * Database object
		 */
		public $db = null;
	
		/**
		 * Initialize the SeasonModel class
		 */
		public function init() {}

		/**
		 * Modify season's informations
		 *
		 * @param car_id, season's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_season($seas_id) {
			try {
	
				$qry = $this->db->prepare('SELECT season.seas_id FROM season WHERE season.seas_id = ?');	
				$qry->bindValue(1, $seas_id, \PDO::PARAM_STR);	
							
				$qry->execute();
				//put  the result into an object
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);
				$qry->closeCursor();
				return (!empty($return_qry->seas_id)) ? 1 : 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>