<?php

	/*
	 * Model for rental modifications
	 * This class handles the creation of a rental
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Rental; 
	require_once('RentalModel.php'); 
	
	class ModifyModel extends RentalModel{
		
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
		 * Initialize the ModifyModel class
		 */
		public function init() {
			try {
				parent::init();	
			} catch(Exception $e) {
				throw new Exception('Une erreur est survenue durant le chargement du module: '.$e->getMessage());
			}
			try {	
				$pdo_options[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
				$this->db = new \PDO('mysql:host='._HOST_ .';dbname='._DATABASE_, _LOGIN_, _PASSWORD_, $pdo_options);
				$this->db->exec('SET NAMES utf8');
			} catch(Exception $e) {
				throw new Exception('Connexion à la base de données impossible: '.$e->getMessage());
			}
		}

	
		/**
		 * Modify all rental's informations from one rental 
		 *
		 * @param rent_name, rent_name's name
		 * @param rent_begin, rent_begin's date
		 * @param rent_end, rent_end's date
		 * @param rent_nb_person, the rent's number person
		 * @param rent_location_state, rent's location state
		 * @param rent_caution_state, rent's caution_state
		 * @param rent_days_number, rent's days_number
		 * @param rent_price, rent's price
		 * @param rent_cust_id, rent's cust_id 
		 * @return 0 without errors, exception message any others cases
		 */
		public function modify_model($rent_name, $rent_begin, 
										$rent_end, $rent_nbPerson,
									 	$rent_locationState, $rent_cautionState,
									 	$rent_daysNumber,$rent_price , $rent_cust_id) {
			try {
				$qry = $this->db->prepare('UPDATE rental
											SET  rent_name=?,
												 rent_begin=?,
												 rent_end=?,
												 rent_nb_person=?,
												 rent_location_state=?,
												 rent_caution_state=?,
												 rent_days_number=?,
												 rent_price=?												 
												 WHERE rent_id = ?');
				

				$qry->bindValue(1, $rent_name, \PDO::PARAM_STR);
				$qry->bindValue(2, $rent_begin, \PDO::PARAM_STR);
				$qry->bindValue(3, $rent_end, \PDO::PARAM_STR);
				$qry->bindValue(4, $rent_nbPerson, \PDO::PARAM_STR);		
				$qry->bindValue(5, $rent_locationState, \PDO::PARAM_STR);
				$qry->bindValue(6, $rent_cautionState, \PDO::PARAM_STR);
				$qry->bindValue(7, $rent_daysNumber, \PDO::PARAM_STR);
				$qry->bindValue(8, $rent_price, \PDO::PARAM_STR);
				$qry->bindValue(9, $rent_cust_id, \PDO::PARAM_STR);
				
				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}

	}

?>