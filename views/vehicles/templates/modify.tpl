{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification d'un vehicule
{% endblock %}

{% block title %}
Modification d'un vehicule
{% endblock %}

{% block content %}	

	<form method="post" ACTION="/AutoEcole-05-01-2016/vehicles/modify/confirm/{{vehicle.PK_VEHICULE}}">
		
		<label for="NUMERO">Immatriculation : </label>
		<input class="form-control" id="NUMERO" name="NUMERO" value="{{vehicle.NUMERO}}" placeholder="{{vehicle.NUMERO}}">
		</br>
		
		<label for="KM">Kilométrage : </label>
		<input class="form-control" id="KM" name="KM" value="{{vehicle.KM}}" placeholder="{{vehicle.KM}}">
		</br>
		
		<label for="DATE_ACHAT">Date achat : </label>
		<input class="form-control" id="DATE_ACHAT" name="DATE_ACHAT" value="{{vehicle.DATE_ACHAT}}" placeholder="{{vehicle.DATE_ACHAT}}">
		</br>
		
		<label for="PRIX_ACHAT">Prix achat : </label>
		<input class="form-control" id="PRIX_ACHAT" name="PRIX_ACHAT" value="{{vehicle.PRIX_ACHAT}}" placeholder="{{vehicle.PRIX_ACHAT}}">
		</br>
		
		<strong>Marque</strong>
		</br>
		<select id="FK_MARQUE" name="FK_MARQUE">
		{% for brand in brands %}
		<option value="{{brand.PK_MARQUE}}" placeholder="{{brand.PK_MARQUE}}">{{brand.NOM}}</option>
		{% endfor %}
		</select>
		</br>

		<strong>Modèle</strong>
		</br>
		<select id="FK_MODELE" name="FK_MODELE">
		{% for model in models %}
		<option value="{{model.PK_MODELE}}" placeholder="{{model.PK_MODELE}}">{{model.NOM_MODELE}}</option>
		{% endfor %}
		</select>
		</br>

		<strong>Moniteur</strong>
		</br>
		<select id="FK_MONITEUR" name="FK_MONITEUR">
		{% for instructor in instructors %}
		<option value="{{instructor.PK_MONITEUR}}" placeholder="{{instructor.PK_MONITEUR}}">{{instructor.SURNOM}}</option>
		{% endfor %}
		</select>
		</br>
		<button type="submit" class="btn btn-default">Modifier le véhicule </button>
	</form>
{% endblock %}

