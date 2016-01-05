{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification d'une location
{% endblock %}

{% block title %}
Modification d'une location
{% endblock %}

{% block content %}
	
	
	<form method="post" ACTION="/Cas-M-Ping/rentals/modify/confirm/{{rental.rent_id}}"/>
		
		<label for="name">Nom de la location : </label>
		<input class="form-control" id="name" name="name" value="{{rental.rent_name}}" placeholder="{{rental.rent_name}}"><br /><br />
		
		<strong>Date de début:</strong></br>     
		<input class="form-control" type="date" id="beginDate" name="beginDate" placeholder="{{rental.rent_begin}}" value=""/></br>
		<div class = "form-group">
		
		<strong>Date de fin:</strong></br>     
		<input class="form-control" type="date" id="endDate" name="endDate" placeholder="{{rental.rent_end}}" value=""/></br>
		</div>
		
		<label for="peopleNumber">Nombre de personnes : </label>
		<input class="form-control" id="peopleNumber" name="peopleNumber" value="{{rental.rent_nb_person}}" placeholder="{{rental.rent_nb_person}}"><br /><br />
		
		<label for="paymentState">Etat du paiement : </label>
		<input class="form-control" id="paymentState" name="paymentState" value="{{rental.rent_caution_state}}" placeholder="{{rental.rent_caution_state}}"><br /><br />
		
		<label for="deposit">Tarif : </label>
		<input class="form-control" id="deposit" name="deposit" value="{{rental.rent_price}}" placeholder="{{rental.rent_price}}"><br /><br />
		
		<button type="submit" name="confirmModifyRental" class="btn btn-default">Valider</button>
		
{% endblock %}
