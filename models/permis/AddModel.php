<?php

	/*
	 * Model for permis modifications
	 * This class handles the add  of a permis
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Permis; 
	require_once('PermisModel.php'); 
	
	class AddModel extends PermisModel{

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
		 * @param PERMIS ,  customer's lasttName
		 */
		public function add_Permis($PERMIS) {
			try {				
				$qry = oci_parse($this->db, 'INSERT INTO AUTO.PERMIS (NOM) VALUES (?)');
				$qry->bindValue(1, $car_id, \PDO::PARAM_INT);

				oci_execute($qry);

				oci_close($this->db);			
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}



	//je cherche si il existe un CLI_ID dans CLIENT ou CLI_NOM = param et CLI_PRENOM = param2. Si il existe je le crée pas et j'utilise cet id pour l'insérer dans LOCATION. Sinon je le crée et je récupère son CLI_ID que je met dans LOCATION.
	
	}
	
?>