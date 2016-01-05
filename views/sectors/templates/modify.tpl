{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Modification de secteur
{% endblock %}
	
{% block header %}
	Modification de secteur
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/sectors/modify/confirm/{{sector.sec_id}}">
		
		<label for="sec_name">Nom de secteur : </label>
		<input class="form-control" id="sec_name" name="sec_name" value="{{sector.sec_name}}" placeholder="{{sector.sec_name}}">
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}