{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Modification d'un emplacement
{% endblock %}
	
{% block header %}
	Modification d'un emplacement
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/locations/modify/confirm/{{id.loc_id}}">
	
		<label for="loc_sec_id">Secteur : </label>
		<select id="loc_sec_id" name="sector">
		{% for sector in sectors %}
			{% if sector.sec_id == id.loc_sec_id %}
				<option value="{{sector.sec_id}}" selected="selected">{{sector.sec_name}}</option>
			{% else %}
				<option value="{{sector.sec_id}}">{{sector.sec_name}}</option>
			{% endif %}
		{% endfor %}
		</select> 
		
		
		<label for="loc_type_id">Type d'emplacement : </label>
		<select id="loc_type_id" name="location">
		{% for typeLocation in typeLocations %}
			{% if typeLocation.type_location_id == id.loc_type_id %}
				<option value="{{typeLocation.type_location_id}}" selected="selected">{{typeLocation.type_location_name}}</option>
			{% else %}
				<option value="{{typeLocation.type_location_id}}">{{typeLocation.type_location_name}}</option>
			{% endif %}
		{% endfor %}
		</select>	
		<button type="submit" class="btn btn-default">Modifier la leçon</button>
	</form>
{% endblock %}