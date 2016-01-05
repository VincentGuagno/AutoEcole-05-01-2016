{# views/sectors/templates/display.tpl #}
	{%extends "layout.tpl" %}

{% block title %}
	Ajout de secteur
{% endblock %}
	
{% block header %}
	Ajout de secteur
{% endblock %}

{% block content %}
	<form method="post" ACTION="/Cas-M-Ping/sectors/add/confirm">
		
		<label for="sec_name">Nom de secteur : </label>
		<input class="form-control" id="sec_name" name="sec_name">
		
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}