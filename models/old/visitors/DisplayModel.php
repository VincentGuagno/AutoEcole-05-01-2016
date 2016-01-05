<?php

	/*
	 * Model for sectors modifications
	 * This class handles the display of a sectors
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Visitor; 
	require_once('VisitorModel.php'); 
	
	class DisplayModel extends VisitorModel{


		/**
		 * DisplayModel instance
		 */
		public static $instance = null;
		
		/**
		 * Database object
		 */
		private $db = null;
		
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
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$this->db = new PDO('mysql:host='._HOST_ .';dbname='._DATABASE_, _LOGIN_, _PASSWORD_, $pdo_options);
				$this->db->exec('SET NAMES utf8');
			} catch(Exception $e) {
				throw new Exception('Connexion à la base de données impossible: '.$e->getMessage());
			}
		}


		/**
		 * Display all Visitor's informations
		 *	
		 * @param sec_id, sector's id
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_Visitors() {
			try {
				// Récupèration de tout les secteur avec la liste de leurs emplacement	
				//et récupération de la jointure location et type_location
				$qry = $this->db->prepare('SELECT * FROM visitor ORDER BY visitor.vis_id');
				
				$qry->execute();
				//get customer's ID      put  the result into an object				
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;
			} catch(Exception $e) {
				return $e->getMessage();
			}	
		}
		
		/**
		 * All Visitor's informations from one Visitor 
		 *
		 * @param vis_id, sector's id
		 * @return return_qry : result into an object, exception message any others cases
		 */	
		public function display_Visitor($vis_id) {
			try {
				// select secteur left join emplacement(location) )				
				$qry = $this->db->prepare('SELECT * FROM visitor WHERE visitor.vis_id =?');	
				$qry->bindValue(1, $vis_id, \PDO::PARAM_INT);
				$qry->execute();

				//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

		/**
		 * return sector's id
		 *
		 * @param sec_id, sector's id		
		 * @return return_qry : result into an object, exception message any others cases
		 */
		public function get_sectorId($sec_id) {
			try {
	
				$qry = $this->db->prepare('SELECT * FROM sector WHERE sec_id = ?');	
                        								
				$qry->bindValue(1, $sec_id, \PDO::PARAM_STR);		

				$qry->execute();
				//put  the result into an object
				$return_qry = $qry->fetchAll();
				$qry->closeCursor();
				return $return_qry;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}	

?>