<?php
	/*
	 * Model for caravan modifications
	 * This class handles the add  of a caravan
	 *
	 * @author Bastien VAUTIER
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	public class VisitorModel {
	
		/**
		 * Modify visitor's informations
		 *
		 * @param vis_id, visitor's id		
		 * @return 0 without errors, exception message any others cases
		 */
		public function has_Caravan($vis_id) {
			try {
	
				$qry = $this->db->prepare('SELECT visitor.vis_id FROM visitor WHERE visitor.vis_id = ?');	

				$qry->bindValue(1, $vis_id, \PDO::PARAM_STR);				

				$qry->execute();
				$qry->closeCursor();
				return 0;
			} catch(Exception $e) {
				return $e->getMessage();
			}
		}
		
	}
?>