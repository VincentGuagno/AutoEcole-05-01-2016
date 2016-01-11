<?php
	/*
	 * Model for eleve modifications
	 * This class handles the add  of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Student; 
	 
	class StudentModel {	
		
		/**
		 * Database object
		 */
		public $db = null;
		
		/**
		 * Initialize the CustomerModel class
		 */
		public function init() {}
		
		/**
		 * Modify eleve's informations
		 *
		 * @param PK_ELEVE, eleve's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_student($PK_ELEVE) {
			try {
				$qry = oci_parse($this->db, 'SELECT ELEVE.PK_ELEVE FROM ELEVE WHERE ELEVE.PK_ELEVE =:PK_ELEVE');	
				oci_bind_by_name($qry,":PK_ELEVE",$PK_ELEVE);
				oci_execute($qry);
					
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				//var_dump($res);
				
				oci_close($this->db);
				return $nrows;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>


