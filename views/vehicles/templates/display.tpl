{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Vehicule
{% endblock %}
	
{% block header %}
	Vehicule
{% endblock %}

{% block content %}

	</br>
	<form method="post" ACTION="/AutoEcole-05-01-2016/vehicles/add">
	<button type="submit" > Ajouter un nouveau vehicule </button>
	</form>
	</br>
	
	<table class="table">
		<tr>
			<th> Numéro du véhicule </th>
			<th> Immatriculation du véhicule </th>
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
				<form method="post" ACTION="/AutoEcole-05-01-2016/vehicles/delete/{{vehicle.PK_VEHICULE}}">
				<button type="submit" > Supprimer </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}