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
		
		<label for="firstName">Prénom : </label>
		<input class="form-control" id="firstName" name="firstName" value="{{instructor.PRENOM}}" placeholder="{{instructor.PRENOM}}">
		
		<label for="lastName">Nom : </label>
		<input class="form-control" id="lastName" name="lastName" value="{{instructor.NOM}}" placeholder="{{instructor.NOM}}">
		
		<label for="adress">Adresse : </label>
		<input class="form-control" id="adress" name="adress" value="{{instructor.ADRESSE}}" placeholder="{{instructor.ADRESSE}}">
				
		<label for="telephone">Téléphone : </label>
		<input class="form-control" id="telephone" name="telephone" value="{{instructor.NUM_TEL}}" placeholder="{{instructor.NUM_TEL}}">
		
		<label for="nenrg">Surnom : </label>
		<input class="form-control" id="nenrg" name="nenrg" value="{{instructor.SURNOM}}" placeholder="{{instructor.SURNOM}}">

		<label for="nenrg">Date d'embauche </label>
		<input class="form-control" id="nenrg" name="nenrg" value="{{instructor.DATE_EMBAUCHE}}" placeholder="{{instructor.DATE_EMBAUCHE}}">
		
		<button type="submit" class="btn btn-default">Modifier</button>
	</form>
{% endblock %}
