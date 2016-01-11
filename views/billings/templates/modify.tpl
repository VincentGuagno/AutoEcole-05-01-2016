{# views/rentals/templates/displayId.tpl #}
	{%extends "layout.tpl" %}

{% block header %}
Modification de la facturation
{% endblock %}

{% block title %}
Modification de la facturation
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


<form method="post" ACTION="/AutoEcole-05-01-2016/billings/modify/confirm/{{{billing.PK_FACTURATION}}">
		
		<strong>Date de facturation :</strong></br>
		<input class="form-control" type="text" id="DATE_FACTURE" name="DATE_FACTURE" value=""></br>
		<strong>Type de facturation : </strong></br>
		<select id="FK_TYPE_FACTURE" name="FK_TYPE_FACTURE">
		{% for billingType in billingTypes %}
		<option value="{{billingType.PK_TYPE_FACTURE}}" placeholder="{{billingType.LIBELLE}}">{{billingType.LIBELLE}}</option>
		{% endfor %}
		</select>
		</br></br>

		<strong>Nom de l'élève : </strong></br>
		<select id="FK_ELEVE" name="FK_ELEVE">
		{% for student in students %}
		<option value="{{student.PK_ELEVE}}" placeholder="{{student.NOM}} {{student.PRENOM}}">{{student.NOM}} {{student.PRENOM}}</option>
		{% endfor %}
		</select>
		</br></br>
		
		<label for="PRIX">Prix : </label>
		<input class="form-control" id="PRIX" name="PRIX" PRIX="{{billing.PRIX_ACHAT}}" placeholder="{{billing.PRIX_ACHAT}}">
		</br>
		
		<label for="ETAT_FACTURE">Etat du paiement : </label>
		<input class="form-control" id="ETAT_FACTURE" name="ETAT_FACTURE" ETAT_FACTURE="{{billing.PRIX_ACHAT}}" placeholder="{{billing.PRIX_ACHAT}}">
		</br>
		<button type="submit" class="btn btn-default">Modifier la facturation</button>
	</form>