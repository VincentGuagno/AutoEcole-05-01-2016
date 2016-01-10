<?php
	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Lecon; 
	 
	class LeconModel {
		


		
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
		 * @param PK_LECON, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_lecon($PK_LECON) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.LECON FROM LECON WHERE LECON.PK_LECON =:PK_LECON');		
				oci_bind_by_name($qry,":PK_LECON",$PK_LECON);		
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}		
	}
?>

