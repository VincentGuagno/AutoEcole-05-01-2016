<?php

	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Formules; 
	require_once('FormulesModel.php'); 
	
	class AddModel extends FormulesModel{

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
		 * @param DATE_PASSAGE ,  customer's lasttName
		 * @param LIBELLE ,  customer's lasttName
		 */
		public function add_formule($NOM,$DATE_PASSAGE) {
			try {		

				//INSERT INTO "AUTO"."EXAMEN" (FK_PERMIS, FK_ELEVE, NOM, DATE_PASSAGE) VALUES ('1', '21', 'ghgh', TO_DATE('2017-01-20 18:44:27', 'YYYY-MM-DD HH24:MI:SS'))

				$qry = oci_parse($this->db, 'INSERT INTO AUTO.FORMULES ( NOM, DATE_PASSAGE) VALUES (?,?)');
				$qry->bindValue(1, $NOM, \PDO::PARAM_STR);
				$qry->bindValue(2, $DATE_PASSAGE, \PDO::PARAM_STR);
		

				oci_execute($qry);
				oci_close($this->db);								
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}
	
?>