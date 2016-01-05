<?php

	/*
	 * Model for seasons modifications
	 * This class handles the display of a seasons
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	
	namespace Season;
	require_once('SeasonModel.php'); 
	
	class displayModel extends SeasonModel{

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
		 * Display all season's informations
		 *
		 * @param seas_id, season's name
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_seasons() {	
			try {
				$qry = $this->db->prepare('SELECT seas_id, seas_name, seas_start_date, seas_end_date, seas_coeff
										   FROM season
										   ORDER BY season.seas_id');	

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
		 * All season's informations from one customer 
		 *
		 * @param seas_id, season's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function display_season($seas_id) {
			try {
				$qry = $this->db->prepare('SELECT * FROM season WHERE seas_id = ?');	
				$qry->bindValue(1, $seas_id, \PDO::PARAM_INT);
				
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
		 * All season's informations from one customer 
		 *
		 * @param seas_id, season's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function display_seasonCoeff($date) {
			try {
				$qry = $this->db->prepare('SELECT seas_coeff FROM season WHERE seas_start_date <= ? AND seas_end_date >= ?');	
				$qry->bindValue(1, $date, \PDO::PARAM_STR);
				$qry->bindValue(2, $date, \PDO::PARAM_STR);
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
		 * return season's id
		 *
		 * @param seas_id, season's id		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_seasonId($seas_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM season WHERE seas_id = ?');	
                        								
				$qry->bindValue(1, $seas_id, \PDO::PARAM_STR);		

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
		 * return season's id
		 *
		 * @param link_location_id, link_location_id's name		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_SeasonByRental($link_location_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM season
													INNER JOIN link_season_location ON link_season_location.link_seas_id = season.seas_id
        											WHERE link_season_location.link_location_id = ?');	
                        								
				$qry->bindValue(1, $link_location_id, \PDO::PARAM_STR);
				
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