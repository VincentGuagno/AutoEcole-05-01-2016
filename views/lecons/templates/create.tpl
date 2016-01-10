{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Création d'un emplacement
{% endblock %}
	
{% block header %}
	Création d'un emplacement
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/locations/add/confirm">
		
		<label for="loc_sec_id">Secteur : </label>
		<select id="loc_sec_id" name="sector">
		{% for sector in sectors %}
		<option value="{{sector.sec_id}}">{{sector.sec_name}}</option>
		{% endfor %}
		</select> 
		
		
		<label for="loc_type_id">Type d'emplacement : </label>
		<select id="loc_type_id" name="location">
		{% for typeLocation in typeLocations %}
		<option value="{{typeLocation.type_location_id}}">{{typeLocation.type_location_name}}</option>
		{% endfor %}
		</select> 
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}