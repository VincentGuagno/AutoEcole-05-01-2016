{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
 Modification d'un moniteur
{% endblock %}

{% block title %}
 Modification d'un moniteur
{% endblock %}

{% block content %}
	
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
		
		<button type="submit" class="btn btn-default">Modifier</button>
	</form>
{% endblock %}
