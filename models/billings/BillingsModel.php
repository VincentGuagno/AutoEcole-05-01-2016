<?php
	/*
	 * Model for Permis modifications
	 * This class handles the add  of a customer
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Billings; 
	 
	class BillingsModel {
		


		
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

				$qry = oci_parse($this->db, 'SELECT AUTO.FACTURATION FROM FACTURATION WHERE FACTURATION.PK_FACTURATION =:PK_FACTURATION');		
				//TODO Debug
				oci_bind_by_name($qry,":PK_FACTURATION",$PK_FACTURATION);			
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_execute($qry);
				oci_close($this->db);		

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>
