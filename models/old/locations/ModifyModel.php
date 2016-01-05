<?php

	/*
	 * Model for location modifications
	 * This class handles the modification of a location
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Location;  
	require_once('LocationModel.php'); 
	
	class ModifyModel extends LocationModel{

		/**
		 * ModifyModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of ModifyModel
		 */
		public function __construct() {
			try {
				ModifyModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of ModifyModel (singleton)
		 *
		 * @return ModifyModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new ModifyModel();
			}
			return self::$instance;
		}
		
		/**
		 * Initialize the ModifyModel class
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
		 * Modify location's informations
		 *
		 * @param loc_sec_id, location's name
		 * @param loc_type_id, location's begin
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_location($before_locSecId, $before_locTypeId,
										$after_locSecId, $after_locTypeId) {
			try {
	
				$qry = $this->db->prepare('UPDATE location 						                                             
											SET location.loc_sec_id = ?, location.loc_type_id = ?
                        					WHERE location.loc_sec_id =? AND location.loc_type_id = ?');

				// Values SET
				$qry->bindValue(1, $after_locSecId, \PDO::PARAM_INT);
				$qry->bindValue(2, $after_locTypeId, \PDO::PARAM_INT);

				// Values WHERE
				$qry->bindValue(3, $before_locSecId, \PDO::PARAM_INT);
				$qry->bindValue(4, $before_locTypeId, \PDO::PARAM_INT);				

				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * Modify location's informations
		 *
		 * @param loc_type_id, locationType's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_typeLocation($loc_type_id) {
			try {
	
				$qry = $this->db->prepare('SELECT location.loc_id FROM	location
                        					WHERE location.loc_type_id =?');
				
				$qry->bindValue(1, $loc_id, \PDO::PARAM_INT);
				
				//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}


	}

?>