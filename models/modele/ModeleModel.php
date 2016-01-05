<?php
	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Modele; 
	 
	class ModeleModel {
		


		
		/**
		 * Database object
		 */
		public $db = null;
		
		/**
		 * Initialize the FactureModel class
		 */
		public function init() {}
		
		/**
		 * Modify permis's informations
		 *
		 * @param PK_MODELE, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_marque($PK_MODELE) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.MODELE FROM MODELE WHERE MODELE.PK_MODELE =?');		
				$qry->bindValue(1, $PK_MODELE, \PDO::PARAM_STR);			
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>
