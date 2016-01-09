<?php
	/*
	 * Model for Permis modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Facture; 
	 
	class FactureModel {
		


		
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
		 * @param PK_TYPE_FACTURE, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_Type_Facture($PK_TYPE_FACTURE) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.TYPE_FACTURE FROM TYPE_FACTURE WHERE TYPE_FACTURE.PK_TYPE_FACTURE =:PK_TYPE_FACTURE');		
				oci_bind_by_name($qry,":PK_TYPE_FACTURE",$PK_TYPE_FACTURE);	

				oci_execute($qry);		
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}		
	}
?>

	