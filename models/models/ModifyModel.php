<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Models;
	require_once('ModelModel.php'); 
	
	class ModifyModel extends ModelModel{

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
		 * @param TYPE_MOTEUR, customer's id
		 * @param PUISSANCE, customer's name
		 * @param NOM_MODELE, customer's name
		 * @param PK_MODELE, customer's address
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_modele($TYPE_MOTEUR, $PUISSANCE, $NOM_MODELE, $PK_MODELE) {
			try {

				// UPDATE "AUTO"."MODELE" SET TYPE_MOTEUR = '2.54', PUISSANCE = '450cv4', NOM_MODELE = 'porche4' WHERE ROWID = 'AAAE7SAABAAAK/pAAB' AND ORA_ROWSCN = '667602'
				$qry = oci_parse($this->db, ("UPDATE MODELE SET TYPE_MOTEUR = ':TYPE_MOTEUR', PUISSANCE = ':PUISSANCE', NOM_MODELE = ':NOM_MODELE' WHERE PK_MODELE = :PK_MODELE");
				
				$qry->bindValue(1, $TYPE_MOTEUR, \PDO::PARAM_STR);
				$qry->bindValue(2, $PUISSANCE, \PDO::PARAM_STR);
				$qry->bindValue(3, $NOM_MODELE, \PDO::PARAM_STR);
				$qry->bindValue(4, $PK_MODELE, \PDO::PARAM_INT);
				oci_bind_by_name($qry,":TYPE_MOTEUR",$TYPE_MOTEUR);
				oci_bind_by_name($qry,":PUISSANCE",$PUISSANCE);
				oci_bind_by_name($qry,":NOM_MODELE",$NOM_MODELE);
				oci_bind_by_name($qry,":PK_MODELE",$PK_MODELE);
			
				oci_execute($qry);
				oci_close($this->db);	
				return 0;				
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>

