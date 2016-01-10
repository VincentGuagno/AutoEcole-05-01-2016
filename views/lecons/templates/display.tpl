{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Leçon
{% endblock %}
	
{% block header %}
	Leçon
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/lecons/add">
	<button type="submit" > Ajout d'une leçon </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/lecons/delete/all">
	<button type="submit" > Suppression d'une leçon </button>
	</form>	
	
	<table class="table">
		<tr>
			<th>PK_LECON </th>
			<th>DATE_LECON </th>
			<th>ETAT_LECON </th>
			<th>ELEVE.NOM</th>
			<th>ELEVE.PRENOM</th>
			<th>MONITEUR.SURNOM</th>
		</tr>
	{% for lecon in lecons %}
		<tr>
			<td>{{lecon.PK_LECON}}</td>
			<td>{{lecon.DATE_LECON}}</td>
			<td>{{lecon.ETAT_LECON}}</td>
			<td>{{lecon.ELEVE.NOM}}</td>
			<td>{{lecon.ELEVE.PRENOM}}</td>
			<td>{{lecon.MONITEUR.SURNOM}}</td>
			<td>
			<form method="post" ACTION="/Cas-M-Ping/lecons/delete/{{lecon.loc_id}}">
			<button type="submit" > Supprimer </button>
			</form>	
			</td>
			<td>
			<form method="post" ACTION="/Cas-M-Ping/lecons/modify/{{lecon.loc_id}}">
			<button type="submit" > Modifier </button>
			</form>	
			</td>
		</tr>
	{% endfor %}
	
{% endblock %}