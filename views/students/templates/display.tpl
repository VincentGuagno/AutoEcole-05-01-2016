{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Elève
{% endblock %}
	
{% block header %}
	Elève
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/students/add">
	<button type="submit" > Ajout d'un élève </button>
	</form>
	
	<table class="table">
		<tr>
			<th> Numéro </th>
			<th> Nom </th>
			<th> Prénom </th>
			<th> Adresse </th>
			<th> Numéro de téléphone </th>
			<th> Date de naissance </th>
			<th> Lieu d'étude </th>
			<th> Libellée </th>
			
		</tr>
	{% for student in students %}
		<tr>
			<td>{{student.PK_ELEVE}}</td>
			<td>{{student.NOM}}</td>
			<td>{{student.PRENOM}}</td>
			<td>{{student.ADRESSE}}</td>
			<td>{{student.NUM_TEL}}</td>
			<td>{{student.DATE_NAISSANCE}}</td>
			<td>{{student.LIEU_ETUDE}}</td>
			<td>{{student.LIBELLE}}</td>

				<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/students/planning/{{student.PK_ELEVE}}">
				<button type="submit" > Planning </button>
				</form>
			</td>
			
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/students/modify/{{student.PK_ELEVE}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/students/delete/{{student.PK_ELEVE}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}
