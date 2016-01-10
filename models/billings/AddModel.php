<?php

	/*
	 * Model for permis modifications
	 * This class handles the add  of a permis
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Billings; 
	require_once('BillingsModel.php'); 
	
	class AddModel extends BillingsModel{

		/**
		 * AddModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of AddModel
		 */
		public function __construct() {
			try {
				AddModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of AddModel (singleton)
		 *
		 * @return AddModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new AddModel();
			}
			return self::$instance;
		}
		
		/**
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
		 * @param DATE_FACTURE ,  
		 * @param PRIX ,  
		 * @param ETAT_FACTURE ,  
		 */
		public function add_billing($DATE_FACTURE, $PRIX, $ETAT_FACTURE, $FK_TYPE_FACTURE, $FK_ELEVE) {
			try {
				//INSERT INTO "AUTO"."FACTURATION" (FK_TYPE_FACTURE, DATE_FACTURE, PRIX, ETAT_FACTURE) VALUES ('2', TO_DATE('2016-01-22 17:48:34', 'YYYY-MM-DD HH24:MI:SS'), '55', '1')
				$qry = oci_parse($this->db, 'INSERT INTO AUTO.FACTURATION (DATE_FACTURE, PRIX, ETAT_FACTURE, FK_TYPE_FACTURE, FK_ELEVE) VALUES (to_date(:DATE_FACTURE,\'MM-DD-YYYY\'),:PRIX,:ETAT_FACTURE,:FK_TYPE_FACTURE,:FK_ELEVE)');
				oci_bind_by_name($qry,":DATE_FACTURE",$DATE_FACTURE);
				oci_bind_by_name($qry,":PRIX",$PRIX);
				oci_bind_by_name($qry,":ETAT_FACTURE",$ETAT_FACTURE);
				oci_bind_by_name($qry,":FK_TYPE_FACTURE",$FK_TYPE_FACTURE);
				oci_bind_by_name($qry,":FK_ELEVE",$FK_ELEVE);
				oci_execute($qry);
				oci_close($this->db);	
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}	
?>