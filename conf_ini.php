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
	define('_BILLINGSTYPE_VIEWS_', _VIEWS_DIR_ .'/billingsType/templates');
	define('_BRANDS_VIEWS_', _VIEWS_DIR_ .'/brands/templates'); 
	define('_EXAMS_VIEWS_', _VIEWS_DIR_ .'/exams/templates'); 
	define('_FORMULAS_VIEWS_', _VIEWS_DIR_ .'/fomulas/templates'); 
	define('_INSTRUCTORS_VIEWS_', _VIEWS_DIR_ .'/instructors/templates'); 
	define('_LECONS_VIEWS_', _VIEWS_DIR_ .'/lecons/templates');
	define('_LICENCES_VIEWS_', _VIEWS_DIR_ .'/licences/templates');
	define('_MODELS_VIEWS_', _VIEWS_DIR_ .'/models/templates');
	define('_VEHICLES_VIEWS_', _VIEWS_DIR_ .'/vehicles/templates');
	define('_ERRORS_VIEWS_', _VIEWS_DIR_ .'/errors'); 
	define('_HOME_VIEWS_', _VIEWS_DIR_ .'/home/templates');
	
	/**
	 * Models's directories
	 */
	define('_BILLINGS_MODELS_', _MODELS_DIR_ .'/billings'); 
	define('_STUDENTS_MODELS_', _MODELS_DIR_ .'/students'); 
	define('_BILLINGSTYPE_MODELS_', _MODELS_DIR_ .'/billingsType');
	define('_BRANDS_MODELS_', _MODELS_DIR_ .'/brands'); 
	define('_EXAMS_MODELS_', _MODELS_DIR_ .'/exams'); 
	define('_FORMULAS_MODELS_', _MODELS_DIR_ .'/fomulas'); 
	define('_INSTRUCTORS_MODELS_', _MODELS_DIR_ .'/instructors');
	define('_LECONS_MODELS_', _MODELS_DIR_ .'/lecons');
	define('_LICENCES_MODELS_', _MODELS_DIR_ .'/licences');
	define('_MODELS_MODELS_', _MODELS_DIR_ .'/models');
	define('_VEHICLES_MODELS_', _MODELS_DIR_ .'/vehicles');
	define('_ERRORS_MODELS_', _MODELS_DIR_ .'/errors');
	define('_HOME_MODELS_', _MODELS_DIR_ .'/home');  
	
	/**
	 * Database settings
	 */
	define('_HOST_', '//localhost/XE'); 
	define('_DATABASE_', ''); 
	define('_LOGIN_', 'auto'); 
	define('_PASSWORD_', 'ecole'); 