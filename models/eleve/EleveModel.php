<?php
	/*
	 * Model for eleve modifications
	 * This class handles the add  of a eleve
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	namespace Eleve; 
	 
	class EleveModel {	
		
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
		public function has_customer($PK_ELEVE) {
			try {
				/*
				$qry = $this->db->prepare('SELECT ELEVE.PK_ELEVE FROM ELEVE WHERE ELEVE.PK_ELEVE =?');	
				$qry->bindValue(1, $PK_ELEVE, \PDO::PARAM_STR);
				$qry->execute();
				$return_qry = $qry->fetch(\PDO::FETCH_OBJ);
				$qry->closeCursor();
				return (!empty($return_qry->PK_ELEVE)) ? 1 : 0;
				*/

				$qry = oci_parse($this->db, 'SELECT ELEVE.PK_ELEVE FROM ELEVE WHERE ELEVE.PK_ELEVE =?');	
				$qry->bindValue(1, $PK_ELEVE, \PDO::PARAM_STR);
				oci_execute($qry);
					
				//$return_qry = $qry->fetchAll();
				$nrows = oci_fetch_all($qry, $res,null,null,OCI_FETCHSTATEMENT_BY_ROW);
				//var_dump($res);
				
				oci_close($this->db);
				return $res;

			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}