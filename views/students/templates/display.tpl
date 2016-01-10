{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Clients
{% endblock %}
	
{% block header %}
	Clients
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/students/add">
	<button type="submit" > Ajout d'un client </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/students/delete/all">
	<button type="submit" > Suppression des clients </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> ELEVE.PK_ELEVE </th>
			<th> ELEVE.NOM </th>
			<th> ELEVE.PRENOM </th>
			<th> ELEVE.ADRESSE </th>
			<th> ELEVE.NUM_TEL </th>
			<th> ELEVE.DATE_NAISSANCE </th>
			<th> ELEVE.LIEU_ETUDE </th>
			<th> FORMULES.LIBELLE </th>
			
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
				<form method="post" ACTION="/Cas-M-Ping/students/modify/{{student.cust_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/students/delete/{{student.cust_id}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}