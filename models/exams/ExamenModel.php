<?php
	/*
	 * Model for marque modifications
	 * This class handles the add  of a marque
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2016 3iL
	 */
	 
	namespace Examen; 
	 
	class ExamenModel {
		


		
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
		public function has_exmen($PK_EXAMEN) {
			try {

				$qry = oci_parse($this->db, 'SELECT AUTO.EXAMEN FROM EXAMEN WHERE EXAMEN.PK_EXAMEN =:PK_EXAMEN');		
				oci_bind_by_name($qry,":PK_EXAMEN",$PK_EXAMEN);
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);				
				oci_close($this->db);
				return $res;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}		
	}
?>



	$qry = oci_parse($this->db, 'INSERT INTO AUTO.FACTURATION (DATE_FACTURE, PRIX, ETAT_FACTURE) VALUES (:DATE_FACTURE,:PRIX,:ETAT_FACTURE)');
				oci_bind_by_name($qry,":DATE_FACTURE",$DATE_FACTURE);
				oci_bind_by_name($qry,":PRIX",$PRIX);
				oci_bind_by_name($qry,":ETAT_FACTURE",$ETAT_FACTURE);
				
				oci_execute($qry);
				oci_close($this->db);