<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Lecon;
	require_once('LeconModel.php'); 
	
	class ModifyModel extends LeconModel{

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
		 * @param DATE_LECON, customer's id
		 * @param ETAT_LECON, customer's name
		 * @param PK_LECON, customer's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_lecon($DATE_LECON, $ETAT_LECON, $PK_LECON) {
			try {

				// UPDATE LECON SET DATE_LECON = TO_DATE('2011-01-22', 'YYYY-MM-DD HH24:MI:SS'), ETAT_LECON = '0' WHERE PK_LECON = 4
				$qry = oci_parse($this->db, ("UPDATE LECON SET DATE_LECON = TO_DATE('?', 'YYYY-MM-DD HH24:MI:SS'), ETAT_LECON = ? WHERE PK_LECON = ?");
				
				$qry->bindValue(1, $DATE_LECON, \PDO::PARAM_STR);
				$qry->bindValue(2, $ETAT_LECON, \PDO::PARAM_INT);
				$qry->bindValue(3, $PK_LECON, \PDO::PARAM_INT);
			
				oci_execute($qry);

				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>