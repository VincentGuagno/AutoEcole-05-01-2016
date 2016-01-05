{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Saison

{% endblock %}

{% block title %}
Saison
{% endblock %}

{% block content %}

	<form method="post" ACTION="/Cas-M-Ping/seasons/add">
	<button type="submit" > Ajout d'une saison </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/seasons/delete/all">
	<button type="submit" > Suppression des saisons </button>
	</form>	
	<table class="table">
		<tr>
			<th> Identifiant </th>
			<th> Nom de la saison </th>
			<th> Date de début </th>
			<th> Date de fin </th>
			<th> Coefficient </th>
			<th> </th>
			<th> </th>
		</tr>
	{% for season in seasons %}
		<tr>
			<td>{{season.seas_id}}</td>
			<td>{{season.seas_name}}</td>
			<td>{{season.seas_start_date}}</td>
			<td>{{season.seas_end_date}}</td>
			<td>{{season.seas_coeff}}</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/seasons/modify/{{season.seas_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/seasons/delete/{{season.seas_id}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}