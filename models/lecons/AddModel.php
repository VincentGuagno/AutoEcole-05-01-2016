<?php

	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Lecon; 
	require_once('LeconModel.php'); 
	
	class AddModel extends LeconModel{

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
		 * @param TYPE_MOTEUR ,  customer's lasttName
		 * @param PUISSANCE ,  customer's lasttName
		 * @param NOM_MODELE ,  customer's lasttName
		 */
		public function add_modele($TYPE_MOTEUR,$PUISSANCE, $NOM_MODELE) {
			try {		
				//INSERT INTO "AUTO"."MODELE" (TYPE_MOTEUR, PUISSANCE, NOM_MODELE) VALUES ('156', '8456', 'plll')

				$qry = oci_parse($this->db, 'INSERT INTO AUTO.MODELE (TYPE_MOTEUR, PUISSANCE, NOM_MODELE) VALUES (?,?,?)');
				$qry->bindValue(1, $TYPE_MOTEUR, \PDO::PARAM_STR);
				$qry->bindValue(2, $PUISSANCE, \PDO::PARAM_STR);
				$qry->bindValue(3, $NOM_MODELE, \PDO::PARAM_STR);

				oci_execute($qry);
				oci_close($this->db);								
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}	
	}
	
?>