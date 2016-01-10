<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Exam;
	require_once('ExamsModel.php'); 
	
	class ModifyModel extends ExamsModel{

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
		 * @param NOM, customer's id
		 * @param DATE_PASSAGE, customer's name
		 * @param PK_EXAMEN, customer's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_examen($NOM, $DATE_PASSAGE, $PK_EXAMEN) {
			try {
	
				// UPDATE EXAMEN SET NOM = ' 1111', DATE_PASSAGE = TO_DATE('2016-01-14 09:26:23', 'YYYY-MM-DD HH24:MI:SS') WHERE PK_EXAMEN =1
				$qry = oci_parse($this->db, ("UPDATE EXAMEN SET NOM = ':NOM', DATE_PASSAGE = TO_DATE(':DATE_PASSAGE', 'YYYY-MM-DD HH24:MI:SS') WHERE PK_EXAMEN =:PK_EXAMEN");
				
				oci_bind_by_name($qry,":NOM",$NOM);
				oci_bind_by_name($qry,":DATE_PASSAGE",$DATE_PASSAGE);
				oci_bind_by_name($qry,":PK_EXAMEN",$PK_EXAMEN);
			
				oci_execute($qry);
				oci_close($this->db);

				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>
