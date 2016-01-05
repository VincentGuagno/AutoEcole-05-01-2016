{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification d'une saison 
{% endblock %}

{% block title %}
Modification d'une saison 
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/Cas-M-Ping/seasons/modify/confirm/{{season.seas_id}}">
		
		<label for="name">Nom de saison : </label>
		<input class="form-control" id="name" name="name" value="{{season.seas_name}}" placeholder="{{season.seas_name}}">
		</br>
		<strong>Date de début:</strong></br>     
		<input class="form-control" type="date" id="beginDate" name="beginDate" value="{{season.seas_start_date}}" placeholder="{{season.seas_start_date}}"/></br>
		<div class = "form-group">
		
		<strong>Date de fin:</strong></br>     
		<input class="form-control" type="date" id="endDate" name="endDate" value="{{season.seas_end_date}}" placeholder="{{season.seas_end_date}}"/></br>
		</div>
		
		<label for="coefficient">Coefficient : </label>
		<input class="form-control" id="coefficient" name="coefficient" value="{{season.seas_coeff}}" placeholder="{{season.seas_coeff}}">
		
		<button type="submit" >Modifier</button>
	</form>
{% endblock %}