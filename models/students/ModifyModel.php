<?php

	/*
	 * Model for eleve modifications
	 * This class handles the modification of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Student;
	require_once('StudentModel.php'); 
	
	class ModifyModel extends StudentModel{

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
		public function modify_student($FK_MONITEUR, $NOM, $PRENOM, $ADRESSE, $NUM_TEL, $DATE_NAISSANCE, $LIEU_ETUDE, $PK_ELEVE) {
			try {

				//UPDATE ELEVE SET FK_MONITEUR = '21', NOM = 'bi', PRENOM = 'jay', ADRESSE = 'no whi', NUM_TEL = 4, DATE_NAISSANCE = TO_DATE('2016-01-17', 'YYYY-MM-DD HH24:MI:SS'), LIEU_ETUDE = 'se' WHERE PK_ELEVE =21
				$qry = oci_parse($this->db, ("UPDATE ELEVE SET FK_MONITEUR = :FK_MONITEUR, NOM = :NOM, PRENOM = :PRENOM, ADRESSE = :ADRESSE, NUM_TEL = :NUM_TEL, DATE_NAISSANCE = TO_DATE(:DATE_NAISSANCE, 'DD/MM/YYYY HH24:MI:SS'), LIEU_ETUDE = :LIEU_ETUDE WHERE PK_ELEVE =:PK_ELEVE"));
			

				oci_bind_by_name($qry,":FK_MONITEUR",$FK_MONITEUR);
				oci_bind_by_name($qry,":NOM",$NOM);
				oci_bind_by_name($qry,":PRENOM",$PRENOM);					
				oci_bind_by_name($qry,":ADRESSE",$ADRESSE);
				oci_bind_by_name($qry,":NUM_TEL",$NUM_TEL);
				oci_bind_by_name($qry,":DATE_NAISSANCE",$DATE_NAISSANCE);				
				oci_bind_by_name($qry,":LIEU_ETUDE",$LIEU_ETUDE);
				oci_bind_by_name($qry,":PK_ELEVE",$PK_ELEVE);
				
			
				oci_execute($qry);
				oci_close($this->db);
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
