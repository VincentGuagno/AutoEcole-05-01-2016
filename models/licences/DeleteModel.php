<?php

	/*
	 * Model for customer modifications
	 * This class handles the delete of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Licence; 
	require_once('LicencesModel.php'); 
	
	class DeleteModel extends LicencesModel{

		/**
		 * DeleteModel instance
		 */
		public static $instance = null;
		
		/**
		 * The constructor of DeleteModel
		 */
		public function __construct() {
			try {
				DeleteModel::init();
			} catch(Exception $e) {
				echo $e->getMessage();
			}
		}
		
		/**
		 * Get current instance of DeleteModel (singleton)
		 *
		 * @return DeleteModel
		 */
		public static function getInstance() {
			if (!self::$instance) {
				self::$instance = new DeleteModel();
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
		 * Delete a specified Eleve
		 *
		 * @param PK_ELEVE, Eleve's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_permis($PK_PERMIS) {
			try {
				
				$qry = oci_parse($this->db, 'DELETE AUTO.PERMIS FROM PERMIS WHERE PERMIS.PK_PERMIS =:PK_PERMIS');	
				oci_bind_by_name($qry,":PK_PERMIS",$PK_PERMIS);
				oci_execute($qry);
				oci_close($this->db);	
				return 0;	
			
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * Delete all Eleve
		 *	
		 * @return 0 without errors, exception message any others cases
		 */
		public function delete_Eleves() {
			try {								

				$qry = oci_parse($this->db, 'DELETE AUTO.* FROM PERMIS');	
				oci_bind_by_name($qry,":PK_PERMIS",$PK_PERMIS);
				oci_execute($qry);
				oci_close($this->db);	
				return 0;	
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>



