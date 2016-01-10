<?php

	/*
	 * Model for marque modifications
	 * This class handles the display of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Exam;	
	require_once('ExamsModel.php'); 
	
	class DisplayModel extends ExamsModel {

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
		public function display_exams() {
			try {								
				$qry = oci_parse($this->db, 'SELECT EXAMEN.PK_EXAMEN,
											  ELEVE.NOM,
											  ELEVE.PRENOM,
											  EXAMEN.NOM AS NOMEXAM,
											  EXAMEN.DATE_PASSAGE,
											  PERMIS.NOM AS NOMPERMIS,
											  MONITEUR.SURNOM 
											FROM EXAMEN
											INNER JOIN ELEVE
											ON ELEVE.PK_ELEVE = EXAMEN.FK_ELEVE
											INNER JOIN PERMIS
											ON PERMIS.PK_PERMIS = EXAMEN.FK_PERMIS
											INNER JOIN MONITEUR
											ON MONITEUR.PK_MONITEUR = ELEVE.FK_MONITEUR');			
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
		 * @param PK_EXAMEN, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_exam($PK_EXAMEN) {
			try {

				$qry = oci_parse($this->db, 'SELECT EXAMEN.DATE_PASSAGE, EXAMEN.NOM, EXAMEN.FK_ELEVE FROM EXAMEN WHERE EXAMEN.PK_EXAMEN =:PK_EXAMEN');	
				oci_bind_by_name($qry,":PK_EXAMEN",$PK_EXAMEN);
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
		 * Display all caravans's informations
		 *		
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_exams_avec_dates($DEBUT, $FIN)  {
			try {								
				$qry = oci_parse($this->db, 'SELECT EXAMEN.*,
													  PERMIS.*
													FROM EXAMEN
													INNER JOIN PERMIS
													ON PERMIS.PK_PERMIS = EXAMEN.PK_EXAMEN 
											WHERE EXAMEN.DATE_PASSAGE BETWEEN TO_DATE(\':DEBUT\', \'YYYY-MM-DD HH24:MI:SS\') AND TO_DATE(\':FIN\', \'YYYY-MM-DD HH24:MI:SS\')');			
				oci_execute($qry);

				oci_bind_by_name($qry,":DEBUT",$DEBUT);
				oci_bind_by_name($qry,":FIN",$FIN);

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


