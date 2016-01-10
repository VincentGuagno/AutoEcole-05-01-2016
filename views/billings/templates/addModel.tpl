{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Ajouter un élève
{% endblock %}
	
{% block header %}
	
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/caravans/renting/confirm">
		
		<label for="nom">Nom de l'élève : </label>
		<input class="form-control" id="nom" name="name" >
		
		<label for="price">Prix : </label>
		<input class="form-control" id="price" name="price" >
		
		<label for="size">Nombre d'heure : </label>
		<input class="form-control" id="size" name="person" >
		
		<label for="location">Emplacement : </label>
		<input class="form-control" id="location" name="location" >
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}