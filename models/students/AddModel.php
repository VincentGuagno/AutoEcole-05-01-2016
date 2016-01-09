<?php

	/*
	 * Model for customer modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Eleve; 
	require_once('EleveModel.php'); 
	
	class AddModel extends EleveModel{

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
		 *
		 * @param cust_id, customer's id
		 * @param cust_firstName, customer's firstName
		 * @param cust_lastName ,  customer's lasttName
		 * @param cust_address, customer's address
		 * @param cust_zipCode, customer's zip code
		 * @param cust_city, customer's city
		 * @param cust_phoneNumber, customer's phone number		
		 * @return 0 without errors, exception message any others cases
		 */
		public function add_customer($cust_lastName,
									 $cust_address,
									 $cust_zipCode, 
									 $cust_city, 
									 $cust_phoneNumber, 									
									 $cust_firstName) {
			try {
				$qry = $this->db->prepare('INSERT INTO camping.customer (cust_lastName,
																		 cust_address, 
																		 cust_postal_code, 
																		 cust_city, 
																		 cust_phone_number, 
																		 cust_record_number, 
																		 cust_firstName) VALUES (?, ?, ?, ?, ?, UUID(), ?)');
				$qry->bindValue(1, $cust_lastName, \PDO::PARAM_STR);
				$qry->bindValue(2, $cust_address, \PDO::PARAM_STR);
				$qry->bindValue(3, $cust_zipCode, \PDO::PARAM_STR);
				$qry->bindValue(4, $cust_city, \PDO::PARAM_STR);
				$qry->bindValue(5, $cust_phoneNumber, \PDO::PARAM_STR);			
				$qry->bindValue(6, $cust_firstName, \PDO::PARAM_STR);
				
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}



	//je cherche si il existe un CLI_ID dans CLIENT ou CLI_NOM = param et CLI_PRENOM = param2. Si il existe je le crée pas et j'utilise cet id pour l'insérer dans LOCATION. Sinon je le crée et je récupère son CLI_ID que je met dans LOCATION.
	
	}
	
?>