{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un instructeur
{% endblock %}

{% block title %}
Ajout d'un instructeur'
{% endblock %}

{% block content %}

<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
   
   <script>
   jQuery(function()
		{
		//formattage de la date dans le format du la bdd       
		jQuery('#DATE_EMBAUCHE').datepicker({ dateFormat: "dd/mm/yy"}).val();   
		}
	); 
  </script>
</head>
	
	</br>

	<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/add/confirm">
	
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM"name="NOM" >
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" >
		
		<label for="ADRESSE">Adresse : </label>
		<input class="form-control" id="ADRESSE"name="ADRESSE" >
		
		<label for="NUM_TEL">Numéro de téléphone : </label>
		<input class="form-control" id="NUM_TEL"name="NUM_TEL" >
		
		<label for="SURNOM">Surnom : </label>
		<input class="form-control" id="SURNOM"name="SURNOM" >
		
		<label for="DATE_EMBAUCHE">Date d'embauche : </label>
		<input class="form-control" id="DATE_EMBAUCHE"name="DATE_EMBAUCHE" >
		
		<button type="submit" class="btn btn-default">Ajouter un instructeur</button>
	</form>
{% endblock %}

