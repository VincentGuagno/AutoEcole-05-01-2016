<?php

	/*
	 * Model for eleve modifications
	 * This class handles the display of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Eleve;	
	require_once('EleveModel.php'); 
	
	class DisplayModel extends EleveModel {

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
		public function display_eleves() {
			try {								
				$qry = oci_parse($this->db, 'SELECT ELEVE.* FROM ELEVE');
				oci_execute($qry);
				
				//$qry = $this->db->prepare('SELECT * FROM caravan ORDER BY caravan.car_id');	
				//
				//$qry->execute();

				//get customer's ID      put  the result into an object
				
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				//var_dump($res);
				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * All Eleve's informations from one Eleve 
		 *
		 * @param PK_ELEVE, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_eleve($PK_ELEVE) {
			try {

				$qry = oci_parse($this->db, 'SELECT ELEVE.NOM,
													  ELEVE.PRENOM,
													  FORMULES.LIBELLE
													FROM ELEVE
													INNER JOIN FORMULES
													ON FORMULES.PK_FORMULE = ELEVE.FK_FORMULES
													WHERE ELEVE.PK_ELEVE   = ?');	
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);

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
		 * @param PK_ELEVE, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_planning_eleve($PK_ELEVE) {
			try {

				$qry = oci_parse($this->db, 'SELECT ELEVE.NOM,
												  ELEVE.PRENOM,
												  MONITEUR.SURNOM,
												  EXAMEN.NOM AS NOM1,
												  EXAMEN.DATE_PASSAGE,
												  LECON.ETAT_LECON,
												  LECON.DATE_LECON,
												  LECON.PK_LECON,
												  EXAMEN.PK_EXAMEN,
												  ELEVE.PK_ELEVE
												FROM ELEVE
												INNER JOIN MONITEUR
												ON MONITEUR.PK_MONITEUR = ELEVE.FK_MONITEUR
												INNER JOIN LECON
												ON ELEVE.PK_ELEVE = LECON.FK_ELEVE
												INNER JOIN EXAMEN
												ON ELEVE.PK_ELEVE    = EXAMEN.FK_ELEVE
												WHERE ELEVE.PK_ELEVE = ?');	
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);

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
		 * @param PK_ELEVE, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_eleve_examen($PK_ELEVE) {
			try {

				$qry = oci_parse($this->db, 'SELECT EXAMEN.*,
													  PERMIS.*,
													  ELEVE.NOM AS NOM1,
													  ELEVE.PRENOM
													FROM ELEVE
													INNER JOIN EXAMEN
													ON ELEVE.PK_ELEVE = EXAMEN.FK_ELEVE
													INNER JOIN PERMIS
													ON PERMIS.PK_PERMIS  = EXAMEN.PK_EXAMEN
													WHERE ELEVE.PK_ELEVE = ?');	
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);

				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);

				oci_close($this->db);
				return $res;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
	?>