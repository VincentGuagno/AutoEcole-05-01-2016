<?php
	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Exam; 
	 
	class ExamsModel {
		


		
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
		 * @param PK_EXAMEN, permis's id
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_exam($PK_EXAMEN) {
			try {

				$qry = oci_parse($this->db, 'SELECT * FROM EXAMEN WHERE EXAMEN.PK_EXAMEN =:PK_EXAMEN');		
				oci_bind_by_name($qry,":PK_EXAMEN",$PK_EXAMEN);
				
				oci_execute($qry);
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $nrows;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}		
	}
?>


