{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Création d'une saison
{% endblock %}

{% block title %}
Création d'une saison
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/seasons/add/confirm">
		
		<label for="seas_name">Nom de saison : </label>
		<input class="form-control" id="seas_name" name="name" >
		
		</br>
		<strong>Date de début:</strong></br>     
		<input class="form-control" type="date" id="beginDate" name="beginDate" placeholder="{{rental.rent_begin}}" value=""/></br>
		<div class = "form-group">
		
		<strong>Date de fin:</strong></br>     
		<input class="form-control" type="date" id="endDate" name="endDate" placeholder="{{rental.rent_end}}" value=""/></br>
		</div>
		
		
		<label for="coefficient">Coefficient : </label>
		<input class="form-control" id="coefficient" name="coefficient" >
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}