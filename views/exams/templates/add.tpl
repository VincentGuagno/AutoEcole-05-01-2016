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
	
		<label for="lastName firstName">Nom : </label>
		<input class="form-control" id="Name"name="lastName" >
		<select id="FK_TYPE_FACTURE" name="TypeFacturations">
		{% for student in students %}
		<option value="{{student.PK_TYPE_FACTURATION}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}		
		<input class="form-control" type="text" id="beginDate" name="DATE_FACTURE" value="">
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}