<?php
	
	/*
	 * Controller for rental controls
	 * This class handles the controls on rentals
	 * The guarantees must be controls by the camping chief
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */

	public class CheckSettingsController extends RentalController {
		
		/**
		 * The constructor of CheckSettingsController
		 */
		public function __construct() {
			
		}
		
		/**
	     * @see RentalController::checkAccess()
	     * @return boolean
	     */
	    public function checkAccess() {
			return true;
	    }

		/**
		 * @see RentalController::viewAccess()
		 * @return boolean
		 */
		public function viewAccess() {
			return true;
		}
		
	}