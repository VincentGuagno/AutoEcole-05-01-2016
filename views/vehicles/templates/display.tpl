{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Vehicule
{% endblock %}
	
{% block header %}
	Vehicule
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/vehicules/add">
	<button type="submit" > Ajout d'un vehicule </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/vehicules/delete/all">
	<button type="submit" > Suppression des vehicules </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> PK_VEHICULE </th>
			<th> VEHICULE.NUMERO </th>
			<th> MODELE.NOM_MODELE </th>
			<th> MONITEUR.SURNOM </th>
		</tr>
	{% for vehicle in vehicles %}
		<tr>
			<td>{{vehicle.PK_VEHICULE}}</td>
			<td>{{vehicle.NUMERO}}</td>
			<td>{{vehicle.NOM_MODELE}}</td>
			<td>{{vehicle.SURNOM}}</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/vehicules/modify/{{vehicule.cust_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/vehicules/delete/{{vehicule.cust_id}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}