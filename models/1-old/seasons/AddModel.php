<?php

	/*
	 * Model for seasons modifications
	 * This class handles the add  of a seasons
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Season;
	require_once('SeasonModel.php'); 
	
	class addModel extends SeasonModel{

		/**
		 * addModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of addModel
		 */
		public function __construct() {
			try {
				addModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of addModel (singleton)
		 *
		 * @return addModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new addModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the addModel class
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
		 * Add new season informations
		 *
		 * @param seas_name, season's name
		 * @param seas_StartDate, season's begin
		 * @param seas_EndDate, season's end
		 * @param seas_coeff, season's coeff
		 * @return 0 without errors, exception message any others cases
		 */
		public function add_season($seas_name, $seas_StartDate, $seas_EndDate, $seas_coeff) {
			try {
				$qry = $this->db->prepare('INSERT INTO season(seas_name, seas_start_date, seas_end_date,seas_coeff) VALUES (?,?,?,?)');
				$qry->bindValue(1, $seas_name, \PDO::PARAM_STR);
				$qry->bindValue(2, $seas_StartDate, \PDO::PARAM_STR);
				$qry->bindValue(3, $seas_EndDate, \PDO::PARAM_STR);
				$qry->bindValue(4, $seas_coeff, \PDO::PARAM_STR);		
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>