{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un client
{% endblock %}

{% block title %}
Ajout d'un client
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/customers/add/confirm">
		
		<label for="firstName">Prénom : </label>
		<input class="form-control" id="firstName" name="firstName" >
		
		<label for="lastName">Nom : </label>
		<input class="form-control" id="lastName"name="lastName" >
		
		<label for="adress">Adresse : </label>
		<input class="form-control" id="adress"name="adress" >
		
		<label for="zipCode">Code Postal : </label>
		<input class="form-control" id="zipCode"name="zipCode" >
		
		<label for="city">Ville : </label>
		<input class="form-control" id="city"name="city" >
		
		<label for="telephone">Téléphone : </label>
		<input class="form-control" id="telephone"name="telephone" >
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}