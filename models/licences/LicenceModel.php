<?php
	/*
	 * Model for Permis modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Licence; 
	 
	class LicencesModel {
				
		/**
		 * Database object
		 */
		public $db = null;
		
		/**
		 * Initialize the CustomerModel class
		 */
		public function init() {}
		
		/**
		 * Modify permis's informations
		 *
		 * @param PK_PERMIS, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_licence($PK_PERMIS) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.PERMIS FROM PERMIS WHERE PERMIS.PK_PERMIS =:PK_PERMIS');			
				oci_bind_by_name($qry,":PK_PERMIS",$PK_PERMIS);			

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
