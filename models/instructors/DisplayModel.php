<?php

	/*
	 * Model for marque modifications
	 * This class handles the display of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Instructor;	
	require_once('InstructorModel.php'); 
	
	class DisplayModel extends InstructorModel {

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
		public function display_instructors() {
			try {								
				$qry = oci_parse($this->db, 'SELECT MONITEUR.* FROM MONITEUR');			
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
		 * @param PK_MONITEUR, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_instructor($PK_MONITEUR) {
			try {

				$qry = oci_parse($this->db, 'SELECT * FROM AUTO.MONITEUR WHERE MONITEUR.PK_MONITEUR =:PK_MONITEUR');	
				oci_bind_by_name($qry,":PK_MONITEUR",$PK_MONITEUR);
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
		 * @param PK_MONITEUR, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_planing_moniteur($PK_MONITEUR) {
			try {

				$qry = oci_parse($this->db, 'SELECT MONITEUR.NOM,
												  MONITEUR.PRENOM,
												  MONITEUR.SURNOM,
												  ELEVE.NOM    AS NOM1,
												  ELEVE.PRENOM AS PRENOM1,
												  LECON.*
												FROM MONITEUR
												INNER JOIN ELEVE
												ON MONITEUR.PK_MONITEUR = ELEVE.FK_MONITEUR
												INNER JOIN LECON
												ON ELEVE.PK_ELEVE          = LECON.FK_ELEVE
												WHERE MONITEUR.PK_MONITEUR = :PK_MONITEUR');	
				oci_bind_by_name($qry,":PK_MONITEUR",$PK_MONITEUR);
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
		 * @param PK_MONITEUR, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_planing_moniteur_avec_date($PK_MONITEUR, $DEBUT, $FIN) {
			try {

				$qry = oci_parse($this->db, 'SELECT MONITEUR.NOM,
												  MONITEUR.PRENOM,
												  MONITEUR.SURNOM,
												  ELEVE.NOM    AS NOM1,
												  ELEVE.PRENOM AS PRENOM1,
												  LECON.*
												FROM MONITEUR
												INNER JOIN ELEVE
												ON MONITEUR.PK_MONITEUR = ELEVE.FK_MONITEUR
												INNER JOIN LECON
												ON ELEVE.PK_ELEVE          = LECON.FK_ELEVE
												WHERE MONITEUR.PK_MONITEUR = :PK_MONITEUR
												AND LECON.DATE_LECON BETWEEN TO_DATE(\':DEBUT\', \'YYYY-MM-DD HH24:MI:SS\') AND TO_DATE(\':FIN\', \'YYYY-MM-DD HH24:MI:SS\')');	

				oci_bind_by_name($qry,":PK_MONITEUR",$PK_MONITEUR);
				oci_bind_by_name($qry,":DEBUT",$DEBUT);
				oci_bind_by_name($qry,":FIN",$FIN);

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
		 * @param DEBUT, Eleve's id
		 * @param FIN, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_planing_moniteurs_avec_date($DEBUT, $FIN) {
			try {

				$qry = oci_parse($this->db, 'SELECT MONITEUR.NOM,
												  MONITEUR.PRENOM,
												  MONITEUR.SURNOM,
												  ELEVE.NOM    AS NOM1,
												  ELEVE.PRENOM AS PRENOM1,
												  LECON.*
												FROM MONITEUR
												INNER JOIN ELEVE
												ON MONITEUR.PK_MONITEUR = ELEVE.FK_MONITEUR
												INNER JOIN LECON
												ON ELEVE.PK_ELEVE          = LECON.FK_ELEVE
												WHERE LECON.DATE_LECON BETWEEN TO_DATE(\':DEBUT\', \'YYYY-MM-DD HH24:MI:SS\') AND TO_DATE(\':FIN', 'YYYY-MM-DD HH24:MI:SS\')');	
			
				oci_bind_by_name($qry,":DEBUT",$DEBUT);
				oci_bind_by_name($qry,":FIN",$FIN);

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
