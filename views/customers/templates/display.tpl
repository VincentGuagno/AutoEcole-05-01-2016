{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Clients
{% endblock %}
	
{% block header %}
	Clients
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/customers/add">
	<button type="submit" > Ajout d'un client </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/customers/delete/all">
	<button type="submit" > Suppression des clients </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> Numéro de dossier </th>
			<th> Nom </th>
			<th> Prénom </th>
			<th> Code Postal </th>
			<th> Ville </th>
			<th> Téléphone </th>
		</tr>
	{% for customer in customers %}
		<tr>
			<td>{{customer.cust_record_number}}</td>
			<td>{{customer.cust_lastName}}</td>
			<td>{{customer.cust_firstName}}</td>
			<td>{{customer.cust_postal_code}}</td>
			<td>{{customer.cust_city}}</td>
			<td>{{customer.cust_phone_number}}</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/customers/modify/{{customer.cust_id}}">
				<button type="submit" > Modifier </button>
				</form>
			</td>
			<td> 
				<form method="post" ACTION="/Cas-M-Ping/customers/delete/{{customer.cust_id}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}