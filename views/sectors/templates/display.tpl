{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Secteurs
{% endblock %}
	
{% block header %}
	Secteurs
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/sectors/add">
	<button type="submit" > Ajouter un secteur</button>
	</form>
	<form method="post" ACTION="/Cas-M-Ping/sectors/delete/all">
	<button type="submit" > Supprimer tous les secteurs </button>
	</form>
	</br>
	{% for sector in sectors %}
		{{sector.sec_name}}
			<form method="post" ACTION="/Cas-M-Ping/sectors/modify/{{sector.sec_id}}" id = "inline-form">
			<button type="submit" id = "inline-form"> Modifier </button>
			</form>
			<form method="post" ACTION="/Cas-M-Ping/sectors/delete/{{sector.sec_id}}" id = "inline-form">
			<button type="submit" id = "inline-form"> Supprimer </button>
			</form>
		<table class="table">
			<tr>
				<th> Numero d'emplacement </th>
				<th> Type d'emplacement </th>
			</tr>
		{% for location in locations if location.loc_sec_id == sector.sec_id%}
			<tr>
				<td>{{location.loc_id}}</td>
				<td>{{location.type_location_name}}</td>
			</tr>
		{% endfor %}
		</table>
	{% endfor %}
{% endblock %}