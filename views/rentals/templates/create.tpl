{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Création d'une location
{% endblock %}

{% block title %}
Création d'une location
{% endblock %}

{% block content %}
	
	<form method="post" action="/Cas-M-Ping/rentals/add/confirm">
	
		<label for="rent_cust_id">Client : </label>
		<select name="rent_cust_id">
		{% for customer in customers %}
		<option value="{{customer.cust_id}}">{{customer.cust_lastName}} {{customer.cust_firstName}}</option>
		{% endfor %}
		</select> 
		</br></br>
		<label for="location">Emplacement : </label>
		<select name="location">
		{% for location in locations %}
		<option value="{{location.loc_id}}">{{location.loc_id}}</option>
		{% endfor %}
		</select> 
		</br></br>
		
		<label for="rent_name">Nom de la location : </label>
		<input class="form-control" id="rent_name" name="rent_name">
		
		<strong>Date de début:</strong></br>     
		<input class="form-control" type="date" id="beginDate" name="beginDate" value=""/></br>
		<div class = "form-group">
		
		<strong>Date de fin:</strong></br>     
		<input class="form-control" type="date" id="endDate" name="endDate"  value=""/></br>
		</div>
		
		<label for="rent_nb_person">Nombre de personnes : </label>
		<input class="form-control" id="rent_nb_person" name="person">
		
		<label for="rent_caution_state">Prix Caution : </label>
		<input class="form-control" id="rent_caution_state" name="price_c">
		
		<label for="rent_validity">Validité : </label>
		<input class="form-control" id="rent_validity" name="val">
		
		<button type="submit" class="btn btn-default"> Créer la location</button>
	</form>
{% endblock %}