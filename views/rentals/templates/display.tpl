{# views/rentals/templates/display.tpl #}
	{%extends "layout.tpl" %}
	
{% block title %}
	Locations
{% endblock %}

 {% block header %}
	Locations
{% endblock %}

{% block content %}

	<form method="post" ACTION="/Cas-M-Ping/rentals/add">
	<button type="submit" > Ajout d'une location </button>
	</form>
	
	<form method="post" ACTION="/Cas-M-Ping/rentals/delete/all">
	<button type="submit" > Suppression des locations </button>
	</form>
	
	<table class="table">
		<tr>
			<th> Nom </th>
			<th> Client </th>
			<th> Nombre de jours </th>
			<th> Nombre de personnes </th>
			<th> Réservation active </th>
			<th> </th>
			<!--<th> </th> -->
			<th> </th>
			<th> </th> 
		</tr>
	{% for rental in rentals %}
		<tr>
			<td>{{rental.rent_name}}</td>
			<td>{{rental.cust_name}}</td>
			<td>{{rental.rent_days_number}}</td>
			<td>{{rental.rent_nb_person}}</td>
			<td>{{rental.rent_validity}}</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/rentals/modify/{{rental.rent_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<!--<td> 
				<form method="post" ACTION="/Cas-M-Ping/rentals/cancel/{{rental.rent_id}}">
				<button type="submit" > Annuler </button>
				</form>
			</td>-->
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/rentals/delete/{{rental.rent_id}}">
				<button type="submit" > Supprimer </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="{{rental.rent_id}}">
				<button type="submit" > Plus </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}