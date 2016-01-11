{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Nouvelle leçon
{% endblock %}
	
{% block header %}
	Nouvelle leçon
{% endblock %}

{% block content %}

	<form method="post" ACTION="/AutoEcole-05-01-2016/lecons/add/confirm">
	
		<label for="DATE_LECON">Date de la leçon : </label>
		<input class="form-control" id="DATE_LECON"name="DATE_LECON" >
				
		<label for="NOM">Nom de l'élève : </label>
		<input class="form-control" id="NOM"name="NOM" >
		
		<label for="PRENOM">Prénom de l'élève: </label>
		<input class="form-control" id="PRENOM"name="PRENOM" >
		
		<label for="SURNOM">Surnom du moniteur : </label>
		<input class="form-control" id="SURNOM"name="SURNOM" >

		<label for="ETAT_LECON">Etat de la leçon : </label>
		<input class="form-control" id="ETAT_LECON" name="ETAT_LECON" >
			
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>

{% endblock %}


