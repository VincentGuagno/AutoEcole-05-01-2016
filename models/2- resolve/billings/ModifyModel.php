<?php

	/*
	 * Model for customer modifications
	 * This class handles the modification of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Facturation;
	require_once('FacturationModel.php'); 
	
	class ModifyModel extends FacturationModel{

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
		 * @param DATE_FACTURE, customer's id
		 * @param PRIX, customer's name
		 * @param ETAT_FACTURE, customer's name
		 * @param PK_FACTURATION, customer's address
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_facturation($DATE_FACTURE, $PRIX, $ETAT_FACTURE, $PK_FACTURATION) {
			try {

				// UPDATE FACTURATION SET DATE_FACTURE = TO_DATE('2010-01-24', 'YYYY-MM-DD HH24:MI:SS'), PRIX = 1250, ETAT_FACTURE = 0 WHERE PK_FACTURATION = 1
				$qry = oci_parse($this->db, ("UPDATE FACTURATION SET DATE_FACTURE = TO_DATE('?', 'YYYY-MM-DD HH24:MI:SS'), PRIX = ?, ETAT_FACTURE = ? WHERE PK_FACTURATION = ?");
				
				$qry->bindValue(1, $DATE_FACTURE, \PDO::PARAM_STR);
				$qry->bindValue(2, $PRIX, \PDO::PARAM_INT);
				$qry->bindValue(3, $ETAT_FACTURE, \PDO::PARAM_INT);
				$qry->bindValue(4, $PK_FACTURATION, \PDO::PARAM_INT);
			
				oci_execute($qry);
				return 0;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>