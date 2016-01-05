<?php
	
	if (file_exists('conf_loader.php')) {
		require('conf_loader.php');
		
		try {
			Dispatcher::getInstance()->dispatch($_POST);
		} catch (Exception $e) {
			echo $e->getMessage();
		}
	} else {
		echo 'Le fichier de chargement de configuration "conf_loader" n\'existe pas!';
	}