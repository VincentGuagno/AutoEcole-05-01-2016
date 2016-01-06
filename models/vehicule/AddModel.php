<?php

	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Vehicule; 
	require_once('VehiculeModel.php'); 
	
	class AddModel extends VehiculeModel{

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
		 * @param FK_MODELE ,  customer's lasttName
		 * @param PUISSANCE ,  customer's lasttName
		 * @param NUMERO ,  customer's lasttName
		 * @param KM ,  customer's lasttName
		 * @param DATE_ACHAT ,  customer's lasttName
		 * @param PRIX_ACHAT ,  customer's lasttName
		 */
		public function add_vehicule($FK_MODELE, $PUISSANCE, $NUMERO, $KM, $DATE_ACHAT, $PRIX_ACHAT) {
			try {		

				// INSERT INTO "AUTO"."VEHICULE" (FK_MODELE, PUISSANCE, NUMERO, KM, DATE_ACHAT, PRIX_ACHAT) VALUES ('1', '1', '1', '44', '121', TO_DATE('2016-01-04 17:56:12', 'YYYY-MM-DD HH24:MI:SS'), '11')


				$qry = oci_parse($this->db, 'INSERT INTO AUTO.VEHICULE (FK_MODELE, FK_MONITEUR, NUMERO, KM, DATE_ACHAT, PRIX_ACHAT) VALUES (?,?,?,?,?,?)');
				$qry->bindValue(1, $FK_MODELE, \PDO::PARAM_STR);
				$qry->bindValue(2, $PUISSANCE, \PDO::PARAM_STR);
				$qry->bindValue(3, $NUMERO, \PDO::PARAM_INT);
				$qry->bindValue(4, $KM, \PDO::PARAM_STR);
				$qry->bindValue(5, $DATE_ACHAT, \PDO::PARAM_STR);
				$qry->bindValue(6, $PRIX_ACHAT, \PDO::PARAM_INT);

				oci_execute($qry);

				oci_close($this->db);
				return $res;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}
	
?>