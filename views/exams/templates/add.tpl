{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un examen
{% endblock %}

{% block title %}
Ajout d'un examen
{% endblock %}

{% block content %}
	
	</br>
	<form method="post" ACTION="/AutoEcole-05-01-2016/exams/add/confirm">
	
		<label for="DATE_DE_PASSAGE">Date de passage : </label>
		<input class="form-control" id="DATE_DE_PASSAGE"name="DATE_DE_PASSAGE" >
		</br>

		<label for="NOM">Nom : </label>
		<input class="form-control" id="NOM"name="NOM" >
		</br>

		<strong>Permis :</strong>
		<select id="FK_PERMIS" name="FK_PERMIS">
		{% for license in licenses %}
		<option value="{{license.PK_PERMIS}}">{{license.NOM}}</option>
		{% endfor %}
		</select>
		</br></br>
		<strong>Eleve :</strong>
		<select id="FK_ELEVE" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select>
		</br></br>
		
		<button type="submit" class="btn btn-default">Ajouter le nouvel examen</button>
	</form>
{% endblock %}