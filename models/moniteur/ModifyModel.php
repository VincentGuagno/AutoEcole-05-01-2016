<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Moniteur;
	require_once('MoniteurModel.php'); 
	
	class ModifyModel extends MoniteurModel{

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
		 * Initialize the DisplayModel class
		 */
		public function init() {
			try {
				parent::init();	
			} catch(Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			try {	
				$this->db = oci_connect(_LOGIN_, _PASSWORD_, _HOST_);
				
				if (!$this->db) {
					$e = oci_error();
					trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
				}
				//-------------------Ancienne connexion----------------------------
				/*
				$pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
				$this->db = new \PDO('mysql:host='._HOST_ .';dbname='._DATABASE_, _LOGIN_, _PASSWORD_, $pdo_options);
				$this->db->exec('SET NAMES utf8');
				*/
				//-----------------------------------------------------------------
				
			} catch(Exception $e) {
				throw new Exception('Connexion à la base de données impossible: '.$e->getMessage());
			}
		}


		/**
		 * Modify all customer's informations from one customer 
		 * NOT IN ORDER
		 * @param NOM, customer's id
		 * @param PRENOM, customer's name
		 * @param ADRESSE, customer's name
		 * @param NUM_TEL, customer's address
		 * @param SURNOM, customer's zip code
		 * @param DATE_EMBAUCHE, customer's city
		 * @param PK_MONITEUR, customer's phone number
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_moniteur($NOM, $PRENOM, $ADRESSE, $NUM_TEL, $SURNOM, $DATE_EMBAUCHE, $PK_MONITEUR) {
			try {
			    // UPDATE MONITEUR SET NOM = 'ho', PRENOM = 'bi', ADRESSE = 'ee', NUM_TEL = 555546, SURNOM = 'org', DATE_EMBAUCHE = TO_DATE('2010-01-15', 'YYYY-MM-DD HH24:MI:SS') WHERE PK_MONITEUR =21

				$qry = oci_parse($this->db, ("UPDATE MONITEUR SET NOM = '?', PRENOM = '?', ADRESSE = '?', NUM_TEL = ?, SURNOM = '?', DATE_EMBAUCHE = TO_DATE('2010-01-15', 'YYYY-MM-DD HH24:MI:SS') WHERE PK_MONITEUR =?");
				
				$qry->bindValue(1, $NOM, \PDO::PARAM_STR);
				$qry->bindValue(2, $PRENOM, \PDO::PARAM_STR);
				$qry->bindValue(3, $ADRESSE, \PDO::PARAM_STR);
				$qry->bindValue(4, $NUM_TEL, \PDO::PARAM_INT);
				$qry->bindValue(5, $SURNOM, \PDO::PARAM_STR);
				$qry->bindValue(6, $DATE_EMBAUCHE, \PDO::PARAM_INT);
				$qry->bindValue(7, $PK_MONITEUR, \PDO::PARAM_INT);
			
				oci_execute($qry);
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>