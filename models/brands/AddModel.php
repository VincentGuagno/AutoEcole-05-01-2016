<?php

	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Marque; 
	require_once('MarqueModel.php'); 
	
	class AddModel extends MarqueModel{

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
		 * @param PK_MARQUE ,  customer's lasttName
		 */
		public function add_marque($PK_MARQUE) {
			try {		

				$qry = oci_parse($this->db, 'INSERT INTO AUTO.MARQUE (NOM) VALUES (:PK_MARQUE)');
				oci_bind_by_name($qry,":PK_MARQUE",$PK_MARQUE);

				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);

				oci_close($this->db);
				return $res;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}	
?>
