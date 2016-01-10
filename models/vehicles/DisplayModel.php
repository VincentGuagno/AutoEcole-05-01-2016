<?php

	/*
	 * Model for marque modifications
	 * This class handles the display of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Vehicles;	
	require_once('VehicleModel.php'); 
	
	class DisplayModel extends VehicleModel {

		/**
		 * DisplayModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of DisplayModel
		 */
		public function __construct() {
			try {
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
		public function display_vehicules() {
			try {								
				$qry = oci_parse($this->db, 'SELECT VEHICULE.NUMERO,
													  MODELE.NOM_MODELE,
													  MONITEUR.SURNOM
													FROM VEHICULE
													INNER JOIN MARQUE
													ON MARQUE.PK_MARQUE = VEHICULE.FK_MARQUE
													INNER JOIN MODELE
													ON MODELE.PK_MODELE = VEHICULE.FK_MODELE
													INNER JOIN MONITEUR
													ON MONITEUR.PK_MONITEUR = VEHICULE.FK_MONITEUR');			
				oci_execute($qry);
					
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * All Eleve's informations from one Eleve 
		 *
		 * @param PK_VEHICULE, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_vehicule($PK_VEHICULE) {
			try {

				$qry = oci_parse($this->db, 'SELECT VEHICULE.NUMERO,
													  VEHICULE.KM,
													  VEHICULE.DATE_ACHAT,
													  VEHICULE.PRIX_ACHAT,
													  MARQUE.NOM,
													  MODELE.TYPE_MOTEUR,
													  MODELE.PUISSANCE,
													  MODELE.NOM_MODELE,
													  MONITEUR.SURNOM,
													  MONITEUR.PRENOM,
													  MONITEUR.NOM AS NOM1
													FROM VEHICULE
													INNER JOIN MARQUE
													ON MARQUE.PK_MARQUE = VEHICULE.FK_MARQUE
													INNER JOIN MODELE
													ON MODELE.PK_MODELE = VEHICULE.FK_MODELE
													INNER JOIN MONITEUR
													ON MONITEUR.PK_MONITEUR    = VEHICULE.FK_MONITEUR
													WHERE VEHICULE.PK_VEHICULE = :PK_VEHICULE');	
				
				oci_bind_by_name($qry,":PK_VEHICULE",$PK_VEHICULE);	
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


	