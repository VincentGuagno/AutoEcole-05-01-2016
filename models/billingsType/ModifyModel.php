<?php

	/*
	 * Model for customer modifications
	 * This class handles the modification of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace BillingTypes;
	require_once('BillingTypesModel.php'); 
	
	class ModifyModel extends BillingTypesModel{

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
		 * @param LIBELLE, customer's id
		 * @param PK_TYPE_FACTURE, customer's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_type_facture($LIBELLE, $PK_TYPE_FACTURE) {
			try {
			
				// UPDATE TYPE_FACTURE SET LIBELLE = 'useless' WHERE PK_TYPE_FACTURE = 3
				$qry = oci_parse($this->db, ("UPDATE MODELE SET LIBELLE = ':LIBELLE' WHERE PK_TYPE_FACTURE = :PK_TYPE_FACTURE");
				
				oci_bind_by_name($qry,":LIBELLE",$LIBELLE);
				oci_bind_by_name($qry,":PK_TYPE_FACTURE",$PK_TYPE_FACTURE);
			
				oci_execute($qry);
			    oci_close($this->db);
				return 0;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
