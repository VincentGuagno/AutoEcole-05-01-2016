{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Locations {{rental.rent_name}}
{% endblock %}

{% block header %}
	Locations {{rental.rent_name}}
{% endblock %}

{% block content %}
	{%set rental = rental[0]%}
	Locataire : {{rental.cust_name}} </br>
	Nombre de personnes : {{rental.rent_nb_person}}</br>
	Nombre de jours : {{rental.rent_days_number}}<br>
	Caution: {{rental.rent_caution_state}}E<br>
	Prix total (hors caution): {{rental.rent_price - rental.rent_caution_state}}E<br>
	Prix total: {{rental.rent_price}}E<br><br /><br />
	<h2> Emplacement :</h2>
	<table class="table">
		<tr>
			<th> Emplacement </th>
			<th> Type d'emplacement </th>
			<th> Prix </th>
		</tr>
	{% for location in locations %}
		<tr>
			<td>{{location.loc_id}}</td>
			<td>{{location.type_location_name}}</td>
			<td>{{location.type_location_price}}E / jours</td>
		</tr>
	{% endfor %}
	</table>
	
	<!--<h2> Location de caravanes :</h2>
	<table class="table">
		<tr>
			<th> Nombre de personnes </th>
			<th> Emplacement </th>
			<th> Prix </th>
		</tr>
	{% for caravan in caravans %}
		<tr>
			<td>{{caravan.car_nb_person}}</td>
			<td>{{caravan.car_id_location}}</td>
			<td>{{caravan.car_price}} €</td>
		</tr>
	{% endfor %}
	</table>-->
	
	<!--<h2> Saison : </h2>
	<table class="table">
		<tr>
			<th> Nom de la saison </th>
			<th> Nombre de jours </th>
			<th> Coefficient </th>
		</tr>
	{% for season in seasons%}
		<tr>
			<td>{{season.seas_name}}</td>
			<td>{{season.seas_end_date - season.seas_start_date}}</td>
			<td>{{season.seas_coeff}}</td>
		</tr>
	{% endfor %}
	</table>-->
	<div>
		<form method="post" ACTION="/Cas-M-Ping/rentals/modify/{{rental.rent_id}}">
			<button type="submit" > Modifier </button>
		</form>
		<form method="post" ACTION="/Cas-M-Ping/rentals/cancel/{{rental.rent_id}}">
			<button type="submit" > Annuler </button>
		</form>
		<form method="post" ACTION="/Cas-M-Ping/rentals/delete/{{rental.rent_id}}">
			<button type="submit" > Supprimer </button>
		</form>
	</div>
{% endblock %}