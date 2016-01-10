<?php

	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Instructor; 
	require_once('InstructorModel.php'); 
	
	class AddModel extends InstructorModel{

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
		 * @param NOM ,  customer's lasttName
		 * @param PRENOM ,  customer's lasttName
		 * @param ADRESSE ,  customer's lasttName
		 * @param NUM_TEL ,  customer's lasttName
		 * @param SURNOM ,  customer's lasttName	
		 * @param DATE_EMBAUCHE ,  customer's lasttName
		 */
		public function add_instructor($NOM, $PRENOM, $ADRESSE, $NUM_TEL, $SURNOM, $DATE_EMBAUCHE) {
			try {		

				// INSERT INTO "AUTO"."MONITEUR" (NOM, PRENOM, ADRESSE, NUM_TEL, SURNOM, DATE_EMBAUCHE) VALUES ('hobbit', 'bilbo', 'eee', '555', 'orgi', TO_DATE('2016-01-11 18:08:51', 'YYYY-MM-DD HH24:MI:SS'))

				$qry = oci_parse($this->db, 'INSERT INTO AUTO.MONITEUR  (NOM, PRENOM, ADRESSE, NUM_TEL, SURNOM, DATE_EMBAUCHE) VALUES (:NOM,:PRENOM,:ADRESSE,:NUM_TEL,:SURNOM,TO_DATE(:DATE_EMBAUCHE,\'DD-MM-YYYY\'))');
				oci_bind_by_name($qry,":NOM",$NOM);
				oci_bind_by_name($qry,":PRENOM",$PRENOM);
				oci_bind_by_name($qry,":ADRESSE",$ADRESSE);
				oci_bind_by_name($qry,":NUM_TEL",$NUM_TEL);
				oci_bind_by_name($qry,":SURNOM",$SURNOM);
				oci_bind_by_name($qry,":DATE_EMBAUCHE",$DATE_EMBAUCHE);	

				oci_execute($qry);
				oci_close($this->db);
				return $res;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}	
?>
