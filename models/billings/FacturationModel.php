<?php
	/*
	 * Model for Permis modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Facturation; 
	 
	class FacturationModel {
		


		
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
		 * @param PK_FACTURATION, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_facturation($PK_FACTURATION) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.FACTURATION FROM FACTURATION WHERE FACTURATION.PK_FACTURATION =?');		
				//TODO Debug
				//$qry->bindValue(1, $PK_FACTURATION, \PDO::PARAM_STR);					
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>
