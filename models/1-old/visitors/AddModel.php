<?php

	/*
	 * Model for visitor modifications
	 * This class handles the add  of a sector
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	
	namespace Visitor;
	require_once('VisitorModel.php'); 
	
	class AddModel extends VisitorModel{

		/**
		 * AddModel instance
		 */
		public static $instance = null;
		
		/**
		 * Database object
		 */
		private $db = null;
		
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
		 * Initialize the AddModel class
		 */
		public function init() {
			try {
				parent::init();	
			} catch(Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			try {	
				$pdo_options[PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
				$this->db = new PDO('mysql:host='._HOST_ .';dbname='._DATABASE_, _LOGIN_, _PASSWORD_, $pdo_options);
				$this->db->exec('SET NAMES utf8');
			} catch(Exception $e) {
				throw new Exception('Connexion à la base de données impossible: '.$e->getMessage());
			}
		}

		/**
		 * Add new visitor 
		 *
		 * @param sec_name, Visitor's name
		 * @return 0 without errors, exception message any others cases
		 */
		public function add_Visitor($vis_firstName , $vis_lastName, $vis_personNumber, $vis_date) {
			try {
				$qry = $this->db->prepare('INSERT INTO camping.visitor (vis_id,
																		vis_firstName, 
																		vis_lastName,
																		vis_personNumber,
																		vis_date) 
											VALUES (NULL, ?, ?, ?, ?');

				$qry->bindValue(1, $vis_firstName, \PDO::PARAM_STR);	
				$qry->bindValue(2, $vis_lastName, \PDO::PARAM_STR);	
				$qry->bindValue(3, $vis_personNumber, \PDO::PARAM_INT);
				$qry->bindValue(4, $vis_date, \PDO::PARAM_STR);
					
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
	}

?>