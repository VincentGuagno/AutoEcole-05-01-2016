{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification d'un client
{% endblock %}

{% block title %}
Modification d'un client
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/customers/modify/confirm/{{customer.cust_id}}">
		
		<label for="firstName">Prénom : </label>
		<input class="form-control" id="firstName" name="firstName" value="{{customer.cust_firstName}}" placeholder="{{customer.cust_firstName}}">
		
		<label for="lastName">Nom : </label>
		<input class="form-control" id="lastName" name="lastName" value="{{customer.cust_lastName}}" placeholder="{{customer.cust_lastName}}">
		
		<label for="adress">Adresse : </label>
		<input class="form-control" id="adress" name="adress" value="{{customer.cust_address}}" placeholder="{{customer.cust_address}}">
		
		<label for="zipCode">Code Postal : </label>
		<input class="form-control" id="zipCode" name="zipCode" value="{{customer.cust_postal_code}}" placeholder="{{customer.cust_postal_code}}">
		
		<label for="city">Ville : </label>
		<input class="form-control" id="city" name="city" value="{{customer.cust_city}}" placeholder="{{customer.cust_city}}">
		
		<label for="telephone">Téléphone : </label>
		<input class="form-control" id="telephone" name="telephone" value="{{customer.cust_phone_number}}" placeholder="{{customer.cust_phone_number}}">
		
		<label for="nenrg">N°Enregistrement : </label>
		<input class="form-control" id="nenrg" name="nenrg" value="{{customer.cust_record_number}}" placeholder="{{customer.cust_record_number}}">
		
		<button type="submit" class="btn btn-default">Modifier</button>
	</form>
{% endblock %}