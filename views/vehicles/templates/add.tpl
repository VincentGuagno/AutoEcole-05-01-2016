{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Ajout d'un véhicule
{% endblock %}

{% block title %}
Ajout d'un véhicule
{% endblock %}

{% block content %}
	
	<form method="post" ACTION="/AutoEcole-05-01-2016/vehicles/add/confirm">
		
		<label for="NUMERO">Immatriculation : </label>
		<input class="form-control" id="NUMERO" name="NUMERO" >
		
		<label for="KM">Kilométrage : </label>
		<input class="form-control" id="KM"name="KM" >
		
		<label for="DATE_ACHAT">Date achat : </label>
		<input class="form-control" id="DATE_ACHAT"name="DATE_ACHAT" >
		
		<label for="PRIX_ACHAT">Prix achat : </label>
		<input class="form-control" id="PRIX_ACHAT"name="PRIX_ACHAT" >
		
		<select id="FK_MARQUE" name="FK_MARQUE">
		{% for brand in brands %}
		<option value="{{brand.PK_MARQUE}}">{{brand.NOM}}</option>
		{% endfor %}
		</select>
		<select id="FK_MODELE" name="FK_MODELE">
		{% for model in models %}
		<option value="{{model.PK_MODELE}}">{{model.NOM_MODELE}}</option>
		{% endfor %}
		</select>
		<select id="FK_MONITEUR" name="FK_MONITEUR">
		{% for instructor in instructors %}
		<option value="{{instructor.PK_MONITEUR}}">{{instructor.SURNOM}}</option>
		{% endfor %}
		</select>
		<button type="submit" class="btn btn-default">Envoyer</button>
	</form>
{% endblock %}