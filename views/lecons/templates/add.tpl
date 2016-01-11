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
		
		<label for="eleve_pk_eleve">Elève : </label>
		<select id="FK_STUDENT" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select> 
		</br></br>
		<label for="DATE_LECON">Date : </label>
		<input class="form-control" id="DATE_LECON"name="DATE_LECON" placeholder ="11-01-2016" >
		
		<label for="ETAT_LECON">Etat de la leçon : </label>
		<input class="form-control" id="ETAT_LECON" name="ETAT_LECON" >
		</br>
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>

{% endblock %}


	