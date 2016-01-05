<?php

	/*
	 * Model for caravan modifications
	 * This class handles the return of a caravan
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Caravan;
	require_once('CaravanModel.php'); 
	
	class ReturnModel extends CaravanModel {


		/**
		 * ReturnModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of ReturnModel
		 */
		public function __construct() {
			try {
				ReturnModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of ReturnModel (singleton)
		 *
		 * @return ReturnModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new ReturnModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the ReturnModel class
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
		 * Delete a specified caravan and link		
		 *
		 * @param car_id, caravan's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_caravan($car_id) {
			try {
				$qry = $this->db->prepare('DELETE FROM link_car_location WHERE link_car_location.lcl_car_id = ?');
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);
				$qry->execute();

				$qry = $this->db->prepare('DELETE FROM caravan WHERE caravan.car_id = ?');
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);
				$qry->execute();

				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * Delete all  caravans and link 
		 *		
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_caravans() {
			try {
				$qry = $this->db->prepare('DELETE FROM link_car_location');
				$qry->execute();
				
				$qry = $this->db->prepare('DELETE FROM caravan');
				$qry->execute();
				
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>