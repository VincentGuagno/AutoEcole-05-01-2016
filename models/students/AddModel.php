<?php

	/*
	 * Model for customer modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Students; 
	require_once('StudentModel.php'); 
	
	class AddModel extends StudentModel{

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
		 *
		 * @param NOM, customer's id
		 * @param PRENOM, customer's firstName
		 * @param ADRESSE ,  customer's lasttName
		 * @param NUM_TEL, customer's address
		 * @param DATE_NAISSANCE, customer's zip code
		 * @param LIEU_ETUDE, customer's city
		 * @return 0 without errors, exception message any others cases
		 */
		public function add_eleve($NOM,
									 $PRENOM,
									 $ADRESSE, 
									 $NUM_TEL, 
									 $DATE_NAISSANCE, 									
									 $LIEU_ETUDE) {
			try {
				//UPDATE ELEVE SET FK_MONITEUR = '21', NOM = 'bi', PRENOM = 'jay', ADRESSE = 'no whi', NUM_TEL = 4, DATE_NAISSANCE = TO_DATE('2016-01-17', 'YYYY-MM-DD HH24:MI:SS'), LIEU_ETUDE = 'se' WHERE PK_ELEVE =21
				$qry = oci_parse($this->db, ("INSERT INTO AUTO.ELEVE  (NOM, PRENOM, ADRESSE, NUM_TEL, DATE_NAISSANCE, LIEU_ETUDE)  VALUES (':NOM', ':PRENOM', ':ADRESSE',:NUM_TEL, TO_DATE(':DATE_NAISSANCE', 'YYYY-MM-DD HH24:MI:SS'),':LIEU_ETUDE')");
							
				oci_bind_by_name($qry,":NOM",$NOM);
				oci_bind_by_name($qry,":PRENOM",$PRENOM);	
				oci_bind_by_name($qry,":ADRESSE",$ADRESSE);
				oci_bind_by_name($qry,":NUM_TEL",$NUM_TEL);
				oci_bind_by_name($qry,":DATE_NAISSANCE",$DATE_NAISSANCE);	
				oci_bind_by_name($qry,":LIEU_ETUDE",$LIEU_ETUDE);

				oci_execute($qry);
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
	
?>


