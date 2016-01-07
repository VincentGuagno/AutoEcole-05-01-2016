<?php

	/*
	 * Model for eleve modifications
	 * This class handles the modification of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Eleve;
	require_once('EleveModel.php'); 
	
	class ModifyModel extends EleveModel{

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
		 * @param FK_MONITEUR, customer's id
		 * @param NOM, customer's name
		 * @param PRENOM, customer's name
		 * @param ADRESSE, customer's address
		 * @param NUM_TEL, customer's zip code
		 * @param DATE_NAISSANCE, customer's city
		 * @param LIEU_ETUDE, customer's phone number
		 * @param PK_ELEVE, customer's record number
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_eleve($FK_MONITEUR, $NOM, $PRENOM, $ADRESSE, $NUM_TEL, $DATE_NAISSANCE, $LIEU_ETUDE, $PK_ELEVE) {
			try {

				//UPDATE ELEVE SET FK_MONITEUR = '21', NOM = 'bi', PRENOM = 'jay', ADRESSE = 'no whi', NUM_TEL = 4, DATE_NAISSANCE = TO_DATE('2016-01-17', 'YYYY-MM-DD HH24:MI:SS'), LIEU_ETUDE = 'se' WHERE PK_ELEVE =21
				$qry = oci_parse($this->db, ("UPDATE ELEVE SET FK_MONITEUR = ?, NOM = '?', PRENOM = '?', ADRESSE = '?', NUM_TEL = ?, DATE_NAISSANCE = TO_DATE('?', 'YYYY-MM-DD HH24:MI:SS'), LIEU_ETUDE = '?' WHERE PK_ELEVE =?");
				
				$qry->bindValue(1, $FK_MONITEUR, \PDO::PARAM_INT);
				$qry->bindValue(2, $NOM, \PDO::PARAM_STR);
				$qry->bindValue(3, $PRENOM, \PDO::PARAM_STR);
				$qry->bindValue(4, $ADRESSE, \PDO::PARAM_STR);
				$qry->bindValue(5, $NUM_TEL, \PDO::PARAM_STR);
				$qry->bindValue(6, $DATE_NAISSANCE, \PDO::PARAM_STR);
				$qry->bindValue(7, $LIEU_ETUDE, \PDO::PARAM_STR);
				$qry->bindValue(8, $PK_ELEVE, \PDO::PARAM_INT);
			
				oci_execute($qry);
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>