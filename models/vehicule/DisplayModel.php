<?php

	/*
	 * Model for marque modifications
	 * This class handles the display of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	
	namespace Vehicule;	
	require_once('VehiculeModel.php'); 
	
	class DisplayModel extends VehiculeModel {

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
		public function display_vehicules() {
			try {								
				$qry = oci_parse($this->db, 'SELECT * FROM AUTO.VEHICULE');			
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
		 * @param PK_VEHICULE, Eleve's id
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function display_vehicule($PK_VEHICULE) {
			try {

				$qry = oci_parse($this->db, 'SELECT * FROM AUTO.VEHICULE WHERE VEHICULE.PK_VEHICULE =?');	
				$qry->bindValue(1, $PK_VEHICULE, \PDO::PARAM_INT);
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