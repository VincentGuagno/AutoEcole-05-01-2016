{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Facturation
{% endblock %}
	
{% block header %}
	
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/billings/add/confirm">
		
		<strong>Date de facturation </strong></br>
		<input class="form-control" type="text" id="beginDate" name="DATE_FACTURE" value=""></br>
		
		<select id="FK_TYPE_FACTURE" name="TypeFacturations">
		{% for billingType in bllingTypes %}
		<option value="{{billingType.PK_TYPE_FACTURATION}}">{{billingType.LIBELLE}}</option>
		{% endfor %}
		
		<label for="PRIX">Prix : </label>
		<input class="form-control" id="PRIX" name="PRIX" >
		
		<label for="ETAT_FACTURE">Etat de paiement : </label>
		<input class="form-control" id="ETAT_FACTURE" name="ETAT_FACTURE" >
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}