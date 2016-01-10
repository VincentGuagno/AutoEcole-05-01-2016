{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Moniteurs
{% endblock %}
	
{% block header %}
	Moniteurs
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/add">

	<button type="submit" > Ajout d'un client </button>
	</form>	
	<table class="table">
		<tr>
			<th> Numéro de dossier </th>
			<th> Nom </th>
			<th> Prénom </th>
			<th> Adresse </th>
			<th> Numéro de téléphone </th>
			<th> Surnom </th>
			<th> Date d'embauche </th>
		</tr>
	{% for instructor in instructors %}
		<tr>
			<td>{{instructor.PK_MONITEUR}}</td>
			<td>{{instructor.NOM}}</td>
			<td>{{instructor.PRENOM}}</td>
			<td>{{instructor.ADRESSE}}</td>
			<td>{{instructor.NUM_TEL}}</td>
			<td>{{instructor.SURNOM}}</td>
			<td>{{instructor.DATE_EMBAUCHE}}</td>
			
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/modify/{{instructor.PK_MONITEUR}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/instructors/delete/{{instructor.PK_MONITEUR}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}