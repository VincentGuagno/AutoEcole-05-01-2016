{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	exams
{% endblock %}
	
{% block header %}
	exams
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/instructors/add">
	<button type="submit" > Ajout d'un client </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/instructors/delete/all">
	<button type="submit" > Suppression des Moniteurs </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> Numéro de dossier </th>
			<th> Nom </th>
			<th> Prénom </th>
			<th> ADRESSE </th>
			<th> NUM_TEL </th>
			<th> SURNOM </th>
			<th> DATE_EMBAUCHE </th>
		</tr>
	{% for instructor in instructors %}
		<tr>
			<td>{{instructor.PK_EXAMEN}}</td>
			<td>{{instructor.NOM}}</td>
			<td>{{instructor.DATE_PASSAGE}}</td>
			<td>{{instructor.ADRESSE}}</td>
			<td>{{instructor.NUM_TEL}}</td>
			<td>{{instructor.SURNOM}}</td>
			<td>{{instructor.DATE_EMBAUCHE}}</td>
			
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/instructors/modify/{{instructor.cust_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/instructors/delete/{{instructor.cust_id}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}