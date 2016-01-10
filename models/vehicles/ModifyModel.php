<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Vehicle;
	require_once('VehicleModel.php'); 
	
	class ModifyModel extends VehicleModel{

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
		 * @param NUMERO, customer's id
		 * @param KM, customer's name
		 * @param DATE_ACHAT, customer's name
		 * @param PRIX_ACHAT, customer's address
		 * @param PK_VEHICULE, customer's zip code
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_vehicule($NUMERO, $KM, $DATE_ACHAT, $PRIX_ACHAT, $PK_VEHICULE) {
			try {
				// UPDATE VEHICULE SET NUMERO = 008, KM = 13165444456, DATE_ACHAT = TO_DATE('2016-01-05', 'YYYY-MM-DD HH24:MI:SS'), PRIX_ACHAT = 555545 WHERE PK_VEHICULE=6
				$qry = oci_parse($this->db, ("UPDATE VEHICULE SET NUMERO = :NUMERO, KM = :KM, DATE_ACHAT = TO_DATE(':DATE_ACHAT', 'YYYY-MM-DD HH24:MI:SS'), PRIX_ACHAT = :PRIX_ACHAT WHERE PK_VEHICULE=:PK_VEHICULE");
				
				oci_bind_by_name($qry,":NUMERO",$NUMERO);
				oci_bind_by_name($qry,":KM",$KM);
				oci_bind_by_name($qry,":DATE_ACHAT",$DATE_ACHAT);	
				oci_bind_by_name($qry,":PRIX_ACHAT",$PRIX_ACHAT);
				oci_bind_by_name($qry,":PK_VEHICULE",$PK_VEHICULE);		
				oci_execute($qry);
				return 0;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
