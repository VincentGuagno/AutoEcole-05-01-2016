<?php
	
	/*
	 * Configuration settings
	 * This file contains all constants settings for application
	 *
	 * @author Jérémie LIECHTI
	 * @version 0.0.1
	 * @copyright 2015 3iL
	 */
	 
	/**
	 * Directories
	 */
	define('_MODELS_DIR_', str_replace('\\', '/', __DIR__) .'/models');
	define('_VIEWS_DIR_', str_replace('\\', '/', __DIR__) .'/views');
	define('_CONTROLLERS_DIR_', str_replace('\\', '/', __DIR__) .'/controllers');
	define('_DEPENDENCIES_DIR_', str_replace('\\', '/', __DIR__) .'/dependencies');
	
	/**
	 * Project's name
	 */
	define('_PROJECT_NAME_', 'AutoEcole-05-01-2016');
	
	/**
	 * Twig settings
	 */
	define('_TWIG_AUTOLOADER_', _DEPENDENCIES_DIR_ .'/twig/lib/Twig/Autoloader.php');
	define('_TWIG_CACHE_', false);
	
	/**
	 * Bootstrap settings
	 */
	define('_BOOTSTRAP_FILE_', '/'._PROJECT_NAME_ .'/dependencies/bootstrap/css/bootstrap.min.css'); 
	
	/**
	 * Twig views's directories
	 */
	define('_BILLINGS_VIEWS_', _VIEWS_DIR_ .'/billings/templates'); 
	define('_STUDENTS_VIEWS_', _VIEWS_DIR_ .'/students/templates'); 
	
	define('_CUSTOMERS_VIEWS_', _VIEWS_DIR_ .'/customers/templates'); 
	define('_ERRORS_VIEWS_', _VIEWS_DIR_ .'/errors'); 
	define('_HOME_VIEWS_', _VIEWS_DIR_ .'/home/templates'); 
	define('_LOCATIONS_VIEWS_', _VIEWS_DIR_ .'/locations/templates'); 
	define('_RENTALS_VIEWS_', _VIEWS_DIR_ .'/rentals/templates'); 
	define('_SECTORS_VIEWS_', _VIEWS_DIR_ .'/sectors/templates'); 
	define('_VISITORS_VIEWS_', _VIEWS_DIR_ .'/visitors/templates'); 
	
	/**
	 * Models's directories
	 */
	define('_BILLINGS_MODELS_', _MODELS_DIR_ .'/billings'); 
	define('_STUDENTS_MODELS_', _MODELS_DIR_ .'/students'); 
	
	define('_CUSTOMERS_MODELS_', _MODELS_DIR_ .'/customers'); 
	define('_ERRORS_MODELS_', _MODELS_DIR_ .'/errors'); 
	define('_HOME_MODELS_', _MODELS_DIR_ .'/home'); 
	define('_LOCATIONS_MODELS_', _MODELS_DIR_ .'/locations'); 
	define('_RENTALS_MODELS_', _MODELS_DIR_ .'/rentals'); 
	define('_SECTORS_MODELS_', _MODELS_DIR_ .'/sectors'); 
	define('_VISITORS_MODELS_', _MODELS_DIR_ .'/visitors'); 
	
	/**
	 * Database settings
	 */
	define('_HOST_', '//localhost/XE'); 
	define('_DATABASE_', ''); 
	define('_LOGIN_', 'auto'); 
	define('_PASSWORD_', 'ecole'); 