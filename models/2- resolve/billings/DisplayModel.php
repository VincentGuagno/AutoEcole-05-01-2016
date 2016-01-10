<?php

	/*
	 * Model for Eleve modifications
	 * This class handles the display of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Billings;	
	require_once('BillingsModel.php'); 
	
	class DisplayModel extends BillingsModel {

		/**
		 * DisplayModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of DisplayModel
		 */
		public function __construct() {
			try {
				echo 'I exist';
				DisplayModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of DisplayModel (singleton)
		 *
		 * @return DisplayModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new DisplayModel();
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
		 * Display all caravans's informations
		 *		
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_billings() {
			try {								
				$qry = oci_parse($this->db, 'SELECT FACTURATION.PK_FACTURATION,
													FACTURATION.DATE_FACTURE,
													FACTURATION.PRIX,
													FACTURATION.ETAT_FACTURE,
													ELEVE.NOM,
													ELEVE.PRENOM,
													TYPE_FACTURE.LIBELLE
													FROM FACTURATION
													INNER JOIN ELEVE
													ON FACTURATION.PK_FACTURATION = ELEVE.FK_FACTURE
													INNER JOIN TYPE_FACTURE
													ON TYPE_FACTURE.PK_TYPE_FACTURE = FACTURATION.PK_FACTURATION');
				oci_execute($qry);
					
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				var_dump($res);
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * All Eleve's informations from one Eleve 
		 *
		 * @param PK_FACTURATION, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_billing($PK_FACTURATION) {
			try {

				$qry = oci_parse($this->db, 'SELECT FACTURATION.DATE_FACTURE,
													  FACTURATION.PRIX,
													  FACTURATION.ETAT_FACTURE,
													  ELEVE.NOM,
													  ELEVE.PRENOM,
													  TYPE_FACTURE.LIBELLE,
													  ELEVE.LIEU_ETUDE,
													  ELEVE.DATE_NAISSANCE,
													  ELEVE.NUM_TEL,
													  ELEVE.ADRESSE
													FROM FACTURATION
													INNER JOIN ELEVE
													ON FACTURATION.PK_FACTURATION = ELEVE.FK_FACTURE
													INNER JOIN TYPE_FACTURE
													ON TYPE_FACTURE.PK_TYPE_FACTURE = FACTURATION.PK_FACTURATION
													WHERE ELEVE.PK_ELEVE = :PK_FACTURATION');
													
				oci_bind_by_name($qry, ":PK_FACTURATION", $PK_FACTURATION);
				oci_execute($qry);
					
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				
				oci_close($this->db);
				return $res;		
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
	?>