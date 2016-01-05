<?php

	/*
	 * Model for visitor modifications
	 * This class handles the modification of a visitor
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Visitor; 
	require_once('VisitorModel.php'); 
	
	class ModifyModel extends VisitorModel{

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
		 * modify vis_id's informations
		 *
		 * @param vis_id, vis_id's id
		 * @param vis_firstName, vis's firstName 
		 * @param vis_lastName, vis's lastName
		 * @param vis_personNumber, vis's personNumber
		 * @param vis_date, vis's date
		 * @return 0 without errors, exception message any others cases
		 */	
		public function modify_Visitor($vis_firstName, $vis_lastName, $vis_personNumber ,$vis_date ,$vis_id) {
			try {
				$qry = $this->db->prepare('UPDATE visitor SET 
															  vis_firstName=?,
															  vis_lastName=?,
															  vis_personNumber=?,
															  vis_date=? 
															  WHERE vis_id=?');
				$qry->bindValue(1, $vis_firstName, \PDO::PARAM_STR);	
				$qry->bindValue(2, $vis_lastName, \PDO::PARAM_STR);	
				$qry->bindValue(3, $vis_personNumber, \PDO::PARAM_INT);
				$qry->bindValue(4, $vis_date, \PDO::PARAM_STR);
				$qry->bindValue(5, $vis_id, \PDO::PARAM_STR);
					
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
		
	}

?>