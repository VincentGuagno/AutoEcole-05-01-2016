{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Caravanes
{% endblock %}
	
{% block header %}
	Caravanes
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/caravans/renting">
	<button type="submit" > Location d'une caravanes </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/caravans/return/all">
	<button type="submit" > Retours des caravanes </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> Identifiant </th>
			<th> Société </th>
			<th> Prix </th>
			<th> Nombre de personnes </th>
			<th> Emplacement </th>
			<th></th>
		</tr>
	{% for caravan in caravans %}
		<tr>
			<td>{{caravan.IDACHAT}}</td>
			<td>{{caravan.DATEACHAT}}</td>
			<td>{{caravan.car_price}}</td>
			<td>{{caravan.car_nb_person}}</td>
			<td>{{caravan.car_id_location}}</td>
			<td>
				<form method="post" ACTION="/Cas-M-Ping/caravans/return/{{caravan.car_id}}">
				<button type="submit" > Retour </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}