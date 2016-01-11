{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
 Modification d'un moniteur
{% endblock %}

{% block title %}
 Modification d'un moniteur
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
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/modify/confirm/{{instructor.PK_MONITEUR}}">
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" value="{{instructor.PRENOM}}" placeholder="{{instructor.PRENOM}}">
		
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM" name="NOM" value="{{instructor.NOM}}" placeholder="{{instructor.NOM}}">
		
		<label for="ADRESSE">Adresse : </label>
		<input class="form-control" id="ADRESSE" name="ADRESSE" value="{{instructor.ADRESSE}}" placeholder="{{instructor.ADRESSE}}">
				
		<label for="NUM_TEL">Téléphone : </label>
		<input class="form-control" id="NUM_TEL" name="NUM_TEL" value="{{instructor.NUM_TEL}}" placeholder="{{instructor.NUM_TEL}}">
		
		<label for="SURNOM">Surnom : </label>
		<input class="form-control" id="SURNOM" name="SURNOM" value="{{instructor.SURNOM}}" placeholder="{{instructor.SURNOM}}">

		<label for="DATE_EMBAUCHE">Date d'embauche </label>
		<input class="form-control" id="DATE_EMBAUCHE" name="DATE_EMBAUCHE" value="{{instructor.DATE_EMBAUCHE}}" placeholder="{{instructor.DATE_EMBAUCHE}}">
		
		<button type="submit" class="btn btn-default">Modifier le moniteur</button>
	</form>
{% endblock %}
