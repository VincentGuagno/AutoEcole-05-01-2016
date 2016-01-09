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
	
	class DeleteModel extends RentalModel{
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
		 * delete rental informations from one rental 
		 *
		 * @param rent_id, rental's id
		 *	
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_rental($rent_id) {
			try {

				//suppression dans link_season_location
				$qry = $this->db->prepare('DELETE FROM link_season_location WHERE link_season_location.link_location_id = ?');
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);
				$qry->execute();

				// suppression dans lien loc emp
				$qry = $this->db->prepare('DELETE FROM link_rent_rental WHERE link_rent_rental.lle_loc_id = ?');
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);
				$qry->execute();

				//suppression dans link_car_location
				$qry = $this->db->prepare('DELETE FROM link_car_location WHERE link_car_location.lcl_rent_id = ?');
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);
				$qry->execute();

				// suppression dans location
				$qry = $this->db->prepare('DELETE FROM rental WHERE rental.rent_id = ?');
				$qry->bindValue(1, $rent_id, \PDO::PARAM_INT);
				$qry->execute();

				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * delete rental informations from one rental 
		 *
		 * @param rent_id, rental's id
		 *	
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_rentals() {
			try {

				//suppression dans link_season_location
				$qry = $this->db->prepare('DELETE FROM link_season_location');				
				$qry->execute();

				// suppression dans lien loc emp
				$qry = $this->db->prepare('DELETE FROM link_rent_rental');				
				$qry->execute();

				//suppression dans link_car_location
				$qry = $this->db->prepare('DELETE FROM link_car_location');			
				$qry->execute();

				// suppression dans location
				$qry = $this->db->prepare('DELETE FROM rental');			
				$qry->execute();

				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>