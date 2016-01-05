<?php

	/*
	 * Model for sectors modifications
	 * This class handles the modification of a sectors
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Sector; 
	require_once('SectorModel.php'); 
	
	class ModifyModel extends SectorModel{

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
		 * modify sector's informations
		 *
		 * @param sec_id, sector's id
		 * @param sec_name, sec_name's id
		 * @return 0 without errors, exception message any others cases
		 */	
		public function modify_sector($sec_id, $sec_name) {
			try {
				$qry = $this->db->prepare('UPDATE sector SET sec_name=? WHERE sec_id = ?');
				$qry->bindValue(1, $sec_name, \PDO::PARAM_STR);
				$qry->bindValue(2, $sec_id, \PDO::PARAM_INT);
				
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * Modify sector's informations
		 *
		 * @param sec_id, sector's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_sector($sec_id) {
			try {
	
				$qry = $this->db->prepare('SELECT sector.sec_name FROM	sector
                        					WHERE sector.sec_id =?');
				
				$qry->bindValue(1, $sec_id, \PDO::PARAM_INT);
				
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}

?>