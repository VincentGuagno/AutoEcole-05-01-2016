{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	billings
{% endblock %}
	
{% block header %}
	billings
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/billings/renting">
	<button type="submit" > Location d'une billinges </button>
	</form>

	<form method="post" ACTION="/Cas-M-Ping/billings/return/all">
	<button type="submit" > Retours des billinges </button>
	</form>	
	
	<table class="table">
		<tr>
			<th> numero de facture </th>
			<th> nom </th>
			<th> prenom </th>
			<th> libelle </th>
			<th> prix </th>
			<th> date de facturation </th>
		</tr>
	{% for billing in billings %}
		<tr>
			<td>{{billing.PK_FACTURATION}}</td>
			<td>{{billing.NOM}}</td>
			<td>{{billing.PRENOM}}</td>
			<td>{{billing.LIBELLE}}</td>
			<td>{{billing.PRIX}}</td>
			<td>{{billing.DATE_FACTURE}}</td>
			<td>
				<form method="post" ACTION="/Cas-M-Ping/billings/return/{{billing.car_id}}">
				<button type="submit" > Retour </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}