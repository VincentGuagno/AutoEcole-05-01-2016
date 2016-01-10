{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Vehicule
{% endblock %}
	
{% block header %}
	Vehicule
{% endblock %}

{% block content %}

	<form method="post" ACTION="/AutoEcole-05-01-2016/vehicules/add">
	<button type="submit" > Ajout d'un vehicule </button>
	</form>
	
	<table class="table">
		<tr>
			<th> Numéro du véhicule </th>
			<th> Immatricuation du véhicule </th>
			<th> Nom du modèle </th>
			<th> Surnom du moniteur </th>
		</tr>
	{% for vehicle in vehicles %}
		<tr>
			<td>{{vehicle.PK_VEHICULE}}</td>
			<td>{{vehicle.NUMERO}}</td>
			<td>{{vehicle.NOM_MODELE}}</td>
			<td>{{vehicle.SURNOM}}</td>
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/vehicules/modify/{{vehicle.PK_VEHICULE}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/vehicules/delete/{{vehicle.PK_VEHICULE}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}