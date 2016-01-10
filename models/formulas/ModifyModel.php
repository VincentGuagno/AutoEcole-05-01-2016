<?php

	/*
	 * Model for marque modifications
	 * This class handles the modification of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Fomulas;
	require_once('FomulaModel.php'); 
	
	class ModifyModel extends FomulaModel{

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
		 * @param PRIX_FM, customer's id
		 * @param NB_LECON_PACK, customer's name
		 * @param LIBELLE, customer's name
		 * @param PK_FORMULE, customer's address
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_formules($PRIX_FM, $NB_LECON_PACK, $PK_FORMULE, $LIBELLE) {
			try {
		
				// UPDATE "AUTO"."FORMULES" SET PRIX_FM = '5124', NB_LECON_PACK = '40', LIBELLE = 'big noobie' WHERE ROWID = 'AAAE7mAABAAALDpAAB' AND ORA_ROWSCN = '643871'

				$qry = oci_parse($this->db, ("UPDATE FORMULES SET PRIX_FM = :PRIX_FM, NB_LECON_PACK = NB_LECON_PACK, LIBELLE = ':LIBELLE' WHERE PK_FORMULE =:PK_FORMULE");	
				oci_bind_by_name($qry,":PRIX_FM",$PRIX_FM);
				oci_bind_by_name($qry,":NB_LECON_PACK",$NB_LECON_PACK);
				oci_bind_by_name($qry,":LIBELLE",$LIBELLE);
				oci_bind_by_name($qry,":PK_FORMULE",$LIBELLE);
			
				oci_execute($qry);
				oci_close($this->db);	
				return 0;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}
?>

