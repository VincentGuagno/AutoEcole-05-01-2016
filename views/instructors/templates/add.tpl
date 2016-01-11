{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un instructeur
{% endblock %}

{% block title %}
Ajout d'un instructeur'
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/add/confirm">
	
		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM"name="NOM" >
		
		<label for="PRENOM">Prénom : </label>
		<input class="form-control" id="PRENOM" name="PRENOM" >
		
		<label for="ADRESSE">adresse : </label>
		<input class="form-control" id="ADRESSE"name="ADRESSE" >
		
		<label for="NUM_TEL">numero de telephone : </label>
		<input class="form-control" id="NUM_TEL"name="NUM_TEL" >
		
		<label for="SURNOM">surnom : </label>
		<input class="form-control" id="SURNOM"name="SURNOM" >
		
		<label for="DATE_EMBAUCHE">date embauche : </label>
		<input class="form-control" id="DATE_EMBAUCHE"name="DATE_EMBAUCHE" >
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}

