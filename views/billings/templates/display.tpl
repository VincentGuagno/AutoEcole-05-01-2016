{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Factures
{% endblock %}
	
{% block header %}
	Factures
{% endblock %}

{% block content %}


	</br>
	<form method="post" ACTION="/AutoEcole-05-01-2016/billings/add">
	<button type="submit" > Ajout d'une facturation </button>
	</form>
	</br>
	<table class="table">
		<tr>
			<th> numero de facture </th>
			<th> nom </th>
			<th> prenom </th>
			<th> Etat de la facture </th>
			<th> prix </th>
			<th> date de facturation </th>
		</tr>
	{% for billing in billings %}
		<tr>
			<td>{{billing.PK_FACTURATION}}</td>
			<td>{{billing.NOM}}</td>
			<td>{{billing.PRENOM}}</td>
			<td>{{billing.ETAT_FACTURE}}</td>
			<td>{{billing.PRIX}}</td>
			<td>{{billing.DATE_FACTURE}}</td>
			
			<td> 
				<form method="post" ACTION="/AutoEcole-05-01-2016/billings/delete/{{billing.PK_FACTURATION}}">
				<button type="submit" > Suppression </button>
				</form>
			</td>
		</tr>
	{% endfor %}
	</table>
{% endblock %}